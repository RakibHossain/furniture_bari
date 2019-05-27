<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
		$this->load->model('PaymentModel');
	}

	public function LoginCheck()
	{
		$getSessVal = $this->session->get_userdata();

		if(isset($getSessVal['logged_in']))
		{
    		redirect('admin/dashboard');
		}

	}

	public function LogoutCheck()
	{
		$getSessVal = $this->session->get_userdata();

		if(!isset($getSessVal['logged_in']))
		{
    		redirect('admin/login');
		}

	}

	public function UserRole()
	{
		$getSessVal = $this->session->get_userdata();

		if(isset($getSessVal['logged_in']))
		{
    		return $getSessVal['logged_in']['role'];
		}

	}

	public function index()
	{
		$this->LoginCheck();
		$this->LogoutCheck();
	}

	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	/*
	*
	* Code Start For Payment
	*
	*/
	public function sendSMS(Array $sms_info)
	{
		$date 	   = $sms_info['date'];
		$user_name = $sms_info['user_name'];
		$amount    = $sms_info['amount'];
		$account   = $sms_info['account'];

		$to 	 = "01670733133,01885936456";
		$message = "Payment Entry. Date: $date, User: $user_name, Amount: $amount, Account: $account.";

	    //send sms
		$send_sms = sendSMS($to, $message);
	}

	public function paymentType()
	{
		$data['title'] = 'Payment Type';
		$data['page'] = 'payments/payment_type';
		$data['type'] = 'new_payment_type';
		$data['types'] = $this->PaymentModel->fetchPaymentType();	

		$this->load->view('layouts/master', $data);
	}

	public function insertPaymentType()
	{
		$post_payment_type = $this->input->post();
		$this->PaymentModel->insertPaymentType($post_payment_type);

		return redirect('admin/payment/type');
	}

	public function editPaymentType($id='')
	{
		$data['title'] = 'Item';
		$data['page'] = 'payments/payment_type';
		$data['type'] = 'edit_payment_type';
		$data['edit_payment_type_id'] = $id;
		$data['edit_payment_type'] = $this->PaymentModel->fetchEditPaymentType($id);

		$this->load->view('layouts/master', $data);
	}

	public function updatePaymentType($id='')
	{	
		$update_payment_type = $this->input->post();
		$this->PaymentModel->updatePaymentType($update_payment_type, $id);

		return redirect('admin/payment/type');
	}

	public function deletePaymentType($id='')
	{
		$this->PaymentModel->deletePaymentType($id);

		return redirect('admin/payment/type');
	}

	public function getPayment($type='', $id='')
	{
		$this->LogoutCheck();

		if($type == 'list')
		{
			$data['title'] = 'Payment List';
			$data['page']  = 'payments/payment_list';
			$data['data']  = $this->PaymentModel->getPayment();
			$data['role']  = $this->UserRole();
		}
		else if($type == 'edit')
		{
			$data['title'] 		= 'Edit Payment';
			$data['type'] 		= 'edit';
			$data['page'] 		= 'payments/create_payment';
			$data['data'] 		= $this->PaymentModel->PaymentEditData($id);
			$data['order_list'] =  $this->PaymentModel->InvoiceSelectList();
			$data['accounts'] 	= $this->PaymentModel->getAccount();
			$data['types'] 		= $this->PaymentModel->fetchPaymentType();

			if($_POST)
			{
				$this->EditPaymentSave($_POST, $id);
				return false;
			}

		}
		else if($type == 'delete')
		{
			$data = ['status'=>'0'];
			$this->db->where('id',$_POST['id']);
			$this->db->update('ji_payment',$data);
			echo 'ok';

			return false;
		}
		else
		{
			$data['title'] = 'New Payment';
			$data['type'] = 'new';
			$data['page'] = 'payments/create_payment';
			$data['order_list'] = $this->PaymentModel->InvoiceSelectList();
			$data['accounts'] = $this->PaymentModel->getAccount();
			$data['types'] = $this->PaymentModel->fetchPaymentType();

			if($_POST)
			{
				$this->NewPaymentSave($_POST);
				return false;
			}

		}

		$this->load->view('layouts/master', $data);
	}

	private function NewPaymentSave($data)
	{
		$detailsFormat = [];
		$data['date']  = $this->DateConvertFormTODB($data['date']);
		$saveStatus    = $this->PaymentModel->SavePayment($data);

		$user_id = $this->session->userdata['logged_in']['id'];
		$user 	 = $this->PaymentModel->getUser($user_id);

		$account = $this->PaymentModel->getAccountAccessType($data['account_name']);

		if ($account[0]->access_type != $user[0]->role) 
		{
			$sms_info = [
				'date' 		=> $data['date'],
				'user_name' => $user[0]->name,
				'account'   => $data['account_name'],
				'amount'    => $data['amount']
			];

			$this->sendSMS($sms_info);
		}

		if($saveStatus)
		{
			redirect("admin/payment/list", "refresh");
		}
		else
		{
     		redirect("admin/payment", "refresh");
		}
		
	}

	private function EditPaymentSave($data, $id)
	{
		$detailsFormat = [];

		if (isset($data['receive_status'])) {
			$data['receive_status'] = 1;
		} else {
			$data['receive_status'] = 0;
		}

		$data['date'] = $this->DateConvertFormTODB($data['date']);
		$saveStatus	  = $this->PaymentModel->EditPayment($data, $id);

		if($saveStatus)
		{
     		redirect("admin/payment/edit/$id", 'refresh');
		}
		else
		{
     		redirect('admin/payment/list', 'refresh');
		}
		
	}
	
	public function getPaymentReport()
	{
		$this->LogoutCheck();
		$this->load->library('pagination');

		$config = [

			'base_url' 		  => base_url('admin/reports/payment'),
			'total_rows' 	  => $this->PaymentModel->count_payment_num_rows(),
			'per_page' 		  => 300,
			'full_tag_open'	  => "<ul class='pagination pagination-lg'>",
			'full_tag_close'  => "</ul>",
			'first_tag_open'  => "<li>",
			'first_tag_close' => "</li>",
			'last_tag_open'	  => "<li>",
			'last_tag_close'  => "</li>",
			'next_tag_open'	  => "<li>",
			'next_tag_close'  => "</li>",
			'prev_tag_open'	  => "<li>",
			'prev_tag_close'  => "</li>",
			'num_tag_open'	  => "<li>",
			'num_tag_close'	  => "</li>",
			'cur_tag_open'	  => "<li class='active'><a>",
			'cur_tag_close'	  => "</a></li>",

		];

		$limit = $config['per_page'];
		$offset = $this->uri->segment(4, 0);

		$data['title'] = 'Payment Report';
		$data['page'] = 'payments/payment_report';
		$this->pagination->initialize($config);
		$data['data'] = $this->PaymentModel->getPaymentReport($limit, $offset);

		$this->load->view('layouts/master', $data);
	}

	public function getPaymentGraphReport()
	{
		$this->LogoutCheck();
		$year = date('Y');

		$data['title'] = "Payment Graph Report ($year)";
		$data['page'] = "payments/payment_graph_report";
		$data['data'] = $this->PaymentModel->getPaymentGraphReport();

		$this->load->view('layouts/master', $data);
	}

	public function getPaymentSummeryReport($type='', $month='', $year='')
	{
		$this->LogoutCheck();

		if($type == 'current')
		{
			$month = date('m');
			$year = date('Y');	
		}
		else if($type == 'prev')
		{
			if($month > 0)
		    {
		      	$month--;
		      	
		      	if ($month == 0) 
		      	{
		      		$year--;
		      		$month = 12;
		      	}

		    }

		}
		else if($type == 'next')
		{	
			if($month <= 12)
		    {
		      	$month++;

		      	if ($month == 13) 
		      	{
		      		$year++;
		      		$month = 1;
		      	}

		    }

		}

		$data['title'] = "Payment Summery Report ( $year-$month )";
		$data['page'] = 'payments/payment_summery_report';
		$data['month'] = $month;
		$data['year'] = $year;
		$data['data'] = $this->PaymentModel->getPaymentSummeryReport($month, $year);

		$this->load->view('layouts/master', $data);
	}

}
