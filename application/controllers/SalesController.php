<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SalesController extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();

        $this->load->library("excel");
		$this->load->model('SalesModel');
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

	public function sendSMS($id, $type)
	{
		$send_sms_data = $this->SalesModel->getSendSmsData($id, $type);

		if ($send_sms_data == false) 
		{
			$this->session->set_flashdata('error_status', 'SMS has been already sent !');
		} 
		else 
		{
			$customer_name   = $send_sms_data->customer_name;
			$total_qty 	     = $send_sms_data->total_qty;
			$invoice_no      = $send_sms_data->order_no;
			$due 		     = $send_sms_data->total_due;
			$delivery_method = $send_sms_data->delivery_by;
			$mobile_no = str_replace([' ', ',', '/'], '', $send_sms_data->mobile_no);
			$to = substr($mobile_no, 0, 11).','.substr($mobile_no, 11, 11);

			if ($type == 'before') 
		    {
		    	if ($delivery_method == 'Courier') 
		    	{
		    		$message = "Hello $customer_name, $total_qty items from your Order No: $invoice_no will be booked to courier within 4 hours. Please have $due BDT (Dues) ready at receive your order from courier. Thanks - your FurnitureBari.com team.";
		    	} 
		    	else 
		    	{
		    		$message = "Hello $customer_name, $total_qty items from your Order No: $invoice_no will be delivered to you within 8 hours. Please have $due BDT (Dues) ready at delivery. Thanks - your FurnitureBari.com team.";
		    	}
		    	
		    }

		    //send sms
			$send_sms = sendSMS($to, $message);
			//store the records in db
			$this->SalesModel->insertSendSMS($id, $type);

			if ($send_sms == true) 
			{
				$this->session->set_flashdata('success_status', 'SMS has been sent successfully !');
			} 
			else 
			{
				$this->session->set_flashdata('error_status', 'Problem occured, please try again !');
			}

		}

		return redirect("admin/invoice/edit/$id");
	}

	// Export data in CSV format
	public function exportInvoice()
	{
		$object = new PHPExcel();

	  	$object->setActiveSheetIndex(0);

	  	$table_columns = ['Invoice No', 'Order Date', 'Delivery Date', 'Sales Person', 'Customer Name', 'Mobile',  'Address', 'Total Quantity', 'Total Amount', 'Due'];

	  	$column = 0;

	  	foreach($table_columns as $field)
	  	{
	   		$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
	   		$column++;
	  	}

	  	$invoice_data = $this->SalesModel->exportInvoice();

	  	$excel_row = 2;
	  	foreach($invoice_data as $row)
	  	{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->order_no);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->order_date);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->delivery_date);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->sales_person);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->customer_name);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->mobile_no);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->address);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->total_qty);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->total_amount);
		   	$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->total_due);
		   	$excel_row++;
	  	}

	  	$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
	  	header('Content-Type: application/vnd.ms-excel');
	  	header('Content-Disposition: attachment;filename="Invoice Data.xls"');
	  	$object_writer->save('php://output');
	}

	public function index()
	{
		$this->LoginCheck();
		$this->LogoutCheck();
	}

	public function item($type='')
	{	
		if ($type == 'group') 
		{
			$data['title'] = 'Item';
			$data['page'] = 'sales/item';
			$data['type'] = $type;
			$data['item_groups'] = $this->SalesModel->fetchItemGroup();
		}
		else 
		{
			$data['title'] = 'Item';
			$data['page'] = 'sales/item';
			$data['type'] = $type;
			$data['items'] = $this->SalesModel->fetchItem();
			$data['item_names'] = $this->SalesModel->fetchItemName();
			$data['item_groups'] = $this->SalesModel->fetchItemGroup();
		}

		$this->load->view('layouts/master', $data);
	}

	public function fetchStockStatus()
	{
		$item_code = $this->input->post('item_code');
		$stock_status = $this->SalesModel->fetchStockStatus($item_code);

		echo json_encode($stock_status);
	}

	public function insertItem($type='')
	{
		if ($type == 'group') 
		{
			$post_item_group = $this->input->post();
			$item_group = $this->SalesModel->checkItemGroup($post_item_group);
		
			if (empty($item_group)) 
			{
				$this->SalesModel->insertItemGroup($post_item_group);
			} 
			else 
			{
				$this->session->set_flashdata('message', 'This entry is already exist in our record !');
			}

			return redirect('sales/item/create/group');
		} 
		else 
		{
			$post_item = $this->input->post();
			$item = $this->SalesModel->checkItem($post_item);

			if (empty($item)) 
			{
				$this->SalesModel->insertItem($post_item);
			} 
			else 
			{
				$this->session->set_flashdata('message', 'This entry is already exist in our record !');
			}

			return redirect('sales/create/item');
		}
		
	}

	public function editItem($id='')
	{
		$data['title'] = 'Item';
		$data['page'] = 'sales/item';
		$data['type'] = 'edit_item';
		$data['edit_item_id'] = $id;
		$data['edit_item'] = $this->SalesModel->fetchEditItem($id);
		$data['item_names'] = $this->SalesModel->fetchItemName();
		$data['item_groups'] = $this->SalesModel->fetchItemGroup();

		$this->load->view('layouts/master', $data);
	}

	public function updateItem($id='')
	{	
		$update_item = $this->input->post();

		$this->SalesModel->updateItem($update_item, $id);

		return redirect('sales/item');
	}

	public function deleteItem($id='')
	{
		$status = $this->SalesModel->deleteItem($id);

		return redirect('sales/item');
	}

	public function createItemName()
	{
		$data['title'] = 'Item';
		$data['page'] = 'sales/item';
		$data['type'] = 'item_name';
		$data['item_names'] = $this->SalesModel->fetchItemName();

		$this->load->view('layouts/master', $data);
	}

	public function insertItemName()
	{
		$post_item_name = $this->input->post();
		$item_name = $this->SalesModel->checkItemName($post_item_name);
		
		if (empty($item_name)) 
		{
			$this->SalesModel->insertItemName($post_item_name);
		} 
		else 
		{
			$this->session->set_flashdata('message', 'This entry is already exist in our record !');
		}

		return redirect('sales/create/item/name');
	}

	public function editItemName($id='')
	{
		$data['title'] = 'Item';
		$data['page'] = 'sales/item';
		$data['type'] = 'edit_item_name';
		$data['edit_item_name_id'] = $id;
		$data['edit_item_name'] = $this->SalesModel->fetchEditItemName($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateItemName($id='')
	{	
		$update_item_name = $this->input->post();

		$this->SalesModel->updateItemName($update_item_name, $id);

		return redirect('sales/create/item/name');
	}

	public function deleteItemName($id='')
	{
		$status = $this->SalesModel->deleteItemName($id);

		return redirect('sales/create/item/name');
	}

	public function editItemGroup($id='')
	{
		$data['title'] = 'Item';
		$data['page'] = 'sales/item';
		$data['type'] = 'edit_item_group';
		$data['edit_item_group_id'] = $id;
		$data['edit_item_group'] = $this->SalesModel->fetchEditItemGroup($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateItemGroup($id='')
	{	
		$update_item_group = $this->input->post();

		$this->SalesModel->updateItemGroup($update_item_group, $id);

		return redirect('sales/item/create/group');
	}

	public function deleteItemGroup($id='')
	{
		$status = $this->SalesModel->deleteItemGroup($id);

		return redirect('sales/item/create/group');
	}

	public function createSalesPerson()
	{
		$data['title'] = 'Sales';
		$data['page'] = 'sales/create_sales_person';
		$data['type'] = 'new';
		$data['users'] = $this->SalesModel->fetchUser();
		$data['sales_persons'] = $this->SalesModel->fetchSalesPerson();

		$this->load->view('layouts/master', $data);
	}

	public function insertSalesPerson()
	{
		$post_sales_person = $this->input->post();
		$this->SalesModel->insertSalesPerson($post_sales_person);

		return redirect('sales/create/person');
	}

	public function editSalesPerson($id='')
	{
		$data['title'] = 'Sales';
		$data['page'] = 'sales/create_sales_person';
		$data['type'] = 'edit';
		$data['edit_sales_person_id'] = $id;
		$data['edit_sales_person'] = $this->SalesModel->fetchEditSalesPerson($id);
		$data['users'] = $this->SalesModel->fetchUser();

		$this->load->view('layouts/master', $data);
	}

	public function updateSalesPerson($id='')
	{	
		$update_sales_person = $this->input->post();

		$this->SalesModel->updateSalesPerson($update_sales_person, $id);

		return redirect('sales/create/person');
	}

	public function deleteSalesPerson($id='')
	{
		$status = $this->SalesModel->deleteSalesPerson($id);

		return redirect('sales/create/person');
	}

	public function createOrderBy()
	{
		$data['title'] = 'Sales';
		$data['page'] = 'sales/order_by';
		$data['type'] = 'new';
		$data['order_by_names'] = $this->SalesModel->fetchOrderBy();

		$this->load->view('layouts/master', $data);
	}

	public function insertOrderBy()
	{
		$post_order_by = $this->input->post();
		$this->SalesModel->insertOrderBy($post_order_by);

		return redirect('sales/create/order-by');
	}

	public function editOrderBy($id='')
	{
		$data['title'] = 'Sales';
		$data['page'] = 'sales/order_by';
		$data['type'] = 'edit';
		$data['edit_order_by_name_id'] = $id;
		$data['edit_order_by_name'] = $this->SalesModel->fetchEditOrderBy($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateOrderBy($id='')
	{	
		$update_order_by = $this->input->post();

		$this->SalesModel->updateOrderBy($update_order_by, $id);

		return redirect('sales/create/order-by');
	}

	public function deleteOrderBy($id='')
	{
		$status = $this->SalesModel->deleteOrderBy($id);

		return redirect('sales/create/order-by');
	}

	public function createDeliveryBy()
	{
		$data['title'] = 'Sales';
		$data['page'] = 'sales/delivery_by';
		$data['type'] = 'new';
		$data['delivery_by_names'] = $this->SalesModel->fetchDeliveryBy();

		$this->load->view('layouts/master', $data);
	}

	public function insertDeliveryBy()
	{
		$post_delivery_by = $this->input->post();
		$this->SalesModel->insertDeliveryBy($post_delivery_by);

		return redirect('sales/create/delivery-by');
	}

	public function editDeliveryBy($id='')
	{
		$data['title'] = 'Sales';
		$data['page'] = 'sales/delivery_by';
		$data['type'] = 'edit';
		$data['edit_delivery_by_name_id'] = $id;
		$data['edit_delivery_by_name'] = $this->SalesModel->fetchEditDeliveryBy($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateDeliveryBy($id='')
	{	
		$update_delivery_by = $this->input->post();

		$this->SalesModel->updateDeliveryBy($update_delivery_by, $id);

		return redirect('sales/create/delivery-by');
	}

	public function deleteDeliveryBy($id='')
	{
		$status = $this->SalesModel->deleteDeliveryBy($id);

		return redirect('sales/create/delivery-by');
	}

	public function createFactory()
	{
		$data['title'] = 'Sales';
		$data['page'] = 'sales/create_factory';
		$data['type'] = 'new';
		$data['factories'] = $this->SalesModel->fetchFactory();

		$this->load->view('layouts/master', $data);
	}

	public function insertFactory()
	{
		$post_factory = $this->input->post();
		$this->SalesModel->insertFactory($post_factory);

		return redirect('sales/create/factory');
	}

	public function editFactory($id='')
	{
		$data['title'] = 'Sales';
		$data['page'] = 'sales/create_factory';
		$data['type'] = 'edit';
		$data['edit_factory_id'] = $id;
		$data['edit_factory'] = $this->SalesModel->fetchEditFactory($id);

		$this->load->view('layouts/master', $data);
	}

	public function updateFactory($id='')
	{	
		$update_factory = $this->input->post();

		$this->SalesModel->updateFactory($update_factory, $id);

		return redirect('sales/create/factory');
	}

	public function deleteFactory($id='')
	{
		$status = $this->SalesModel->deleteFactory($id);

		return redirect('sales/create/factory');
	}

	public function fetchInvoiceItemCode()
    {
    	$item_name = $this->input->post('item_name');
		$item_codes = $this->SalesModel->fetchInvoiceItemCode($item_name);

		$option = "";

		foreach($item_codes as $item_code)
	    {
	    	$option .= "<option value='".$item_code->item_code."' >".$item_code->item_code."</option>";
	    }

	    echo $option;
    }

	public function invoice($type='', $id='')
	{
		$this->LogoutCheck();

		if($type == 'list')
		{
			$data['title'] = 'Invoice List';
			$data['page']  = 'sales/invoice_list';
			$data['data']  = $this->SalesModel->InvoiceList();
			$data['role']  = $this->UserRole();
		}
		else if($type == 'edit')
		{
			$data['title'] = 'Edit Invoice';
			$data['page']  = 'sales/create_invoice';
			$data['type']  = 'edit';
			$data['data']  = $this->SalesModel->InvoiceEditData($id);
			$data['due']   = $this->SalesModel->InvoiceList($id);
			$data['send_order_confirmation_sms'] = $this->SalesModel->checkSendOrderConfirmationSms($id);
			$data['send_before_delivery_sms'] = $this->SalesModel->checkSendBeforeDeliverySms($id);
			$data['send_due_sms'] = $this->SalesModel->checkSendDueSms($id);
			$data['send_clear_sms'] = $this->SalesModel->checkSendClearSms($id);
			$data['order_by_names'] = $this->SalesModel->fetchOrderBy();
			$data['delivery_by_names'] = $this->SalesModel->fetchDeliveryBy();
			$data['factories'] = $this->SalesModel->fetchFactory();
			$data['sales_persons'] = $this->SalesModel->fetchSalesPerson();
			$sales_items = $this->SalesModel->fetchItem();
			$purchase_items = $this->SalesModel->fetchPurchaseItem();

			$items = array_merge($sales_items, $purchase_items);

			$item_name_array = [];
			$item_code_array = [];

			foreach ($items as $item) 
			{
				$item_name_array[] = $item->item_name;
				//$item_code_array[] = $item->item_code;
			}

			$data['item_names'] = array_unique($item_name_array);
			//$data['item_codes'] = array_unique($item_code_array);
			$data['item_codes'] = $this->SalesModel->fetchItem();

			if($_POST)
			{
				$this->EditInvoiceSave($_POST, $id);
				return false;
			}

		}
		else if($type == 'delete')
		{
			$data = ['status'=>'0'];
			$this->db->where('id', $_POST['id']);
			$this->db->update('ji_invoice', $data);

			echo 'ok';

			return false;
		}
		else
		{
			$data['title'] = 'Invoice';
			$data['page']  = 'sales/create_invoice';
			$data['type']  = 'new';
			$data['order_by_names'] = $this->SalesModel->fetchOrderBy();
			$data['delivery_by_names'] = $this->SalesModel->fetchDeliveryBy();
			$data['factories'] = $this->SalesModel->fetchFactory();
			$data['sales_persons'] = $this->SalesModel->fetchSalesPerson();
			$sales_items = $this->SalesModel->fetchItem();
			$purchase_items = $this->SalesModel->fetchPurchaseItem();

			$items = array_merge($sales_items, $purchase_items);

			$item_name_array = [];
			$item_code_array = [];

			foreach ($items as $item) 
			{
				$item_name_array[] = $item->item_name;
				// $item_code_array[] = $item->item_code;
			}

			$data['item_names'] = array_unique($item_name_array);
			// $data['item_codes'] = array_unique($item_code_array);
			$data['item_codes'] = $this->SalesModel->fetchItem();

			if($_POST)
			{
				$this->NewInvoiceSave($_POST);
				return false;
			}

		}

		$this->load->view('layouts/master', $data);
	}

	private function NewInvoiceSave($data)
	{
		$detailsFormat = [];
		$detailsData   = $data['details'];
		$detailsFields = array_keys($detailsData);

		$data['order_date']    = $this->DateConvertFormTODB($data['order_date']);
		$data['delivery_date'] = $this->DateConvertFormTODB($data['delivery_date']);

		$saveStatus = $this->SalesModel->SaveInvoice($data);

		if($saveStatus)
		{
	 		redirect('admin/invoice/list', 'refresh');
		}
		else
		{
	 		redirect('admin/invoice', 'refresh');
		}
		
	}

	private function EditInvoiceSave($data, $id)
	{
		$detailsFormat = [];
		$detailsData   = $data['details'];
		$detailsFields = array_keys($detailsData);

		$data['order_date']    = $this->DateConvertFormTODB($data['order_date']);
		$data['delivery_date'] = $this->DateConvertFormTODB($data['delivery_date']);

		$saveStatus = $this->SalesModel->EditInvoice($data, $id);

		if($saveStatus)
		{
	 		redirect("admin/invoice/edit/$id", "refresh");
		}
		else
		{
	 		redirect("admin/invoice/list", "refresh");
		}
		
	}
	
	public function getInvoiceReport()
	{
		$this->LogoutCheck();
		$this->load->library('pagination');

		$config = [

			'base_url' 			=> base_url('admin/reports/invoice'),
			'total_rows' 		=> $this->SalesModel->count_invoice_num_rows(),
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

		$limit 	= $config['per_page'];
		$offset = $this->uri->segment(4, 0);

		$data['title'] = 'Invoice Report';
		$data['page']  = 'sales/invoice_report';
		// $data['data']  = $this->SalesModel->getInvoiceReport($limit, $offset);
		$data['data']  = $this->SalesModel->getInvoiceReport();
		$data['sales_persons'] = $this->SalesModel->fetchSalesPerson();

		// $this->pagination->initialize($config);
		$this->load->view('layouts/master', $data);
	}

	public function getInvoiceGraphReport()
	{
		$this->LogoutCheck();
		$year = date('Y');

		$data['title'] = "Invoice Graph Report ($year)";
		$data['page'] = "sales/invoice_graph_report";
		$data['data'] = $this->SalesModel->getInvoiceGraphReport();

		$this->load->view('layouts/master', $data);
	}

	public function getInvoiceSummeryReport($type='', $month='', $year='')
	{
		$this->LogoutCheck();

		if($type == 'current')
		{
			$month = date('m');
			$year = date('Y');
		}
		else if($type == 'prev')
		{
			if($month > 0)
		    {
		      	$month--;

		      	if ($month == 0) 
		      	{
		      		$year--;
		      		$month = 12;
		      	}

		    }

		}
		else if($type == 'next')
		{
			if($month <= 12)
		    {
		      	$month++;

		      	if ($month == 13) 
		      	{
		      		$year++;
		      		$month = 1;
		      	}

		    }

		}

		$data['title'] = "Invoice Summery Report ( $year-$month )";
		$data['page'] = 'sales/invoice_summery_report';
		$data['type'] = $type;
		$data['month'] = $month;
		$data['year'] = $year;
		$data['data'] = $this->SalesModel->getInvoiceSummeryReport($month, $year);

		$this->load->view('layouts/master', $data);
	}

	public function ReportsPaymentEdit($id='')
	{
		$data['title'] = 'Edit Invoice';
		$data['page'] = 'sales/create_invoice';
		$data['type'] = 'edit';
		$data['data'] = $this->SalesModel->InvoiceEditData($id);
		$data['due'] = $this->SalesModel->InvoiceList($id);

		if($_POST)
		{
			$this->EditInvoiceSave($_POST, $id);

			return false;
		}		

		$this->load->view('layouts/master', $data);
	}

}
