<?php defined('BASEPATH') or exit('No direct script access allowed');
class Department extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}
	//-----------------------------------------------------------------------
	public function index()
	{
		// Employee data here
		$data['department'] = $this->db->get('jeol_hr_tbl')->result_array();
		$data['view'] = 'admin/department/department';
		$this->load->view('layout', $data);
	}

	public function add_department($id = 0)
	{
		if ($id != 0) $data['department'] = $this->db->get_where('jeol_hr_tbl', array('id =' => $id))->row_array();
		if ($this->input->post('submit')) {
			$data = array(
				'name' => $this->input->post('emp_name'),
				'description' => $this->input->post('description'),
				'status' => "Active"
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_hr_tbl', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_hr_tbl', $data);
			}

			redirect(base_url('admin/department/department'));
		}
		$data['id'] = $id;
		$data['view'] = 'admin/department/add_department';
		$this->load->view('layout', $data);
	}
}
