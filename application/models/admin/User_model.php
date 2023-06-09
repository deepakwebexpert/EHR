<?php
class User_model extends CI_Model
{
	public function add_user($data)
	{
		$this->db->insert('ci_users', $data);
		return true;
	}

	public function add_employee($data)
	{
		$this->db->insert('jeol_employee_tbl', $data);
		$insert_id = $this->db->insert_id();

		return  $insert_id;
	}

	//---------------------------------------------------
	// get all users for server-side datatable processing (ajax based)
	public function get_all_users($ex = '')
	{
		$wh = array();
		$SQL = 'SELECT * FROM jeol_employee_tbl';
		if($ex == 'ex') $wh[] = " emp_status = 'Delete' ";
		else $wh[] = " emp_status = 'Active' ";
		if (count($wh) > 0) {
			$WHERE = implode(' and ', $wh);
			return $this->datatable->LoadJson($SQL, $WHERE);
		} else {
			return $this->datatable->LoadJson($SQL);
		}
	}

	//---------------------------------------------------
	// get all user records
	public function get_all_simple_users()
	{
		$this->db->where('is_admin', 0);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get('ci_users');
		return $result = $query->result_array();
	}

	//---------------------------------------------------
	// Count total user for pagination
	public function count_all_users()
	{
		return $this->db->count_all('ci_users');
	}

	//---------------------------------------------------
	// Get all users for pagination
	public function get_all_users_for_pagination($limit, $offset)
	{
		$wh = array();
		$this->db->order_by('created_at', 'desc');
		$this->db->limit($limit, $offset);

		if (count($wh) > 0) {
			$WHERE = implode(' and ', $wh);
			$query = $this->db->get_where('ci_users', $WHERE);
		} else {
			$query = $this->db->get('ci_users');
		}
		return $query->result_array();
		//echo $this->db->last_query();
	}


	//---------------------------------------------------
	// get all users for server-side datatable with advanced search
	public function get_all_users_by_advance_search()
	{
		$wh = array();
		$SQL = 'SELECT * FROM ci_users';
		if ($this->session->userdata('user_search_type') != '')
			$wh[] = "is_active = '" . $this->session->userdata('user_search_type') . "'";
		if ($this->session->userdata('user_search_from') != '')
			$wh[] = " `created_at` >= '" . date('Y-m-d', strtotime($this->session->userdata('user_search_from'))) . "'";
		if ($this->session->userdata('user_search_to') != '')
			$wh[] = " `created_at` <= '" . date('Y-m-d', strtotime($this->session->userdata('user_search_to'))) . "'";

		$wh[] = " is_admin = 0";
		if (count($wh) > 0) {
			$WHERE = implode(' and ', $wh);
			return $this->datatable->LoadJson($SQL, $WHERE);
		} else {
			return $this->datatable->LoadJson($SQL);
		}
	}





	//---------------------------------------------------
	// Get user detial by ID
	public function get_user_by_id($id)
	{
		$query = $this->db->get_where('ci_users', array('id' => $id));
		return $result = $query->row_array();
	}

	//---------------------------------------------------
	// Edit user Record
	public function edit_user($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}

	//---------------------------------------------------
	// Get User Role/Group
	public function get_user_groups()
	{
		$query = $this->db->get('ci_user_groups');
		return $result = $query->result_array();
	}

	//---------------------------------------------------
	// Get User Role/Group
	public function reporting_employees()
	{
		$query = $this->db->get('jeol_employee_tbl');
		return $result = $query->result_array();
	}

	//---------------------------------------------------
	// Get User Role/Group
	public function designation()
	{
		$query = $this->db->get('jeol_hr_tbl');
		return $result = $query->result_array();
	}
}
