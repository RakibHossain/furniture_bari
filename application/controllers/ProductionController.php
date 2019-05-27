<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProductionController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url', 'form');  
		$this->load->model('ProductionModel');	
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
	* Code Start For Payment
	*
	*/
	public function activity()
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/activity';
		$data['type'] = 'new';
		$data['activities'] = $this->ProductionModel->fetchActivity();

		$this->load->view('layouts/master', $data);
	}

	public function insertActivity()
	{
		$post_activity = $this->input->post();
		$this->ProductionModel->insertActivity($post_activity);

		return redirect('production/activity');
	}

	public function editActivity($id='')
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/activity';
		$data['type'] = 'edit';
		$data['edit_activity'] = $this->ProductionModel->fetchEditActivity($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateActivity($id='')
	{	
		$update_activity = $this->input->post();

		$this->ProductionModel->updateActivity($update_activity, $id);

		return redirect('production/activity');	
	}

	public function deleteActivity($id='')
	{
		$this->ProductionModel->deleteActivity($id);

		return redirect('production/activity');
	}

	public function itemActivity()
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/item_activity';
		$data['activities'] = $this->ProductionModel->fetchItemActivity();

		$this->load->view('layouts/master', $data);
	}

	public function createItemActivity()
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/create_item_activity';
		$data['type'] = 'new';
		$data['items'] = $this->ProductionModel->fetchItem();
		$data['activities'] = $this->ProductionModel->fetchActivity();

		$this->load->view('layouts/master', $data);
	}

	public function insertItemActivity()
	{
		$post_activity_item = $this->input->post();
		$this->ProductionModel->insertItemActivity($post_activity_item);

		return redirect('production/item/activity');
	}

	public function editItemActivity($id='')
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/create_item_activity';
		$data['type'] = 'edit';
		$data['edit_activity_id'] = $id;
		$data['edit_activities'] = $this->ProductionModel->fetchEditItemActivity($id);
		$data['items'] = $this->ProductionModel->fetchItem();
		$data['activities'] = $this->ProductionModel->fetchActivity();

		$this->load->view('layouts/master', $data);
	}

	public function updateItemActivity($id='')
	{	
		$update_item_activity = $this->input->post();

		$this->ProductionModel->updateItemActivity($update_item_activity, $id);

		return redirect('production/item/activity');
	}

	public function deleteItemActivity($id='')
	{
		$this->ProductionModel->deleteItemActivity($id);

		return redirect('production/item/activity');
	}

	public function productionProcess()
	{
		$this->load->library('pagination');

		$config = [

				'base_url' 			=> base_url('production/process'),
				'total_rows' 		=> $this->ProductionModel->count_production_process_num_rows(),
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

		$data['title'] = 'Production';
		$data['page'] = 'production/process';
		$data['production_process'] = $this->ProductionModel->fetchProductionProcess($limit, $offset);

		$this->load->view('layouts/master', $data);
	}

	public function createProductionProcess($type='')
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/create_process';
		$data['type'] = $type;

		if ($type == 'new') 
		{
			$post_item_name = $this->input->post();
			$data['item_activities'] = $this->ProductionModel->fetchActivityItem($post_item_name);
		}

		$data['activities'] = $this->ProductionModel->fetchActivity();
		$data['production_items'] = $this->ProductionModel->fetchProductionItemActivity();
		$data['production_item_codes'] = $this->ProductionModel->fetchItemCode();
		$data['invoices'] = $this->ProductionModel->fetchInvoice();

		$this->load->view('layouts/master', $data);
	}

	public function insertProductionProcess()
	{
		$post_production_process = $this->input->post();
		$this->ProductionModel->insertProductionProcess($post_production_process);

		return redirect('production/process');
	}

	public function editProductionProcess($id='')
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/create_process';
		$data['type'] = 'edit_production_process';
		$data['edit_process_id'] = $id;
		$data['edit_process'] = $this->ProductionModel->fetchEditProductionProcess($id);
		$data['activities'] = $this->ProductionModel->fetchActivity();
		$data['po_ids'] = $this->ProductionModel->fetchPOID();
		$data['invoices'] = $this->ProductionModel->fetchInvoice();

		$this->load->view('layouts/master', $data);
	}

	public function updateProductionProcess($id='')
	{	
		$update_process = $this->input->post();

		$this->ProductionModel->updateProductionProcess($update_process, $id);

		return redirect('production/process');
		
	}

	public function deleteProductionProcess($id='')
	{
		$this->ProductionModel->deleteProductionProcess($id);

		return redirect('production/process');
	}

	public function fetchStockProductionProcessItemName()
    {
		$items = $this->ProductionModel->fetchStockProductionProcessItemName();

		$option = "";
		
	    foreach($items as $item)
	    {
	        $option .= "<option value='".$item->item_name."' >".$item->item_name."</option>";
	    }

	    echo $option;
    }

    public function fetchStockProductionProcessItemCode()
    {
		$items = $this->ProductionModel->fetchStockProductionProcessItemCode();

		$option = "";
		
	    foreach($items as $item)
	    {
	        $option .= "<option value='".$item->item_code."' >".$item->item_code."</option>";
	    }

	    echo $option;
    }

	public function fetchProductionProcessItemName()
    {
    	$invoice_no = $this->input->post('invoice_no');
		$item_names = $this->ProductionModel->fetchProductionProcessItemName($invoice_no);

		$option = "";
		
	    foreach($item_names as $item_name)
	    {
	        $option .= "<option value='".$item_name->item_name."' >".$item_name->item_name."</option>";
	    }

	    echo $option;
    }

	public function fetchProductionProcessItemCode()
    {
    	$invoice_no = $this->input->post('invoice_no');
		$item_codes = $this->ProductionModel->fetchProductionProcessItemCode($invoice_no);

		$option = "";
		
	    foreach($item_codes as $item_code)
	    {
	        $option .= "<option value='".$item_code->item_code."' >".$item_code->item_code."</option>";
	    }

	    echo $option;
    }

    public function getExistingItemBudget()
    {
    	$item_code = $this->input->post('item_code');
		$existing_item_budjet = $this->ProductionModel->getExistingItemBudget($item_code);

		echo json_encode($existing_item_budjet);
    }

	public function budget()
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/budget';
		$data['budgets'] = $this->ProductionModel->fetchProductionBudget();

		$this->load->view('layouts/master', $data);
	}

	public function createBudget($type='')
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/create_budget';
		$data['type'] = $type;
		$data['po_ids'] = $this->ProductionModel->getProductionProcessID('budget');

		if ($type == 'new') 
		{
			$budget_item_po_id = $this->input->post();

			if (empty($budget_item_po_id['po_id'])) 
			{
				$data['items'] = $this->ProductionModel->getSalesItem();
			} 
			else 
			{
				$data['production_budget_items'] = $this->ProductionModel->getProductionBudgetItem();
				$data['budget_info'] = $this->ProductionModel->fetchBudgetInfo($budget_item_po_id);
			}
			
			$data['budget_item_po_id'] = $budget_item_po_id;
			$data['purchase_items'] = $this->ProductionModel->fetchPurchaseItem();
			$data['purchase_item_names'] = $this->ProductionModel->fetchPurchaseItemName();
			$data['activities'] = $this->ProductionModel->fetchActivity();
		}

		$this->load->view('layouts/master', $data);
	}

	public function insertBudget()
	{
		$post_production_budget = $this->input->post();
		$this->ProductionModel->insertBudget($post_production_budget);

		return redirect('production/budget');
	}

	public function editBudget($id='')
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/create_budget';
		$data['type'] = 'edit';
		$data['edit_budget_id'] = $id;
		$data['edit_budget'] = $this->ProductionModel->fetchEditProductionBudget($id);
		$data['production_budget_items'] = $this->ProductionModel->getProductionBudgetItem();
		$data['purchase_items'] = $this->ProductionModel->fetchPurchaseItem();
		$data['purchase_item_names'] = $this->ProductionModel->fetchPurchaseItemName();
		$data['activities'] = $this->ProductionModel->fetchActivity();

		$this->load->view('layouts/master', $data);
	}

	public function updateBudget($id='')
	{	
		$update_budget = $this->input->post();
		$this->ProductionModel->updateBudget($update_budget, $id);

		return redirect('production/budget');
	}

	public function deleteBudget($id='')
	{
		$this->ProductionModel->deleteBudget($id);

		return redirect('production/budget');
	}

	public function cost()
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/cost';
		$data['production_costs'] = $this->ProductionModel->fetchProductionCost();

		$this->load->view('layouts/master', $data);
	}

	public function createCost($type='')
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/create_cost';
		$data['type'] = $type;
		$data['po_ids'] = $this->ProductionModel->getProductionProcessID('cost');

		if ($type == 'new') 
		{
			$cost_item_po_id = $this->input->post();
			$data['item_cost'] = $this->ProductionModel->fetchCreateCost($cost_item_po_id);
			$data['purchase_items'] = $this->ProductionModel->fetchPurchaseItem();
			$data['purchase_item_names'] = $this->ProductionModel->fetchPurchaseItemName();
			$data['activities'] = $this->ProductionModel->fetchActivity();
			$data['cost_item_po_id'] = $cost_item_po_id;
		}

		$this->load->view('layouts/master', $data);
	}

	public function insertCost()
	{
		$post_production_cost = $this->input->post();
		$stock_message = $this->ProductionModel->insertCost($post_production_cost);

		if ($stock_message == 0) 
		{
			$this->session->set_flashdata('stock_error_message', 'Sorry, insufficient stock quantity !');
		}

		return redirect('production/cost');
	}

	public function editCost($id='')
	{
		$data['title'] = 'Production';
		$data['page'] = 'production/create_cost';
		$data['type'] = 'edit';
		$data['edit_cost_id'] = $id;
		$data['edit_cost'] = $this->ProductionModel->fetchEditProductionCost($id);
		$data['purchase_items'] = $this->ProductionModel->fetchPurchaseItem();
		$data['activities'] = $this->ProductionModel->fetchActivity();
		
		$this->load->view('layouts/master', $data);
	}

	public function updateCost($id='')
	{	
		$update_cost = $this->input->post();
		$this->ProductionModel->updateCost($update_cost, $id);

		return redirect('production/cost');
	}

	public function deleteCost($id='')
	{
		$this->ProductionModel->deleteCost($id);

		return redirect('production/cost');
	}

}
