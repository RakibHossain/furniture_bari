<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AccountController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('sendsms_helper');
		$this->load->model('AccountModel');	
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
		$date 	   = $sms_info['date'];
		$user_name = $sms_info['user_name'];
		$amount    = $sms_info['amount'];

		if (!empty($sms_info['from_account'])) 
		{
			$from_account = $sms_info['from_account'];
			$to_account   = $sms_info['to_account'];

			$message = "Account Transfer. Date: $date, User: $user_name, Amount: $amount, From Account: $from_account, To Account: $to_account.";
		} 
		else 
		{
			$account = $sms_info['account'];
			$message = "Account Cashinflow. Date: $date, User: $user_name, Amount: $amount, Account: $account.";
		}

		$to = "01670733133";

	    //send sms
		$send_sms = sendSMS($to, $message);
	}

	public function accountDayClose()
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/day_close';
		$data['account_balances'] = $this->AccountModel->fetchAccountBalance();

		$this->load->view('layouts/master', $data);
	}

	public function insertAccountDayClose()
	{
		$post_insert_data = $this->input->post();

		var_dump($post_insert_data);
		die();
	}

    public function createReference()
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/create_reference';
		$data['type'] = 'new_reference';
		$data['references'] = $this->AccountModel->fetchReference();

		$this->load->view('layouts/master', $data);
	}

	public function insertReference()
	{
		$post_new_reference = $this->input->post();
		$this->AccountModel->insertReference($post_new_reference);

		return redirect('account/create/reference');
	}

	public function editReference($id='')
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/create_reference';
		$data['type'] = 'edit_reference';
		$data['edit_reference_id'] = $id;
		$data['edit_reference'] = $this->AccountModel->fetchEditReference($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateReference($id='')
	{	
		$update_reference = $this->input->post();

		$this->AccountModel->updateReference($update_reference, $id);

		return redirect('account/create/reference');	
	}

	public function deleteReference($id='')
	{
		$this->AccountModel->deleteReference($id);

		return redirect('account/create/reference');
	}

	public function cashInflow()
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/cash_inflow';
		$data['cash_inflows'] = $this->AccountModel->getCashInflow();

		$this->load->view('layouts/master', $data);
	}

	public function createCashInflow()
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/create_cash_inflow';
		$data['type'] = 'new';
		$data['accounts'] = $this->AccountModel->fetchAccount();
		$data['references'] = $this->AccountModel->fetchReference();
		$data['payment_types'] = $this->AccountModel->fetchPaymentType();

		$this->load->view('layouts/master', $data);
	}

	public function insertCashInflow()
	{
		$post_new_cash_inflow = $this->input->post();
		$this->AccountModel->insertCashInflow($post_new_cash_inflow);

		$user_id = $this->session->userdata['logged_in']['id'];
		$user = $this->AccountModel->getUser($user_id);

		$account = $this->AccountModel->getAccountAccessType($post_new_cash_inflow['account_name']);

		if ($account[0]->access_type != $user[0]->role) 
		{

			$sms_info = [
				'date' 		=> $post_new_cash_inflow['date'],
				'user_name' => $user[0]->name,
				'account'   => $post_new_cash_inflow['account_name'],
				'amount'    => $post_new_cash_inflow['amount']
			];

			$this->sendSMS($sms_info);
		}

		return redirect('account/cashinflow');
	}

	public function editCashInflow($id='')
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/create_cash_inflow';
		$data['type'] = 'edit';
		$data['edit_cash_inflow_id'] = $id;
		$data['edit_cash_inflow'] = $this->AccountModel->fetchEditCashInflow($id);
		$data['accounts'] = $this->AccountModel->fetchAccount();
		$data['references'] = $this->AccountModel->fetchReference();
		$data['payment_types'] = $this->AccountModel->fetchPaymentType();

		$this->load->view('layouts/master', $data);
	}

	public function updateCashInflow($id='')
	{	
		$update_cash_inflow = $this->input->post();
		$this->AccountModel->updateCashInflow($update_cash_inflow, $id);

		return redirect('account/cashinflow');
	}

	public function deleteCashInflow($id='')
	{
		$this->AccountModel->deleteCashInflow($id);

		return redirect('account/cashinflow');
	}

	public function createAccount()
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/create_account';
		$data['accounts'] = $this->AccountModel->fetchAccount();
		$data['user_types'] = $this->AccountModel->fetchUserType();

		$this->load->view('layouts/master', $data);
	}

	public function insertAccount()
	{
		$post_new_account = $this->input->post();
		$this->AccountModel->insertAccount($post_new_account);

		return redirect('admin/account');
	}

	public function editAccount($id)
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/edit_account';
		$data['edit_account_id'] = $id;
		$data['edit_account'] = $this->AccountModel->fetchEditAccount($id);
		$data['user_types'] = $this->AccountModel->fetchUserType();

		$this->load->view('layouts/master', $data);
	}

	public function updateAccount($id='')
	{	
		$update_account = $this->input->post();
		$this->AccountModel->updateAccount($update_account, $id);

		return redirect('admin/account');
	}

	public function deleteAccount($id='')
	{
		$this->AccountModel->deleteAccount($id);

		return redirect('admin/account');
	}

	public function getAccountBalance()
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/account_balance';
		$data['account_balances'] = $this->AccountModel->fetchAccountBalance();

		$this->load->view('layouts/master', $data);
	}

	public function getAccountBalanceReports($type='')
	{
		if ($type == 'current')
		{
			$account_name = $this->input->post('account_name');
			$from_date = $this->DateConvertFormTODB($this->input->post('from_date'));
			$to_date = $this->DateConvertFormTODB($this->input->post('to_date'));

			$data['account_name'] = $account_name;
			$data['from_date'] = $from_date;
			$data['to_date'] = $to_date;
			$data['account_balance_reports'] = $this->AccountModel->getAccountBalanceReports($account_name, $from_date, $to_date);
		}

		$data['title'] = 'Account';
		$data['page'] = 'account/account_balance_reports';
		$data['type'] = $type;
		$data['accounts'] = $this->AccountModel->fetchAccount();
		
		$this->load->view('layouts/master', $data);
	}

	public function accountIncomingReports($type='')
	{
		if($type == 'current')
		{
			$month = date('m');
			$year  = date('Y');
		}
		else if($type == 'prev')
		{
			$month = $this->input->post('month');
			$year  = $this->input->post('year');
			
			if($month > 0)
		    {
		      	$month -- ;

		      	if ($month == 0) 
		      	{
		      		$year--;
		      		$month = 12;
		      	}

		    }

		}
		else if($type == 'next')
		{
			$month = $this->input->post('month');
			$year  = $this->input->post('year');
			
			if($month <= 12)
		    {
		      	$month ++ ;

		      	if ($month == 13) 
		      	{
		      		$year++;
		      		$month = 1;
		      	}

		    }

		}

		$type = 'incoming';

		$data['title'] 	  = "Account Incoming Reports ( $year-$month )";
		$data['page'] 	  = 'account/account_reports';
		$data['type'] 	  = $type;
		$data['month']    = $month;
		$data['year'] 	  = $year;
		$data['accounts'] = $this->AccountModel->fetchAccount();
		$data['account_reports'] = $this->AccountModel->fetchAccountReports($type, $month, $year);

		$this->load->view('layouts/master', $data);
	}

	public function accountOutgoingReports($type='')
	{
		if($type == 'current')
		{
			$month = date('m');
			$year  = date('Y');
			
		}
		else if($type == 'prev')
		{
			$month = $this->input->post('month');
			$year  = $this->input->post('year');
			
			if($month > 0)
		    {
		      	$month -- ;

		      	if ($month == 0) 
		      	{
		      		$year--;
		      		$month = 12;
		      	}

		    }

		}
		else if($type == 'next')
		{
			$month = $this->input->post('month');
			$year  = $this->input->post('year');
			
			if($month <= 12)
		    {
		      	$month ++ ;

		      	if ($month == 13) 
		      	{
		      		$year++;
		      		$month = 1;
		      	}

		    }

		}

		$type = 'outgoing';

		$data['title'] 	  = "Account Outgoing Reports ( $year-$month )";
		$data['page'] 	  = 'account/account_reports';
		$data['type'] 	  = $type;
		$data['month'] 	  = $month;
		$data['year'] 	  = $year;
		$data['accounts'] = $this->AccountModel->fetchAccount();
		$data['account_reports'] = $this->AccountModel->fetchAccountReports($type, $month, $year);

		$this->load->view('layouts/master', $data);
	}

	public function accountAdjustment()
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/account_adjustment';
		$data['accounts'] = $this->AccountModel->fetchAccount();
		$data['account_adjustments'] = $this->AccountModel->fetchAccountBalance();

		$this->load->view('layouts/master', $data);
	}

	public function insertAccountAdjustment()
	{
		$post_account_adjustment = $this->input->post();
		$this->AccountModel->insertAccountAdjustment($post_account_adjustment);

		return redirect('admin/account/adjustment');
	}

	public function accountWithdraw($type='')
	{
		$data['title'] = 'Account';
		$data['page'] = 'account/account_withdraw';
		$data['accounts'] = $this->AccountModel->fetchAccount();
		$data['withdraws'] = $this->AccountModel->fetchWithdraw();
		//$data['account_balances'] = $this->AccountModel->fetchAccountBalance();

		if ($type == 'insert') 
		{
			$account_withdraw = $this->input->post();
			$this->AccountModel->accountWithdrawInsert($account_withdraw);

			return redirect('admin/account/withdraw');
		}

		$this->load->view('layouts/master', $data);
	}

	public function getTransferAccount()
	{
		$data['title'] 			  = 'Transfer';
		$data['page'] 			  = 'account/transfer_account';
		$data['accounts'] 		  = $this->AccountModel->fetchAccount();
		$data['transfer_reports'] = $this->AccountModel->getTransferReport();

		$this->load->view('layouts/master', $data);
	}

	public function insertTransferAccount()
	{
		$post_transfer_account = $this->input->post();
		$post_transfer_account['date'] = $this->DateConvertFormTODB($post_transfer_account['date']);
		$status = $this->AccountModel->insertTransferAccount($post_transfer_account);

		$user_id = $this->session->userdata['logged_in']['id'];
		$user 	 = $this->AccountModel->getUser($user_id);

		$sms_info = [
			'date' 		   => $post_transfer_account['date'],
			'user_name'    => $user[0]->name,
			'from_account' => $post_transfer_account['from_account'],
			'to_account'   => $post_transfer_account['to_account'],
			'amount'       => $post_transfer_account['amount']
		];

		$this->sendSMS($sms_info);

		if ($status == true) 
		{
			$this->session->set_flashdata('success_status', 'Balance Successfully Transferred !');
		} 
		else 
		{
			$this->session->set_flashdata('error_status', 'Transfer was unsuccessfull !');
		}

		return redirect('account/transfer');
	}

}
