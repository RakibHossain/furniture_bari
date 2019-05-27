<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ExpanseController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url');
		$this->load->model('ExpanseModel');
		$this->load->helper('form');
		
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

	public function expanse($type='')
	{
		$data['title'] = 'Expense';
		$data['page'] = 'expanse/expanse';
		$data['type'] = $type;
		$data['expanses'] = $this->ExpanseModel->fetchExpanse();
		$data['expanse_categories'] = $this->ExpanseModel->fetchExpanseCategory();

		$this->load->view('layouts/master', $data);
	}

	public function insertExpanse($type='')
	{
		if ($type == 'category') 
		{
			$post_expanse_categories = $this->input->post();
			$this->ExpanseModel->insertExpanseCategory($post_expanse_categories);

			return redirect('admin/expanse');
		} 
		else 
		{
			$post_expanses = $this->input->post();
			$this->ExpanseModel->insertExpanse($post_expanses);

			return redirect('admin/expanse');
		}
		
	}

	public function editExpanse($id='')
	{
		$data['title'] = 'Expense';
		$data['page'] = 'expanse/expanse';
		$data['type'] = 'edit_expanse';
		$data['edit_expanse_id'] = $id;
		$data['edit_expanse'] = $this->ExpanseModel->fetchEditExpanse($id);
		$data['expanse_categories'] = $this->ExpanseModel->fetchExpanseCategory();

		$this->load->view('layouts/master', $data);
	}

	public function updateExpanse($id='')
	{	
		$update_expanse = $this->input->post();

		$this->ExpanseModel->updateExpanse($update_expanse, $id);

		return redirect('admin/expanse');
	}

	public function deleteExpanse($id='')
	{
		$status = $this->ExpanseModel->deleteExpanse($id);

		return redirect('admin/expanse');
	}

	public function createNewExpanse()
	{
		$data['title'] = 'Expense';
		$data['page'] = 'expanse/create_new_expanse';
		$data['type'] = "";
		$data['expanses'] = $this->ExpanseModel->fetchExpanseName();
		$data['expanse_categories'] = $this->ExpanseModel->fetchExpanseCategory();
		$data['accounts'] = $this->ExpanseModel->fetchAccount();

		$this->load->view('layouts/master', $data);
	}

	public function insertNewExpanse()
	{
		$post_new_expanses = $this->input->post();
		//$post_new_expanses['date'] = $this->DateConvertFormTODB($post_new_expanses['date']);
		$this->ExpanseModel->insertNewExpanse($post_new_expanses);

		return redirect('admin/expanse/list');
	}

	public function editNewExpanse($id='')
	{
		$data['title'] = 'Expense';
		$data['page'] = 'expanse/create_new_expanse';
		$data['type'] = 'edit';
		$data['edit_new_expanse'] = $this->ExpanseModel->fetchEditNewExpanse($id);
		$data['expanses'] = $this->ExpanseModel->fetchExpanseName();
		$data['expanse_categories'] = $this->ExpanseModel->fetchExpanseCategory();
		$data['accounts'] = $this->ExpanseModel->fetchAccount();

		$this->load->view('layouts/master', $data);
	}

	public function updateNewExpanse($id='')
	{	
		$update_new_expanse = $this->input->post();
		$this->ExpanseModel->updateNewExpanse($update_new_expanse, $id);

		return redirect('admin/expanse/list');
	}

	public function deleteNewExpanse($id='')
	{
		$status = $this->ExpanseModel->deleteNewExpanse($id);

		return redirect('admin/expanse/list');
	}

	public function editExpanseCategory($id='')
	{
		$data['title'] = 'Expense';
		$data['page'] = 'expanse/expanse';
		$data['type'] = 'edit_category';
		$data['edit_category_id'] = $id;
		$data['edit_expanse_category'] = $this->ExpanseModel->fetchEditExpanseCategory($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateExpanseCategory($id='')
	{	
		$update_expanse_category = $this->input->post();

		$this->ExpanseModel->updateExpanseCategory($update_expanse_category, $id);

		return redirect('admin/expanse/category');
	}

	public function deleteExpanseCategory($id='')
	{
		$status = $this->ExpanseModel->deleteExpanseCategory($id);

		return redirect('admin/expanse');
	}

	public function expanseList()
	{
		$this->load->library('pagination');

		$config = [

				'base_url' 			=> base_url('admin/expanse/list'),
				'total_rows' 		=> $this->ExpanseModel->count_new_expanse_num_rows(),
				'per_page' 			=> 300,
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
		$offset = $this->uri->segment(4, 0);
		$this->pagination->initialize($config);

		$data['title'] = 'Expense List';
		$data['page'] = 'expanse/expanse_list';
		$data['users'] = $this->ExpanseModel->fetchUserType();
		$data['expanses'] = $this->ExpanseModel->fetchExpanseList($limit, $offset);

		$this->load->view('layouts/master', $data);
	}

	public function getExpenseListDetails()
	{
		$this->load->library('pagination');

		$config = [

				'base_url' 			=> base_url('admin/expanse/list/details'),
				'total_rows' 		=> $this->ExpanseModel->count_new_expanse_details_num_rows(),
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
		$offset = $this->uri->segment(5, 0);
		$this->pagination->initialize($config);

		$data['title'] = 'Expense List Details';
		$data['page'] = 'expanse/expanse_list_details';
		$data['expanses'] = $this->ExpanseModel->getExpenseListDetails($limit, $offset);

		$this->load->view('layouts/master', $data);
	}

	public function expanseReport($type='')
	{
		if($type == 'current')
		{
			$month = date('m');
			$year = date('Y');
			
		}
		else if($type == 'prev')
		{
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			
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
			$year = $this->input->post('year');

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

		$data['title'] = "Expense Report ( $year-$month )";
		$data['page'] = 'expanse/expanse_report';
		$data['month'] = $month;
		$data['year'] = $year;
		$data['expanse_reports'] = $this->ExpanseModel->fetchExpanseReport($month, $year);

		$this->load->view('layouts/master', $data);
	}

	public function expanseReportDetails($type='')
	{
		$data['title'] = 'Expense';
		$data['page'] = 'expanse/expanse_report_details';
		$data['type'] = $type;
		$date = $_GET['date'];
		$data['expanse_categories'] = $this->ExpanseModel->fetchExpanseReportCategory($type);
		$data['expanse_report_details'] = $this->ExpanseModel->fetchExpanseReportDetails($date);

		$this->load->view('layouts/master', $data);
	}

	public function expanseSummeryReport($type)
	{
		$data['title'] = 'Expense Summery Report';
		$data['page'] = 'expanse/expanse_summery_report';
		$data['type'] = $type;

		if ($type == 'new') 
		{
			$data['expense_names'] = $this->ExpanseModel->fetchExpanse();
			$data['expense_categories'] = $this->ExpanseModel->fetchExpanseCategory();
		}
		else
		{
			$post_expense_summery_reports = $this->input->post();
			
			$data['expense_names'] = $this->ExpanseModel->fetchExpanse();
			$data['expense_categories'] = $this->ExpanseModel->fetchExpanseCategory();
			$data['expense_summery_reports'] = $this->ExpanseModel->fetchExpenseSummeryReport($post_expense_summery_reports);
		}

		$this->load->view('layouts/master', $data);
	}

}
