<?php

class ServiceModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
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

	public function getInvoice()
	{
		$query = $this->db->select('id, order_no')
						->order_by('id', 'desc')
						->get('ji_invoice')
						->result();

		return $query;
	}

	public function getInvoiceInfo($invoice_id='')
	{
		$parentQuery = $this->db->select('ji_invoice.*, ji_invoice_details.item_name, ji_invoice_details.item_code, (ji_invoice.net_total - IFNULL((SELECT SUM(`amount`) from `ji_payment` where `ji_payment`.`ji_invoice_id` = `ji_invoice`.`id` and `ji_payment`.`status` = "1"), 0)) as total_due')
						->join('ji_invoice_details', 'ji_invoice_details.ji_invoice_id = ji_invoice.id', 'left')
						->where('status !=', '0')
						->where('ji_invoice.id', $invoice_id)
				        ->get('ji_invoice')
				        ->row();

		$childQuery = $this->db->select('*')
								->where('ji_invoice_id', $invoice_id)
								->get('ji_invoice_details')
								->result();

        return ["parent" => $parentQuery, "child" => $childQuery];
	}

	public function insertService($type, Array $post_new_service)
	{
		if ($type == 'data') 
		{
			$this->db->insert('ji_services', $post_new_service);
			$lastID = $this->db->insert_id();

			return $lastID;
		} 
		elseif ($type == 'details_data') 
		{
			$this->db->insert('ji_service_details', $post_new_service);
		}
		else
		{
			$this->db->insert('ji_service_comments', $post_new_service);
		}

	}

	public function getServiceList()
	{
		$query = $this->db->select('ji_services.*')
					->join('ji_service_details', 'ji_services.id = ji_service_details.ji_service_id', 'left')
					->join('ji_service_comments', 'ji_services.id = ji_service_comments.ji_service_id', 'left')
					->where('ji_services.status !=', '0')
					->where_in('ji_services.status', ['1','2','4'])
					->group_by('ji_services.id')
					->order_by('ji_services.id', 'desc')
			        ->get('ji_services')
			        ->result();

        return $query;
	}

	public function getEditService($id='')
	{
		$query = $this->db->select('*')
							->where('status !=', '0')
							->where('id', $id)
							->get('ji_services')
							->row();

		$childQuery = $this->db->select('*')
								->where('ji_service_id', $id)
								->get('ji_service_details')
								->result_array();

		$commentQuery = $this->db->select('*')
								->where('ji_service_id', $id)
								->get('ji_service_comments')
								->result_array();

        return ["parent" => $query, "child" => $childQuery, "comment_details" => $commentQuery];
	}

	public function updateService($type, Array $update_data, $id)
	{
		if ($type == 'data') 
		{
			$this->db->where('id', $id)->update('ji_services', $update_data);
			$this->db->where('ji_service_id', $id)->delete('ji_service_details');
			$this->db->where('ji_service_id', $id)->delete('ji_service_comments');
		} 
		elseif ($type == 'details_data') 
		{
			$this->db->insert('ji_service_details', $update_data);
		}
		else
		{
			$this->db->insert('ji_service_comments', $update_data);
		}
	}

	public function deleteService($id='')
	{
		$this->db->where('id = ', $id)->delete('ji_services');
		$this->db->where('ji_service_id = ', $id)->delete('ji_service_details');
		$this->db->where('ji_service_id = ', $id)->delete('ji_service_comments');
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

}
