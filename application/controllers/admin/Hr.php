<?php defined('BASEPATH') or exit('No direct script access allowed');
class HR extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}
	//-----------------------------------------------------------------------
	public function leaves()
	{
		// Employee data here
		$data['department'] = $this->db->get('jeol_leave_type')->result_array();
		$data['view'] = 'admin/hr/leaves';
		$this->load->view('layout', $data);
	}

	public function del_leaves($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('jeol_leave_type');
			redirect(base_url('admin/hr/leaves'));
		}
	}

	public function add_leaves($id = 0)
	{
		if ($id != 0) $data['department'] = $this->db->get_where('jeol_leave_type', array('id =' => $id))->row_array();
		if ($this->input->post('submit')) {
			$data = array(
				'employee_name' => $this->input->post('employee_name'),
				'leave_year' => $this->input->post('leave_year'),
				'cl' => $this->input->post('cl'),
				'al' => $this->input->post('al'),
				'cc' => $this->input->post('cc')
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_leave_type', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_leave_type', $data);
			}

			redirect(base_url('admin/hr/leaves'));
		}
		$data['id'] = $id;
		$data['employees'] = $this->db->get('jeol_employee_tbl')->result_array();
		$data['view'] = 'admin/hr/add_leaves';
		$this->load->view('layout', $data);
	}
}
