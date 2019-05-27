<?php

class AccountModel extends CI_Model 
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

	public function getUser($user_id)
	{
		$query = $this->db->select('*')
					->where('id =', $user_id)
					->get('ji_user')
					->result();

		return $query;
	}

	public function getAccountAccessType($account_name)
	{
		$query = $this->db->select('*')
					->where('account_name =', $account_name)
					->get('ji_accounts')
					->result();

		return $query;
	}

	public function fetchUserType()
	{
		$query = $this->db->select('*')
					->get('ji_user_type')
					->result();

		return $query;
	}

	public function fetchReference()
	{
		$query = $this->db->select('*')
						->get('ji_account_reference')
						->result();

		return $query;
	}

	public function fetchAccount()
	{
		$query = $this->db->select('*')
						->get('ji_accounts')
						->result();

		return $query;
	}

	public function getCashInflow()
	{
		$user_role = $this->session->userdata['logged_in']['role'];

		if ($user_role == 1 || $user_role == 5) 
		{
			$query = $this->db->select('ji_account_cash_inflow.*, ji_user.name as user_name')
						->join('ji_user', 'ji_user.id = ji_account_cash_inflow.ji_user_id')
						->order_by('ji_account_cash_inflow.id', 'desc')
						->get('ji_account_cash_inflow')
						->result();
		} 
		else 
		{
			$query = $this->db->select('ji_account_cash_inflow.*, ji_user.name as user_name')
						->join('ji_user', 'ji_user.id = ji_account_cash_inflow.ji_user_id')
						->join('ji_accounts', 'ji_accounts.account_name = ji_account_cash_inflow.account_name', 'left')
						->where('ji_accounts.access_type', $user_role)
						->order_by('ji_account_cash_inflow.id', 'desc')
						->get('ji_account_cash_inflow')
						->result();
		}

		return $query;
	}

	public function fetchEditCashInflow($id)
	{
		$query = $this->db->select('*')
				->where('id = ', $id)
				->get('ji_account_cash_inflow')
				->row();

		return $query;
	}

	public function fetchPaymentType()
	{
		$query = $this->db->select('*')
						->get('ji_payment_type')
						->result();

		return $query;
	}

	public function fetchEditAccount($id)
	{
		$query = $this->db->select('*')
				->where('id = ', $id)
				->get('ji_accounts')
				->row();

		return $query;
	}

	public function fetchEditReference($id)
	{
		$query = $this->db->select('*')
				->where('id = ', $id)
				->get('ji_account_reference')
				->row();

		return $query;
	}

	public function getTransferReport()
	{
		$user_role = $this->session->userdata['logged_in']['role'];

		if ($user_role == 1 || $user_role == 3 || $user_role == 5) 
		{
			$query = $this->db->select('*')
						->order_by('id', 'desc')
						->get('ji_account_transfer')
						->result();
		} 
		else 
		{
			$query = $this->db->select('ji_account_transfer.*')
						->join('ji_accounts', 'ji_accounts.account_name = ji_account_transfer.from_account', 'left')
						->where('ji_accounts.access_type', $user_role)
						->where('ji_account_transfer.date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)')
						->order_by('ji_account_transfer.id', 'desc')
						->get('ji_account_transfer')
						->result();
		}
		
		return $query;
	}

	public function insertUserActivity(Array $user_activity_data)
	{
		$this->db->insert('ji_user_activity', $user_activity_data);
	}

	public function insertReference(Array $post_new_reference)
	{
		$this->db->insert('ji_account_reference', $post_new_reference);
	}

	public function updateReference(Array $update_reference, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_account_reference', $update_reference);
	}

	public function deleteReference($id)
	{
		$this->db->where('id = ', $id)->delete('ji_account_reference');
	}

	public function insertCashInflow(Array $post_new_cash_inflow)
	{
		$fetch_balance_query = $this->db->select('amount')
					->where('account_name = ', $post_new_cash_inflow['account_name'])
					->get('ji_account_reports')
					->row();

		$fetch_balance_amount = $fetch_balance_query->amount;

		$new_balance_amount = $fetch_balance_amount + $post_new_cash_inflow['amount'];

		$this->db->set('amount', $new_balance_amount)
				->where('account_name = ', $post_new_cash_inflow['account_name'])
				->update('ji_account_reports');

		$this->db->insert('ji_account_cash_inflow', $post_new_cash_inflow);
		$lastID = $this->db->insert_id();

		$date = $this->DateConvertFormTODB($post_new_cash_inflow['date']);

		if ($post_new_cash_inflow['reference_no'] != 'Adjustment') 
		{
			$fields = $this->db->field_data('ji_account_incoming_reports');
			$account_name = str_replace([' ', ':', '(', ')'], '', $post_new_cash_inflow['account_name']);

			foreach ($fields as $field)
			{
				if ($field->name == $account_name) 
				{
					$insert_account_incoming_report = [

						'date' => $date,
						'ji_account_cash_inflow_id' => $lastID,
						$account_name => $post_new_cash_inflow['amount']
						
					];

					$this->db->insert('ji_account_incoming_reports', $insert_account_incoming_report);
					break;
				}

			}

		}

		if ($post_new_cash_inflow['amount'] < 0) 
		{
			$amount = abs($post_new_cash_inflow['amount']);
			$insert_account_balance_report = [

				'date' 			      => $date,
				'account_name'	      => $post_new_cash_inflow['account_name'],
				'withdraw_adjustment' => $amount
				
			];
		} 
		else 
		{
			if ($post_new_cash_inflow['reference_no'] == 'Service') 
			{
				$insert_account_balance_report = [

					'date' 		   => $date,
					'account_name' => $post_new_cash_inflow['account_name'],
					'service' 	   => $post_new_cash_inflow['amount']
					
				];
			} 
			else 
			{
				$insert_account_balance_report = [

					'date' 			    => $date,
					'account_name'	    => $post_new_cash_inflow['account_name'],
					'invest_adjustment' => $post_new_cash_inflow['amount']
					
				];
			}
		}
		
		$this->db->insert('ji_account_balance_reports', $insert_account_balance_report);

		$user_activity_data = [

			'ji_user_id'    => $post_new_cash_inflow['ji_user_id'],
			'ji_account_cash_inflow_id' => $lastID,
			'activity_type' => 1,
			'date'          => date("Y-m-d"),
			'time'          => date("h:i:sa")

		];

		$this->insertUserActivity($user_activity_data);
	}

	public function updateCashInflow(Array $update_cash_inflow, $id)
	{
		$account = $update_cash_inflow['account_name'];
		$amount = $update_cash_inflow['amount'];
		$previous_account = $update_cash_inflow['previous_account_name'];
		$previous_amount = $update_cash_inflow['previous_amount'];

		unset($update_cash_inflow['previous_account_name']);
		unset($update_cash_inflow['previous_amount']);

		$account_balance_query = $this->db->select('amount')
					->where('account_name = ', $account)
					->get('ji_account_reports')
					->row();

		$account_balance_amount = $account_balance_query->amount;

		if ($previous_account == $account) 
		{
			if ($previous_amount >= $amount) 
			{
				$difference_amount = $previous_amount - $amount;
				$new_balance_amount = $account_balance_amount - $difference_amount;
			} 
			else 
			{
				$difference_amount = $amount - $previous_amount;
				$new_balance_amount = $account_balance_amount + $difference_amount;
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
			$new_balance_amount = $previous_account_amount - $previous_amount;

			$this->db->set('amount', $new_balance_amount)
					->where('account_name = ', $previous_account)
					->update('ji_account_reports');

			$new_balance_amount = $account_balance_amount + $amount;

			$this->db->set('amount', $new_balance_amount)
					->where('account_name = ', $account)
					->update('ji_account_reports');
					
		}

		$this->db->where('id = ', $id)
				->update('ji_account_cash_inflow', $update_cash_inflow);

		$this->db->where('ji_account_cash_inflow_id', $id)->delete('ji_account_incoming_reports');
		$fields = $this->db->field_data('ji_account_incoming_reports');
		$account_name = str_replace([' ', ':', '(', ')'], '', $update_cash_inflow['account_name']);
		$date = $this->DateConvertFormTODB($update_cash_inflow['date']);

		foreach ($fields as $field)
		{
			if ($field->name == $account_name) 
			{
				$insert_account_incoming_report = [

					'date' => $date,
					'ji_account_cash_inflow_id' => $id,
					$account_name => $update_cash_inflow['amount']
					
				];

				$this->db->insert('ji_account_incoming_reports', $insert_account_incoming_report);

				break;
			}

		}

		$user_activity_data = [

			'ji_user_id'    => $update_cash_inflow['ji_user_id'],
			'ji_account_cash_inflow_id' => $id,
			'activity_type' => 2,
			'date'          => date("Y-m-d"),
			'time'          => date("h:i:sa")

		];

		$this->insertUserActivity($user_activity_data);
	}

	public function deleteCashInflow($id)
	{
		$this->db->where('id = ', $id)->delete('ji_account_cash_inflow');
	}

	public function insertAccount(Array $post_new_account)
	{
		$this->db->insert('ji_accounts', $post_new_account);

		$post_new_account = [

			'date' => $post_new_account['date'],
			'account_name' => $post_new_account['account_name'],
			'amount' => 0

		];

		$this->db->insert('ji_account_reports', $post_new_account);
		$account_name = str_replace([' ', ':', '(', ')'], '', $post_new_account['account_name']);

		$column = [

			$account_name => [
				'type' => 'VARCHAR', 
				'constraint' => '255'
			]

		];

		$this->load->dbforge();
		$this->dbforge->add_column('ji_account_incoming_reports', $column);
		$this->dbforge->add_column('ji_account_outgoing_reports', $column);
	}

	public function updateAccount(Array $update_account, $id)
	{
		$previous_account = $update_account['previous_account_name'];
		unset($update_account['previous_account_name']);

		$this->db->where('id = ', $id)->update('ji_accounts', $update_account);

		$this->db->set('account_name', $update_account['account_name'])
				->where('account_name', $previous_account)
				->update('ji_account_reports');

		$previous_account = str_replace([' ', ':', '(', ')'], '', $previous_account);
		$update_account = str_replace([' ', ':', '(', ')'], '', $update_account['account_name']);

		$column = [

			$previous_account => [
				'name' => $update_account,
				'type' => 'VARCHAR',
				'constraint' => '255'
			]

		];

		$this->load->dbforge();
		$this->dbforge->modify_column('ji_account_incoming_reports', $column);
		$this->dbforge->modify_column('ji_account_outgoing_reports', $column);
	}

	public function deleteAccount($id)
	{
		$account_name = $this->db->select('account_name')
					->where('id =', $id)
					->get('ji_accounts')
					->row();

		$this->db->where('id = ', $id)->delete('ji_accounts');
		$this->db->where('account_name = ', $account_name->account_name)->delete('ji_account_reports');

		$account_name = str_replace([' ', ':', '(', ')'], '', $account_name->account_name);

		$this->load->dbforge();
		$this->dbforge->drop_column('ji_account_incoming_reports', $account_name);
		$this->dbforge->drop_column('ji_account_outgoing_reports', $account_name);
	}

	public function insertAccountAdjustment(Array $post_account_adjustment)
	{
		$date = $this->DateConvertFormTODB($post_account_adjustment['date']);

		$insert_account_balance_report = [

			'date' 				  => $date,
			'account_name'		  => $post_account_adjustment['account_name'],
			'withdraw_adjustment' => $post_account_adjustment['amount']
			
		];

		$this->db->insert('ji_account_balance_reports', $insert_account_balance_report);

		$previous_amount = 0;
		$update_amount = 0;

		$query = $this->db->select('*')
					->where('account_name =', $post_account_adjustment['account_name'])
					->get('ji_account_reports')
					->row();

		if (!empty($query)) 
		{
			$previous_amount = $query->amount;

			$update_amount = $previous_amount + $post_account_adjustment['amount'];
			$post_account_adjustment['amount'] = $update_amount;

			$this->db->set('amount', $post_account_adjustment['amount'])
					->where('account_name = ', $post_account_adjustment['account_name'])
					->update('ji_account_reports');
		} 
		else 
		{
			$update_amount = $previous_amount + $post_account_adjustment['amount'];
			$post_account_adjustment['amount'] = $update_amount;

			$this->db->insert('ji_account_reports', $post_account_adjustment);
		}

		return true;
	}

	public function fetchAccountBalance()
	{
		$user_role = $this->session->userdata['logged_in']['role'];

		if ($user_role == 1 || $user_role == 5) 
		{
			$query = $this->db->select('*')
						->get('ji_account_reports')
						->result();
		} 
		else 
		{
			$query = $this->db->select('*')
						->join('ji_accounts', 'ji_accounts.account_name = ji_account_reports.account_name', 'left')
						->where('ji_accounts.access_type', $user_role)
						->get('ji_account_reports')
						->result();
		}

		return $query;
	}

	public function getAccountBalanceReports($account_name, $from_date, $to_date)
	{
		$prev_day_account_balance = $this->db->select('*')
								->where('account_name', $account_name)
								->get('ji_account_reports')
								->row();

		$range_day_account_balance_reports = $this->db->select("day(date) as date_day, SUM(sales) as sales, SUM(service) as service, SUM(invest_adjustment) as invest_adjustment, SUM(bank_transfer_incoming) as bank_transfer_incoming, SUM(cash_transfer_incoming) as cash_transfer_incoming, SUM(bank_transfer_outgoing) as bank_transfer_outgoing, SUM(cash_transfer_outgoing) as cash_transfer_outgoing, SUM(expense) as expense, SUM(cash_purchase) as cash_purchase, SUM(vendor_pay) as vendor_pay, SUM(worker_pay) as worker_pay, SUM(withdraw_adjustment) as withdraw_adjustment")
							->where("account_name", $account_name)
							->where("date >", $from_date)
							->where("date <=", $to_date)
							->group_by('date')
							->order_by('date', 'ASC')
					        ->get('ji_account_balance_reports')
					        ->result();

		return ["prev_day_account_balance" => $prev_day_account_balance, "range_day_account_balance_reports" => $range_day_account_balance_reports];
	}

	public function fetchAccountReports($type, $month, $year)
	{
		if ($type == 'incoming') 
		{
			$query = $this->db->select("day(date) as date_day, SUM(BankFB) as Bank_FB, SUM(CashInMDP) as Cash_In_MDP, SUM(Bkash) as Bkash, SUM(CashInMirpur) as Cash_In_Mirpur, SUM(CashInFactory) as Cash_In_Factory, SUM(CashOnMD) as Cash_On_MD, SUM(DBBL) as DBBL")
							->where('MONTH(date)', $month)
							->where('YEAR(date)', $year)
							->group_by('date')
							->order_by('date', 'ASC')
					        ->get('ji_account_incoming_reports')
					        ->result();
		} 
		else 
		{
			$query = $this->db->select("day(date) as date_day, SUM(BankFB) as Bank_FB, SUM(CashInMDP) as Cash_In_MDP, SUM(Bkash) as Bkash, SUM(CashInMirpur) as Cash_In_Mirpur, SUM(CashInFactory) as Cash_In_Factory, SUM(CashOnMD) as Cash_On_MD, SUM(DBBL) as DBBL")
							->where('MONTH(date)', $month)
							->where('YEAR(date)', $year)
							->group_by('date')
							->order_by('date', 'ASC')
					        ->get('ji_account_outgoing_reports')
					        ->result();
		}

		return $query;
	}

	public function fetchWithdraw()
	{
		$query = $this->db->select('*')
					->order_by('id', 'desc')
					->get('ji_account_withdraw')
					->result();

		return $query;
	}

	public function accountWithdrawInsert(Array $account_withdraw)
	{
		$withdraw_account = $account_withdraw['account_name'];

		$fetch_withdraw_query = $this->db->select('amount')
					->where('account_name = ', $withdraw_account)
					->get('ji_account_reports')
					->row();

		$fetch_withdraw_amount = $fetch_withdraw_query->amount;

		$withdraw_amount = $account_withdraw['amount'];

		$new_withdraw_amount = $fetch_withdraw_amount - $withdraw_amount;

		$account_withdraw['balance'] = $new_withdraw_amount;

		$this->db->insert('ji_account_withdraw', $account_withdraw);

		$this->db->set('amount', $new_withdraw_amount)
				->where('account_name = ', $withdraw_account)
				->update('ji_account_reports');

		$fields = $this->db->field_data('ji_account_outgoing_reports');
		$account_name = str_replace([' ', ':', '(', ')'], '', $withdraw_account);
		$date = $this->DateConvertFormTODB($account_withdraw['date']);

		foreach ($fields as $field)
		{
			if ($field->name == $account_name) 
			{
				$insert_account_outgoing_report = [

					'date' => $date,
					$account_name => $withdraw_amount
					
				];

				$this->db->insert('ji_account_outgoing_reports', $insert_account_outgoing_report);
				break;
			}

		}

		$insert_account_balance_report = [

			'date' 				  => $date,
			'account_name'		  => $account_withdraw['account_name'],
			'withdraw_adjustment' => $account_withdraw['amount']
			
		];

		$this->db->insert('ji_account_balance_reports', $insert_account_balance_report);
		return true;
	}

	public function insertTransferAccount(Array $post_transfer_account)
	{
		$from_account = $post_transfer_account['from_account'];
		$to_account = $post_transfer_account['to_account'];
		$transfer_amount = $post_transfer_account['amount'];
		$date = $this->DateConvertFormTODB($post_transfer_account['date']);

		$transfer_from = $this->db->select('amount')
					->where('account_name = ', $from_account)
					->get('ji_account_reports')
					->row();

		$transfer_from_amount = $transfer_from->amount;

		$transfer_to = $this->db->select('amount')
					->where('account_name = ', $to_account)
					->get('ji_account_reports')
					->row();

		$transfer_to_amount = $transfer_to->amount;

		$new_transfer_from_amount = $transfer_from_amount - $transfer_amount;
		$new_transfer_to_amount = $transfer_to_amount + $transfer_amount;

		if (($new_transfer_from_amount >= 0) && ($from_account != $to_account)) 
		{
			$this->db->set('amount', $new_transfer_from_amount)
					->where('account_name = ', $from_account)
					->update('ji_account_reports');

			$this->db->set('amount', $new_transfer_to_amount)
					->where('account_name = ', $to_account)
					->update('ji_account_reports');

			$post_transfer_account['balance_from'] = $new_transfer_from_amount;
			$post_transfer_account['balance_to'] = $new_transfer_to_amount;

			$this->db->insert('ji_account_transfer', $post_transfer_account);
			$lastID = $this->db->insert_id();

			$fields = $this->db->field_data('ji_account_outgoing_reports');
			$account_name = str_replace([' ', ':', '(', ')'], '', $from_account);

			foreach ($fields as $field)
			{
				if ($field->name == $account_name) 
				{
					$insert_account_outgoing_report = [

						'date' => $date,
						$account_name => $transfer_amount
						
					];

					$this->db->insert('ji_account_outgoing_reports', $insert_account_outgoing_report);
					break;
				}

			}

			$fields = $this->db->field_data('ji_account_incoming_reports');
			$account_name = str_replace([' ', ':', '(', ')'], '', $to_account);

			foreach ($fields as $field)
			{
				if ($field->name == $account_name) 
				{
					$insert_account_incoming_report = [

						'date' => $date,
						$account_name => $transfer_amount
						
					];

					$this->db->insert('ji_account_incoming_reports', $insert_account_incoming_report);
					break;
				}

			}

			if (strpos($from_account, 'Bank') !== false) 
			{
			    // true
			    $insert_account_outgoing_balance_report = [

					'date' 			=> $date,
					'account_name'	=> $from_account,
					'bank_transfer_outgoing' => $post_transfer_account['amount']
					
				];

				$insert_account_incoming_balance_report = [

					'date' 			=> $date,
					'account_name'	=> $to_account,
					'bank_transfer_incoming' => $post_transfer_account['amount']
					
				];

				$this->db->insert('ji_account_balance_reports', $insert_account_outgoing_balance_report);
				$this->db->insert('ji_account_balance_reports', $insert_account_incoming_balance_report);
			}
			else
			{
				// false
				if (strpos($to_account, 'Bank') !== false) 
				{
					// true
					$insert_account_outgoing_balance_report = [

						'date' 			=> $date,
						'account_name'	=> $from_account,
						'bank_transfer_outgoing' => $post_transfer_account['amount']
						
					];

					$insert_account_incoming_balance_report = [

						'date' 			=> $date,
						'account_name'	=> $to_account,
						'bank_transfer_incoming' => $post_transfer_account['amount']
						
					];

				}
				else
				{
					// false
					$insert_account_outgoing_balance_report = [

						'date' 			=> $date,
						'account_name'	=> $from_account,
						'cash_transfer_outgoing' => $post_transfer_account['amount']
						
					];

					$insert_account_incoming_balance_report = [

						'date' 			=> $date,
						'account_name'	=> $to_account,
						'cash_transfer_incoming' => $post_transfer_account['amount']
						
					];

				}

				$this->db->insert('ji_account_balance_reports', $insert_account_outgoing_balance_report);
				$this->db->insert('ji_account_balance_reports', $insert_account_incoming_balance_report);
			}

			$user_activity_data = [

				'ji_user_id' 	=> $post_transfer_account['ji_user_id'],
				'ji_account_transfer_id' => $lastID,
				'activity_type' => 1,
				'date'          => date("Y-m-d"),
				'time'          => date("h:i:sa")

			];

			$this->insertUserActivity($user_activity_data);
			return true;
		} 
		else 
		{
			return false;
		}
		
	}

}
