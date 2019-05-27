<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MenuController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

		$this->load->model('MenuModel');
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

    public function createMenu()
	{
		$data['title'] = 'Menu';
		$data['page']  = 'menu/create_menu';
		$data['type']  = 'new';
		$data['menus'] = $this->MenuModel->getMenu();

		$this->load->view('layouts/master', $data);
	}

	public function insertMenu()
	{
		$data = $this->input->post();
		$data['name'] = $data['name'];
		$this->MenuModel->insertMenu($data);

		return redirect('admin/create/menu');
	}

	public function editMenu($id='')
	{
		$data['title'] 		  = 'Menu';
		$data['page']  		  = 'menu/create_menu';
		$data['type']  		  = 'edit';
		$data['edit_menu_id'] = $id;
		$data['edit_menu'] 	  = $this->MenuModel->getEditMenu($id);
		$data['menus'] 		  = $this->MenuModel->getMenu();

		$this->load->view('layouts/master', $data);
	}

	public function updateMenu($id='')
	{	
		$data = $this->input->post();
		$data['name'] = $data['name'];
		$this->MenuModel->updateMenu($data, $id);

		return redirect('admin/create/menu');
	}

	public function deleteMenu($id='')
	{
		$this->MenuModel->deleteMenu($id);
		return redirect('admin/create/menu');
	}

	public function createSubMenu()
	{
		$data['title'] 	   = 'SubMenu';
		$data['page']  	   = 'menu/create_sub_menu';
		$data['type']  	   = 'new';
		$data['menus'] 	   = $this->MenuModel->getMenu();
		$data['sub_menus'] = $this->MenuModel->getSubMenu();

		$this->load->view('layouts/master', $data);
	}

	public function insertSubMenu()
	{
		$data = $this->input->post();

		$data = [
			'ji_parent_menu_id' => $data['menu_id'],
			'name' 				=> $data['name'],
			'url'				=> $data['url']
		];

		$this->MenuModel->insertSubMenu($data);

		return redirect('admin/create/submenu');
	}

	public function editSubMenu($id='')
	{
		$data['title'] 		  	  = 'Sub Menu';
		$data['page']  		  	  = 'menu/create_sub_menu';
		$data['type']  		  	  = 'edit';
		$data['edit_sub_menu_id'] = $id;
		$data['edit_sub_menu'] 	  = $this->MenuModel->getEditSubMenu($id);
		$data['menus'] 		  	  = $this->MenuModel->getMenu();
		$data['sub_menus'] 		  = $this->MenuModel->getSubMenu();

		$this->load->view('layouts/master', $data);
	}

	public function updateSubMenu($id='')
	{	
		$data = $this->input->post();

		$data = [
			'ji_parent_menu_id' => $data['menu_id'],
			'name' 				=> $data['name'],
			'url'				=> $data['url']
		];

		$this->MenuModel->updateSubMenu($data, $id);

		return redirect('admin/create/submenu');
	}

	public function deleteSubMenu($id='')
	{
		$this->MenuModel->deleteSubMenu($id);
		return redirect('admin/create/submenu');
	}

	public function getMenuPermission()
	{
		$data['title'] 	   = 'Menu Permission';
		$data['page']  	   = 'menu/menu_permission';
		$data['type']  	   = 'new';
		// $data['menus'] 	   = $this->MenuModel->getMenu();
		// $data['sub_menus'] = $this->MenuModel->getSubMenu();

		$this->load->view('layouts/master', $data);
	}

}
