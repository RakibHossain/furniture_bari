<?php

class MarketingModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	public function getCustomer($to_customer)
	{
		$this->db->select('customer_name, mobile_no');

		if ($to_customer == 1) {
			$this->db->where("order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
		}
		if ($to_customer == 2) {
			$this->db->where('order_date >= DATE_SUB(NOW(), INTERVAL 4 MONTH)');
		}
		if ($to_customer == 3) {
			$this->db->where('order_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH)');
		}
		if ($to_customer == 4) {
			$this->db->where('order_date >= DATE_SUB(NOW(), INTERVAL 12 MONTH)');
		}

		$query = $this->db->get('ji_invoice')->result();
		return $query;
	}

	public function insertMarketingSMS($data)
	{
		$this->db->insert('ji_sms_marketing', $data);
	}

	public function getMarketingSMSList()
	{
		$query = $this->db->select('*')
					->get('ji_sms_marketing')
					->result();

		return $query;
	}

}
