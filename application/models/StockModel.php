<?php

class StockModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	public function fetchSalesItem()
	{
		$query = $this->db->select('item_name, item_code')
					->order_by('id', 'desc')
					->get('ji_product_item')
					->result();

		return $query;
	}

	public function fetchPurchaseItem()
	{
		$query = $this->db->select('item_name, item_code')
					->order_by('id', 'desc')
					->get('ji_purchase_item')
					->result();

		return $query;
	}

	public function fetchStockReport($stock_item='')
	{
		$query = $this->db->select('*')
					->order_by('id', 'desc')
					->where('item_category = ', $stock_item)
					->get('ji_stock')
					->result();

		return $query;
	}

	public function insertAdjustment(Array $post_adjustment)
	{
		$detailsData = $post_adjustment['details'];
		unset($post_adjustment['details']);

		foreach ($detailsData as $key => $value) 
		{
			$this->db->insert('ji_stock', $value);
		}

		return true;
	}

}
