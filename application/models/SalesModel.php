<?php

class SalesModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Dhaka");
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

	public function insertSendSMS($id='', $type='')
	{
		if ($type == 'confirmation') 
		{
			$sms_type = 1;
		}
		elseif ($type == 'before') 
		{
			$sms_type = 2;
		} 
		elseif ($type == 'due')
		{
			$sms_type = 3;
		}
		else
		{
			$sms_type = 4;
		}
		
		$time = date("h:i:sa");
		$data = [
			'ji_user_id' 	=> $this->session->userdata['logged_in']['id'],
			'ji_invoice_id' => $id,
			'sms_type'     	=> $sms_type,
			'date'          => date("Y-m-d"),
			'time'          => $time
		];

		$this->db->insert('ji_send_sms', $data);
		return true;
	}

	public function getSendSmsData($id='', $type='')
	{
		if ($type == 'confirmation') 
		{
			$sms_type = 1;
		}
		elseif ($type == 'before') 
		{
			$sms_type = 2;
		} 
		elseif ($type == 'due')
		{
			$sms_type = 3;
		}
		else
		{
			$sms_type = 4;
		}

		$check_sent_sms = $this->db->select('*')
					->where('ji_invoice_id', $id)
					->where('sms_type', $sms_type)
					->get('ji_send_sms')
					->row();

		if (empty($check_sent_sms)) 
		{
			$query = $this->db->select('ji_invoice.*, (ji_invoice.net_total - IFNULL(sum(ji_payment.amount), 0)) as total_due')
					->join('ji_payment', 'ji_payment.ji_invoice_id = ji_invoice.id', 'left')
					->where('ji_invoice.id', $id)
					->where('ji_invoice.status !=', '0')
					->get('ji_invoice')
					->row();

			return $query;
		} 
		else 
		{
			return false;
		}

	}

	public function fetchStockStatus($item_code='')
	{
		$query = $this->db->select('*')
						->where('item_code =', $item_code)
						//->where('qty >', 0)
						->get('ji_stock')
						->row();

		return $query;
	}

	public function fetchItem()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_product_item')
						->result();

		return $query;
	}

	public function fetchPurchaseItem()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_purchase_item')
						->result();

		return $query;
	}

	public function fetchInvoiceItemCode($item_name='')
	{
		$query = $this->db->select('item_code')
					->where('item_name', $item_name)
					->order_by('id', 'desc')
					->get('ji_product_item')
					->result();

		return $query;
	}

	public function fetchItemName()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_product_item_name')
						->result();

		return $query;
	}

	public function fetchEditItemName($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_product_item_name')
						->row();

		return $query;
	}

	public function fetchItemGroup()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_product_item_group')
						->result();

		return $query;
	}

	public function fetchEditItem($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_product_item')
						->row();

		return $query;
	}

	public function fetchEditItemGroup($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_product_item_group')
						->row();

		return $query;
	}

	public function fetchUser()
	{
		$query = $this->db->select('*')
					->get('ji_user')
					->result();

		return $query;
	}

	public function fetchSalesPerson()
	{
		$query = $this->db->select('ji_user.name, ji_sales_person.id')
						->join('ji_sales_person', 'ji_user.id = ji_sales_person.ji_user_id')
						->order_by('ji_sales_person.id', 'desc')
						->get('ji_user')
						->result();

		return $query;
	}

	public function fetchEditSalesPerson($id='')
	{
		$query = $this->db->select('ji_user.name, ji_sales_person.id, ji_sales_person.ji_user_id')
						->join('ji_user', 'ji_user.id = ji_sales_person.ji_user_id')
						->where('ji_sales_person.id =', $id)
						->get('ji_sales_person')
						->row();

		return $query;
	}

	public function fetchOrderBy()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_order_by')
						->result();

		return $query;
	}

	public function fetchEditOrderBy($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_order_by')
						->row();

		return $query;
	}

	public function fetchDeliveryBy()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_delivery_by')
						->result();

		return $query;
	}

	public function fetchEditDeliveryBy($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_delivery_by')
						->row();

		return $query;
	}

	public function fetchFactory()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_factory')
						->result();

		return $query;
	}

	public function fetchEditFactory($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_factory')
						->row();

		return $query;
	}

	public function checkItem(Array $post_item)
	{
		if (isset($post_item['purchase_item'])) 
		{
			$query = $this->db->select('id')
						->where('item_code', $post_item['item_code'])
						->get('ji_purchase_item')
						->row();
		} 
		else 
		{
			$query = $this->db->select('id')
						->where('item_code', $post_item['item_code'])
						->get('ji_product_item')
						->row();
		}

		return $query;
	}

	public function insertItem(Array $post_item)
	{
		$post_item['item_code'] = strtoupper($post_item['item_code']);

		if (isset($post_item['purchase_item'])) 
		{
			$post_item['purchase_item'] = 1;
			$this->db->insert('ji_product_item', $post_item);

			unset($post_item['purchase_item']);

			$post_item['sales_item'] = 1;
			$this->db->insert('ji_purchase_item', $post_item);
		}
		else
		{
			$this->db->insert('ji_product_item', $post_item);
		}

	}

	public function updateItem(Array $update_item, $id)
	{
		if (isset($update_item['purchase_item'])) 
		{
			$update_item['purchase_item'] = 1;
			$this->db->where('id = ', $id)
				->update('ji_product_item', $update_item);

			unset($update_item['purchase_item']);

			$update_item['sales_item'] = 1;
			$this->db->insert('ji_purchase_item', $update_item);
		}
		else
		{
			$this->db->where('id = ', $id)
				->update('ji_product_item', $update_item);
		}
		
	}

	public function deleteItem($id)
	{
		$this->db->where('id = ', $id)->delete('ji_product_item');
	}

	public function checkItemName(Array $post_item_name)
	{
		$query = $this->db->select('id')
						->where('item_name', $post_item_name['item_name'])
						->get('ji_product_item_name')
						->row();

		return $query;
	}

	public function insertItemName(Array $post_item_name)
	{
		$this->db->insert('ji_product_item_name', $post_item_name);
	}

	public function updateItemName(Array $update_item_name, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_product_item_name', $update_item_name);
	}

	public function deleteItemName($id)
	{
		$this->db->where('id = ', $id)->delete('ji_product_item_name');
	}

	public function checkItemGroup(Array $post_item_name)
	{
		$query = $this->db->select('id')
						->where('item_group_name', $post_item_name['item_group_name'])
						->get('ji_product_item_group')
						->row();

		return $query;
	}

	public function insertItemGroup(Array $post_item_group)
	{
		$this->db->insert('ji_product_item_group', $post_item_group);
	}

	public function updateItemGroup(Array $update_item_group, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_product_item_group', $update_item_group);
	}

	public function deleteItemGroup($id)
	{
		$this->db->where('id = ', $id)->delete('ji_product_item_group');
	}

	public function insertSalesPerson(Array $post_person)
	{
		$this->db->insert('ji_sales_person', $post_person);
	}

	public function updateSalesPerson(Array $update_person, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_sales_person', $update_person);
	}

	public function deleteSalesPerson($id)
	{
		$this->db->where('id = ', $id)->delete('ji_sales_person');
	}

	public function insertOrderBy(Array $post_order_by)
	{
		$this->db->insert('ji_order_by', $post_order_by);
	}

	public function updateOrderBy(Array $update_order_by, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_order_by', $update_order_by);
	}

	public function deleteOrderBy($id)
	{
		$this->db->where('id = ', $id)->delete('ji_order_by');
	}

	public function insertDeliveryBy(Array $post_delivery_by)
	{
		$this->db->insert('ji_delivery_by', $post_delivery_by);
	}

	public function updateDeliveryBy(Array $update_delivery_by, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_delivery_by', $update_delivery_by);
	}

	public function deleteDeliveryBy($id)
	{
		$this->db->where('id = ', $id)->delete('ji_delivery_by');
	}

	public function insertFactory(Array $post_factory)
	{
		$this->db->insert('ji_factory', $post_factory);
	}

	public function updateFactory(Array $update_factory, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_factory', $update_factory);
	}

	public function deleteFactory($id)
	{
		$this->db->where('id = ', $id)->delete('ji_factory');
	}

	public function insertUserActivity(Array $user_activity_data)
	{
		$this->db->insert('ji_user_activity', $user_activity_data);
	}

	public function getNewInvoiceNo()
	{
		$last_invoice = $this->db->select('id')
							->order_by('id', 'desc')
							->limit(1)
							->get('ji_invoice')
							->row();

		$last_invoice_id = (isset($last_invoice->id)) ? $last_invoice->id : 1;
		$new_invoice_no  = date('my').$last_invoice_id;

		return $new_invoice_no;
	}

	public function SaveInvoice(Array $data)
	{
		$detailsData = $data['details'];
		unset($data['details']);

		$data['order_no'] = $this->getNewInvoiceNo();

		$this->db->insert('ji_invoice', $data);
		$lastID = $this->db->insert_id();

		foreach ($detailsData as $key => $value) 
		{
			if (isset($value['stock_status'])) 
			{
				$value['stock_status'] = 1;
				
				$stock_query = $this->db->select('qty, unit_price, total')
								->where('item_code = ', $value['item_code'])
								->get('ji_stock')
								->row();

				if (!empty($stock_query)) 
				{
					$stock_qty  = (!empty($stock_query->qty)) ? $stock_query->qty : 0;
					$recent_qty = $value['qty'];

					$stock_total_price  = (!empty($stock_query->total)) ? $stock_query->total : 0;
					$recent_total_price = $value['total'];

					$new_qty 		 = $stock_qty - $recent_qty;
					$new_total_price = $stock_total_price - $recent_total_price;
					$new_unit_price  = ($new_total_price / $new_qty);

					$update_data = [
				        "qty" 		 => $new_qty,
				        "unit_price" => $new_unit_price,
				        "total" 	 => $new_total_price
				    ];

					$this->db->where('item_code =', $value['item_code'])->update('ji_stock', $update_data);
				} 

			}

			$value['ji_invoice_id'] = $lastID;
			$this->db->insert('ji_invoice_details', $value);
		}

		$time = date("h:i:sa");
		$user_activity_data = [
			'ji_user_id'    => $data['ji_user_id'],
			'ji_invoice_id' => $lastID,
			'activity_type' => 1,
			'date'          => date("Y-m-d"),
			'time'          => $time
		];

		$this->insertUserActivity($user_activity_data);

		// Send sms & store the records in db
		$customer_name = $data['customer_name'];
		$invoice_no    = $data['order_no'];
		$message       = "Hello $customer_name, Order details for your Order No: $invoice_no have been confirmed. We will inform you when your order is on it's way to you. Thanks - your FurnitureBari.com team. Delivery Manager No: 01885936441 and Hotline No: 01885936450";
		$mobile_no 	   = str_replace([' ', ',', '/'], '', $data['mobile_no']);
		$to 	   	   = substr($mobile_no, 0, 11).','.substr($mobile_no, 11, 11);
		$send_sms  	   = sendSMS($to, $message);
		$this->insertSendSMS($lastID, $type='confirmation');

		return true;
	}

	public function EditInvoice(Array $data, $id)
	{
		$detailsData = $data['details'];
		unset($data['details']);

		$field = $this->db->select('*')
					->where('id = ', $id)
					->get('ji_invoice')
					->row();

		$this->db->where('id', $id)
				->update('ji_invoice', $data);

		$this->db->where('ji_invoice_id', $id)
				->delete('ji_invoice_details');

		foreach ($detailsData as $key => $value) 
		{
			$stock_query = $this->db->select('qty, unit_price, total')
								->where('item_code = ', $value['item_code'])
								->get('ji_stock')
								->row();

			$previous_qty 		= $value['previous_qty'];
			$previous_total 	= $value['previous_total'];
			$recent_qty 		= $value['qty'];
			$recent_total_price = $value['total'];
			$stock_qty 			= (!empty($stock_query->qty)) ? $stock_query->qty : 0;
			$stock_total_price  = (!empty($stock_query->total)) ? $stock_query->total : 0;

			if (isset($value['stock_status'])) 
			{
				$value['stock_status'] = 1;

				if (!empty($stock_query)) 
				{
					if ($stock_qty >= $recent_qty) 
					{
						$new_qty 		 = $stock_qty - $recent_qty;
						$new_unit_price  = (($stock_total_price + $recent_total_price) / $new_qty);
						$new_total_price = $new_qty * $new_unit_price;

						$update_data = [
					        "qty" 		 => $new_qty,
					        "unit_price" => $new_unit_price,
					        "total" 	 => $new_total_price
					    ];

					    $this->db->where('item_code =', $value['item_code'])->update('ji_stock', $update_data);
					}

				}

			}
			else
			{
				$value['stock_status'] = 0;

				if (!empty($stock_query)) 
				{
					if ($previous_qty >= $recent_qty)
					{
						$difference_qty = $previous_qty - $recent_qty;
						$difference_total_price = $previous_total - $recent_total_price;

						$update_qty = $stock_qty - $difference_qty;
						$new_qty 	= ($update_qty != 0) ? $update_qty : 1;
						$new_total_price = $stock_total_price - $difference_total_price;
						$new_unit_price  = ($new_total_price / $new_qty);

						$update_data = [
					        "qty" 		 => $new_qty,
					        "unit_price" => $new_unit_price,
					        "total" 	 => $new_total_price
					    ];

					    $this->db->where('item_code =', $value['item_code'])->update('ji_stock', $update_data);
					}
					else
					{
						$difference_qty = $recent_qty - $previous_qty;
						$difference_total_price = $recent_total_price - $previous_total;

						$new_qty = $stock_qty + $difference_qty;
						$new_total_price = $stock_total_price + $difference_total_price;
						$new_unit_price  = ($new_total_price / $new_qty);

						$update_data = [
					        "qty" 		 => $new_qty,
					        "unit_price" => $new_unit_price,
					        "total" 	 => $new_total_price
					    ];

					    $this->db->where('item_code =', $value['item_code'])->update('ji_stock', $update_data);
					}

				}

			}

			unset($value['previous_qty']);
			unset($value['previous_total']);

			$value['ji_invoice_id'] = $id;
			$this->db->insert('ji_invoice_details', $value);
		}
		
		$time = date("h:i:sa");
		$user_activity_data = [
			'ji_user_id' 	=> $data['ji_user_id'],
			'ji_invoice_id' => $id,
			'activity_type' => 2,
			'date'          => date("Y-m-d"),
			'time'          => $time
		];

		$this->insertUserActivity($user_activity_data);
		$lastID = $this->db->insert_id();
		
		$user_activity_field['ji_user_activity_id'] = $lastID;
		if ($field->order_date != $data['order_date']) {
			$user_activity_field['field_name'] = 'Order Date';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->delivery_date != $data['delivery_date']) {
			$user_activity_field['field_name'] = 'Delivery Date';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->sales_person != $data['sales_person']) {
			$user_activity_field['field_name'] = 'Sales Person';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->sales_assistent != $data['sales_assistent']) {
			$user_activity_field['field_name'] = 'Sales Assistent';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->factory != $data['factory']) {
			$user_activity_field['field_name'] = 'Factory';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->order_by != $data['order_by']) {
			$user_activity_field['field_name'] = 'Order By';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->delivery_by != $data['delivery_by']) {
			$user_activity_field['field_name'] = 'Delivery By';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->status != $data['status']) {
			$user_activity_field['field_name'] = 'Status';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->customer_name != $data['customer_name']) {
			$user_activity_field['field_name'] = 'Customer Name';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->mobile_no != $data['mobile_no']) {
			$user_activity_field['field_name'] = 'Mobile No';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->urgency_status != $data['urgency_status']) {
			$user_activity_field['field_name'] = 'Urgency';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->remarks != $data['remarks']) {
			$user_activity_field['field_name'] = 'Remarks';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}
		if ($field->address != $data['address']) {
			$user_activity_field['field_name'] = 'Address';
			$this->db->insert('ji_user_activity_fields', $user_activity_field);
		}

		return true;
	}

	public function count_invoice_num_rows()
	{
		$query = $this->db->select('*')
						->get('ji_invoice')
						->num_rows();
		
		return $query;
	}

	public function getInvoiceReport()
	{
		$this->db->select('ji_invoice.id, ji_invoice.order_no, ji_invoice.mobile_no, ji_invoice.address, ji_invoice.order_date, ji_invoice.delivery_date, ji_invoice.customer_name, ji_invoice.net_total, (ji_invoice.net_total - IFNULL((SELECT SUM(`amount`) from `ji_payment` where `ji_payment`.`ji_invoice_id` = `ji_invoice`.`id` and `ji_payment`.`status` = "1"), 0)) as total_due, ji_invoice.order_by, ji_invoice.delivery_by, ji_invoice.status');
		$this->db->join('ji_invoice_details', 'ji_invoice_details.ji_invoice_id = ji_invoice.id', 'left');
		// $this->db->limit($limit, $offset);

		if($_GET)
		{
			if(!empty($_GET['from_date']))
				$this->db->where('ji_invoice.order_date >=', $this->DateConvertFormTODB($_GET['from_date']));
			if(!empty($_GET['to_date']))
				$this->db->where('ji_invoice.order_date <=', $this->DateConvertFormTODB($_GET['to_date']));
			if(!empty($_GET['item_code']))
				$this->db->like('ji_invoice_details.item_code', $_GET['item_code']);
			if(!empty($_GET['sales_person']))
				$this->db->like('ji_invoice.sales_person', $_GET['sales_person']);
			if(!empty($_GET['status']))
				$this->db->where('ji_invoice.status ', $_GET['status']);
			else
				$this->db->where('ji_invoice.status !=','0');
		}
		else
		{
			$this->db->where('ji_invoice.status !=','0');
		}

		$this->db->group_by('ji_invoice.id')->order_by('id', 'desc');
        $query = $this->db->get('ji_invoice')->result();
        
        return $query;
	}

	public function getInvoiceGraphReport()
	{
		$query = $this->db->select('MONTH(order_date) as month, SUM(total_amount) as total_amount')
					->where('YEAR(order_date) =', date('Y'))
					->where('status =', '3')
					->group_by('MONTH(order_date)')
			        ->get('ji_invoice')
			        ->result();

        return $query;
	}

	public function getInvoiceSummeryReport($month, $year)
	{
		$query = $this->db->select('GROUP_CONCAT(DISTINCT ji_invoice.id SEPARATOR ", ") as id, GROUP_CONCAT(DISTINCT ji_invoice_details.item_code SEPARATOR ", ") as item_code, GROUP_CONCAT(DISTINCT ji_invoice.order_no SEPARATOR ", ") as order_no, GROUP_CONCAT(ji_invoice.status SEPARATOR ", ") as status, day(ji_invoice.delivery_date) as date_day, GROUP_CONCAT(DISTINCT DATEDIFF(ji_invoice.delivery_date, ji_invoice.order_date) SEPARATOR ", ") AS duration, GROUP_CONCAT(DISTINCT ji_payment.reference_no SEPARATOR ", ") as reference_no, GROUP_CONCAT(DISTINCT ji_invoice.total_amount SEPARATOR ", ") as indevidual_amount, SUM(DISTINCT ji_invoice.total_amount) as total_amount')
					->join('ji_invoice_details', 'ji_invoice.id = ji_invoice_details.ji_invoice_id')
					->join('ji_payment', 'ji_invoice.id = ji_payment.ji_invoice_id')
					->where('ji_payment.status', '1')
					->where('MONTH(ji_invoice.delivery_date)', $month)
					->where('YEAR(ji_invoice.delivery_date)', $year)
					->where('ji_invoice.status !=','0')
					->group_by('ji_invoice.delivery_date')
					->order_by('ji_invoice.delivery_date', 'ASC')
			        ->get('ji_invoice')
			        ->result();

        return $query;
	}

	public function InvoiceSelectList()
	{
		$query = $this->db->select('id, order_no')->where('status !=', '0')->get('ji_invoice')->result_array();
		$allID = array_column($query, 'id');
		$allOrderno = array_column($query, 'order_no');

		$result = array_combine($allID, $allOrderno);

        return $result;   
	}

	public function InvoiceList($id='')
	{
		$this->db->select('ji_invoice.*, (ji_invoice.net_total - IFNULL(sum(ji_payment.amount), 0)) as total_due');
		$this->db->join('ji_payment', 'ji_payment.ji_invoice_id = ji_invoice.id', 'left');

		if($id)
		{
			$this->db->where('ji_invoice.id ', $id);
		}

		if ($_GET) 
		{
			/*if($_GET['item_code'])
				$this->db->like('ji_invoice_details.item_code', $_GET['item_code']);*/

			if($_GET['factory'])
				$this->db->like('ji_invoice.factory', $_GET['factory']);

			if($_GET['delivery_by'])
				$this->db->like('ji_invoice.delivery_by', $_GET['delivery_by']);
		}
		else
		{
			$this->db->where('ji_invoice.status !=', '0');
		}

		$this->db->where_in('ji_invoice.status', ['1','2','4']);
		$this->db->group_by('ji_invoice.id')->order_by('id', 'desc');

        $query = $this->db->get('ji_invoice')->result();

        return $query;
	}

	public function InvoiceEditData($id)
	{
		$query = $this->db->select('*')
							->where('status !=', '0')
							->where('id', $id)
							->get('ji_invoice')
							->row();

		$advanceFetchQuery = $this->db->select('GROUP_CONCAT(amount SEPARATOR ", ") as amount')
							->where('status !=', '0')
							->where('ji_invoice_id', $id)
							->where('reference_no', 'Advance')
							->get('ji_payment')
							->row();

		$childQuery = $this->db->select('*')
								->where('ji_invoice_id', $id)
								->get('ji_invoice_details')
								->result_array();

		$editHistoryQuery = $this->db->select('ji_user.name as user_name, ji_user_activity.id as ji_user_activity_id, ji_user_activity.date as edit_date, ji_user_activity.time as edit_time, ji_user_activity_fields.field_name')
								->join('ji_user_activity_fields', 'ji_user_activity.id = ji_user_activity_fields.ji_user_activity_id')
								->join('ji_user', 'ji_user.id = ji_user_activity.ji_user_id')
								->where('ji_user_activity.ji_invoice_id', $id)
								->get('ji_user_activity')
								->result();

        return ["parent" => $query, "child" => $childQuery, "advance_fetch" => $advanceFetchQuery, "edit_history" => $editHistoryQuery];
	}

	public function exportInvoice()
	{
		$query = $this->db->select('ji_invoice.*, (ji_invoice.net_total - IFNULL(sum(ji_payment.amount), 0)) as total_due')
					->join('ji_payment', 'ji_payment.ji_invoice_id = ji_invoice.id', 'left')
					->group_by('ji_invoice.id')
					->order_by('ji_invoice.id', 'desc')
					->get('ji_invoice')
					->result();

        return $query;
	}

	public function checkSendOrderConfirmationSms($id)
	{
		$query = $this->db->select('sms_type')
					->where('ji_invoice_id', $id)
					->where('sms_type', 1)
					->get('ji_send_sms')
					->result();

		return $query;
	}

	public function checkSendBeforeDeliverySms($id)
	{
		$query = $this->db->select('sms_type')
					->where('ji_invoice_id', $id)
					->where('sms_type', 2)
					->get('ji_send_sms')
					->result();

		return $query;
	}

	public function checkSendDueSms($id)
	{
		$query = $this->db->select('sms_type')
					->where('ji_invoice_id', $id)
					->where('sms_type', 3)
					->get('ji_send_sms')
					->result();

		return $query;
	}

	public function checkSendClearSms($id)
	{
		$query = $this->db->select('sms_type')
					->where('ji_invoice_id', $id)
					->where('sms_type', 4)
					->get('ji_send_sms')
					->result();

		return $query;
	}

}
