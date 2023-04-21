<?php defined('BASEPATH') or exit('No direct script access allowed');
class HR extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('activity_model', 'activity_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->helper('helper');
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

	public function leave_application($curr_year = "2023")
	{

		// Query Here
		if ($this->session->userdata('group_id') == '6') {
			$con = "emp_status='Active'";
		} else {
			$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
		}

		$this->db->select('id');
		$this->db->from('jeol_employee_tbl');
		$this->db->where($con);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
		} else {
			$report_person_ids = $query->result_array();
			if (!empty($report_person_ids)) {
				foreach ($report_person_ids as $key => $value) $report_person[] = $value['id'];
			}

			// if ($curr_year == '') {
			// 	$this->db->select('*');
			// 	$this->db->from('jeol_apply_leave');
			// 	$this->db->where_in('YEAR(submit_date)', array('2020', '2019', '2021', '2022', '2023'));
			// 	$this->db->order_by('id', 'DESC');
			// 	$query = $this->db->get();
			// 	$sql_leave_request = $query->result_array();
			// } else {
			$this->db->select('*');
			$this->db->from('jeol_apply_leave');
			$this->db->where('YEAR(submit_date)', $curr_year);
			$this->db->order_by('id', 'DESC');
			$sql_leave_request = $this->db->get();
			$data['sql_leave_request_checkdata'] = $sql_leave_request->result_array();
			$sql_leave_request_check = $sql_leave_request->num_rows();
			// }
		}




		// $sql = "SELECT travel.sheet_id,emp.emp_name,travel.start_date,travel.end_date,travel.status,travel.member_id  FROM `jeol_travelsheet_tbl` as travel join jeol_employee_tbl as emp on travel.member_id=emp.id WHERE  travel.status!='Not Submitted' and travel.sheet_type='1' and year(travel.claim_date) = '$curr_year' ";

		// $data['emp_data'] = $this->db->query($sql)->result_array();


		$data['report_person'] = $report_person;
		$data['year'] = $curr_year;
		$data['view'] = 'admin/hr/leave_application';
		$this->load->view('layout', $data);
	}
}
