<?php

class MenuModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	public function getMenu()
	{
		$query = $this->db->select('*')
					->get('ji_parent_menus')
					->result();

		return $query;
	}

	public function getSubMenu()
	{
		$query = $this->db->select('ji_child_menus.*, ji_parent_menus.name as parent_menu_name')
					->join('ji_parent_menus', 'ji_parent_menus.id = ji_child_menus.ji_parent_menu_id', 'left')
					->get('ji_child_menus')
					->result();

		return $query;
	}

	public function getEditMenu($id)
	{
		$query = $this->db->select('*')
				->where('id = ', $id)
				->get('ji_parent_menus')
				->row();

		return $query;
	}

	public function getEditSubMenu($id)
	{
		$query = $this->db->select('ji_child_menus.*, ji_parent_menus.name as parent_menu_name')
				->join('ji_parent_menus', 'ji_parent_menus.id = ji_child_menus.ji_parent_menu_id', 'left')
				->where('ji_child_menus.id = ', $id)
				->get('ji_child_menus')
				->row();

		return $query;
	}

	public function insertMenu(Array $data)
	{
		$this->db->insert('ji_parent_menus', $data);
	}

	public function updateMenu(Array $data, $id)
	{
		$this->db->where('id = ', $id)->update('ji_parent_menus', $data);
	}

	public function deleteMenu($id)
	{
		$this->db->where('id = ', $id)->delete('ji_parent_menus');
		$this->db->where('ji_parent_menu_id = ', $id)->delete('ji_child_menus');
	}

	public function insertSubMenu(Array $data)
	{
		$this->db->insert('ji_child_menus', $data);
	}

	public function updateSubMenu(Array $data, $id)
	{
		$this->db->where('id = ', $id)->update('ji_child_menus', $data);
	}

	public function deleteSubMenu($id)
	{
		$this->db->where('id = ', $id)->delete('ji_child_menus');
	}

}
