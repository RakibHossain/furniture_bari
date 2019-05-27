<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MarketingController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
        $this->load->helper('sendsms');
		$this->load->model('MarketingModel');
	}

	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
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

	public function viewSendMarketingSMS()
	{
		if (!empty($this->input->get('menu_id'))) 
		{
			$menu_id = $this->input->get('menu_id');
			$this->session->set_userdata('menu_id', $menu_id);
		}

		$data['title'] = 'SMS Marketing';
		$data['page']  = 'marketing/send_marketing_sms';
		$data['type']  = 'new';

		$this->load->view('layouts/master', $data);
	}

	public function viewSendSingleSMS()
	{
		if (!empty($this->input->get('menu_id'))) 
		{
			$menu_id = $this->input->get('menu_id');
			$this->session->set_userdata('menu_id', $menu_id);
		}

		$data['title']   = 'Send SMS';
		$data['page']    = 'marketing/send_sms';
		$data['type']    = 'new';

		$this->load->view('layouts/master', $data);
	}

	public function sendMarketingSMS()
	{
		$sms_data = $this->input->post();
		$menu_id  = $this->session->userdata('menu_id');
		$user_id  = $this->session->userdata['logged_in']['id'];

		// $to_customer  = $sms_data['to_customer'];
		$subject  	  = $sms_data['subject'];
		$greeting 	  = $sms_data['greeting'];
		$message_body = $sms_data['message'];

		// $customers = $this->MarketingModel->getCustomer($to_customer);
		// foreach ($customers as $key => $customer) 
		// {
		// 	$mobile_no = str_replace([' ', ',', '/'], '', $customer->mobile_no);
		// 	$to 	   = substr($mobile_no, 0, 11);
		// 	$message   = "$greeting $customer->customer_name, $message_body";
		// 	$send_sms  = sendSMS($to, $message);	// send sms
		// }

		$customers = [
			0 => 'Hossain',
			1 => 'Imam',
			2 => 'Rakib'
		];
		$total = count($customers);
		foreach ($customers as $key => $customer) 
		{
			$percent = intval((++$key * 100) / $total);

			// $to 	   = "01673120069,01303042783";
			// $message   = "$greeting $customer[$key], $message_body";
			// $send_sms  = sendSMS($to, $message);	// send sms

			echo json_encode($percent);
		}

		// if ($send_sms == true) 
		// {
		// 	$data = [
		// 		'ji_user_id'   	=> $user_id,
		// 		'subject' 	   	=> $subject,
		// 		'message' 	   	=> $message,
		// 		'to_customer' 	=> $to_customer,
		// 		'send_sms_date' => date('Y-m-d')
		// 	];

		// 	$this->MarketingModel->insertMarketingSMS($data);
		// 	$this->session->set_flashdata('success_status', 'SMS has been sent successfully !');
		// } 
		// else 
		// {
		// 	$this->session->set_flashdata('error_status', 'Problem occured, please try again !');
		// }

		// return redirect("marketing/list/sms");
	}

	public function sendSingleSMS()
	{
		$sms_data = $this->input->post();
		$menu_id  = $this->session->userdata('menu_id');
		$user_id  = $this->session->userdata['logged_in']['id'];

		$message   = $sms_data['message'];
		$mobile_no = str_replace([' ', ',', '/'], '', $sms_data['to_mobile_no']);
		$to 	   = substr($mobile_no, 0, 11);

		$digit_length = strlen($to);

		if ($digit_length == 11) 
		{
			$send_sms = sendSMS($to, $message);		// send sms

			if ($send_sms == true) 
			{
				$this->session->set_flashdata('success_status', 'SMS has been sent successfully !');
			} 
			else 
			{
				$this->session->set_flashdata('error_status', 'Problem occured, please try again !');
			}

		}
		else 
		{
			$this->session->set_flashdata('error_status', 'Please enter 11 digits number and try again !');
		}

		return redirect("marketing/send/single/sms/view");
	}

	public function viewMarketingSMSList()
	{
		$data['title']     = 'SMS Marketing List';
		$data['page']      = 'marketing/marketing_sms_list';
		$data['sms_lists'] = $this->MarketingModel->getMarketingSMSList();

		$this->load->view('layouts/master', $data);
	}

}
