<?php

class WorkerManagementModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Dhaka");
	}
	
	private function DateConvertFormToDB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	public function fetchActivity()
	{
		$query = $this->db->select('*')
						->get('ji_production_activity')
						->result();

		return $query;
	}

	public function fetchWorkerType()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_worker_type')
						->result();

		return $query;
	}

	public function fetchWorker()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_workers')
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

	public function fetchItem()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_product_item')
						->result();

		return $query;
	}

	public function fetchEditWorker($id)
	{
		$query = $this->db->select('*')
				->where('id = ', $id)
				->get('ji_workers')
				->row();

		return $query;
	}

	public function fetchPaymentType()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_payment_type')
						->result();

		return $query;
	}

	public function fetchAccount()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_accounts')
						->result();

		return $query;
	}

	public function getWorkerBill()
	{
		if ($this->session->userdata['logged_in']['role'] == 1) 
		{
			$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_worker_bills')
						->result();
		} 
		else 
		{
			$query = $this->db->select('*')
						->where("date >= DATE_SUB(NOW(), INTERVAL 2 MONTH)")
						->order_by('id', 'desc')
						->get('ji_worker_bills')
						->result();
		}

		return $query;
	}

	public function fetchEditWorkerBill($id='')
	{
		$parentQuery = $this->db->select('*')
							->where('id', $id)
							->get('ji_worker_bills')
							->row();

		$childQuery = $this->db->select('*')
								->where('ji_worker_bill_id', $id)
								->get('ji_worker_bill_details')
								->result();

        return ["parent" => $parentQuery, "child" => $childQuery];

	}

	public function getWorkerPayBill()
	{
		if ($this->session->userdata['logged_in']['role'] == 1) 
		{
			$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_worker_pay_bills')
						->result();
		} 
		else 
		{
			$query = $this->db->select('*')
						->where("date >= DATE_SUB(NOW(), INTERVAL 2 MONTH)")
						->order_by('id', 'desc')
						->get('ji_worker_pay_bills')
						->result();
		}

		return $query;
	}

	public function fetchWorkerBillItemCode($po_id='')
	{
		$query = $this->db->select('item_code')
						->where('po_id =', $po_id)
						->order_by('id', 'desc')
						->get('ji_production_process')
						->result();

		return $query;
	}

	public function fetchEditWorkerPayBill($id='')
	{
		$query = $this->db->select('*')
				->where('id = ', $id)
				->get('ji_worker_pay_bills')
				->row();

		return $query;
	}

	public function fetchWorkerBalance($worker_name='')
	{
		$query = $this->db->select('balance')
						->where('name = ', $worker_name)
						->get('ji_workers')
						->row();

		return $query;
	}

	public function fetchPOID()
	{
		$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_production_process')
						->result();

		return $query;
	}

	public function fetchWorkerPOID($worker_name='')
	{
		$query = $this->db->distinct()
						->select('po_id')
						->join('ji_worker_bills', 'ji_worker_bills.id = ji_worker_bill_details.ji_worker_bill_id', 'left')
						->where('worker = ', $worker_name)
						->get('ji_worker_bill_details')
						->result();

		return $query;
	}

	public function insertUserActivity(Array $user_activity_data)
	{
		$this->db->insert('ji_user_activity', $user_activity_data);
	}

	public function insertWorkerType(Array $post_worker_type)
	{
		$this->db->insert('ji_worker_type', $post_worker_type);
	}

	public function insertWorker(Array $post_new_worker)
	{
		$worker_name = ucfirst($post_new_worker['name']);
		$post_new_worker['name'] = $worker_name;

		$this->db->insert('ji_workers', $post_new_worker);
	}

	public function updateWorker(Array $update_worker, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_workers', $update_worker);
	}

	public function deleteWorker($id)
	{
		$this->db->where('id = ', $id)->delete('ji_workers');
	}

	public function insertBill(Array $post_bill)
	{
		$detailsData = $post_bill['details'];
		$post_bill['date'] = $this->DateConvertFormToDB($post_bill['date']);

		unset($post_bill['details']);
		unset($post_bill['previous_total_amount']);

		$this->db->insert('ji_worker_bills', $post_bill);
		$lastID = $this->db->insert_id();

		foreach ($detailsData as $value) 
		{
			$value['ji_worker_bill_id'] = $lastID;
			$this->db->insert('ji_worker_bill_details', $value);
		}

		$worker = $post_bill['worker'];
		$amount = $post_bill['total_amount'];

		$worker_balance_query = $this->db->select('balance')
					->where('name = ', $worker)
					->get('ji_workers')
					->row();

		$worker_balance_amount = $worker_balance_query->balance;
		$new_worker_balance_amount = $worker_balance_amount + $amount;

		$this->db->set('balance', $new_worker_balance_amount)
				->where('name = ', $worker)
				->update('ji_workers');

		date_default_timezone_set("Asia/Dhaka");
		$time = date("h:i:sa");

		$user_activity_data = [

			'ji_user_id'    => $post_bill['ji_user_id'],
			'ji_worker_bill_id' => $lastID,
			'activity_type' => 1,
			'date'          => date("Y-m-d"),
			'time'          => $time

		];

		$this->insertUserActivity($user_activity_data);

		return true;
	}

	public function updateBill(Array $update_bill, $id)
	{
		$detailsData = $update_bill['details'];
		$worker = $update_bill['worker'];
		$current_amount = $update_bill['total_amount'];
		$previous_worker = $update_bill['previous_worker'];
		$previous_amount = $update_bill['previous_total_amount'];
		$update_bill['date'] = $this->DateConvertFormToDB($update_bill['date']);

		unset($update_bill['details']);
		unset($update_bill['previous_worker']);
		unset($update_bill['previous_total_amount']);
		
		$this->db->where('id', $id)
				->update('ji_worker_bills', $update_bill);

		$this->db->where('ji_worker_bill_id', $id)
				->delete('ji_worker_bill_details');

		$worker_balance_query = $this->db->select('balance')
					->where('name = ', $worker)
					->get('ji_workers')
					->row();

		$worker_balance_amount = (!empty($worker_balance_query->balance)) ? $worker_balance_query->balance : 0;

		if ($worker == $previous_worker) 
		{
			if ($previous_amount >= $current_amount) 
			{
				$difference_worker_balance_amount = $previous_amount - $current_amount;
				$new_worker_balance_amount = $worker_balance_amount - $difference_worker_balance_amount;
			} 
			else 
			{
				$difference_worker_balance_amount = $current_amount - $previous_amount;
				$new_worker_balance_amount = $worker_balance_amount + $difference_worker_balance_amount;
			}

			$this->db->set('balance', $new_worker_balance_amount)
						->where('name = ', $worker)
						->update('ji_workers');
		} 
		else 
		{
			$previous_worker_balance_query = $this->db->select('balance')
								->where('name = ', $previous_worker)
								->get('ji_workers')
								->row();

			$previous_worker_balance_amount = (!empty($previous_worker_balance_query->balance)) ? $previous_worker_balance_query->balance : 0;
			$new_worker_balance_amount = $previous_worker_balance_amount - $current_amount;

			$this->db->set('balance', $new_worker_balance_amount)
						->where('name = ', $previous_worker)
						->update('ji_workers');
			
			$new_worker_balance_amount = $worker_balance_amount + $current_amount;

			$this->db->set('balance', $new_worker_balance_amount)
						->where('name = ', $worker)
						->update('ji_workers');	
		}

		foreach ($detailsData as $key => $value) 
		{
			$value['ji_worker_bill_id'] = $id;
			$this->db->insert('ji_worker_bill_details', $value);
		}

		date_default_timezone_set("Asia/Dhaka");
		$time = date("h:i:sa");

		$user_activity_data = [

			'ji_user_id'    => $update_bill['ji_user_id'],
			'ji_worker_bill_id' => $id,
			'activity_type' => 2,
			'date'          => date("Y-m-d"),
			'time'          => $time

		];

		$this->insertUserActivity($user_activity_data);

		return true;
	}

	public function deleteBill($id)
	{
		$this->db->where('id = ', $id)->delete('ji_worker_bills');
		$this->db->where('ji_worker_bill_id = ', $id)->delete('ji_worker_bill_details');
	}

	public function insertPayBill(Array $post_pay_bill)
	{
		$account 			   = $post_pay_bill['account'];
		$worker 			   = $post_pay_bill['worker'];
		$amount 			   = $post_pay_bill['amount'];
		$date 				   = $this->DateConvertFormToDB($post_pay_bill['date']);
		$post_pay_bill['date'] = $this->DateConvertFormToDB($post_pay_bill['date']);

		$this->db->insert('ji_worker_pay_bills', $post_pay_bill);
		$lastID = $this->db->insert_id();

		$account_query = $this->db->select('amount')
					->where('account_name = ', $account)
					->get('ji_account_reports')
					->row();

		$worker_balance_query = $this->db->select('balance')
					->where('name = ', $worker)
					->get('ji_workers')
					->row();

		$account_amount = $account_query->amount;
		$worker_balance_amount = $worker_balance_query->balance;

		$new_account_amount = $account_amount - $amount;
		$new_worker_balance_amount = $worker_balance_amount - $amount;

		$this->db->set('amount', $new_account_amount)
				->where('account_name = ', $account)
				->update('ji_account_reports');

		$this->db->set('balance', $new_worker_balance_amount)
				->where('name = ', $worker)
				->update('ji_workers');

		$insert_expanse_report = [

			'ji_worker_pay_bill_id' => $lastID,
			'date' => $date,
			'worker_expanse_total' => $amount

		];

		$this->db->insert('ji_expanse_report', $insert_expanse_report);

		$fields = $this->db->field_data('ji_account_outgoing_reports');
		$account_name = str_replace([' ', ':', '(', ')'], '', $post_pay_bill['account']);

		foreach ($fields as $field)
		{
			if ($field->name == $account_name) 
			{
				$insert_account_incoming_report = [

					'date' 					=> $date,
					'ji_worker_pay_bill_id' => $lastID,
					$account_name 			=> $post_pay_bill['amount']
					
				];

				$this->db->insert('ji_account_outgoing_reports', $insert_account_incoming_report);
				break;
			}

		}

		$insert_account_balance_report = [

			'date' 					=> $date,
			'account_name'			=> $account,
			'worker_pay' 			=> $post_pay_bill['amount'],
			'ji_worker_pay_bill_id' => $lastID,
			
		];

		$this->db->insert('ji_account_balance_reports', $insert_account_balance_report);

		$user_activity_data = [

			'ji_user_id'    		=> $post_pay_bill['ji_user_id'],
			'ji_worker_pay_bill_id' => $lastID,
			'activity_type' 		=> 1,
			'date'          		=> date("Y-m-d"),
			'time'          		=> date("h:i:sa")

		];

		$this->insertUserActivity($user_activity_data);
		return true;
	}

	public function updatePayBill(Array $update_pay_bill, $id)
	{
		$recent_account 		 = $update_pay_bill['account'];
		$recent_worker 			 = $update_pay_bill['worker'];
		$recent_amount 			 = $update_pay_bill['amount'];
		$previous_account 		 = $update_pay_bill['previous_account'];
		$previous_worker 		 = $update_pay_bill['previous_worker'];
		$previous_amount 		 = $update_pay_bill['previous_amount'];
		$date 					 = $this->DateConvertFormToDB($update_pay_bill['date']);
		$update_pay_bill['date'] = $this->DateConvertFormToDB($update_pay_bill['date']);

		unset($update_pay_bill['previous_account']);
		unset($update_pay_bill['previous_worker']);
		unset($update_pay_bill['previous_amount']);

		$this->db->where('id = ', $id)
				->update('ji_worker_pay_bills', $update_pay_bill);

		$account_query = $this->db->select('amount')
					->where('account_name = ', $recent_account)
					->get('ji_account_reports')
					->row();

		$worker_balance_query = $this->db->select('balance')
					->where('name = ', $recent_worker)
					->get('ji_workers')
					->row();

		$previous_account_query = $this->db->select('amount')
					->where('account_name = ', $previous_account)
					->get('ji_account_reports')
					->row();

		$previous_worker_balance_query = $this->db->select('balance')
					->where('name = ', $previous_worker)
					->get('ji_workers')
					->row();

		$current_account_amount = $account_query->amount;
		$current_worker_balance = $worker_balance_query->balance;
		$previous_account_amount = $previous_account_query->amount;
		$previous_worker_balance = $previous_worker_balance_query->balance;

		if ($previous_amount >= $recent_amount) 
		{
			if ($previous_account == $recent_account) 
			{
				if ($previous_worker == $recent_worker) 
				{
					$difference_amount = $previous_amount - $recent_amount;	
					$new_account_amount = $current_account_amount + $difference_amount;
					$new_worker_balance = $current_worker_balance + $difference_amount;
				} 
				else 
				{
					$difference_amount = $previous_amount - $recent_amount;	
					$new_account_amount = $current_account_amount + $difference_amount;
					$new_worker_balance = $current_worker_balance - $recent_amount;
					$previous_worker_new_balance = $previous_worker_balance + $previous_amount;

					$this->db->set('balance', $previous_worker_new_balance)
								->where('name = ', $previous_worker)
								->update('ji_workers');
				}
				
			} 
			else 
			{
				if ($previous_worker == $recent_worker) 
				{
					$difference_amount = $previous_amount - $recent_amount;	
					$new_account_amount = $current_account_amount - $recent_amount;
					$new_worker_balance = $current_worker_balance + $difference_amount;
					$previous_account_new_amount = $previous_account_amount + $previous_amount;

					$this->db->set('amount', $previous_account_new_amount)
								->where('account_name = ', $previous_account)
								->update('ji_account_reports');
				} 
				else 
				{
					$new_account_amount = $current_account_amount - $recent_amount;
					$new_worker_balance = $current_worker_balance - $recent_amount;
					$previous_worker_new_balance = $previous_worker_balance + $previous_amount;
					$previous_account_new_amount = $previous_account_amount + $previous_amount;

					$this->db->set('balance', $previous_worker_new_balance)
								->where('name = ', $previous_worker)
								->update('ji_workers');

					$this->db->set('amount', $previous_account_new_amount)
								->where('account_name = ', $previous_account)
								->update('ji_account_reports');
				}

			}
			
		} 
		else 
		{
			if ($previous_account == $recent_account) 
			{
				$difference_amount = $recent_amount - $previous_amount;
				$new_account_amount = $current_account_amount - $difference_amount;

				if ($previous_worker == $recent_worker) 
				{
					$new_worker_balance = $current_worker_balance + $difference_amount;
				} 
				else 
				{
					$new_worker_balance = $current_worker_balance - $recent_amount;
					$previous_worker_new_balance = $previous_worker_balance + $previous_amount;

					$this->db->set('balance', $previous_worker_new_balance)
								->where('name = ', $previous_worker)
								->update('ji_workers');
				}
				
			} 
			else 
			{
				if ($previous_worker == $recent_worker) 
				{
					$difference_amount = $recent_amount - $previous_amount;
					$new_account_amount = $current_account_amount - $recent_amount;
					$new_worker_balance = $current_worker_balance + $difference_amount;
					$previous_account_new_amount = $previous_account_amount + $previous_amount;

					$this->db->set('amount', $previous_account_new_amount)
								->where('account_name = ', $previous_account)
								->update('ji_account_reports');
				} 
				else 
				{
					$new_account_amount = $current_account_amount - $recent_amount;
					$new_worker_balance = $current_worker_balance - $recent_amount;
					$previous_worker_new_balance = $previous_worker_balance + $previous_amount;
					$previous_account_new_amount = $previous_account_amount + $previous_amount;

					$this->db->set('balance', $previous_worker_new_balance)
								->where('name = ', $previous_worker)
								->update('ji_workers');

					$this->db->set('amount', $previous_account_new_amount)
								->where('account_name = ', $previous_account)
								->update('ji_account_reports');
				}

			}

		}

		$this->db->set('amount', $new_account_amount)
				->where('account_name = ', $recent_account)
				->update('ji_account_reports');

		$this->db->set('balance', $new_worker_balance)
				->where('name = ', $recent_worker)
				->update('ji_workers');

		$update_expanse_report = [

			'ji_worker_pay_bill_id' => $id,
			'date' => $date,
			'worker_expanse_total' => $recent_amount

		];

		$this->db->where('ji_worker_pay_bill_id', $id)
				->update('ji_expanse_report', $update_expanse_report);

		$this->db->where('ji_worker_pay_bill_id', $id)->delete('ji_account_outgoing_reports');
		$fields = $this->db->field_data('ji_account_outgoing_reports');
		$account_name = str_replace([' ', ':', '(', ')'], '', $update_pay_bill['account']);

		foreach ($fields as $field)
		{
			if ($field->name == $account_name) 
			{
				$insert_account_incoming_report = [

					'date' 					=> $date,
					'ji_worker_pay_bill_id' => $id,
					$account_name 			=> $update_pay_bill['amount']
					
				];

				$this->db->insert('ji_account_outgoing_reports', $insert_account_incoming_report);
				break;
			}

		}

		$insert_account_balance_report = [

			'date' 					=> $date,
			'account_name'			=> $recent_account,
			'worker_pay' 			=> $update_pay_bill['amount'],
			'ji_worker_pay_bill_id' => $id,
			
		];

		$this->db->where('ji_worker_pay_bill_id = ', $id)
				->update('ji_account_balance_reports', $insert_account_balance_report);

		$user_activity_data = [

			'ji_user_id'    => $update_pay_bill['ji_user_id'],
			'ji_worker_pay_bill_id' => $id,
			'activity_type' => 2,
			'date'          => date("Y-m-d"),
			'time'          => date("h:i:sa")

		];

		$this->insertUserActivity($user_activity_data);
		return true;
	}

	public function deletePayBill($id)
	{
		$this->db->where('id = ', $id)->delete('ji_worker_pay_bills');

		return true;
	}

	public function getWorkerBillReport($post_worker_report)
	{
		$worker = $post_worker_report['worker'];
		$from_date = $this->DateConvertFormToDB($post_worker_report['from_date']);
		$to_date = $this->DateConvertFormToDB($post_worker_report['to_date']);

		if ($worker == 'Select A Worker') 
		{
			$worker = '';
		}

		$this->db->select('*');

		if (!empty($worker)) 
		{
			$this->db->where('worker = ', $worker);
		}

		$this->db->where("date >", $from_date);
		$this->db->where("date <=", $to_date);
		$this->db->order_by('date', 'ASC');
		$query = $this->db->get('ji_worker_bills')->result();

		return $query;
	}

	public function getWorkerPaybillReport($post_worker_report)
	{
		$worker = $post_worker_report['worker'];
		$from_date = $this->DateConvertFormToDB($post_worker_report['from_date']);
		$to_date = $this->DateConvertFormToDB($post_worker_report['to_date']);

		if ($worker == 'Select A Worker') 
		{
			$worker = '';
		}

		$this->db->select('*');

		if (!empty($worker)) 
		{
			$this->db->where('worker = ', $worker);
		}

		$this->db->where("date >", $from_date);
		$this->db->where("date <=", $to_date);
		$this->db->order_by('date', 'ASC');
		$query = $this->db->get('ji_worker_pay_bills')->result();

		return $query;
	}

	public function getWorkerSummeryReport($month, $year)
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
