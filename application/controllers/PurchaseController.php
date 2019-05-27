<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url', 'form');  
		$this->load->model('PurchaseModel');		
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
	* Code Start For Purchase
	*
	*/

	public function fetchPurchaseItemCode()
    {
    	$item_name = $this->input->post('item_name');
		$item_codes = $this->PurchaseModel->fetchPurchaseItemCode($item_name);

		$option = "";
		$option .= "<option value='Select Item Code'>Select Item Code</option>";
		
		foreach($item_codes as $item_code)
	    {
	    	$option .= "<option value='".$item_code->item_code."' >".$item_code->item_code."</option>";
	    }

	    echo $option;
    }

	public function item($type='')
	{	
		if ($type == 'group') 
		{
			$data['title'] = 'Purchase';
			$data['page'] = 'purchase/item';
			$data['type'] = $type;
			$data['item_groups'] = $this->PurchaseModel->fetchItemGroup();
		}
		else 
		{
			$data['title'] = 'Purchase';
			$data['page'] = 'purchase/item';
			$data['type'] = $type;
			$data['items'] = $this->PurchaseModel->fetchItem();
			$data['item_groups'] = $this->PurchaseModel->fetchItemGroup();
			$data['item_names'] = $this->PurchaseModel->fetchItemName();
		}

		$this->load->view('layouts/master', $data);
		
	}

	public function insertItem($type='')
	{
		if ($type == 'group') 
		{
			$this->form_validation->set_rules('item_Group_name', 'Item Group Name', 'required');

			$post_item_groups = $this->input->post();
			$this->PurchaseModel->insertItemGroup($post_item_groups);

			return redirect('purchase/item/group');
		} 
		else 
		{
			$post_items = $this->input->post();
			$this->PurchaseModel->insertItem($post_items);

			return redirect('purchase/item');
		}
		
	}

	public function editItem($id='')
	{
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/item';
		$data['type'] = 'edit_item';
		$data['edit_item_id'] = $id;
		$data['edit_item'] = $this->PurchaseModel->fetchEditItem($id);
		$data['item_groups'] = $this->PurchaseModel->fetchItemGroup();
		$data['item_names'] = $this->PurchaseModel->fetchItemName();

		$this->load->view('layouts/master', $data);
	}

	public function updateItem($id='')
	{	
		$update_item = $this->input->post();

		$this->PurchaseModel->updateItem($update_item, $id);

		return redirect('purchase/item');
	}

	public function createItemName()
	{
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/item';
		$data['type'] = 'item_name';
		$data['item_names'] = $this->PurchaseModel->fetchItemName();

		$this->load->view('layouts/master', $data);
	}

	public function insertItemName()
	{
		$post_item_name = $this->input->post();
		$this->PurchaseModel->insertItemName($post_item_name);

		return redirect('purchase/create/item/name');
	}

	public function editItemName($id='')
	{
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/item';
		$data['type'] = 'edit_item_name';
		$data['edit_item_name_id'] = $id;
		$data['edit_item_name'] = $this->PurchaseModel->fetchEditItemName($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateItemName($id='')
	{	
		$update_item_name = $this->input->post();

		$this->PurchaseModel->updateItemName($update_item_name, $id);

		return redirect('purchase/create/item/name');
	}

	public function deleteItemName($id='')
	{
		$status = $this->PurchaseModel->deleteItemName($id);

		return redirect('purchase/create/item/name');
	}

	public function editItemGroup($id='')
	{
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/item';
		$data['type'] = 'edit_group';
		$data['edit_item_group_id'] = $id;
		$data['edit_item_group'] = $this->PurchaseModel->fetchEditItemGroup($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateItemGroup($id='')
	{	
		$update_item_group = $this->input->post();

		$this->PurchaseModel->updateItemGroup($update_item_group, $id);

		return redirect('purchase/item/group');
	}

	public function deleteItem($id='')
	{
		$status = $this->PurchaseModel->deleteItem($id);

		return redirect('purchase/item');
	}

	public function deleteItemGroup($id='')
	{
		$status = $this->PurchaseModel->deleteItemGroup($id);

		return redirect('purchase/item/group');
	}

	public function purchaseReport($type)
	{
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/purchase_report';
		$data['type'] = $type;

		if ($type == 'new') 
		{
			$sales_items = $this->PurchaseModel->fetchProductItem();
			$purchase_items = $this->PurchaseModel->fetchPurchaseItem();

			$item_name_array = [];
			$sales_item_name_array = [];
			$purchase_item_name_array = [];

			foreach ($sales_items as $sales_item) 
			{
				$sales_item_name_array [] = $sales_item->item_name;
			}

			foreach ($purchase_items as $purchase_item) 
			{
				$purchase_item_name_array [] = $purchase_item->item_name;
			}

			$item_name_array = array_merge($sales_item_name_array, $purchase_item_name_array);
			$data['item_names'] = array_unique($item_name_array);
		}
		else
		{
			$post_purchase_reports = $this->input->post();
			$data['purchase_reports'] = $this->PurchaseModel->fetchPurchaseReport($post_purchase_reports);
		}

		$this->load->view('layouts/master', $data);
	}

	public function purchaseSummeryReport($type='')
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

		$data['title'] = "Purchase Summery Report ( $year-$month )";
		$data['page'] = 'purchase/purchase_summery_report';
		$data['month'] = $month;
		$data['year'] = $year;
		$data['data'] = $this->PurchaseModel->purchaseSummeryReport($month, $year);

		$this->load->view('layouts/master', $data);
	}

	public function supplier($type='')
	{	
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/supplier';
		$data['type'] = $type;
		$data['suppliers'] = $this->PurchaseModel->fetchSupplier();
		$data['supplier_types'] = $this->PurchaseModel->fetchSupplierType();

		$this->load->view('layouts/master', $data);
	}

	public function supplierReport()
	{	
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/supplier_report';
		$data['supplier_reports'] = $this->PurchaseModel->fetchSupplier();

		$this->load->view('layouts/master', $data);
	}

	public function getSupplierReport()
	{
		$supplier_report_info = $this->input->post();

		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/supplier_transection_report';
		$data['suppliers'] = $this->PurchaseModel->fetchSupplier();
		$data['supplier_reports'] = $this->PurchaseModel->getSupplierReport($supplier_report_info);

		if ($supplier_report_info['bill_type'] == 'Bill') 
		{
			$data['type'] = 'Bill';
		}
		else
		{
			$data['type'] = 'Pay Bill';
		}

		$this->load->view('layouts/master', $data);
	}

	public function insertSupplier($type='')
	{
		if ($type == 'type') 
		{
			$post_supplier_types = $this->input->post();
			$this->PurchaseModel->insertSupplierType($post_supplier_type);

			return redirect('purchase/supplier/type');
		} 
		else 
		{
			$post_supplier = $this->input->post();
			$supplier = $this->PurchaseModel->checkSupplier($post_supplier);

			if (empty($supplier)) 
			{
				$this->PurchaseModel->insertSupplier($post_supplier);
			} 
			else 
			{
				$this->session->set_flashdata('message', 'This entry is already exist in our record !');
			}

			return redirect('purchase/supplier');
		}
		
	}

	public function editSupplier($id='')
	{
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/supplier';
		$data['type'] = 'edit_supplier';
		$data['edit_supplier_id'] = $id;
		$data['edit_supplier'] = $this->PurchaseModel->fetchEditSupplier($id);
		$data['supplier_types'] = $this->PurchaseModel->fetchSupplierType();

		$this->load->view('layouts/master', $data);
	}

	public function updateSupplier($id='')
	{	
		$update_supplier = $this->input->post();

		$this->PurchaseModel->updateSupplier($update_supplier, $id);

		return redirect('purchase/supplier');
	}

	public function deleteSupplier($id='')
	{
		$status = $this->PurchaseModel->deleteSupplier($id);

		return redirect('purchase/supplier');
	}

	public function editSupplierType($id='')
	{
		$data['title'] = 'Purchase';
		$data['page'] = 'purchase/supplier';
		$data['type'] = 'edit_supplier_type';
		$data['edit_supplier_type_id'] = $id;
		$data['edit_supplier_type'] = $this->PurchaseModel->fetchEditSupplierType($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateSupplierType($id='')
	{	
		$update_supplier_type = $this->input->post();

		$this->PurchaseModel->updateSupplierType($update_supplier_type, $id);

		return redirect('purchase/supplier/type');	
	}

	public function deleteSupplierType($id='')
	{
		$status = $this->PurchaseModel->deleteSupplierType($id);

		return redirect('purchase/supplier/type');
	}

	public function getBill()
    {
    	$this->load->library('pagination');

		$config = [

				'base_url' 			=> base_url('purchase/bill'),
				'total_rows' 		=> $this->PurchaseModel->count_purchase_bill_num_rows(),
				'per_page' 			=> 50,
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
		$this->pagination->initialize($config);

    	$data['title'] = 'Purchase Bills';
		$data['page'] = 'purchase/bill';
		$data['bills'] = $this->PurchaseModel->getBill($limit, $offset);

		$this->load->view('layouts/master', $data);
    }

    public function createBill()
    {
    	$data['title'] = 'Purchase Bills';
		$data['page'] = 'purchase/create_bill';
		$data['type'] = 'new';
		$data['suppliers'] = $this->PurchaseModel->fetchSupplier();
		$data['po_ids'] = $this->PurchaseModel->fetchProcessID();
		$data['item_codes'] = $this->PurchaseModel->fetchItem();
		$data['accounts'] = $this->PurchaseModel->fetchAccount();

		$sales_items = $this->PurchaseModel->fetchProductItem();
		$purchase_items = $this->PurchaseModel->fetchPurchaseItem();

		$item_name_array = [];
		$sales_item_name_array = [];
		$purchase_item_name_array = [];

		foreach ($sales_items as $sales_item) 
		{
			$sales_item_name_array [] = $sales_item->item_name;
		}

		foreach ($purchase_items as $purchase_item) 
		{
			$purchase_item_name_array [] = $purchase_item->item_name;
		}

		$item_name_array = array_merge($sales_item_name_array, $purchase_item_name_array);
		$data['item_names'] = array_unique($item_name_array);

		$this->load->view('layouts/master', $data);
    }

    public function insertBill()
	{
		$post_bill = $this->input->post();
		//$post_bill['date'] = $this->DateConvertFormTODB($post_bill['date']);
		$this->PurchaseModel->insertBill($post_bill);

		return redirect('purchase/bill');
	}

	public function editBill($id='')
	{
		$data['title'] = 'Purchase Bills';
		$data['page'] = 'purchase/create_bill';
		$data['type'] = 'edit';
		$data['edit_bill_id'] = $id;
		$data['edit_bill'] = $this->PurchaseModel->fetchEditBill($id);
		$data['suppliers'] = $this->PurchaseModel->fetchSupplier();
		$data['po_ids'] = $this->PurchaseModel->fetchProcessID();
		$data['item_codes'] = $this->PurchaseModel->fetchItem();
		$items = $this->PurchaseModel->fetchItem();

		$item_name_array = [];

		foreach ($items as $item) 
		{
			$item_name_array[] = $item->item_name;
		}

		$data['item_names'] = array_unique ($item_name_array);

		$this->load->view('layouts/master', $data);
	}

	public function updateBill($id='')
	{	
		$update_bill = $this->input->post();

		$this->PurchaseModel->updateBill($update_bill, $id);

		return redirect('purchase/bill');	
	}

	public function deleteBill($id='')
	{
		$this->PurchaseModel->deleteBill($id);

		return redirect('purchase/bill');
	}

	public function getPayBill()
    {
    	$this->load->library('pagination');

		$config = [

				'base_url' 			=> base_url('purchase/pay/bill'),
				'total_rows' 		=> $this->PurchaseModel->count_purchase_pay_bill_num_rows(),
				'per_page' 			=> 50,
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

    	$data['title'] = 'Purchase Pay Bills';
		$data['page'] = 'purchase/pay_bill';
		$data['pay_bills'] = $this->PurchaseModel->getPayBill($limit, $offset);

		$this->load->view('layouts/master', $data);
    }

    public function getPayBillBalance()
    {
    	$account = $this->input->post('account');
		$balance = $this->PurchaseModel->getAccBalance($account);

		echo json_encode($balance);
    }

    public function getPayBillSupplierBalance()
    {
    	$supplier = $this->input->post('supplier');
		$balance = $this->PurchaseModel->getSupplierBalance($supplier);

		echo json_encode($balance);
    }

    public function createPayBill()
    {
    	$data['title'] = 'Purchase Pay Bills';
		$data['page'] = 'purchase/create_pay_bill';
		$data['type'] = 'new';
		$data['suppliers'] = $this->PurchaseModel->fetchSupplier();
		$data['accounts'] = $this->PurchaseModel->fetchAccount();
		$data['payment_types'] = $this->PurchaseModel->fetchPaymentType();

		$this->load->view('layouts/master', $data);
    }

    public function insertPayBill()
	{
		$post_pay_bill = $this->input->post();
		$this->PurchaseModel->insertPayBill($post_pay_bill);

		return redirect('purchase/pay/bill');
	}

	public function editPayBill($id='')
    {
    	$data['title'] = 'Purchase Pay Bills';
		$data['page'] = 'purchase/create_pay_bill';
		$data['type'] = 'edit';
		$data['edit_pay_bill_id'] = $id;
		$data['edit_pay_bill'] = $this->PurchaseModel->fetchEditPayBill($id);
		$data['suppliers'] = $this->PurchaseModel->fetchSupplier();
		$data['accounts'] = $this->PurchaseModel->fetchAccount();
		$data['payment_types'] = $this->PurchaseModel->fetchPaymentType();

		$this->load->view('layouts/master', $data);
    }

    public function updatePayBill($id='')
	{	
		$update_pay_bill = $this->input->post();

		$this->PurchaseModel->updatePayBill($update_pay_bill, $id);

		return redirect('purchase/pay/bill');	
	}

	public function deletePayBill($id='')
	{
		$this->PurchaseModel->deletePayBill($id);

		return redirect('purchase/pay/bill');
	}

}
