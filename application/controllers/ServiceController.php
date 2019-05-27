<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('sendsms_helper');
		$this->load->model('ServiceModel');
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

	public function sendSMS(Array $sms_info)
	{
		$to = $sms_info['mobile_no'];
		$customer_name = $sms_info['customer_name'];

		$message = "Dear sir $customer_name, thank you for contact with us. Our service team will contact within 3 working days. Service Hotline: 01885936445 Please see our warranty policy: https://bit.ly/2Ne4XlK";

	    //send sms
		$send_sms = sendSMS($to, $message);
	}

	public function getInvoiceInfo()
    {
    	$invoice_id = $this->input->post('invoice_id');
		$invoice_info = $this->ServiceModel->getInvoiceInfo($invoice_id);

		echo json_encode($invoice_info);
    }

    public function createService()
	{
		$data['title'] = 'Service';
		$data['page'] = 'service/create_service';
		$data['type'] = 'new';
		$data['invoices'] = $this->ServiceModel->getInvoice();
		$sales_items = $this->ServiceModel->fetchItem();
		$purchase_items = $this->ServiceModel->fetchPurchaseItem();

		$items = array_merge($sales_items, $purchase_items);

		$item_name_array = [];
		$item_code_array = [];

		foreach ($items as $item) 
		{
			$item_name_array[] = $item->item_name;
			//$item_code_array[] = $item->item_code;
		}

		$data['item_names'] = array_unique($item_name_array);
		//$data['item_codes'] = array_unique($item_code_array);
		$data['item_codes'] = $this->ServiceModel->fetchItem();

		$this->load->view('layouts/master', $data);
	}

	public function insertService()
	{
		$insert_data = $this->input->post();
		$details_data = $insert_data['details'];
		$comment_details_data = $insert_data['comment_details'];

		unset($insert_data['details']);
		unset($insert_data['comment_details']);

		$date = $this->DateConvertFormTODB($insert_data['date']);
		$followup_date = $this->DateConvertFormTODB($insert_data['followup_date']);
		$delivery_date = $this->DateConvertFormTODB($insert_data['delivery_date']);
		
		$post_new_service = [

			'ji_user_id'    => $insert_data['user_id'],
			'ji_invoice_id' => $insert_data['invoice_id'],
			'invoice_no' 	=> $insert_data['invoice_no'],
			'date' 			=> $date,
			'followup_date' => $followup_date,
			'delivery_date' => $delivery_date,
			'status'		=> $insert_data['status'],
			'due'			=> $insert_data['due'],
			'remarks'		=> $insert_data['remarks'],
			'customer_name'	=> $insert_data['customer_name'],
			'mobile_no'		=> $insert_data['mobile_no'],
			'address'		=> $insert_data['address']

		];

		$lastID = $this->ServiceModel->insertService('data', $post_new_service);

		foreach ($details_data as $key => $value) 
		{
			$post_new_service = [

				'ji_user_id'    => $insert_data['user_id'],
				'ji_service_id' => $lastID,
				'item_name'    	=> $value['item_name'],
				'item_code' 	=> $value['item_code'],
				'problem'		=> $value['problem']

			];

			if (isset($value['item_problem_status'])) {
				$post_new_service['item_problem_status'] = 1;
			} else {
				$post_new_service['item_problem_status'] = 0;
			}

			$this->ServiceModel->insertService('details_data', $post_new_service);
		}

		foreach ($comment_details_data as $key => $value) 
		{
			$post_new_service = [

				'ji_user_id'    => $insert_data['user_id'],
				'ji_service_id' => $lastID,
				'comment_date' 	=> $this->DateConvertFormTODB($value['comment_date']),
				'comment'		=> $value['comment']

			];

			$this->ServiceModel->insertService('comment_details_data', $post_new_service);
		}

		$sms_info = [
			'mobile_no'     => $insert_data['mobile_no'],
			'customer_name' => $insert_data['customer_name']
		];

		$this->sendSMS($sms_info);

		return redirect('service/list');
	}

	public function editService($id='')
	{
		$data['title'] = 'Service';
		$data['page'] = 'service/create_service';
		$data['type'] = 'edit';
		$data['data'] = $this->ServiceModel->getEditService($id);
		$data['invoices'] = $this->ServiceModel->getInvoice();

		$this->load->view('layouts/master', $data);
	}

	public function updateService($id='')
	{
		$update_data = $this->input->post();
		$details_data = $update_data['details'];
		$comment_details_data = $update_data['comment_details'];

		unset($update_data['details']);
		unset($update_data['comment_details']);

		$date = $this->DateConvertFormTODB($update_data['date']);
		$followup_date = $this->DateConvertFormTODB($update_data['followup_date']);
		$delivery_date = $this->DateConvertFormTODB($update_data['delivery_date']);
		
		$post_update_service = [

			'ji_user_id'    => $update_data['user_id'],
			'ji_invoice_id' => $update_data['invoice_id'],
			'invoice_no' 	=> $update_data['invoice_no'],
			'date' 			=> $date,
			'followup_date' => $followup_date,
			'delivery_date' => $delivery_date,
			'status'		=> $update_data['status'],
			'due'			=> $update_data['due'],
			'remarks'		=> $update_data['remarks'],
			'customer_name'	=> $update_data['customer_name'],
			'mobile_no'		=> $update_data['mobile_no'],
			'address'		=> $update_data['address']

		];

		$this->ServiceModel->updateService('data', $post_update_service, $id);

		foreach ($details_data as $key => $value) 
		{
			$post_update_service = [

				'ji_user_id'    => $update_data['user_id'],
				'ji_service_id' => $id,
				'item_name'    	=> $value['item_name'],
				'item_code' 	=> $value['item_code'],
				'problem'		=> $value['problem']

			];

			if (isset($value['item_problem_status'])) {
				$post_update_service['item_problem_status'] = 1;
			} else {
				$post_update_service['item_problem_status'] = 0;
			}

			$this->ServiceModel->updateService('details_data', $post_update_service, $id);
		}

		foreach ($comment_details_data as $key => $value) 
		{
			$post_update_service = [

				'ji_user_id'    => $update_data['user_id'],
				'ji_service_id' => $id,
				'comment_date' 	=> $this->DateConvertFormTODB($value['comment_date']),
				'comment'		=> $value['comment']

			];

			$this->ServiceModel->updateService('comment_details_data', $post_update_service, $id);
		}

		return redirect('service/list');
	}

	public function deleteService($id='')
	{
		$this->ServiceModel->deleteService($id);
		return redirect('service/list');
	}

	public function getServiceList()
	{
		$data['title'] = 'Service';
		$data['page']  = 'service/service_list';
		$data['role']  = $this->UserRole();
		$data['services'] = $this->ServiceModel->getServiceList();

		$this->load->view('layouts/master', $data);
	}

}
