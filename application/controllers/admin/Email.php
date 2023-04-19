<?php defined('BASEPATH') or exit('No direct script access allowed');
class Email extends MY_Controller
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
		$data['department'] = $this->db->get('customer')->result_array();
		$data['view'] = 'admin/customer/customer';
		$this->load->view('layout', $data);
	}

	public function schedule()
	{
		// Employee data here
		$data['department'] = $this->db->get('jeol_schedule_mails')->result_array();
		$data['view'] = 'admin/email/email';
		$this->load->view('layout', $data);
	}


	public function add_schedule($id = 0)
	{

		if ($id != 0) {
			$data['email'] = $this->db->get_where('jeol_schedule_mails', array('id =' => $id))->row_array();
		}
		if ($this->input->post('submit')) {
			$data = array(
				'emp_id' => $this->input->post('emp_id'),
				'emp_to' => $this->input->post('emp_to'),
				'emp_cc' => $this->input->post('emp_cc'),
				'emp_cc_two' => $this->input->post('emp_cc_two')
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_schedule_mails', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_schedule_mails', $data);
			}

			redirect(base_url('admin/email/schedule'));
		}
		$data['id'] = $id;
		$data['employees'] = $this->db->get('jeol_employee_tbl')->result_array();
		$data['view'] = 'admin/email/add_email';
		$this->load->view('layout', $data);
	}

	public function leave ()
	{
		// Employee data here
		$data['department'] = $this->db->get('jeol_leave_mails')->result_array();
		$data['view'] = 'admin/email/leave';
		$this->load->view('layout', $data);
	}

	public function add_leave($id = 0)
	{

		if ($id != 0) {
			$data['email'] = $this->db->get_where('jeol_leave_mails', array('id =' => $id))->row_array();
		}
		if ($this->input->post('submit')) {
			$data = array(
				'emp_id' => $this->input->post('emp_id'),
				'emp_to' => $this->input->post('emp_to'),
				'emp_cc' => $this->input->post('emp_cc'),
				'emp_cc_two' => $this->input->post('emp_cc_two')
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_leave_mails', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_leave_mails', $data);
			}

			redirect(base_url('admin/email/leave'));
		}
		$data['id'] = $id;
		$data['employees'] = $this->db->get('jeol_employee_tbl')->result_array();
		$data['view'] = 'admin/email/add_leave';
		$this->load->view('layout', $data);
	}

	public function travel_emails()
	{
		// Employee data here
		$data['department'] = $this->db->get('jeol_travel_mails')->result_array();
		$data['view'] = 'admin/email/travel_email';
		$this->load->view('layout', $data);
	}

	public function add_travel_emails($id = 0)
	{

		if ($id != 0) {
			$data['email'] = $this->db->get_where('jeol_travel_mails', array('id =' => $id))->row_array();
		}
		if ($this->input->post('submit')) {
			$data = array(
				'emp_id' => $this->input->post('emp_id'),
				'emp_to' => $this->input->post('emp_to'),
				'emp_cc' => $this->input->post('emp_cc'),
				'emp_cc_two' => $this->input->post('emp_cc_two')
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_travel_mails', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_travel_mails', $data);
			}

			redirect(base_url('admin/email/leave'));
		}
		$data['id'] = $id;
		$data['employees'] = $this->db->get('jeol_employee_tbl')->result_array();
		$data['view'] = 'admin/email/add_travel_email';
		$this->load->view('layout', $data);
	}

}
