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
		if ($this->session->userdata('group_id') != '6') $this->db->where($con . " !=", 0);
		else $this->db->where($con);
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

			if ($this->session->userdata('group_id') == '6') {
				$this->db->where('YEAR(submit_date)', $curr_year);
			} else {
				$this->db->where_in('YEAR(submit_date)', array('2020', '2019', '2021', '2022', '2023'));
			}



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

	public function approve_leave($id, $mem_id)
	{
		$data = array('leave_status' => 'Approved');

		$this->db->where('id', $id);
		$this->db->update('jeol_apply_leave', $data);


		// $table = "jeol_leave_mails";

		// $data = jeol_reporting_mail($mem_id, $table);

		// $sql_reporting_person_tl = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata('user_id') . "'"));
		// $sql_reporting_person = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_employee_tbl` WHERE id='$mem_id'"));
		// $reporting_person_name = $sql_reporting_person['emp_name'];
		// $this->email->from(ADMIN_FROM, $sql_reporting_person_tl['emp_name']);

		// $to = $sql_reporting_person['emp_email'];
		// $this->email->to($to);
		// $this->email->cc($data[1]);
		// $this->email->subject('Leaves Application Approved');
		// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 205));
		// $mailtemp = $sql->row();
		// $msg1 = $mailtemp->description;

		// $messagebody = str_replace("{employee_name}", $sql_reporting_person['emp_name'], $msg1);
		// $messagebody1 = str_replace("{person_name}", $sql_reporting_person_tl['emp_name'], $messagebody);

		// $this->email->message($messagebody1);
		// $this->email->send();

		redirect('admin/hr/leave_application');
	}

	public function reject_leave($id, $mem_id)
	{
		$data = array('leave_status' => 'Rejected');

		$this->db->where('id', $id);
		$this->db->update('jeol_apply_leave', $data);


		// 	$sql_reporting_person_tl = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata('user_id') . "'"));

		// $sql_reporting_person = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_employee_tbl` WHERE id='$mem_id'"));
		// $reporting_person_name = $sql_reporting_person['emp_name'];
		// $this->email->from(ADMIN_FROM, $sql_reporting_person_tl['emp_name']);

		// $to = $sql_reporting_person['emp_email'];
		// $this->email->to($to);
		// //$this->email->cc(ADMIN_CC);
		// $this->email->subject('Leaves Application Rejected');
		// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 305));
		// $mailtemp = $sql->row();
		// $msg1 = $mailtemp->description;

		// $messagebody = str_replace("{employee_name}", $sql_reporting_person['emp_name'], $msg1);
		// $messagebody1 = str_replace("{contact_person}", $sql_reporting_person_tl['emp_name'], $messagebody);

		// $this->email->message($messagebody1);
		// $this->email->send();

		redirect('admin/hr/leave_application');
	}

	public function my_leave_application($curr_year = "2023")
	{

		$emp_id = $this->session->userdata('user_id');

		$this->db->where('employee_name', $emp_id);
		$query = $this->db->get('jeol_leave_type');

		// Leave Applications
		$this->db->where('submit_date >', '2023-03-31');
		$this->db->where('member_id', $this->session->userdata('user_id'));
		$this->db->order_by('id', 'DESC');
		$data['sql_leave_request'] = $this->db->get('jeol_apply_leave')->result_array();


		$data['departments'] = $query->result_array();
		$data['view'] = 'admin/hr/my_leave_application';
		$this->load->view('layout', $data);
	}

	public function apply_my_leave_application($leave_id = 0)
	{

		$emp_id = $this->session->userdata('user_id');

		$this->db->where('employee_name', $emp_id);
		$query = $this->db->get('jeol_leave_type');

		$data['departments'] = $query->result_array();
		$data['leave_id'] = $leave_id;
		$data['view'] = 'admin/hr/apply_my_leave_application';
		$this->load->view('layout', $data);
	}

	public function edit_apply_my_leave_application($id = 0)
	{


		$this->db->where('id', $id);
		$query = $this->db->get('jeol_apply_leave');

		$data['leave_data'] = $query->row_array();

		$data['id'] = $id;
		$data['view'] = 'admin/hr/edit_apply_my_leave_application';
		$this->load->view('layout', $data);
	}

	public function apply_leave($leave = 0)
	{


		$emp_id = $this->session->userdata('user_id');
		if ($this->input->post('submit')) {
			// echo "fff"; die;

			$start_ts = strtotime($this->input->post('start_date'));
			$end_ts = strtotime($this->input->post('end_date'));
			$diff = $end_ts - $start_ts;
			$no_dd = round($diff / 86400) + 1;

			$data = array(

				'start_date' => date("Y-m-d", strtotime($this->input->post('start_date'))),
				'end_date' => $this->input->post('end_date'),
				'leave_type' => $this->input->post('leave_type'),
				'leave_status' => 'Sent',
				'submit_date' => date('Y-m-d'),
				'no_days' => $no_dd,
				'member_id' => $emp_id,
				'leave_id' => $this->input->post('leave_id'),
				'reason' => $this->input->post('reason')
			);
			$this->db->insert('jeol_apply_leave', $data);

			// if ($edit_id == 0) {
			// Insert

			// $table = "jeol_leave_mails";
			// $data = jeol_reporting_mail($emp_id, $table);

			// $sql_reporting_person = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_employee_tbl` WHERE id='$emp_id'"));
			// $reporting_person_id = $sql_reporting_person['report_to'];
			// $sql_reporting_person_name = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_employee_tbl` WHERE id='$reporting_person_id'"));

			// $sql_auth_person = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_employee_tbl` WHERE emp_email='$data[0]'"));
			// $reporting_auth_name = $sql_auth_person['emp_name'];


			// $this->email->from(ADMIN_FROM, $sql_reporting_person['emp_name']);
			// $this->email->to($data[0]);
			// $this->email->cc($data[1]);
			// $this->email->subject('Request For Leave Application');
			// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 105));
			// $mailtemp = $sql->row();
			// $msg1 = $mailtemp->description;

			// $messagebody = str_replace("{tl_member}", $reporting_auth_name, $msg1);
			// $messagebody1 = str_replace("{emp_name}", $sql_reporting_person['emp_name'], $messagebody);
			// $messagebody2 = str_replace("{from}", date("Y-m-d", strtotime($this->input->post('start_date'))), $messagebody1);
			// $messagebody3 = str_replace("{to}", date("Y-m-d", strtotime($this->input->post('end_date'))), $messagebody2);
			// $messagebody4 = str_replace("{reason}", $this->input->post('reason'), $messagebody3);
			// $this->email->message($messagebody4);
			// $this->email->send();

			// } else {
			// 	// Update
			// 	$this->db->where('id', $id);
			// 	$this->db->update('jeol_leave_type', $data);
			// }

			redirect(base_url('admin/hr/my_leave_application'));
		}
	}

	public function update_leave($id = 0)
	{

		$start_ts = strtotime($this->input->post('start_date'));
		$end_ts = strtotime($this->input->post('end_date'));
		$diff = $end_ts - $start_ts;
		$no_dd = round($diff / 86400) + 1;

		$data = array(

			'start_date' => date("Y-m-d", strtotime($this->input->post('start_date'))),
			'end_date' => $this->input->post('end_date'),
			'leave_type' => $this->input->post('leave_type'),


			'submit_date' => date('Y-m-d'),
			'no_days' => $no_dd,

			// 'leave_id' => $this->input->post('leave_id'),
			'reason' => $this->input->post('reason')




		);
		$this->db->where('id', $id);
		$this->db->update('jeol_apply_leave', $data);
		redirect(base_url('admin/hr/my_leave_application'));
	}

	public function delete_leave($id = 0)
	{
		if ($id != 0) {

			$this->db->where('id', $id);
			$this->db->delete('jeol_apply_leave');
			redirect('admin/hr/my_leave_application');
		}
	}
}
