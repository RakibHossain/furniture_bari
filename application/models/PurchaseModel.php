<?php

class PurchaseModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Dhaka");
	}
	
	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	public function count_purchase_bill_num_rows()
	{
		$query = $this->db->select('id')
						->get('ji_purchase_bills')
						->num_rows();
		
		return $query;
	}

	public function count_purchase_pay_bill_num_rows()
	{
		$query = $this->db->select('id')
						->get('ji_purchase_pay_bills')
						->num_rows();
		
		return $query;
	}

	public function searchPOID($po_id='')
	{
		$query = $this->db->select('po_id')
						->where('po_id =', $po_id)
						->get('ji_production_cost')
						->result();

		if (!empty($query)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
		
	}

	public function fetchAccount()
	{
		$query = $this->db->select('*')->get('ji_accounts')->result();

		return $query;
	}

	public function fetchInvoice()
	{
		$query = $this->db->select('order_no')
						->where('status = ', 3) // This is somthing ridiculous, status should be '1' but it's not working. It works for status '3'.
						->get('ji_invoice')
						->result();
        
        return $query;
	}

	public function fetchEditItem($id='')
	{
		$query = $this->db->select('*')
						->where('id = ', $id)
						->get('ji_purchase_item')
						->row();
        
        return $query;
	}

	public function fetchItemName()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_purchase_item_name')
						->result();

		return $query;
	}

	public function fetchProcessID()
	{
		$query = $this->db->select('po_id')
						->get('ji_production_process')
						->result();

		return $query;
	}

	public function fetchEditItemName($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_purchase_item_name')
						->row();

		return $query;
	}

	public function fetchEditItemGroup($id='')
	{
		$query = $this->db->select('*')
						->where('id = ', $id)
						->get('ji_purchase_item_group')
						->row();
        
        return $query;
	}

	public function fetchEditSupplierType($id='')
	{
		$query = $this->db->select('*')
						->where('id = ', $id)
						->get('ji_supplier_type')
						->row();
        
        return $query;
	}

	public function fetchEditSupplier($id='')
	{
		$query = $this->db->select('*')
						->where('id = ', $id)
						->get('ji_supplier')
						->row();
        
        return $query;
	}

	public function fetchEditPayBill($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_purchase_pay_bills')
						->row();
        
        return $query;
	}

	public function insertUserActivity(Array $user_activity_data)
	{
		$this->db->insert('ji_user_activity', $user_activity_data);
	}

	public function insertItem(Array $post_items)
	{
		$post_items['item_code'] = strtoupper($post_items['item_code']);
		
		$this->db->insert('ji_purchase_item', $post_items);
	}

	public function updateItem(Array $update_item, $id)
	{
		$update_item['item_code'] = strtoupper($update_item['item_code']);

		$this->db->where('id = ', $id)
				->update('ji_purchase_item', $update_item);
	}

	public function insertItemName(Array $post_item_name)
	{
		$post_item_name['item_name'] = ucfirst($post_item_name['item_name']);

		$this->db->insert('ji_purchase_item_name', $post_item_name);
	}

	public function updateItemName(Array $update_item_name, $id)
	{
		$update_item_name['item_name'] = ucfirst($update_item_name['item_name']);

		$this->db->where('id = ', $id)
				->update('ji_purchase_item_name', $update_item_name);
	}

	public function deleteItemName($id)
	{
		$this->db->where('id = ', $id)->delete('ji_purchase_item_name');
	}

	public function insertItemGroup(Array $post_item_groups)
	{
		$this->db->insert('ji_purchase_item_group', $post_item_groups);
	}

	public function updateItemGroup(Array $update_item_group, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_purchase_item_group', $update_item_group);
	}

	public function fetchItem()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_purchase_item')
						->result();

		return $query;
	}

	public function fetchProductItem()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_product_item_name')
						->result();

		return $query;
	}

	public function fetchPurchaseItem()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_purchase_item_name')
						->result();

		return $query;
	}

	public function fetchPurchaseItemCode($item_name='')
	{
		$query = $this->db->select('item_code')
						->where('item_name', $item_name)
						->order_by('id', 'desc')
						->get('ji_purchase_item')
						->result();

		if (empty($query)) 
		{
			$query = $this->db->select('item_code')
						->where('item_name', $item_name)
						->order_by('id', 'desc')
						->get('ji_product_item')
						->result();
		}

		return $query;
	}

	public function fetchItemGroup()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_purchase_item_group')
						->result();

		return $query;
	}

	public function getBill($limit, $offset)
	{
		if ($this->session->userdata['logged_in']['role'] == 1) 
		{
			$query = $this->db->select('*')
						->order_by('id', 'desc')
						->limit($limit, $offset)
						->get('ji_purchase_bills')
						->result();
		}
		else
		{
			$query = $this->db->select('*')
						->where("date >= DATE_SUB(NOW(), INTERVAL 2 MONTH)")
						->order_by('id', 'desc')
						->limit($limit, $offset)
						->get('ji_purchase_bills')
						->result();
		}

		return $query;
	}

	public function getPayBill($limit, $offset)
	{
		if ($this->session->userdata['logged_in']['role'] == 1) 
		{
			$query = $this->db->select('*')
						->order_by('id', 'desc')
						->limit($limit, $offset)
						->get('ji_purchase_pay_bills')
						->result();
		} 
		else 
		{
			$query = $this->db->select('*')
						->where("date >= DATE_SUB(NOW(), INTERVAL 2 MONTH)")
						->order_by('id', 'desc')
						->limit($limit, $offset)
						->get('ji_purchase_pay_bills')
						->result();
		}

		return $query;
	}

	public function fetchSupplier()
	{
		$query = $this->db->select('*')
						->order_by('supplier_category', 'desc')
						->get('ji_supplier')
						->result();

		return $query;
	}

	public function getSupplierReport(Array $supplier_report_info)
	{
		$supplier_name = $supplier_report_info['supplier_name'];
		$bill_type = $supplier_report_info['bill_type'];

		if ($bill_type == "Bill") 
		{
			$query = $this->db->select('id, date, total_qty as qty, total_amount as amount')
						->where('supplier', $supplier_name)
						->order_by('id', 'desc')
						->get('ji_purchase_bills')
						->result();
		} 
		else 
		{
			$query = $this->db->select('id, date, account, amount')
						->where('supplier', $supplier_name)
						->order_by('id', 'desc')
						->get('ji_purchase_pay_bills')
						->result();
		}

		return $query;
	}

	public function fetchSupplierType()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_supplier_type')
						->result();

		return $query;
	}

	public function fetchEditBill($id='')
	{
		$parentQuery = $this->db->select('*')
							->where('id', $id)
							->get('ji_purchase_bills')
							->row();

		$childQuery = $this->db->select('*')
								->where('ji_purchase_bill_id', $id)
								->get('ji_purchase_bill_details')
								->result();

        return ["parent"=>$parentQuery, "child"=>$childQuery];

	}

	public function fetchPaymentType()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_payment_type')
						->result();

		return $query;
	}

	public function getAccBalance($account='')
	{
		$query = $this->db->select('amount')
						->where('account_name = ', $account)
						->get('ji_account_reports')
						->row();

		return $query;
	}

	public function getSupplierBalance($supplier='')
	{
		$query = $this->db->select('balance')
						->where('name = ', $supplier)
						->get('ji_supplier')
						->row();

		return $query;
	}

	public function fetchPurchaseReport($post_purchase_reports)
	{
		$item_name = $post_purchase_reports['item_name'];
		$item_code = $post_purchase_reports['item_code'];
		$from_date = $this->DateConvertFormTODB($post_purchase_reports['from_date']);
		$to_date = $this->DateConvertFormTODB($post_purchase_reports['to_date']);

		if ($item_name == 'Select Item Name') 
		{
			$item_name = '';
		}

		if ($item_code == 'Select Item Code') 
		{
			$item_code = '';
		}

		$this->db->select('ji_purchase_bills.*');
		$this->db->join('ji_purchase_bill_details', 'ji_purchase_bills.id = ji_purchase_bill_details.ji_purchase_bill_id', 'left');

		if (!empty($item_name)) 
		{
			$this->db->where('ji_purchase_bill_details.item_name = ', $item_name);
		}

		if (!empty($item_code)) 
		{
			$this->db->where('ji_purchase_bill_details.item_code = ', $item_code);
		}

		$this->db->where("ji_purchase_bills.date >", $from_date);
		$this->db->where("ji_purchase_bills.date <=", $to_date);
		$this->db->order_by('ji_purchase_bills.date', 'ASC');
		$query = $this->db->get('ji_purchase_bills')->result();

		return $query;
	}

	public function deleteItem($id)
	{
		$this->db->where('id = ', $id)->delete('ji_purchase_item');
	}

	public function deleteItemGroup($id)
	{
		$this->db->where('id = ', $id)->delete('ji_purchase_item_group');
	}

	public function checkSupplier(Array $post_supplier)
	{
		$query = $this->db->select('id')
					->where('name', $post_supplier['name'])
					->where('type', $post_supplier['type'])
					->get('ji_supplier')
					->row();

		return $query;
	}

	public function insertSupplier(Array $post_supplier)
	{
		$this->db->insert('ji_supplier', $post_supplier);
	}

	public function updateSupplier(Array $update_supplier, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_supplier', $update_supplier);
	}

	public function insertSupplierType(Array $post_supplier_type)
	{
		$this->db->insert('ji_supplier_type', $post_supplier_type);
	}

	public function updateSupplierType(Array $update_supplier_type, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_supplier_type', $update_supplier_type);
	}

	public function deleteSupplier($id)
	{
		$this->db->where('id = ', $id)->delete('ji_supplier');
	}

	public function deleteSupplierType($id)
	{
		$this->db->where('id = ', $id)->delete('ji_supplier_type');
	}

	public function insertBill(Array $data)
	{
		$detailsData = $data['details'];
		$account = $data['account'];
		$supplier = $data['supplier'];
		$net_total = $data['net_total'];
		$data['date'] = $this->DateConvertFormTODB($data['date']);

		if (isset($data['pay_bill'])) 
		{
			$pay_bill = $data['pay_bill'];
			unset($data['pay_bill']);
		}

		unset($data['details']);
		unset($data['account']);

		$supplier_balance_query = $this->db->select('balance')
										->where('name = ', $supplier)
										->get('ji_supplier')
										->row();

		$supplier_balance_amount = (!empty($supplier_balance_query->balance)) ? $supplier_balance_query->balance : 0;

		$this->db->insert('ji_purchase_bills', $data);
		$lastID = $this->db->insert_id();

		if (isset($pay_bill)) 
		{
			$pay_bill_data = [

				'date' => $this->DateConvertFormTODB($data['date']),
				'supplier' => $supplier,
				'payment_type' => "Cash",
				'account' => $account,
				'amount' => $net_total

			];

			$this->db->insert('ji_purchase_pay_bills', $pay_bill_data);
			
			$account_balance_query = $this->db->select('amount')
										->where('account_name = ', $account)
										->get('ji_account_reports')
										->row();

			$account_balance_amount = $account_balance_query->amount;
			$new_account_balance_amount = $account_balance_amount - $net_total;

			$this->db->set('amount', $new_account_balance_amount)
						->where('account_name = ', $account)
						->update('ji_account_reports');

			$insert_expanse_report = [

				'ji_purchase_pay_bill_id' 	=> $lastID,
				'date' 						=> $this->DateConvertFormTODB($data['date']),
				'purchase_expanse_total' 	=> $net_total

			];

			$this->db->insert('ji_expanse_report', $insert_expanse_report);
		}
		else
		{
			$new_supplier_balance_amount = $supplier_balance_amount + $net_total;

			$this->db->set('balance', $new_supplier_balance_amount)
						->where('name = ', $supplier)
						->update('ji_supplier');
		}

		foreach ($detailsData as $key => $value) 
		{
			if (isset($value['stock_status'])) 
			{
				$value['stock_status'] = 1;
				$value['po_id'] = '';
			}

			$fetch_item_code_query = $this->db->select('*')
							->where('item_code = ', $value['item_code'])
							->get('ji_purchase_item')
							->row();

			if (!empty($fetch_item_code_query)) 
			{
				$item_code = $fetch_item_code_query->item_code;
				$sales_item_status = $fetch_item_code_query->sales_item;
			}
			else
			{
				$item_code = $value['item_code'];
				$sales_item_status = 2;
			}

			$stock_query = $this->db->select('qty, unit_price, total')
							->where('item_code = ', $item_code)
							->get('ji_stock')
							->row();

			if (!empty($stock_query)) 
			{
				$stock_qty = (!empty($stock_query->qty)) ? $stock_query->qty : 0;
				$recent_qty = $value['qty'];

				$stock_total_price = (!empty($stock_query->total)) ? $stock_query->total : 0;
				$recent_total_price = $value['total'];

				$new_qty = $stock_qty + $recent_qty;
				$new_total_price = $stock_total_price + $recent_total_price;
				$new_unit_price = ($new_total_price / $new_qty);

				$update_data = [

			        "qty" 			=> $new_qty,
			        "unit_price" 	=> $new_unit_price,
			        "total" 		=> $new_total_price

			    ];

				$this->db->where('item_code', $item_code)
						->update('ji_stock', $update_data);

				$value['ji_purchase_bill_id'] = $lastID;
				$this->db->insert('ji_purchase_bill_details', $value);
			} 
			else 
			{
				$value['ji_purchase_bill_id'] = $lastID;
				$this->db->insert('ji_purchase_bill_details', $value);

				unset($value['stock_status']);
				unset($value['po_id']);
				unset($value['description']);
				unset($value['ji_purchase_bill_id']);

				if ($sales_item_status == 1) 
				{
					$value['item_category'] = "Sales Item";
				} 
				else 
				{
					$value['item_category'] = "Purchase Item";
				}

				$this->db->insert('ji_stock', $value);
				
			}

		}

		date_default_timezone_set("Asia/Dhaka");
		$time = date("h:i:sa");

		$user_activity_data = [

			'ji_user_id'    => $data['ji_user_id'],
			'ji_purchase_bill_id' => $lastID,
			'activity_type' => 1,
			'date'          => date("Y-m-d"),
			'time'          => $time

		];

		$this->insertUserActivity($user_activity_data);

		return true;
	}

	public function updateBill(Array $update_bill, $id)
	{
		$supplier = $update_bill['supplier'];
		$net_total = $update_bill['net_total'];
		$previous_supplier = $update_bill['previous_supplier'];
		$previous_net_total = $update_bill['previous_net_total'];
		$detailsData = $update_bill['details'];
		$update_bill['date'] = $this->DateConvertFormTODB($update_bill['date']);

		unset($update_bill['details']);
		unset($update_bill['previous_supplier']);
		unset($update_bill['previous_net_total']);

		$this->db->where('id', $id)
				->update('ji_purchase_bills', $update_bill);

		$this->db->where('ji_purchase_bill_id', $id)
				->delete('ji_purchase_bill_details');

		$supplier_balance_query = $this->db->select('balance')
					->where('name = ', $supplier)
					->get('ji_supplier')
					->row();

		$supplier_balance_amount = (!empty($supplier_balance_query->balance)) ? $supplier_balance_query->balance : 0;

		if ($supplier == $previous_supplier) 
		{
			if ($previous_net_total >= $net_total) 
			{
				$difference_supplier_balance_amount = $previous_net_total - $net_total;
				$new_supplier_balance_amount = $supplier_balance_amount - $difference_supplier_balance_amount;
			} 
			else 
			{
				$difference_supplier_balance_amount = $net_total - $previous_net_total;
				$new_supplier_balance_amount = $supplier_balance_amount + $difference_supplier_balance_amount;
			}

			$this->db->set('balance', $new_supplier_balance_amount)
						->where('name = ', $supplier)
						->update('ji_supplier');
		} 
		else 
		{
			$previous_supplier_balance_query = $this->db->select('balance')
								->where('name = ', $previous_supplier)
								->get('ji_supplier')
								->row();

			$previous_supplier_balance_amount = (!empty($previous_supplier_balance_query->balance)) ? $previous_supplier_balance_query->balance : 0;
			$new_supplier_balance_amount = $previous_supplier_balance_amount - $net_total;

			$this->db->set('balance', $new_supplier_balance_amount)
						->where('name = ', $previous_supplier)
						->update('ji_supplier');
			
			$new_supplier_balance_amount = $supplier_balance_amount + $net_total;

			$this->db->set('balance', $new_supplier_balance_amount)
						->where('name = ', $supplier)
						->update('ji_supplier');	
		}

		foreach ($detailsData as $key => $value) 
		{
			if (isset($value['stock_status'])) 
			{
				$value['stock_status'] = 1;
				$value['po_id'] = '';
			}

			$fetch_item_code_query = $this->db->select('*')
							->where('item_code = ', $value['item_code'])
							->get('ji_purchase_item')
							->row();

			$item_code = $fetch_item_code_query->item_code;
			$sales_item_status = $fetch_item_code_query->sales_item;

			$stock_query = $this->db->select('qty, unit_price, total')
							->where('item_code = ', $item_code)
							->get('ji_stock')
							->row();

			if (!empty($stock_query)) 
			{
				$stock_qty = (!empty($stock_query->qty)) ? $stock_query->qty : 0;
				$recent_qty = $value['qty'];
				$previous_qty = $value['previous_qty'];

				$stock_total_price = (!empty($stock_query->total)) ? $stock_query->total : 0;
				$recent_total_price = $value['total'];
				$previous_total_price = $value['previous_total'];

				if ($previous_qty >= $recent_qty) 
				{
					$difference_qty = $previous_qty - $recent_qty;
					$new_qty = $stock_qty - $difference_qty;
				}
				else
				{
					$difference_qty = $recent_qty - $previous_qty;
					$new_qty = $stock_qty + $difference_qty;
				}

				if ($previous_total_price >= $recent_total_price) 
				{
					$difference_total_price = $previous_total_price - $recent_total_price;
					$new_total_price = $stock_total_price + $difference_total_price;
				}
				else
				{
					$difference_total_price = $recent_total_price - $previous_total_price;
					$new_total_price = $stock_total_price - $difference_total_price;
				}

				$new_unit_price = ($new_total_price / $new_qty);

				$update_data = [

			        "qty" => $new_qty,
			        "unit_price" => $new_unit_price,
			        "total" => $new_total_price

			    ];

				$this->db->where('item_code', $item_code)
						->update('ji_stock', $update_data);

				unset($value['previous_qty']);
				unset($value['previous_unit_price']);
				unset($value['previous_total']);

				$value['ji_purchase_bill_id'] = $id;
				$this->db->insert('ji_purchase_bill_details', $value);
			} 
			else 
			{
				unset($value['previous_qty']);
				unset($value['previous_unit_price']);
				unset($value['previous_total']);

				$value['ji_purchase_bill_id'] = $id;
				$this->db->insert('ji_purchase_bill_details', $value);

				unset($value['stock_status']);
				unset($value['po_id']);
				unset($value['description']);
				unset($value['ji_purchase_bill_id']);

				if ($sales_item_status == 1) 
				{
					$value['item_category'] = "Sales Item";
				} 
				else 
				{
					$value['item_category'] = "Purchase Item";
				}

				$this->db->insert('ji_stock', $value);
				
			}

		}

		date_default_timezone_set("Asia/Dhaka");
		$time = date("h:i:sa");

		$user_activity_data = [

			'ji_user_id'    => $update_bill['ji_user_id'],
			'ji_purchase_bill_id' => $id,
			'activity_type' => 2,
			'date'          => date("Y-m-d"),
			'time'          => $time

		];

		$this->insertUserActivity($user_activity_data);

		return true;
	}

	public function deleteBill($id)
	{
		$this->db->where('id = ', $id)->delete('ji_purchase_bills');
		$this->db->where('ji_purchase_bill_id = ', $id)->delete('ji_purchase_bill_details');
	}

	public function insertPayBill(Array $post_pay_bill)
	{
		$account  = $post_pay_bill['account'];
		$amount   = $post_pay_bill['amount'];
		$supplier = $post_pay_bill['supplier'];
		$date     = $this->DateConvertFormTODB($post_pay_bill['date']);
		$post_pay_bill['date'] = $this->DateConvertFormTODB($post_pay_bill['date']);

		$this->db->insert('ji_purchase_pay_bills', $post_pay_bill);
		$lastID = $this->db->insert_id();

		$account_balance_query = $this->db->select('amount')
									->where('account_name = ', $account)
									->get('ji_account_reports')
									->row();

		$supplier_balance_query = $this->db->select('balance')
									->where('name = ', $supplier)
									->get('ji_supplier')
									->row();

		$account_balance_amount  = $account_balance_query->amount;
		$supplier_balance_amount = $supplier_balance_query->balance;

		$new_account_balance_amount  = $account_balance_amount - $amount;
		$new_supplier_balance_amount = $supplier_balance_amount - $amount;

		$this->db->set('amount', $new_account_balance_amount)
					->where('account_name = ', $account)
					->update('ji_account_reports');

		$this->db->set('balance', $new_supplier_balance_amount)
					->where('name = ', $supplier)
					->update('ji_supplier');

		$insert_expanse_report = [

			'ji_purchase_pay_bill_id' => $lastID,
			'date' 					  => $date,
			'purchase_expanse_total'  => $amount

		];

		$this->db->insert('ji_expanse_report', $insert_expanse_report);

		$fields = $this->db->field_data('ji_account_outgoing_reports');
		$account_name = str_replace([' ', ':', '(', ')'], '', $post_pay_bill['account']);

		foreach ($fields as $field)
		{
			if ($field->name == $account_name) 
			{
				$insert_account_incoming_report = [

					'date' => $date,
					'ji_purchase_pay_bill_id' => $lastID,
					$account_name => $post_pay_bill['amount']
					
				];

				$this->db->insert('ji_account_outgoing_reports', $insert_account_incoming_report);
				break;
			}

		}

		$supplier = $this->db->select('supplier_category')
									->where('name = ', $supplier)
									->get('ji_supplier')
									->row();

		if ($supplier->supplier_category == 'cash') 
		{
			$insert_account_balance_report = [

				'date' 			=> $date,
				'account_name'	=> $account,
				'cash_purchase' => $post_pay_bill['amount'],
				'ji_purchase_pay_bill_id' => $lastID,
				
			];

		}
		else
		{
			$insert_account_balance_report = [

				'date' 			=> $date,
				'account_name'	=> $account,
				'vendor_pay' 	=> $post_pay_bill['amount'],
				'ji_purchase_pay_bill_id' => $lastID,
				
			];

		}

		$this->db->insert('ji_account_balance_reports', $insert_account_balance_report);

		$user_activity_data = [

			'ji_user_id'    => $post_pay_bill['ji_user_id'],
			'ji_purchase_pay_bill_id' => $lastID,
			'activity_type' => 1,
			'date'          => date("Y-m-d"),
			'time'          => date("h:i:sa")

		];

		$this->insertUserActivity($user_activity_data);
		return true;
	}

	public function updatePayBill(Array $update_pay_bill, $id)
	{
		$account 				 = $update_pay_bill['account'];
		$amount 				 = $update_pay_bill['amount'];
		$supplier 				 = $update_pay_bill['supplier'];
		$previous_account 		 = $update_pay_bill['previous_account'];
		$previous_amount 		 = $update_pay_bill['previous_amount'];
		$previous_supplier 		 = $update_pay_bill['previous_supplier'];
		$date 					 = $this->DateConvertFormTODB($update_pay_bill['date']);
		$update_pay_bill['date'] = $this->DateConvertFormTODB($update_pay_bill['date']);

		unset($update_pay_bill['previous_account']);
		unset($update_pay_bill['previous_amount']);
		unset($update_pay_bill['previous_supplier']);

		$account_balance_query = $this->db->select('amount')
					->where('account_name = ', $account)
					->get('ji_account_reports')
					->row();

		$account_balance_amount = $account_balance_query->amount;

		$supplier_balance_query = $this->db->select('balance')
					->where('name = ', $supplier)
					->get('ji_supplier')
					->row();

		$supplier_balance_amount = (!empty($supplier_balance_query->balance)) ? $supplier_balance_query->balance : 0;

		if ($previous_supplier == $supplier) 
		{
			if ($previous_account == $account) 
			{
				if ($previous_amount >= $amount) 
				{
					$difference_amount = $previous_amount - $amount;
					$new_balance_amount = $account_balance_amount + $difference_amount;
				} 
				else 
				{
					$difference_amount = $amount - $previous_amount;
					$new_balance_amount = $account_balance_amount - $difference_amount;
				}

				$this->db->set('amount', $new_balance_amount)
						->where('account_name = ', $account)
						->update('ji_account_reports');

			} 
			else 
			{
				$previous_account_query = $this->db->select('amount')
						->where('account_name = ', $previous_account)
						->get('ji_account_reports')
						->row();

				$previous_account_amount = $previous_account_query->amount;
				$new_balance_amount = $previous_account_amount + $previous_amount;

				$this->db->set('amount', $new_balance_amount)
						->where('account_name = ', $previous_account)
						->update('ji_account_reports');

				$new_balance_amount = $account_balance_amount - $amount;

				$this->db->set('amount', $new_balance_amount)
						->where('account_name = ', $account)
						->update('ji_account_reports');
						
			}

			if ($previous_amount >= $amount) 
			{
				$difference_amount = $previous_amount - $amount;
				$new_supplier_balance_amount = $supplier_balance_amount + $difference_amount;
			} 
			else 
			{
				$difference_amount = $amount - $previous_amount;
				$new_supplier_balance_amount = $supplier_balance_amount - $difference_amount;
			}

			$this->db->set('balance', $new_supplier_balance_amount)
						->where('name = ', $supplier)
						->update('ji_supplier');	
		} 
		else 
		{
			if ($previous_account == $account) 
			{
				if ($previous_amount >= $amount) 
				{
					$difference_amount = $previous_amount - $amount;
					$new_balance_amount = $account_balance_amount + $difference_amount;
				} 
				else 
				{
					$difference_amount = $amount - $previous_amount;
					$new_balance_amount = $account_balance_amount - $difference_amount;
				}

				$this->db->set('amount', $new_balance_amount)
						->where('account_name = ', $account)
						->update('ji_account_reports');
			} 
			else 
			{
				$previous_account_query = $this->db->select('amount')
						->where('account_name = ', $previous_account)
						->get('ji_account_reports')
						->row();

				$previous_account_amount = $previous_account_query->amount;
				$new_balance_amount = $previous_account_amount + $previous_amount;

				$this->db->set('amount', $new_balance_amount)
						->where('account_name = ', $previous_account)
						->update('ji_account_reports');

				$new_balance_amount = $account_balance_amount - $amount;

				$this->db->set('amount', $new_balance_amount)
						->where('account_name = ', $account)
						->update('ji_account_reports');
						
			}

			$previous_supplier_balance_query = $this->db->select('balance')
								->where('name = ', $previous_supplier)
								->get('ji_supplier')
								->row();

			$previous_supplier_balance_amount = (!empty($previous_supplier_balance_query->balance)) ? $previous_supplier_balance_query->balance : 0;
			$new_supplier_balance_amount = $previous_supplier_balance_amount + $previous_amount;

			$this->db->set('balance', $new_supplier_balance_amount)
						->where('name = ', $previous_supplier)
						->update('ji_supplier');
			
			$new_supplier_balance_amount = $supplier_balance_amount - $amount;

			$this->db->set('balance', $new_supplier_balance_amount)
						->where('name = ', $supplier)
						->update('ji_supplier');
		}

		$this->db->where('id = ', $id)
				->update('ji_purchase_pay_bills', $update_pay_bill);

		$update_expanse_report = [

			'ji_purchase_pay_bill_id' => $id,
			'date' 					  => $date,
			'purchase_expanse_total'  => $amount

		];

		$this->db->where('ji_purchase_pay_bill_id', $id)
				->update('ji_expanse_report', $update_expanse_report);

		$this->db->where('ji_purchase_pay_bill_id', $id)->delete('ji_account_outgoing_reports');
		$fields = $this->db->field_data('ji_account_outgoing_reports');
		$account_name = str_replace([' ', ':', '(', ')'], '', $update_pay_bill['account']);

		foreach ($fields as $field)
		{
			if ($field->name == $account_name) 
			{
				$insert_account_incoming_report = [

					'date' => $date,
					'ji_purchase_pay_bill_id' => $id,
					$account_name => $update_pay_bill['amount']
					
				];

				$this->db->insert('ji_account_outgoing_reports', $insert_account_incoming_report);
				break;
			}

		}

		$supplier = $this->db->select('supplier_category')
									->where('name = ', $supplier)
									->get('ji_supplier')
									->row();

		if ($supplier->supplier_category == 'cash') 
		{
			$insert_account_balance_report = [

				'date' 			=> $date,
				'account_name'	=> $account,
				'cash_purchase' => $update_pay_bill['amount'],
				'ji_purchase_pay_bill_id' => $id,
				
			];

		}
		else
		{
			$insert_account_balance_report = [

				'date' 			=> $date,
				'account_name'	=> $account,
				'vendor_pay' 	=> $update_pay_bill['amount'],
				'ji_purchase_pay_bill_id' => $id,
				
			];

		}

		$this->db->where('ji_purchase_pay_bill_id = ', $id)
				->update('ji_account_balance_reports', $insert_account_balance_report);

		$user_activity_data = [

			'ji_user_id'    => $update_pay_bill['ji_user_id'],
			'ji_purchase_pay_bill_id' => $id,
			'activity_type' => 2,
			'date'          => date("Y-m-d"),
			'time'          => date("h:i:sa")

		];

		$this->insertUserActivity($user_activity_data);
		return true;
	}

	public function deletePayBill($id)
	{
		$this->db->where('id = ', $id)->delete('ji_purchase_pay_bills');
	}

	public function purchaseSummeryReport($month, $year)
	{
		$query = $this->db->select('GROUP_CONCAT(DISTINCT ji_purchase_bills.id SEPARATOR ", ") as id, GROUP_CONCAT(DISTINCT ji_purchase_bills.supplier SEPARATOR ", ") as supplier, day(ji_purchase_bills.date) as date_day, GROUP_CONCAT(DISTINCT ji_purchase_bill_details.total SEPARATOR ", ") as individual_amount, SUM(DISTINCT ji_purchase_bills.net_total) as total_amount')
					->join('ji_purchase_bill_details', 'ji_purchase_bills.id = ji_purchase_bill_details.ji_purchase_bill_id')
					->where('MONTH(ji_purchase_bills.date)', $month)
					->where('YEAR(ji_purchase_bills.date)', $year)
					->group_by('ji_purchase_bills.date')
					->order_by('ji_purchase_bills.date', 'ASC')
			        ->get('ji_purchase_bills')
			        ->result();

        return $query;
	}

}
