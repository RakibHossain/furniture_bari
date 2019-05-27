<?php

class ExpanseModel extends CI_Model 
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

	public function count_new_expanse_num_rows()
	{
		$query = $this->db->select('id')
						->get('ji_new_expanse')
						->num_rows();
		
		return $query;
	}

	public function count_new_expanse_details_num_rows()
	{
		$query = $this->db->select('ji_new_expanse.id')
						->join('ji_new_expanse_details', 'ji_new_expanse.id = ji_new_expanse_details.ji_new_expanse_id', 'left')
						->get('ji_new_expanse')
						->num_rows();
		
		return $query;
	}

	public function fetchUserType()
	{
		$query = $this->db->select('*')
				        ->get('ji_user_type')
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

	public function fetchExpanse()
	{
		$query = $this->db->select('*')
					->order_by('id', 'desc')
					->get('ji_expanse')
					->result();

		return $query;
	}

	public function fetchExpanseName()
	{
		$query = $this->db->distinct()
					->select('expanse_name')
					->order_by('id', 'desc')
					->get('ji_expanse')
					->result();

		return $query;
	}

	public function fetchExpanseCategory()
	{
		$query = $this->db->select('*')
					->order_by('id', 'desc')
					->get('ji_expanse_category')
					->result();

		return $query;
	}

	public function fetchExpanseReportCategory($type='')
	{
		if ($type == 'expanse') 
		{
			$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_expanse_category')
						->result();
		} 
		elseif ($type == 'purchase') 
		{
			$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_purchase_item_name')
						->result();
		}
		else 
		{
			$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_worker_type')
						->result();
		}

		return $query;
	}

	public function fetchEditNewExpanse($id='')
	{
		$parentQuery = $this->db->select('*')
							->where('id', $id)
							->get('ji_new_expanse')
							->row();

		$childQuery = $this->db->select('*')
								->where('ji_new_expanse_id', $id)
								->get('ji_new_expanse_details')
								->result();

		return ["parent"=>$parentQuery, "child"=>$childQuery];
	}

	public function fetchEditExpanseCategory($id='')
	{
		$query = $this->db->select('*')
						->where('id', $id)
						->get('ji_expanse_category')
						->row();

		return $query;
	}

	public function fetchEditExpanse($id='')
	{
		$query = $this->db->select('*')
						->where('id', $id)
						->get('ji_expanse')
						->row();

		return $query;
	}

	public function fetchExpanseList($limit, $offset)
	{
		$query = $this->db->select('ji_new_expanse.*, ji_user.name as user_type')
						->join('ji_user', 'ji_user.id = ji_new_expanse.ji_user_id', 'left')
						->order_by('ji_new_expanse.id', 'desc')
						->limit($limit, $offset)
				        ->get('ji_new_expanse')
				        ->result();
				        
		return $query;
	}

	public function getExpenseListDetails($limit, $offset)
	{
		$user_role = $this->session->userdata['logged_in']['role'];

		if ($user_role == 1 || $user_role == 5) 
		{
			$query = $this->db->select('ji_new_expanse.id as expanse_id, ji_new_expanse.date as date, ji_new_expanse.net_total, ji_new_expanse_details.*')
						->join('ji_new_expanse_details', 'ji_new_expanse.id = ji_new_expanse_details.ji_new_expanse_id', 'left')
						->order_by('ji_new_expanse.id', 'desc')
						->limit($limit, $offset)
				        ->get('ji_new_expanse')
				        ->result();
		} 
		else 
		{
			$query = $this->db->select('ji_new_expanse.id as expanse_id, ji_new_expanse.date as date, ji_new_expanse.net_total, ji_new_expanse_details.*')
						->join('ji_new_expanse_details', 'ji_new_expanse.id = ji_new_expanse_details.ji_new_expanse_id', 'left')
						->join('ji_accounts', 'ji_accounts.account_name = ji_new_expanse_details.account', 'left')
						->where('ji_accounts.access_type', $user_role)
						->order_by('ji_new_expanse.id', 'desc')
						->limit($limit, $offset)
				        ->get('ji_new_expanse')
				        ->result();
		}

		return $query;
	}

	public function fetchExpanseReport($month, $year)
	{
		$query = $this->db->select('date, day(date) as date_day, SUM(expanse_total) as expanse_total, SUM(purchase_expanse_total) as purchase_expanse_total, SUM(worker_expanse_total) as worker_expanse_total')
							->where('MONTH(date)', $month)
							->where('YEAR(date)', $year)
							->group_by('date')
							->order_by('date', 'ASC')
					        ->get('ji_expanse_report')
					        ->result();

		return $query;
	}

	public function fetchExpanseReportDetails($date)
	{
		$query = $this->db->select('*, SUM(amount) as amount')
							->group_by('expanse_category')
							->where('date', $date)
					        ->get('ji_expanse_report_details')
					        ->result();

		return $query;
	}

	public function fetchExpenseSummeryReport(Array $post_expense_summery_reports)
	{
		$expense_name = $post_expense_summery_reports['expense_name'];
		$expense_category = $post_expense_summery_reports['expense_category'];
		$from_date = $this->DateConvertFormTODB($post_expense_summery_reports['from_date']);
		$to_date = $this->DateConvertFormTODB($post_expense_summery_reports['to_date']);

		if ($expense_name == 'Select Expense Name') 
		{
			$expense_name = '';
		}

		if ($expense_category == 'Select Expense Category') 
		{
			$expense_category = '';
		}

		/*$time_limit = $post_expense_summery_reports['time_limit'];
		$query = $this->db->select("ji_new_expanse.date, ji_new_expanse_details.expanse_name, ji_new_expanse_details.account, ji_new_expanse_details.amount")
							->join('ji_new_expanse_details', 'ji_new_expanse.id = ji_new_expanse_details.ji_new_expanse_id')
							->where("ji_new_expanse.date >= DATE_SUB(NOW(), INTERVAL $time_limit MONTH)")
							->where("ji_new_expanse_details.expanse_name", $expense_name)
							->order_by('ji_new_expanse.date', 'ASC')
					        ->get('ji_new_expanse')
					        ->result();*/

		$this->db->select("ji_new_expanse.date, ji_new_expanse_details.expanse_name, ji_new_expanse_details.account, ji_new_expanse_details.amount, ji_new_expanse_details.description");
		$this->db->join('ji_new_expanse_details', 'ji_new_expanse.id = ji_new_expanse_details.ji_new_expanse_id');

		if (!empty($expense_name)) 
		{
			$this->db->where("ji_new_expanse_details.expanse_name", $expense_name);
		}

		if (!empty($expense_category)) 
		{
			$this->db->where("ji_new_expanse_details.expanse_category", $expense_category);
		}

		$this->db->where("ji_new_expanse.date >=", $from_date);
		$this->db->where("ji_new_expanse.date <", $to_date);
		$this->db->order_by('ji_new_expanse.date', 'ASC');
		$query = $this->db->get('ji_new_expanse')->result();

		return $query;
	}

	public function insertUserActivity(Array $user_activity_data)
	{
		$this->db->insert('ji_user_activity', $user_activity_data);
	}

	public function insertExpanse(Array $post_expanses)
	{
		$this->db->insert('ji_expanse', $post_expanses);
	}

	public function updateExpanse(Array $update_expanse, $id)
	{
		$this->db->where('id = ', $id)->update('ji_expanse', $update_expanse);
	}

	public function deleteExpanse($id)
	{
		$this->db->where('id = ', $id)->delete('ji_expanse');
	}

	public function insertExpanseCategory(Array $post_expanse_categories)
	{
		/*$column = [

			'preferences' => [
				'type' => 'VARCHAR', 
				'constraint' => '255', 
				'after' => 'another_column'
			]

		];
	
		$this->load->dbforge();
		$this->dbforge->add_column('table_name', $column);*/

		$this->db->insert('ji_expanse_category', $post_expanse_categories);
	}

	public function updateExpanseCategory(Array $update_expanse_category, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_expanse_category', $update_expanse_category);
	}

	public function deleteExpanseCategory($id)
	{
		$this->db->where('id = ', $id)->delete('ji_expanse_category');
	}

	public function insertNewExpanse(Array $post_new_expanse)
	{
		$date = $this->DateConvertFormTODB($post_new_expanse['date']);
		$post_new_expanse['date'] = $date;
		$post_new_expanse['user'] = $this->session->userdata['logged_in']['role'];
		$detailsData = $post_new_expanse['details'];

		unset($post_new_expanse['details']);

		$this->db->insert('ji_new_expanse', $post_new_expanse);
		$lastID = $this->db->insert_id();

		$insert_expanse_report = [

			'ji_new_expanse_id' => $lastID,
			'date' 				=> $date,
			'expanse_total' 	=> $post_new_expanse['net_total']

		];

		$this->db->insert('ji_expanse_report', $insert_expanse_report);

		foreach ($detailsData as $key => $value) 
		{
			$account = $value['account'];
			$amount = $value['amount'];

			$account_amount_query = $this->db->select('amount')
						->where('account_name = ', $account)
						->get('ji_account_reports')
						->row();

			$account_amount = $account_amount_query->amount;
			$new_account_amount = $account_amount - $amount;

			$this->db->set('amount', $new_account_amount)
					->where('account_name = ', $account)
					->update('ji_account_reports');

			$value['ji_new_expanse_id'] = $lastID;
			$this->db->insert('ji_new_expanse_details', $value);
			$new_expanse_details_id = $this->db->insert_id();

			unset($value['expanse_name']);
			unset($value['account']);
			unset($value['description']);

			$insert_expanse_report_details = [

				"date" 			   => $date,
				"expanse_name" 	   => "expanse",
				"expanse_category" => $value['expanse_category'],
				"amount" 		   => $value['amount']

			];

			$this->db->insert('ji_expanse_report_details', $insert_expanse_report_details);

			$insert_account_balance_report = [

				'date' 		   => $date,
				'account_name' => $account,
				'expense' 	   => $amount
				
			];

			$this->db->insert('ji_account_balance_reports', $insert_account_balance_report);

			$fields = $this->db->field_data('ji_account_outgoing_reports');
			$account_name = str_replace([' ', ':', '(', ')'], '', $account);

			foreach ($fields as $field)
			{
				if ($field->name == $account_name) 
				{
					$insert_account_incoming_report = [

						'date' => $date,
						'ji_new_expanse_details_id' => $new_expanse_details_id,
						$account_name => $amount
						
					];

					$this->db->insert('ji_account_outgoing_reports', $insert_account_incoming_report);
					break;
				}

			}

		}

		$user_activity_data = [

			'ji_user_id'    => $post_new_expanse['ji_user_id'],
			'ji_new_expanse_id' => $lastID,
			'activity_type' => 1,
			'date'          => date("Y-m-d"),
			'time'          => date("h:i:sa")

		];

		$this->insertUserActivity($user_activity_data);

		return true;
	}

	public function updateNewExpanse(Array $update_new_expanse, $id)
	{
		$date = $this->DateConvertFormTODB($update_new_expanse['date']);
		$update_new_expanse['date'] = $date;
		$detailsData = $update_new_expanse['details'];

		unset($update_new_expanse['details']);

		$this->db->where('id', $id)
				->update('ji_new_expanse', $update_new_expanse);

		$this->db->where('ji_new_expanse_id', $id)
				->delete('ji_new_expanse_details');

		$update_expanse_report = [

			'ji_new_expanse_id' => $id,
			'expanse_total' 	=> $update_new_expanse['net_total']

		];

		$this->db->where('ji_new_expanse_id', $id)
				->update('ji_expanse_report', $update_expanse_report);

		foreach ($detailsData as $key => $value) 
		{
			$type = $value['type'];
			unset($value['type']);

			if ($type == 'edit') 
			{
				$recent_expanse_account = $value['account'];
				$recent_expanse_amount = $value['amount'];
				$previous_expanse_account = $value['previous_account'];
				$previous_expanse_amount = $value['previous_amount'];

				unset($value['previous_account']);
				unset($value['previous_amount']);

				if ($recent_expanse_account == $previous_expanse_account)
				{
					$account_balance_query = $this->db->select('amount')
							->where('account_name = ', $recent_expanse_account)
							->get('ji_account_reports')
							->row();

					$current_account_balance = $account_balance_query->amount;
					$new_account_amount = ($current_account_balance + $previous_expanse_amount) - $recent_expanse_amount;

					$this->db->set('amount', $new_account_amount)
						->where('account_name = ', $recent_expanse_account)
						->update('ji_account_reports');
				}
				else
				{
					$recent_account_balance_query = $this->db->select('amount')
							->where('account_name = ', $recent_expanse_account)
							->get('ji_account_reports')
							->row();

					$previous_account_balance_query = $this->db->select('amount')
							->where('account_name = ', $previous_expanse_account)
							->get('ji_account_reports')
							->row();

					$recent_account_balance = $recent_account_balance_query->amount;
					$previous_account_balance = $previous_account_balance_query->amount;

					$new_account_balance = $previous_account_balance + $previous_expanse_amount;

					$this->db->set('amount', $new_account_balance)
								->where('account_name = ', $previous_expanse_account)
								->update('ji_account_reports');

					$new_account_balance = $recent_account_balance - $recent_expanse_amount;

					$this->db->set('amount', $new_account_balance)
								->where('account_name = ', $recent_expanse_account)
								->update('ji_account_reports');
				}

				if (isset($value['previous_expense_details_id'])) 
				{
					$previous_expense_details_id = $value['previous_expense_details_id'];
					unset($value['previous_expense_details_id']);

					$this->db->where('ji_new_expanse_details_id', $previous_expense_details_id)->delete('ji_account_outgoing_reports');
				}

				$value['ji_new_expanse_id'] = $id;
				$this->db->insert('ji_new_expanse_details', $value);
				$new_expanse_details_id = $this->db->insert_id();

				$fields = $this->db->field_data('ji_account_outgoing_reports');
				$account_name = str_replace([' ', ':', '(', ')'], '', $recent_expanse_account);

				foreach ($fields as $field)
				{
					if ($field->name == $account_name) 
					{
						$insert_account_incoming_report = [

							'date' => $date,
							'ji_new_expanse_details_id' => $new_expanse_details_id,
							$account_name => $recent_expanse_amount
							
						];

						$this->db->insert('ji_account_outgoing_reports', $insert_account_incoming_report);
						break;
					}

				}

			} 
			else 
			{
				$delete_expense_account = $value['delete_expense_account'];
				$delete_expense_amount = $value['delete_expense_amount'];

				unset($value['delete_expense_account']);
				unset($value['delete_expense_amount']);

				$account_balance_query = $this->db->select('amount')
							->where('account_name = ', $delete_expense_account)
							->get('ji_account_reports')
							->row();

				$current_account_balance = $account_balance_query->amount;
				$new_account_amount = $current_account_balance + $delete_expense_amount;

				$this->db->set('amount', $new_account_amount)
					->where('account_name = ', $delete_expense_account)
					->update('ji_account_reports');
			}

		}

		$user_activity_data = [

			'ji_user_id'    => $update_new_expanse['ji_user_id'],
			'ji_new_expanse_id' => $id,
			'activity_type' => 2,
			'date'          => date("Y-m-d"),
			'time'          => date("h:i:sa")

		];

		$this->insertUserActivity($user_activity_data);
		return true;
	}

	public function deleteNewExpanse($id)
	{
		$accounts = $this->db->select('account, amount')
						->where('ji_new_expanse_id', $id)
						->get('ji_new_expanse_details')
						->result();

		foreach ($accounts as $key => $account) 
		{
			$account_name = $account->account;
			$account_amount = $account->amount;

			$account_balance_query = $this->db->select('amount')
						->where('account_name = ', $account_name)
						->get('ji_account_reports')
						->row();

			$current_account_balance = $account_balance_query->amount;
			$new_account_balance = $current_account_balance + $account_amount;

			$this->db->set('amount', $new_account_balance)
							->where('account_name = ', $account_name)
							->update('ji_account_reports');
		}

		$this->db->where('id = ', $id)->delete('ji_new_expanse');
		$this->db->where('ji_new_expanse_id = ', $id)->delete('ji_new_expanse_details');
		$this->db->where('ji_new_expanse_id = ', $id)->delete('ji_expanse_report');
	}

}
