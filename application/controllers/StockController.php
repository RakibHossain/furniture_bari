<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StockController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('StockModel');
		
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
	* Code Start For Stock
	*
	*/
	public function report()
	{
		$data['title'] = 'Stock';
		$data['page'] = 'stock/report';

		$stock_item = $this->input->post();

		if (empty($stock_item)) 
		{
			$stock_item = 'Sales Item';
		} 
		else 
		{
			$stock_item = $stock_item['stock_item'];
		}

		$data['stock_item'] = $stock_item;
		$data['stock_reports'] = $this->StockModel->fetchStockReport($stock_item);

		$this->load->view('layouts/master', $data);
	}

	public function createAdjustment()
	{
		$data['title'] = 'Stock';
		$data['page'] = 'stock/create_adjustment';

		$sales_item = $this->StockModel->fetchSalesItem();
		$purchase_item = $this->StockModel->fetchPurchaseItem();

		$data['items'] = array_merge($sales_item, $purchase_item);

		$this->load->view('layouts/master', $data);
	}

	public function insertAdjustment()
	{
		$post_adjustment = $this->input->post();
		$this->StockModel->insertAdjustment($post_adjustment);

		return redirect('stock/report');
	}

}
