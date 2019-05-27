<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class WorkerManagementController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url', 'form');
		$this->load->model('WorkerManagementModel');
		
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

	public function showWorker()
	{
		$data['title'] = 'Worker Management';
		$data['page'] = 'worker_management/worker';
		$data['workers'] = $this->WorkerManagementModel->fetchWorker();	

		$this->load->view('layouts/master', $data);

	}

	public function insertWorkerType()
	{
		$post_worker_type = $this->input->post();
		$this->WorkerManagementModel->insertWorkerType($post_worker_type);

		return redirect('worker/create');
	}

	public function createWorker()
	{
		$data['title'] = 'Worker Management';
		$data['page'] = 'worker_management/create_worker';
		$data['type'] = 'new';
		$data['worker_types'] = $this->WorkerManagementModel->fetchWorkerType();	

		$this->load->view('layouts/master', $data);

	}

	public function insertWorker()
	{
		$post_new_worker = $this->input->post();
		$this->WorkerManagementModel->insertWorker($post_new_worker);

		return redirect('worker/workers');
	}

	public function editWorker($id='')
	{
		$data['title'] = 'Worker Management';
		$data['page'] = 'worker_management/create_worker';
		$data['type'] = 'edit';
		$data['edit_worker'] = $this->WorkerManagementModel->fetchEditWorker($id);
		$data['worker_types'] = $this->WorkerManagementModel->fetchWorkerType();	

		$this->load->view('layouts/master', $data);
	}

	public function updateWorker($id='')
	{	
		$update_worker = $this->input->post();

		$this->WorkerManagementModel->updateWorker($update_worker, $id);

		return redirect('worker/workers');
		
	}

	public function deleteWorker($id='')
	{
		$status = $this->WorkerManagementModel->deleteWorker($id);

		return redirect('worker/workers');
	}

	public function workerPayBillBalance()
    {
    	$worker_name = $this->input->post('worker_name');
		$balance = $this->WorkerManagementModel->fetchWorkerBalance($worker_name);

		echo json_encode($balance);
    }

    public function workerPayBillPOID()
    {
    	$worker_name = $this->input->post('worker_name');
		$po_ids = $this->WorkerManagementModel->fetchWorkerPOID($worker_name);
		$production_processes = $this->WorkerManagementModel->fetchPOID();

		$option = "";
		$po_id_array = [];

		foreach($po_ids as $po_id)
	    {
	    	$po_id_array [] = $po_id->po_id;
	    }

	    foreach ($production_processes as $production_process) 
		{
		    if (!in_array($production_process->po_id, $po_id_array)) 
	    	{
	    		$option .= "<option value='".$production_process->po_id."' >".$production_process->po_id."</option>";
	    	}
	    	
		}

	    echo $option;
    }

    public function workerBillItemCode()
    {
    	$po_id = $this->input->post('po_id');
		$item_codes = $this->WorkerManagementModel->fetchWorkerBillItemCode($po_id);

		$option = "";

		foreach($item_codes as $item_code)
	    {
	    	$option .= "<option value='".$item_code->item_code."' >".$item_code->item_code."</option>";
	    }

	    echo $option;
    }

    public function getBill()
    {
    	$data['title'] = 'Worker Bills';
		$data['page'] = 'worker_management/bill';
		$data['bills'] = $this->WorkerManagementModel->getWorkerBill();

		$this->load->view('layouts/master', $data);
    }

    public function createBill()
    {
    	$data['title'] = 'Worker Bills';
		$data['page'] = 'worker_management/create_bill';
		$data['type'] = 'new';
		$data['workers'] = $this->WorkerManagementModel->fetchWorker();
		$data['activities'] = $this->WorkerManagementModel->fetchActivity();
		$data['payment_types'] = $this->WorkerManagementModel->fetchPaymentType();
		$data['production_processes'] = $this->WorkerManagementModel->fetchPOID();
		$data['item_codes'] = $this->WorkerManagementModel->fetchItem();

		$this->load->view('layouts/master', $data);
    }

    public function insertBill()
	{
		$post_bill = $this->input->post();
		//$post_bill['date'] = $this->DateConvertFormTODB($post_bill['date']);
		$this->WorkerManagementModel->insertBill($post_bill);

		return redirect('worker/bill');
	}

	public function editBill($id='')
	{
		$data['title'] = 'Worker Bills';
		$data['page'] = 'worker_management/create_bill';
		$data['type'] = 'edit';
		$data['edit_bill_id'] = $id;
		$data['edit_bill'] = $this->WorkerManagementModel->fetchEditWorkerBill($id);
		$data['workers'] = $this->WorkerManagementModel->fetchWorker();
		$data['activities'] = $this->WorkerManagementModel->fetchActivity();
		$data['payment_types'] = $this->WorkerManagementModel->fetchPaymentType();
		$data['production_processes'] = $this->WorkerManagementModel->fetchPOID();
		$data['item_codes'] = $this->WorkerManagementModel->fetchItem();

		$this->load->view('layouts/master', $data);
	}

	public function updateBill($id='')
	{	
		$update_bill = $this->input->post();

		$this->WorkerManagementModel->updateBill($update_bill, $id);

		return redirect('worker/bill');
	}

	public function deleteBill($id='')
	{
		$this->WorkerManagementModel->deleteBill($id);

		return redirect('worker/bill');
	}

	public function getPayBill()
    {
    	$data['title'] = 'Worker Pay Bills';
		$data['page'] = 'worker_management/pay_bill';
		$data['pay_bills'] = $this->WorkerManagementModel->getWorkerPayBill();

		$this->load->view('layouts/master', $data);
    }

    public function createPayBill()
    {
    	$data['title'] = 'Worker Pay Bills';
		$data['page'] = 'worker_management/create_pay_bill';
		$data['type'] = 'new';
		$data['workers'] = $this->WorkerManagementModel->fetchWorker();
		$data['accounts'] = $this->WorkerManagementModel->fetchAccount();
		$data['payment_types'] = $this->WorkerManagementModel->fetchPaymentType();

		$this->load->view('layouts/master', $data);
    }

    public function insertPayBill()
	{
		$post_pay_bill = $this->input->post();
		$this->WorkerManagementModel->insertPayBill($post_pay_bill);

		return redirect('worker/pay/bill');
	}

	public function editPayBill($id='')
	{
		$data['title'] = 'Worker Pay Bills';
		$data['page'] = 'worker_management/create_pay_bill';
		$data['type'] = 'edit';
		$data['edit_pay_bill_id'] = $id;
		$data['edit_pay_bill'] = $this->WorkerManagementModel->fetchEditWorkerPayBill($id);
		$data['workers'] = $this->WorkerManagementModel->fetchWorker();
		$data['accounts'] = $this->WorkerManagementModel->fetchAccount();
		$data['payment_types'] = $this->WorkerManagementModel->fetchPaymentType();
		$data['production_processes'] = $this->WorkerManagementModel->fetchPOID();

		$this->load->view('layouts/master', $data);
	}

	public function updatePayBill($id='')
	{	
		$update_pay_bill = $this->input->post();

		$this->WorkerManagementModel->updatePayBill($update_pay_bill, $id);

		return redirect('worker/pay/bill');
		
	}

	public function deletePayBill($id='')
	{
		$this->WorkerManagementModel->deletePayBill($id);

		return redirect('worker/pay/bill');
	}

	public function getWorkerBillReport($type)
	{
		$data['title'] = 'Worker Bill Report';
		$data['page'] = 'worker_management/worker_bill_report';
		$data['type'] = $type;

		if ($type == 'new') 
		{
			$data['workers'] = $this->WorkerManagementModel->fetchWorker();
		}
		else
		{
			$post_worker_report = $this->input->post();
			$data['worker_bill_reports'] = $this->WorkerManagementModel->getWorkerBillReport($post_worker_report);
		}

		$this->load->view('layouts/master', $data);
	}

	public function getWorkerPaybillReport($type)
	{
		$data['title'] = 'Worker Paybill Report';
		$data['page'] = 'worker_management/worker_paybill_report';
		$data['type'] = $type;

		if ($type == 'new') 
		{
			$data['workers'] = $this->WorkerManagementModel->fetchWorker();
		}
		else
		{
			$post_worker_report = $this->input->post();
			$data['worker_paybill_reports'] = $this->WorkerManagementModel->getWorkerPaybillReport($post_worker_report);
		}

		$this->load->view('layouts/master', $data);
	}

	public function getWorkerSummeryReport($type='')
	{
		$this->LogoutCheck();

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

		$data['title'] = "Worker Summery Report ( $year-$month )";
		$data['page'] = 'worker_management/Worker_summery_report';
		$data['month'] = $month;
		$data['year'] = $year;
		$data['data'] = $this->WorkerManagementModel->getWorkerSummeryReport($month, $year);

		$this->load->view('layouts/master', $data);
	}

}
