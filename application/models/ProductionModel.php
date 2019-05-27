<?php

class ProductionModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	public function count_production_process_num_rows()
	{
		$query = $this->db->select('id')
						->get('ji_production_process')
						->num_rows();
		
		return $query;
	}

	public function searchPOID($po_id='')
	{
		$query = $this->db->select('po_id')
						->where('po_id =', $po_id)
						->get('ji_production_cost')
						->result();

		return $query;
	}

	public function getSalesItem()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_product_item')
						->result();

		return $query;
	}

	public function getProductionBudgetItem()
	{
		$query = $this->db->select('DISTINCT(item_code)')
						->order_by('id', 'desc')
						->get('ji_production_budget')
						->result();

		return $query;
	}

	public function fetchItem()
	{
		$query = $this->db->select('*')
						->get('ji_product_item_name')
						->result();

		return $query;
	}

	public function fetchActivity()
	{
		$query = $this->db->select('*')
						->get('ji_production_activity')
						->result();

		return $query;
	}

	public function fetchItemActivity()
	{
		$query = $this->db->select('*')
						->get('ji_production_activity_item')
						->result();

		return $query;
	}

	public function fetchItemCode()
	{
		$query = $this->db->select('item_code')
						->get('ji_product_item')
						->result();

		return $query;
	}

	public function fetchBudgetInfo($budget_item_po_id='')
	{
		$query = $this->db->select('*')
							->where('po_id = ', $budget_item_po_id['po_id'])
							->get('ji_production_process')
							->row();

		return $query;
	}

	public function getExistingItemBudget($item_code='')
	{
		$production_budget_query = $this->db->select('*')
						->where('item_code', $item_code)
				        ->get('ji_production_budget')
				        ->result();

		$material_budget_query = $this->db->select('ji_production_material_budget.*')
						->join('ji_production_material_budget', 'ji_production_material_budget.ji_production_budget_id = ji_production_budget.id', 'left')
						->where('ji_production_budget.item_code', $item_code)
				        ->get('ji_production_budget')
				        ->result();

		$operational_budget_query = $this->db->select('ji_production_operation_budget.*')
						->join('ji_production_operation_budget', 'ji_production_operation_budget.ji_production_budget_id = ji_production_budget.id', 'left')
						->where('ji_production_budget.item_code', $item_code)
				        ->get('ji_production_budget')
				        ->result();

        return ["production_budget" => $production_budget_query, "material_budget" => $material_budget_query, "operational_budget" => $operational_budget_query];
	}

	public function getProductionProcessID($type='')
	{
		$parentQuery = $this->db->select('po_id')
							->get('ji_production_process')
							->result();

		if ($type == 'budget') 
		{
			$childQuery = $this->db->select('po_id')
							->get('ji_production_budget')
							->result();
		} 
		else 
		{
			$childQuery = $this->db->select('po_id')
							->get('ji_production_cost')
							->result();
		}

		return ["parent" => $parentQuery, "child" => $childQuery];
	}

	public function fetchPOID()
	{
		$query = $this->db->select('po_id')
							->get('ji_production_process')
							->result();

		return $query;
	}

	public function fetchStockProductionProcessItemName()
	{
		$query = $this->db->select('item_name')
						->get('ji_product_item_name')
						->result();

		return $query;
	}

	public function fetchStockProductionProcessItemCode()
	{
		$query = $this->db->select('item_code')
						->get('ji_product_item')
						->result();

		return $query;
	}

	public function fetchProductionProcessItemName($invoice_no)
	{
		$query = $this->db->select('ji_invoice_details.item_name')
						->join('ji_invoice', 'ji_invoice.id = ji_invoice_details.ji_invoice_id', 'left')
						->where('ji_invoice.order_no = ', $invoice_no)
						->get('ji_invoice_details')
						->result();

		return $query;
	}

	public function fetchProductionProcessItemCode($invoice_no)
	{
		$query = $this->db->select('ji_invoice_details.item_code')
						->join('ji_invoice', 'ji_invoice.id = ji_invoice_details.ji_invoice_id', 'left')
						->where('ji_invoice.order_no = ', $invoice_no)
						->get('ji_invoice_details')
						->result();

		return $query;
	}

	public function fetchActivityItem(Array $item_name)
	{
		$item_id = '';

		$item_query = $this->db->select('id')
						->where('item_name = ', $item_name['item_name'])
						->get('ji_production_activity_item')
						->row();

		if (!empty($item_query)) 
		{
			$item_id = $item_query->id;
		}

		$activity_query = $this->db->select('*')
					->where('ji_production_activity_item_id = ', $item_id)
					->get('ji_production_activity_item_details')
					->result();

		return $activity_query;
	}

	public function fetchEditItemActivity($id='')
	{
		$parentQuery = $this->db->select('*')
							->where('id', $id)
							->get('ji_production_activity_item')
							->row();

		$childQuery = $this->db->select('*')
								->where('ji_production_activity_item_id', $id)
								->get('ji_production_activity_item_details')
								->result();

        return ["parent" => $parentQuery, "child" => $childQuery];

	}

	public function fetchProductionItemActivity()
	{
		$query = $this->db->select('*')
						->get('ji_production_activity_item')
						->result();

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

	public function fetchProductionProcess($limit, $offset)
	{
		$parentQuery = $this->db->select('*')
						->order_by('id', 'desc')
						->limit($limit, $offset)
						->get('ji_production_process')
						->result();

		$childQuery = $this->db->select('*')
							->get('ji_production_process_details')
							->result();

        return ["parent"=>$parentQuery, "child"=>$childQuery];
	}

	public function fetchEditProductionProcess($id='')
	{
		$parentQuery = $this->db->select('*')
							->where('id', $id)
							->get('ji_production_process')
							->row();

		$childQuery = $this->db->select('*')
								->where('ji_production_process_id', $id)
								->get('ji_production_process_details')
								->result();

        return ["parent" => $parentQuery, "child" => $childQuery];
	}

	public function fetchEditActivity($id='')
	{
		$query = $this->db->select('*')
							->where('id', $id)
							->get('ji_production_activity')
							->row();

        return $query;

	}

	public function fetchProductionBudget()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_production_budget')
						->result();

		return $query;
	}

	public function fetchEditProductionBudget($id='')
	{
		$parentQuery = $this->db->select('*')
							->where('id', $id)
							->get('ji_production_budget')
							->row();

		$materialQuery = $this->db->select('*')
								->where('ji_production_budget_id', $id)
								->get('ji_production_material_budget')
								->result();

		$operationQuery = $this->db->select('*')
								->where('ji_production_budget_id', $id)
								->get('ji_production_operation_budget')
								->result();

        return ["parent_budget"=>$parentQuery, "material_budget"=>$materialQuery, "operation_budget"=>$operationQuery];

	}

	public function fetchCreateCost(Array $cost_item_po_id)
	{
		$cost_item_information = $this->db->select('*')
						->where('po_id = ', $cost_item_po_id['po_id'])
						->get('ji_production_process')
						->row();

		$item_cost = $this->db->select('*')
						->where('po_id = ', $cost_item_po_id['po_id'])
						->get('ji_purchase_bill_details')
						->result();

		$item_activity = $this->db->select('*')
						->where('po_id = ', $cost_item_po_id['po_id'])
						->get('ji_worker_bill_details')
						->result();

		return ["information" => $cost_item_information, "cost" => $item_cost, "activity" => $item_activity];
	}

	public function fetchProductionCost()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_production_cost')
						->result();

		return $query;
	}

	public function fetchPurchaseItem()
	{
		$query = $this->db->select('*')
						->get('ji_purchase_item')
						->result();

		return $query;
	}

	public function fetchPurchaseItemName()
	{
		$query = $this->db->select('item_name')
						->get('ji_purchase_item_name')
						->result();

		return $query;
	}

	public function fetchEditProductionCost($id='')
	{
		$parentQuery = $this->db->select('*')
							->where('id', $id)
							->get('ji_production_cost')
							->row();

		$materialQuery = $this->db->select('*')
							->where('ji_production_cost_id', $id)
							->get('ji_production_material_cost')
							->result();

		$operationQuery = $this->db->select('*')
							->where('ji_production_cost_id', $id)
							->get('ji_production_operation_cost')
							->result();

        return ["parent_cost" => $parentQuery, "material_cost" => $materialQuery, "operation_cost" => $operationQuery];
	}

	public function insertActivity(Array $post_activity)
	{
		$this->db->insert('ji_production_activity', $post_activity);
	}

	public function updateActivity(Array $update_activity, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_production_activity', $update_activity);
	}

	public function deleteActivity($id)
	{
		$this->db->where('id = ', $id)->delete('ji_production_activity');
	}

	public function insertItemActivity(Array $post_activity_item)
	{
		$detailsData = $post_activity_item['details'];
		unset($post_activity_item['details']);

		$this->db->insert('ji_production_activity_item', $post_activity_item);
		$lastID = $this->db->insert_id();

		foreach ($detailsData as $key => $value) 
		{
			$value['ji_production_activity_item_id'] = $lastID;
			$this->db->set($value)
					->insert('ji_production_activity_item_details');
		}

		return true;
	}

	public function updateItemActivity(Array $update_item_activity, $id)
	{
		$detailsData = $update_item_activity['details'];
		unset($update_item_activity['details']);

		$this->db->where('id', $id)
				->update('ji_production_activity_item', $update_item_activity);

		$this->db->where('ji_production_activity_item_id', $id)
				->delete('ji_production_activity_item_details');

		foreach ($detailsData as $key => $value) 
		{
			$value['ji_production_activity_item_id'] = $id;

			$this->db->set($value)
					->insert('ji_production_activity_item_details');
		}

		return true;
	}

	public function deleteItemActivity($id)
	{
		$this->db->where('id = ', $id)->delete('ji_production_activity_item');
		$this->db->where('ji_production_activity_item_id = ', $id)->delete('ji_production_activity_item_details');
	}

	public function insertProductionProcess(Array $data)
	{
		$count = 0;
		$count_complete = 0;

		$getSl = $this->db->select('id')
						->order_by('id', 'desc')
						->limit(1)
						->get('ji_production_process')
						->row();

		$getSl->id = (isset($getSl->id)) ? $getSl->id : 1;
		$data['po_id'] = 'PO-0'.$getSl->id;
		
		$detailsData = $data['details'];
		unset($data['details']);

		if (isset($data['stock_status'])) 
		{
			$data['stock_status'] = 1;
			$this->db->insert('ji_production_process', $data);
			$lastID = $this->db->insert_id();
		} 
		else 
		{
			$this->db->insert('ji_production_process', $data);
			$lastID = $this->db->insert_id();
		}

		foreach ($detailsData as $key => $value) 
		{
			$value['ji_production_process_id'] = $lastID;
			$this->db->insert('ji_production_process_details', $value);

			++$count;

			if ($value['status'] == 'Complete') 
			{
				++$count_complete;
			}

		}

		$fetch_item_code_query = $this->db->select('*')
								->where('item_code = ', $data['item_code'])
								->get('ji_purchase_item')
								->row();

		$sales_item_status = (!empty($fetch_item_code_query->sales_item)) ? $fetch_item_code_query->sales_item : 0;

		$fetch_stock_query = $this->db->select('*')
								->where('item_code = ', $data['item_code'])
								->get('ji_stock')
								->row();

		if (!empty($fetch_stock_query)) 
		{
			$stock_qty = (!empty($fetch_stock_query->qty)) ? $fetch_stock_query->qty : 0;
			$stock_unit_cost = (!empty($fetch_stock_query->unit_price)) ? $fetch_stock_query->unit_price : 0;
			$stock_total_cost = (!empty($fetch_stock_query->total)) ? $fetch_stock_query->total : 0;

			if ($sales_item_status == 1) 
			{
				$update_stock = [

					"item_category" => "Sales Item",
					"item_name" => $data['item_name'],
					"item_code" => $data['item_code'],
			        "qty" => $stock_qty + 1,
			        "unit_price" => $stock_unit_cost,
		        	"total" => $stock_total_cost + $stock_unit_cost

				];

			}
			else
			{
				$update_stock = [

					"item_category" => "Purchase Item",
					"item_name" => $data['item_name'],
					"item_code" => $data['item_code'],
			        "qty" => $stock_qty + 1,
			        "unit_price" => $stock_unit_cost,
		        	"total" => $stock_total_cost + $stock_unit_cost

				];

			}

			$this->db->where('item_code = ', $data['item_code'])
							->update('ji_stock', $update_stock);
					
		}
		else
		{
			if ($count == $count_complete) 
			{
				if ($sales_item_status == 1) 
				{
					$stock_data = [

						"item_category" => "Sales Item",
						"item_name" => $data['item_name'],
						"item_code" => $data['item_code'],
				        "qty" => 1,
				        "unit_price" => 0,
			        	"total" => 0

				    ];

				}
				else
				{
					$stock_data = [

						"item_category" => "Purchase Item",
						"item_name" => $data['item_name'],
						"item_code" => $data['item_code'],
				        "qty" => 1,
				        "unit_price" => 0,
			        	"total" => 0

				    ];

				}

				$this->db->insert('ji_stock', $stock_data);

			}

		}

		return true;
	}

	public function updateProductionProcess(Array $update_process, $id)
	{
		$count = 0;
		$count_complete = 0;
		
		$detailsData = $update_process['details'];
		unset($update_process['details']);

		if (isset($update_process['stock_status'])) 
		{
			$update_process['stock_status'] = 1;
			$this->db->where('id', $id)
				->update('ji_production_process', $update_process);
		} 
		else 
		{
			$this->db->where('id', $id)
				->update('ji_production_process', $update_process);
		}

		$this->db->where('ji_production_process_id', $id)
				->delete('ji_production_process_details');

		foreach ($detailsData as $key => $value) 
		{
			$value['ji_production_process_id'] = $id;
			$this->db->insert('ji_production_process_details', $value);

			++$count;

			if ($value['status'] == 'Complete') 
			{
				++$count_complete;
			}

		}

		$fetch_item_code_query = $this->db->select('*')
								->where('item_code = ', $update_process['item_code'])
								->get('ji_purchase_item')
								->row();

		$sales_item_status = (!empty($fetch_item_code_query->sales_item)) ? $fetch_item_code_query->sales_item : 0;

		$fetch_stock_query = $this->db->select('*')
								->where('item_code = ', $update_process['item_code'])
								->get('ji_stock')
								->row();

		if (!empty($fetch_stock_query)) 
		{
			$stock_qty = $fetch_stock_query->qty;
			$stock_unit_cost = $fetch_stock_query->unit_price;
			$stock_total_cost = $fetch_stock_query->total;

			if ($count == $count_complete) 
			{
				$update_stock = [

			        "qty" => $stock_qty + 1,
			        "unit_price" => $stock_unit_cost,
		        	"total" => $stock_total_cost + $stock_unit_cost

				];

			}
			else
			{
				$update_stock = [

			        "qty" => $stock_qty - 1,
			        "unit_price" => $stock_unit_cost,
		        	"total" => $stock_total_cost - $stock_unit_cost

				];

			}

			$this->db->where('item_code = ', $update_process['item_code'])
						->update('ji_stock', $update_stock);

		}
		else
		{
			if ($count == $count_complete) 
			{
				if ($sales_item_status == 1) 
				{
					$stock_data = [

						"item_category" => "Sales Item",
						"item_name" => $update_process['item_name'],
						"item_code" => $update_process['item_code'],
				        "qty" => 1,
				        "unit_price" => 0,
			        	"total" => 0

				    ];

				}
				else
				{
					$stock_data = [

						"item_category" => "Purchase Item",
						"item_name" => $update_process['item_name'],
						"item_code" => $update_process['item_code'],
				        "qty" => 1,
				        "unit_price" => 0,
			        	"total" => 0

				    ];

				}

				$this->db->insert('ji_stock', $stock_data);
			}

		}

		return true;
	}

	public function deleteProductionProcess($id)
	{
		$this->db->where('id = ', $id)->delete('ji_production_process');
		$this->db->where('ji_production_process_id = ', $id)->delete('ji_production_process_details');
	}

	public function insertBudget(Array $post_production_budget)
	{
		$materialDetailsData = $post_production_budget['material_details'];
		unset($post_production_budget['material_details']);

		$operationDetailsData = $post_production_budget['operation_details'];
		unset($post_production_budget['operation_details']);

		$this->db->insert('ji_production_budget', $post_production_budget);
		$lastID = $this->db->insert_id();

		foreach ($materialDetailsData as $key => $value) 
		{
			$value['ji_production_budget_id'] = $lastID;
			$this->db->insert('ji_production_material_budget', $value);
		}

		foreach ($operationDetailsData as $key => $value) 
		{
			$value['ji_production_budget_id'] = $lastID;
			$this->db->insert('ji_production_operation_budget', $value);
		}

		return true;
	}

	public function updateBudget(Array $update_budget, $id)
	{
		$materialDetailsData = $update_budget['material_details'];
		unset($update_budget['material_details']);

		$operationDetailsData = $update_budget['operation_details'];
		unset($update_budget['operation_details']);

		$this->db->where('id', $id)
				->update('ji_production_budget', $update_budget);

		$this->db->where('ji_production_budget_id', $id)
				->delete('ji_production_material_budget');

		$this->db->where('ji_production_budget_id', $id)
				->delete('ji_production_operation_budget');

		foreach ($materialDetailsData as $key => $value) 
		{
			$value['ji_production_budget_id'] = $id;
			$this->db->insert('ji_production_material_budget', $value);
		}

		foreach ($operationDetailsData as $key => $value) 
		{
			$value['ji_production_budget_id'] = $id;
			$this->db->insert('ji_production_operation_budget', $value);
		}

		return true;
	}

	public function deleteBudget($id)
	{
		$this->db->where('id = ', $id)->delete('ji_production_budget');
		$this->db->where('ji_production_budget_id = ', $id)->delete('ji_production_material_budget');
		$this->db->where('ji_production_budget_id = ', $id)->delete('ji_production_operation_budget');
	}

	public function insertCost(Array $post_production_cost)
	{
		$materialDetailsData = $post_production_cost['material_details'];
		unset($post_production_cost['material_details']);

		$operationDetailsData = $post_production_cost['operation_details'];
		unset($post_production_cost['operation_details']);

		$this->db->insert('ji_production_cost', $post_production_cost);
		$lastID = $this->db->insert_id();

		foreach ($materialDetailsData as $key => $value) 
		{
			$stock_query = $this->db->select('qty, unit_price, total')
								->where('item_code = ', $value['purchase_item_code'])
								->get('ji_stock')
								->row();

			$stock_qty = (!empty($stock_query->qty)) ? $stock_query->qty : 0;
			$recent_qty = $value['qty'];

			$stock_total_price = (!empty($stock_query->total)) ? $stock_query->total : 0;
			$recent_total_price = $value['total'];

			if (!empty($stock_query)) 
			{
				if ($stock_qty >= $recent_qty)
				{
					$new_qty = $stock_qty - $recent_qty;
					$new_total_price = $stock_total_price + $recent_total_price;
					$new_unit_price = ($new_total_price / $new_qty);

					$update_data = [

				        "qty" => $new_qty,
				        "unit_price" => $new_unit_price,
				        "total" => $new_total_price

				    ];

					$this->db->where('item_code', $value['purchase_item_code'])
								->update('ji_stock', $update_data);

					$stock_message = 1;

				}
				else
				{
					$stock_message = 0;
				}

			}
			else
			{
				$stock_message = 0;
			}

			$value['ji_production_cost_id'] = $lastID;
			$this->db->insert('ji_production_material_cost', $value);
		}

		$stock_query = $this->db->select('qty, unit_price, total')
								->where('item_code = ', $post_production_cost['item_code'])
								->get('ji_stock')
								->row();

		$stock_qty = (!empty($stock_query->qty)) ? $stock_query->qty : 0;
		$recent_qty = $post_production_cost['total_qty'];

		$stock_total_price = (!empty($stock_query->total)) ? $stock_query->total : 0;
		$recent_total_price = $post_production_cost['total_amount'];

		$new_qty = $stock_qty + $recent_qty;
		$new_total_price = $stock_total_price + $recent_total_price;
		$new_unit_price = ($new_total_price / $new_qty);

		$update_data = [

	        "qty" => $new_qty,
	        "unit_price" => $new_unit_price,
	        "total" => $new_total_price

	    ];

		if (!empty($stock_query)) 
		{
			$this->db->where('item_code', $post_production_cost['item_code'])
						->update('ji_stock', $update_data);

		}
		else
		{
			$this->db->insert('ji_stock', $update_data);
		}

		foreach ($operationDetailsData as $key => $value) 
		{
			$value['ji_production_cost_id'] = $lastID;
			$this->db->insert('ji_production_operation_cost', $value);
		}

		return $stock_message;
	}

	public function updateCost(Array $update_cost, $id)
	{
		$materialDetailsData = $update_cost['material_details'];
		unset($update_cost['material_details']);

		$operationDetailsData = $update_cost['operation_details'];
		unset($update_cost['operation_details']);

		$this->db->where('id', $id)
				->update('ji_production_cost', $update_cost);

		$this->db->where('ji_production_cost_id', $id)
				->delete('ji_production_material_cost');

		$this->db->where('ji_production_cost_id', $id)
				->delete('ji_production_operation_cost');

		foreach ($materialDetailsData as $key => $value) 
		{
			$stock_query = $this->db->select('qty, unit_price, total')
					->where('item_code = ', $value['purchase_item_code'])
					->get('ji_stock')
					->row();

			$stock_qty = (!empty($stock_query->qty)) ? $stock_query->qty : 0;
			$previous_qty = $value['hidden_qty'];
			$recent_qty = $value['qty'];

			$stock_total_price = (!empty($stock_query->total)) ? $stock_query->total : 0;
			$previous_total = $value['hidden_total'];
			$recent_total_price = $value['total'];

			if ($previous_qty > $recent_qty)
			{
				$difference_qty = $previous_qty - $recent_qty;
				$difference_total_price = $previous_total - $recent_total_price;

				$new_qty = $stock_qty - $difference_qty;
				$new_total_price = $stock_total_price - $difference_total_price;
				$new_unit_price = ($new_total_price / $new_qty);

			}
			else
			{
				$difference_qty = $recent_qty - $previous_qty;
				$difference_total_price = $recent_total_price - $previous_total;

				$new_qty = $stock_qty + $difference_qty;
				$new_total_price = $stock_total_price + $difference_total_price;
				$new_unit_price = ($new_total_price / $new_qty);

			}

			$update_data = [

		        "qty" => $new_qty,
		        "unit_price" => $new_unit_price,
		        "total" => $new_total_price

			];

			$this->db->where('item_code', $item_code)
					->update('ji_stock', $update_data);

			unset($value['hidden_qty']);
			unset($value['hidden_total']);
			
			$value['ji_production_cost_id'] = $id;
			$this->db->insert('ji_production_material_cost', $value);
		}

		foreach ($operationDetailsData as $key => $value) 
		{
			$value['ji_production_cost_id'] = $id;
			$this->db->insert('ji_production_operation_cost', $value);
		}

		return true;
	}

	public function deleteCost($id)
	{
		$this->db->where('id = ', $id)->delete('ji_production_cost');
		$this->db->where('ji_production_cost_id = ', $id)->delete('ji_production_material_cost');
		$this->db->where('ji_production_cost_id = ', $id)->delete('ji_production_operation_cost');
	}

}
