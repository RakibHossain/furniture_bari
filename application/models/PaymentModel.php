<?php

class PaymentModel extends CI_Model 
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

	public function getSendSmsData($id='')
	{
		$query = $this->db->select("ji_invoice.*, (ji_invoice.net_total - IFNULL(sum(ji_payment.amount), 0)) as total_due")
				->join('ji_payment', 'ji_payment.ji_invoice_id = ji_invoice.id', 'left')
				->where('ji_invoice.id', $id)
				->where('ji_invoice.status !=', '0')
				->get('ji_invoice')
				->row();

		return $query;
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

	public function count_payment_num_rows()
	{
		$query = $this->db->select('*')
						->get('ji_payment')
						->num_rows();
		
		return $query;
	}

	public function fetchPaymentType()
	{
		$query = $this->db->select('*')
						->get('ji_payment_type')
						->result();

		return $query;
	}

	public function fetchEditPaymentType($id='')
	{
		$query = $this->db->select('*')
						->where('id =', $id)
						->get('ji_payment_type')
						->row();

		return $query;
	}

	public function insertUserActivity(Array $user_activity_data)
	{
		$this->db->insert('ji_user_activity', $user_activity_data);
	}

	public function insertPaymentType(Array $post_payment_type)
	{
		$this->db->insert('ji_payment_type', $post_payment_type);
	}

	public function updatePaymentType(Array $update_payment_type, $id)
	{
		$this->db->where('id = ', $id)
				->update('ji_payment_type', $update_payment_type);
	}

	public function deletePaymentType($id='')
	{
		$this->db->where('id = ', $id)->delete('ji_payment_type');
	}

	public function getAccount()
	{
		$query = $this->db->select('*')->get('ji_accounts')->result();

		return $query;
	}

	public function getPayment($value='')
	{
		$user_role = $this->session->userdata['logged_in']['role'];

		if ($user_role == 1 || $user_role == 5) 
		{
			$query = $this->db->select('ji_payment.id, ji_invoice.order_no, ji_payment.payment_type, ji_payment.date, ji_payment.reference_no, ji_payment.receive_status, ji_payment.account_name, ji_payment.amount, ji_user.name')
						->join('ji_invoice', 'ji_invoice.id = ji_payment.ji_invoice_id', 'left')
						->join('ji_user', 'ji_user.id = ji_payment.ji_user_id', 'left')
						->where('ji_payment.status', '1')
						->order_by('id', 'desc')
						->limit(50)
						->get('ji_payment')
						->result();
		} 
		else 
		{
			$query = $this->db->select('ji_payment.id, ji_invoice.order_no, ji_payment.payment_type, ji_payment.date, ji_payment.reference_no, ji_payment.receive_status, ji_payment.account_name, ji_payment.amount, ji_user.name')
						->join('ji_invoice', 'ji_invoice.id = ji_payment.ji_invoice_id', 'left')
						->join('ji_user', 'ji_user.id = ji_payment.ji_user_id', 'left')
						->join('ji_accounts', 'ji_accounts.account_name = ji_payment.account_name', 'left')
						->where('ji_accounts.access_type', $user_role)
						->where('ji_payment.status', '1')
						->order_by('id', 'desc')
						->limit(50)
						->get('ji_payment')
						->result();
		}
        
        return $query;
	}

	public function SavePayment(Array $data)
	{
		unset($data['hidden_date']);
		
		$fetch_balance_query = $this->db->select('amount')
					->where('account_name = ', $data['account_name'])
					->get('ji_account_reports')
					->row();

		$previous_balance_amount = (!empty($fetch_balance_query->amount)) ? $fetch_balance_query->amount : 0;
		$new_balance_amount = $previous_balance_amount + $data['amount'];

		$this->db->set('amount', $new_balance_amount)
				->where('account_name', $data['account_name'])
				->update('ji_account_reports');

		$this->db->insert('ji_payment', $data);
		$lastID = $this->db->insert_id();
		
		$fields 	  = $this->db->field_data('ji_account_incoming_reports');
		$account_name = str_replace([' ', ':', '(', ')'], '', $data['account_name']);
		$date 		  = $this->DateConvertFormTODB($data['date']);

		foreach ($fields as $field)
		{
			if ($field->name === $account_name) 
			{
				$insert_account_incoming_report = [
					'date' 			=> $date,
					'ji_payment_id' => $lastID,
					$account_name 	=> $data['amount']
				];

				$this->db->insert('ji_account_incoming_reports', $insert_account_incoming_report);
				break;
			}

		}

		$insert_account_balance_report = [
			'date' 		   => $date,
			'account_name' => $data['account_name'],
			'sales' 	   => $data['amount']
		];

		$this->db->insert('ji_account_balance_reports', $insert_account_balance_report);

		$user_activity_data = [
			'ji_user_id'    => $data['ji_user_id'],
			'ji_payment_id' => $lastID,
			'activity_type' => 1,
			'date'          => date("Y-m-d"),
			'time'          => date("h:i:sa")
		];

		$this->insertUserActivity($user_activity_data);

		$send_sms_data = $this->getSendSmsData($data['ji_invoice_id']);

		// Send sms & store the records in db
		$customer_name = $send_sms_data->customer_name;
		$due 		   = $send_sms_data->total_due;
		if ($data['reference_no'] == 'Delivery') {
			if (!empty($due)) {
				$message = "Hello $customer_name, Thank you for shopping on FurnitureBari.com Please keep clear your $due BDT (Dues) to get proper warranty service. Service Hotline No: 01885936445";
				$type 	 = 'due';
			} else {
				$message = "Hello $customer_name, Thank you for shopping on FurnitureBari.com Please visit our website to see more Hot products. Service Hotline No: 01885936445";
				$type 	 = 'clear';
			}
		}
		
		$mobile_no = str_replace([' ', ',', '/'], '', $send_sms_data->mobile_no);
		$to 	   = substr($mobile_no, 0, 11).','.substr($mobile_no, 11, 11);
		$send_sms  = sendSMS($to, $message);
		$this->insertSendSMS($lastID, $type);

		return true;
	}

	public function PaymentEditData($id)
	{
		$query = $this->db->select('*')
						->where('status', '1')
						->where('id', $id)
						->get('ji_payment')
						->row();

        return $query;
	}

	public function EditPayment(Array $data, $id)
	{
		$previous_payment_amount = $data['previous_amount'];
		$previous_account 		 = $data['previous_account_name'];
		$recent_payment_amount 	 = $data['amount'];
		$recent_account 		 = $data['account_name'];

		unset($data['previous_amount']);
		unset($data['previous_account_name']);

		$fetch_current_account_balance_query = $this->db->select('amount')
												->where('account_name = ', $recent_account)
												->get('ji_account_reports')
												->row();

		$fetch_previous_account_balance_query = $this->db->select('amount')
												->where('account_name = ', $previous_account)
												->get('ji_account_reports')
												->row();

		$current_account_balance_amount  = $fetch_current_account_balance_query->amount;
		$previous_account_balance_amount = $fetch_previous_account_balance_query->amount;

		if ($previous_account == $recent_account) 
		{
			if ($previous_payment_amount >= $recent_payment_amount)
			{
				$difference_payment_amount  = $previous_payment_amount - $recent_payment_amount;
				$new_account_balance_amount = $current_account_balance_amount - $difference_payment_amount;
			}
			else
			{
				$difference_payment_amount  = $recent_payment_amount - $previous_payment_amount;
				$new_account_balance_amount = $current_account_balance_amount + $difference_payment_amount;
			}

		}
		else
		{
			$new_account_balance_amount = $current_account_balance_amount + $recent_payment_amount;
			$previous_account_new_balance_amount = $previous_account_balance_amount - $previous_payment_amount;

			$this->db->set('amount', $previous_account_new_balance_amount)
						->where('account_name = ', $previous_account)
						->update('ji_account_reports');
		}

		$this->db->set('amount', $new_account_balance_amount)
				->where('account_name = ', $recent_account)
				->update('ji_account_reports');

		$this->db->where('id', $id)->update('ji_payment', $data);
		
		$this->db->where('ji_payment_id', $id)->delete('ji_account_incoming_reports');
		$fields = $this->db->field_data('ji_account_incoming_reports');
		$account_name = str_replace([' ', ':', '(', ')'], '', $data['account_name']);
		$date = $this->DateConvertFormTODB($data['date']);

		foreach ($fields as $field)
		{
			if ($field->name === $account_name) 
			{
				$insert_account_incoming_report = [

					'date' 			=> $date,
					'ji_payment_id' => $id,
					$account_name 	=> $data['amount']
					
				];

				$this->db->insert('ji_account_incoming_reports', $insert_account_incoming_report);
				break;
			}

		}

		$time = date("h:i:sa");
		$user_activity_data = [
			'ji_user_id'    => $data['ji_user_id'],
			'ji_payment_id' => $id,
			'activity_type' => 2,
			'date'          => date("Y-m-d"),
			'time'          => $time
		];

		$this->insertUserActivity($user_activity_data);

		$send_sms_data = $this->getSendSmsData($data['ji_invoice_id']);

		// Send sms & store the records in db
		$customer_name = $send_sms_data->customer_name;
		$due 		   = $send_sms_data->total_due;
		if ($data['reference_no'] == 'Delivery') {
			if (!empty($due)) {
				$message = "Hello $customer_name, Thank you for shopping on FurnitureBari.com Please keep clear your $due BDT (Dues) to get proper warranty service. Service Hotline No: 01885936445";
				$type 	 = 'due';
			} else {
				$message = "Hello $customer_name, Thank you for shopping on FurnitureBari.com Please visit our website to see more Hot products. Service Hotline No: 01885936445";
				$type 	 = 'clear';
			}
		}
		
		$mobile_no = str_replace([' ', ',', '/'], '', $send_sms_data->mobile_no);
		$to 	   = substr($mobile_no, 0, 11).','.substr($mobile_no, 11, 11);
		$send_sms  = sendSMS($to, $message);
		$this->insertSendSMS($id, $type);

		return true;
	}

	public function InvoiceSelectList()
	{
		$query = $this->db->select('id, order_no')->where('status !=', '0')->get('ji_invoice')->result_array();
		$allID = array_column($query, 'id');
		$allOrderno = array_column($query, 'order_no');

		$result = array_combine($allID, $allOrderno);

        return $result;
	}

	public function getPaymentReport($limit, $offset)
	{
		$this->db->select('ji_payment.id, ji_payment.ji_invoice_id, ji_invoice.order_no, ji_payment.payment_type, ji_payment.date, ji_payment.reference_no, ji_payment.receive_status, ji_payment.account_name, ji_payment.amount');
		$this->db->where('ji_payment.status', '1')->order_by('id', 'desc');
		$this->db->join('ji_invoice', 'ji_invoice.id = ji_payment.ji_invoice_id', 'left');
		$this->db->limit($limit, $offset);
		
		if($_GET)
		{
			if($_GET['from_date'])
				$this->db->where('ji_payment.date >=', $this->DateConvertFormTODB($_GET['from_date']));

			if($_GET['to_date'])
				$this->db->where('ji_payment.date <=', $this->DateConvertFormTODB($_GET['to_date']));
		}
		
		$this->db->where('ji_payment.status !=','0');
		$this->db->group_by('ji_payment.id')->order_by('id', 'desc');

        $query = $this->db->get('ji_payment')->result();

        return $query;
	}

	public function getPaymentGraphReport()
	{
		$query = $this->db->select('MONTH(date) as month, SUM(amount) as total_amount')
					->where('YEAR(date) =', date('Y'))
					->where('status !=', '0')
					->group_by('MONTH(date)')
			        ->get('ji_payment')
			        ->result();

        return $query;
	}

	public function getPaymentSummeryReport($month, $year)
	{
		$query = $this->db->select('GROUP_CONCAT(DISTINCT ji_invoice.id SEPARATOR ", ") as id, GROUP_CONCAT(DISTINCT ji_invoice.order_no SEPARATOR ", ") as order_no, GROUP_CONCAT(ji_invoice.status SEPARATOR ", ") as status, day(ji_payment.date) as date_day, GROUP_CONCAT(ji_payment.reference_no SEPARATOR ", ") as reference_no, GROUP_CONCAT(DISTINCT ji_invoice_details.item_code SEPARATOR ", ") as item_code, SUM(DISTINCT IF(ji_payment.reference_no = "Advance",ji_payment.amount,0)) as advance_paid, SUM(DISTINCT IF(ji_payment.reference_no = "Delivery",ji_payment.amount,0)) as delivery_paid, SUM(DISTINCT ji_payment.amount) as total_paid')
						->join('ji_invoice_details', 'ji_invoice_details.ji_invoice_id = ji_payment.ji_invoice_id', 'left')
						->join('ji_invoice', 'ji_invoice.id = ji_payment.ji_invoice_id', 'left')
						->where('MONTH(ji_payment.date)', $month)
						->where('YEAR(ji_payment.date)', $year)
						->where('ji_payment.status !=', '0')
						->group_by('ji_payment.date')
						->order_by('ji_payment.date', 'ASC')
				        ->get('ji_payment')
				        ->result();

        return $query;
	}

}
