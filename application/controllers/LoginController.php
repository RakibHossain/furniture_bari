<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
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

	public function Login()
	{
		$this->LoginCheck();
		
		if($_POST)
		{
			$username = $_POST['username'];
			$password = MD5($_POST['password']);

			$this->db->select('id, username, password, role');
			$this->db->from('ji_user');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->where('status', '1');
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1)
			{
				$result = $query->row();

				$sess_array = [
					'id' 	   => $result->id,
					'role'     => $result->role,
					'username' => $result->username
				];

				$this->session->set_userdata('logged_in', $sess_array);
    			redirect('admin/dashboard');
			}
			else
			{
				$this->session->set_flashdata('error_status', '<strong>Invalid Username or Password !</strong> Please try again.');
    			redirect('admin/login');
			}

		}
		else
		{
			$this->load->view('login');
		}
	}

	public function Logout()
	{
    	$this->session->sess_destroy();
    	redirect('admin/login');
	}

	public function userAuth()
	{	
		if($_POST)
		{
			$userID = $_POST['userID'];

			$query = $this->db->select('*')
						->where('id', $userID)
						->where('status', '1')
						->limit(1)
						->get('ji_user');

			if($query->num_rows() == 1)
			{
				echo json_encode(1);
			}
			else
			{
				echo json_encode(0);
			}

		}

	}
	
	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	/*
	*
	* Code Start For Dashboard
	*
	*/
	public function dashboard()
	{
		$this->LogoutCheck();

		$data['title'] = 'Dashboard';
		$data['page']  = 'dashboard';

		$this->load->view('layouts/master', $data);
	}

}
