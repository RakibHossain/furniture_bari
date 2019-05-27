<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

		$this->load->model('UserModel');
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

	public function userType()
	{
		$data['title'] = 'User Type';
		$data['page'] = 'user/user_type';
		$data['user_types'] = $this->UserModel->fetchUserType();

		$this->load->view('layouts/master', $data);
	}

	public function createUserType()
	{
		$data['title'] = 'User Type';
		$data['page'] = 'user/create_user_type';
		$data['type'] = 'new';

		$this->load->view('layouts/master', $data);
	}

	public function insertUserType()
	{
		$new_user_type = $this->input->post();
		$this->UserModel->insertUserType($new_user_type);

		return redirect('admin/user/type');
	}

	public function editUserType($id='')
	{
		$data['title'] = 'User Type';
		$data['page'] = 'user/create_user_type';
		$data['type'] = 'edit';
		$data['edit_user_type_id'] = $id;
		$data['edit_user_type'] = $this->UserModel->fetchEditUserType($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateUserType($id='')
	{	
		$update_user_type = $this->input->post();
		$this->UserModel->updateUserType($update_user_type, $id);

		return redirect('admin/user/type');
	}

	/*public function deleteUserType($id='')
	{
		$this->UserModel->deleteUserType($id);

		return redirect('admin/user/type');
	}*/

	public function user()
	{
		$data['title'] = 'User';
		$data['page'] = 'user/user';
		$data['users'] = $this->UserModel->fetchUser();

		$this->load->view('layouts/master', $data);
	}

    public function createUser()
	{
		$data['title'] = 'User';
		$data['page'] = 'user/create_user';
		$data['type'] = 'new';
		$data['user_types'] = $this->UserModel->fetchUserType();

		$this->load->view('layouts/master', $data);
	}

	public function insertUser()
	{
		$post_new_user = $this->input->post();
		$post_new_user['password'] = MD5($post_new_user['password']);
		$this->UserModel->insertUser($post_new_user);

		return redirect('admin/user');
	}

	public function editUser($id='')
	{
		$data['title'] = 'User';
		$data['page'] = 'user/create_user';
		$data['type'] = 'edit';
		$data['edit_user_id'] = $id;
		$data['edit_user'] = $this->UserModel->fetchEditUser($id);
		$data['user_types'] = $this->UserModel->fetchUserType();

		$this->load->view('layouts/master', $data);
	}

	public function updateUser($id='')
	{	
		$update_user = $this->input->post();
		$update_user['password'] = MD5($update_user['password']);
		$this->UserModel->updateUser($update_user, $id);

		return redirect('admin/user');	
	}

	public function deleteUser($id='')
	{
		$this->UserModel->deleteUser($id);

		return redirect('admin/user');
	}

	public function getUserActivity()
	{
		$this->LogoutCheck();
		$this->load->library('pagination');

		$config = [

			'base_url' 			=> base_url('user/activity'),
			'total_rows' 		=> $this->UserModel->count_user_activity_num_rows(),
			'per_page' 			=> 500,
			'full_tag_open'		=> "<ul class='pagination pagination-lg'>",
			'full_tag_close'	=> "</ul>",
			'first_tag_open'	=> "<li>",
			'first_tag_close'	=> "</li>",
			'last_tag_open'		=> "<li>",
			'last_tag_close'	=> "</li>",
			'next_tag_open'		=> "<li>",
			'next_tag_close'	=> "</li>",
			'prev_tag_open'		=> "<li>",
			'prev_tag_close'	=> "</li>",
			'num_tag_open'		=> "<li>",
			'num_tag_close'		=> "</li>",
			'cur_tag_open'		=> "<li class='active'><a>",
			'cur_tag_close'		=> "</a></li>",

		];

		$limit = $config['per_page'];
		$offset = $this->uri->segment(3, 0);

		$data['title'] = 'User activity';
		$data['page'] = 'user/user_activity';
		$this->pagination->initialize($config);
		$data['user_activities'] = $this->UserModel->getUserActivity($limit, $offset);

		$this->load->view('layouts/master', $data);
	}

}
