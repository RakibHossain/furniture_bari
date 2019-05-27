<?php

class UserModel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	private function DateConvertFormTODB($date)
	{
		return date("Y-m-d", strtotime($date));
	}

	public function count_user_activity_num_rows()
	{
		$query = $this->db->select('*')
						->get('ji_user_activity')
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

	public function fetchUser()
	{
		$query = $this->db->select('*')
					->get('ji_user')
					->result();

		return $query;
	}

	public function fetchEditUser($id)
	{
		$query = $this->db->select('*')
				->where('id = ', $id)
				->get('ji_user')
				->row();

		return $query;
	}

	public function fetchEditUserType($id)
	{
		$query = $this->db->select('*')
				->where('id = ', $id)
				->get('ji_user_type')
				->row();

		return $query;
	}

	public function insertUserType(Array $new_user_type)
	{
		$this->db->insert('ji_user_type', $new_user_type);
	}

	public function updateUserType(Array $update_user_type, $id)
	{
		$this->db->where('id = ', $id)->update('ji_user_type', $update_user_type);
	}

	/*public function deleteUserType($id)
	{
		$this->db->where('id = ', $id)->delete('ji_user_type');
	}*/

	public function insertUser(Array $post_new_user)
	{
		$this->db->insert('ji_user', $post_new_user);
	}

	public function updateUser(Array $update_user, $id)
	{
		$this->db->where('id = ', $id)->update('ji_user', $update_user);
	}

	public function deleteUser($id)
	{
		$this->db->where('id = ', $id)->delete('ji_user');
	}

	public function getUserActivity($limit, $offset)
	{
		$query = $this->db->select('ji_user_activity.*, ji_user.name')
						->join('ji_user', 'ji_user.id = ji_user_activity.ji_user_id')
						->limit($limit, $offset)
						->order_by('ji_user_activity.id', 'desc')
						->get('ji_user_activity')
						->result();

		return $query;
	}

}
