<?php defined('BASEPATH') or exit('No direct script access allowed');
class Users extends MY_Controller
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
		$data['view'] = 'admin/users/user_list';
		$this->load->view('layout', $data);
	}

	public function ex()
	{
		$data['view'] = 'admin/users/user_list_ex';
		$this->load->view('layout', $data);
	}
	//-----------------------------------------------------------------------
	public function datatable_json()
	{
		$records = $this->user_model->get_all_users();
		$data = array();
		$i = 0;

		foreach ($records['data']  as $row) {

			// Report to Names
			$reported_ids = $row['report_to'];
			$ids = explode(",", $reported_ids);
			$names = '';

			foreach ($ids as $key => $value) {
				$names .= $this->db->get_where('jeol_employee_tbl', array('id =' => $value))->row()->emp_name . '  ,';
			}
			$disabled = ($row['is_admin'] == 1) ? 'disabled' : '' . '<span>';
			$data[] = array(
				++$i,
				$row['emp_name'] . '<br>C:' . $row['emp_phone'],
				$names,
				"D:  " . $row['emp_position'] . '<br>R:  ' . $row['emp_role'],
				$row['emp_code'] . "<br>PW  : " . $row['emp_password'],
				$row['emp_status'],


				// '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/users/edit/' . $row['id']) . '"> <i class="material-icons">visibility</i></a><a title="Edit" class="update btn btn-sm btn-primary" href="' . base_url('admin/users/edit/' . $row['id']) . '"> <i class="material-icons">edit</i></a><a title="Delete" class="delete btn btn-sm btn-danger ' . $disabled . '" data-href="' . base_url('admin/users/del/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>',
				'<a title="Edit" class="update btn btn-sm btn-primary m-r-10" href="' . base_url('admin/users/edit/' . $row['id']) . '"> <i class="material-icons">edit</i></a><a title="Delete" class="delete btn btn-sm btn-danger ' . $disabled . '" data-href="' . base_url('admin/users/del/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>',

			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}

	public function datatable_json_ex()
	{
		$records = $this->user_model->get_all_users('ex');
		$data = array();
		$i = 0;

		foreach ($records['data']  as $row) {

			// Report to Names
			$reported_ids = $row['report_to'];
			$ids = explode(",", $reported_ids);
			$names = '';
			// print_r($ids); die;
			foreach ($ids as $key => $value) {
				$names .= $this->db->get_where('jeol_employee_tbl', array('id =' => $value))->row()->emp_name . '  ,';
			}

			$disabled = ($row['is_admin'] == 1) ? 'disabled' : '' . '<span>';
			$data[] = array(
				++$i,
				$row['emp_name'] . '<br>C:' . $row['emp_phone'],
				$names,
				"D:" . $row['emp_position'] . '<br>R:' . $row['emp_role'],
				$row['emp_code'] . "<br>PW  : " . $row['emp_password'],
				$row['emp_status'],


				// '<a title="Restore" class="update btn btn-sm btn-primary" href="' . base_url('admin/users/restore/' . $row['id']) . '"> <i class="material-icons">restore</i></a>',
				'<a title="Restore" class="update btn btn-sm btn-primary" data-href="' . base_url('admin/users/restore/' . $row['id']) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">restore</i></a>',



			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}

	public function restore($id = 0)
	{
		$data = [
			'emp_status' => 'Active',
		];
		$this->db->where('id', $id);
		$this->db->update('jeol_employee_tbl', $data);
		redirect(base_url('admin/users/ex'));
	}
	//-----------------------------------------------------------------------
	public function add()
	{
		$data['user_groups'] = $this->user_model->get_user_groups();
		$data['reporting_employees'] = $this->user_model->reporting_employees();
		$data['designation'] = $this->user_model->designation();
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('emp_name', 'Username', 'trim|min_length[3]|required');
			// $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			// $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			// $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');
			// $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			// $this->form_validation->set_rules('password', 'Password', 'trim|required');
			// $this->form_validation->set_rules('address', 'Address', 'trim');
			// $this->form_validation->set_rules('group', 'Group', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/users/user_add';
				$this->load->view('layout', $data);
			} else {


				// Prepare employee Data Here
				$emp_data = array(
					'emp_name' => $this->input->post('emp_name'),
					'emp_email' => $this->input->post('emp_email'),
					'emp_password' => $this->input->post('emp_password'),
					'emp_code' => $this->input->post('emp_code'),
					'emp_grade' => $this->input->post('emp_grade'),
					'emp_phone' =>  $this->input->post('emp_phone'),
					'emp_address' => $this->input->post('emp_address'),
					'emp_city' => $this->input->post('emp_city'),
					'emp_country' => $this->input->post('emp_country'),
					'emp_role' => $this->input->post('emp_role'),
					'emp_position' => $this->input->post('emp_position'),
					'emp_salary' => $this->input->post('emp_salary'),
					'currency_type' => $this->input->post('currency_type'),
					'reg_date' => $this->input->post('emp_doj'),
					'emp_doj' => $this->input->post('emp_doj'),
					'emp_status' => 'Active',
					'report_to' => implode(',', $this->input->post('report_to[]'))

				);


				$insert_id = $this->user_model->add_employee($emp_data);

				$userData = array(
					'username' => $this->input->post('emp_code'),
					'firstname' => $this->input->post('emp_name'),
					'lastname' => $this->input->post('emp_name'),
					'email' => $this->input->post('emp_code'),
					'emp_id' => $insert_id,
					'password' =>  md5($this->input->post('emp_password')),
					// 'password' =>  password_hash($this->input->post('emp_password'), PASSWORD_BCRYPT),
					'address' => $this->input->post('emp_address'),
					'role' => 1,
					'is_verify' => 1,
					'is_active' => 1,
					'is_admin' => $this->input->post('group_id'),
					'token' => 'dddd',
					'password_reset_code' => 'dddd',
					'last_ip' => 'dddd',
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
					'group_id' => $this->input->post('group_id'),
					'user_status' => 1,
				);
				$result = $this->user_model->add_user($userData);

				if ($result) {
					// Add User Activity
					$this->activity_model->add(1);

					$this->session->set_flashdata('msg', 'User has been added successfully!');
					redirect(base_url('admin/users'));
				}
			}
		} else {
			$data['view'] = 'admin/users/user_add';
			$this->load->view('layout', $data);
		}
	}
	//-----------------------------------------------------------------------
	public function edit($id = 0)
	{
		$data['reporting_employees'] = $this->user_model->reporting_employees();
		$data['designation'] = $this->user_model->designation();
		$data['user'] = $this->user_model->get_user_by_id($id);
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('group_id', 'Username', 'trim|required');
			// $this->form_validation->set_rules('firstname', 'Username', 'trim|required');
			// $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			// $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			// $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			// $this->form_validation->set_rules('status', 'Status', 'trim|required');
			// $this->form_validation->set_rules('address', 'Address', 'trim');
			// $this->form_validation->set_rules('group', 'Group', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->user_model->get_user_by_id($id);
				$data['user_groups'] = $this->user_model->get_user_groups();
				$data['view'] = 'admin/users/user_edit';
				$this->load->view('layout', $data);
			} else {

				// Prepare employee Data Here
				$emp_data = array(
					'emp_name' => $this->input->post('emp_name'),
					'emp_email' => $this->input->post('emp_email'),
					'emp_password' => $this->input->post('emp_password'),
					'emp_code' => $this->input->post('emp_code'),
					'emp_grade' => $this->input->post('emp_grade'),
					'emp_phone' =>  $this->input->post('emp_phone'),
					'emp_address' => $this->input->post('emp_address'),
					'emp_city' => $this->input->post('emp_city'),
					'emp_country' => $this->input->post('emp_country'),
					'emp_role' => $this->input->post('emp_role'),
					'emp_position' => $this->input->post('emp_position'),
					'emp_salary' => $this->input->post('emp_salary'),
					'currency_type' => $this->input->post('currency_type'),
					'reg_date' => $this->input->post('emp_doj'),
					'emp_doj' => $this->input->post('emp_doj'),
					'emp_status' => 'Active',
					'report_to' => implode(',', $this->input->post('report_to[]'))

				);


				$this->db->where('id', $data['user']['emp_id']);
				$this->db->update('jeol_employee_tbl', $emp_data);
				// $insert_id = $this->user_model->add_employee($emp_data);

				$userData = array(
					'username' => $this->input->post('emp_code'),
					'firstname' => $this->input->post('emp_name'),
					'lastname' => $this->input->post('emp_name'),
					'email' => $this->input->post('emp_code'),
					'password' =>  md5($this->input->post('emp_password')),
					// 'password' =>  password_hash($this->input->post('emp_password'), PASSWORD_BCRYPT),
					'address' => $this->input->post('emp_address'),
					'role' => 1,
					'is_verify' => 1,
					'is_active' => 1,
					'is_admin' => $this->input->post('group_id'),
					'token' => 'dddd',
					'password_reset_code' => 'dddd',
					'last_ip' => 'dddd',
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
					'group_id' => $this->input->post('group_id'),
					'user_status' => 1,
				);
				$result = $this->user_model->edit_user($userData, $id);


				if ($result) {

					// Add User Activity
					$this->activity_model->add(2);

					$this->session->set_flashdata('msg', 'User has been updated successfully!');
					redirect(base_url('admin/users'));
				}
			}
		} else {
			$data['user'] = $this->user_model->get_user_by_id($id);

			// Employee data here
			$data['employee_data'] = $this->db->get_where('jeol_employee_tbl', array('id =' => $data['user']['emp_id']))->row_array();
			$data['user_groups'] = $this->user_model->get_user_groups();
			$data['view'] = 'admin/users/user_edit';
			$this->load->view('layout', $data);
		}
	}
	//-----------------------------------------------------------------------
	public function del($id = 0)
	{
		// $this->db->delete('ci_users', array('id' => $id));

		// Add User Activity
		// $this->activity_model->add(3);
		$data = [
			'emp_status' => 'Delete',
		];
		$this->db->where('id', $id);
		$this->db->update('jeol_employee_tbl', $data);

		$this->session->set_flashdata('msg', 'Use has been deleted successfully!');
		redirect(base_url('admin/users'));
	}

	public function department()
	{
		// Employee data here
		$data['department'] = $this->db->get('jeol_hr_tbl')->result_array();
		$data['view'] = 'admin/users/department';
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

			redirect(base_url('admin/users/department'));
		}
		$data['id'] = $id;
		$data['view'] = 'admin/users/add_department';
		$this->load->view('layout', $data);
	}

	public function schedular()
	{
		// Query Here
		if ($this->session->userdata('group_id') == '6') {
			$this->db->select('*');
			$this->db->from('jeol_timesheet_tbl');
			$this->db->order_by('id', 'desc');
			$query = $this->db->get();
			$data['sql_timesheet'] = $query->result_array();
		} else {

			$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
			$this->db->select('*');
			$this->db->from('jeol_employee_tbl');
			$this->db->where($con . " !=", 0);
			$query = $this->db->get();
			$data['query_get_name']  = $query->result_array();
		}

		$data['group_id'] = $this->session->userdata('group_id');
		$data['schedule'] = $this->db->get('schedule')->result_array();
		$data['view'] = 'admin/schedular/schedular';
		$this->load->view('layout', $data);
	}

	public function local_travel_log_sheet($curr_year = "2023")
	{

		if ($this->input->method() == "post") :
			$select_sheet_id = $this->input->post('sub_admin_list');
			$count = count($select_sheet_id);
			if ($this->input->post('submitbuttonname') == 'Approved') {
				$data = array(
					'status' => "Approved"
				);
				$sheet_id_new = array();
				$emp_id_new = array();
				for ($i = 0; $i < $count; $i++) {
					$new = explode('_', $select_sheet_id[$i]);
					$sheet_id_new[] = $new[0];
					$emp_id_new[] = $new[1];

					//$this->mdl_travel->update_travelsheet_log($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelexp_log_tbl', $data);

					// $this->mdl_travel->update_travel_submit_log($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelsheet_log_tbl', $data);
				}

				// $data['travels'] = $this->mdl_travel->get_all_monthEmpsubmit($this->input->post('sheet_id'), $this->input->post('emp_id'));
				// /* her using helper function*/
				// //echo $emp_id = $this->input->post('emp_id');

				// /// $emp_id = array_unique($emp_id_new);
				// $emp_count = count($emp_id_new);
				// $new_emp_id = array();
				// for ($h = 0; $h < $emp_count; $h++) {
				// 	if (!in_array($emp_id_new[$h], $new_emp_id)) {
				// 		$new_emp_id[] =  $emp_id_new[$h];
				// 	}
				// }
				// $count_new_emp_id = count($new_emp_id);
				// for ($p = 0; $p < $count_new_emp_id; $p++) {
				// 	//dump($new_emp_id);
				// 	$table = "jeol_travel_mails";
				// 	$data = jeol_reporting_mail($new_emp_id[$p], $table);
				// 	//dump($data);

				// 	/* Email Templates */
				// 	//echo "SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='".$this->input->post('emp_id')."'";
				// 	$query = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $new_emp_id[$p] . "'"));
				// 	//$query = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='".$this->input->post('emp_id')."'"));
				// 	$query_tl = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata('user_id') . "'"));
				// 	$this->email->from(ADMIN_FROM, $query_tl['emp_name']);
				// 	$this->email->to($query['emp_email']);
				// 	//$this->email->to($data[0]);
				// 	//$list = array(ADMIN_CC, ADMIN_CC_TWO);
				// 	$this->email->cc($data[1]);
				// 	$this->email->subject('Travel Log Sheet Approval Email');
				// 	$sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 60));
				// 	$mailtemp = $sql->row();
				// 	$msg1 = $mailtemp->description;

				// 	$query_sheet = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_travelsheet_log_tbl` WHERE `sheet_id`='" . $this->input->post('sheet_id') . "'"));

				// 	$messagebody = str_replace("Placeholder1", $query['emp_name'], $msg1);
				// 	$messagebody1 = str_replace("Placeholder2", $query_tl['emp_name'], $messagebody);
				// 	$messagebody2 = str_replace("Placeholder3", $query_sheet['start_date'], $messagebody1);
				// 	$messagebody3 = str_replace("Placeholder4", $query_sheet['end_date'], $messagebody2);
				// 	//$messagebody3=str_replace("Placeholder4",$query['emp_name'],$messagebody2);
				// 	$this->email->message($messagebody3);


				// 	$this->email->send();
				// }
			} else {
				$data = array(
					'status' => "Rejected"
				);
				$sheet_id_new = array();
				$emp_id_new = array();
				for ($i = 0; $i < $count; $i++) {
					$new = explode('_', $select_sheet_id[$i]);
					$sheet_id_new[] = $new[0];
					$emp_id_new[] = $new[1];

					//$this->mdl_travel->update_travelsheet_log($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelexp_log_tbl', $data);

					// $this->mdl_travel->update_travel_submit_log($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelsheet_log_tbl', $data);
				}
				// $data['travels'] = $this->mdl_travel->get_all_monthEmpsubmit($this->input->post('sheet_id'), $this->input->post('emp_id'));
				// $data['main_content'] = 'travel_management_subadmin_log';
				// $this->load->view('includes/page_template', $data);

				// //$emp_id = $this->input->post('emp_id');
				// $emp_count = count($emp_id_new);
				// $new_emp_id = array();
				// for ($h = 0; $h < $emp_count; $h++) {
				// 	if (!in_array($emp_id_new[$h], $new_emp_id)) {
				// 		$new_emp_id[] =  $emp_id_new[$h];
				// 	}
				// }
				// $count_new_emp_id = count($new_emp_id);
				// for ($p = 0; $p < $count_new_emp_id; $p++) {

				// 	$table = "jeol_travel_mails";
				// 	$data = jeol_reporting_mail($new_emp_id[$p], $table);
				// 	/* Email Templates */
				// 	//$query = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='".$this->input->post('emp_id')."'"));
				// 	$query = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $new_emp_id[$p] . "'"));
				// 	$query_tl = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata('user_id') . "'"));
				// 	$this->email->from(ADMIN_FROM, $query_tl['emp_name']);
				// 	//$this->email->to($query['emp_email']);
				// 	$this->email->to($query['emp_email']);
				// 	//$list = array(ADMIN_CC, ADMIN_CC_TWO);
				// 	//$this->email->cc($data[1]); 
				// 	$this->email->subject('Travel Log Sheet Rejection Email');
				// 	$sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 70));
				// 	$mailtemp = $sql->row();
				// 	$msg1 = $mailtemp->description;

				// 	$query_sheet = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_travelsheet_log_tbl` WHERE `sheet_id`='" . $this->input->post('sheet_id') . "'"));

				// 	$messagebody = str_replace("Placeholder1", $query['emp_name'], $msg1);
				// 	$messagebody1 = str_replace("Placeholder2", $query_tl['emp_name'], $messagebody);
				// 	$messagebody2 = str_replace("Placeholder3", $query_sheet['start_date'], $messagebody1);
				// 	$messagebody3 = str_replace("Placeholder4", $query_sheet['end_date'], $messagebody2);
				// 	//$messagebody3=str_replace("Placeholder4",$query['emp_name'],$messagebody2);
				// 	$this->email->message($messagebody3);


				// 	$this->email->send();
				// }
			}
		endif;
		if ($this->session->userdata('group_id') == '6') {
			$sql = "SELECT travel.sheet_id,emp.emp_name,travel.start_date,travel.claim_date,travel.end_date,travel.status,travel.emp_status,travel.end_time_type,travel.ttl_duration,travel.start_time_type,travel.start_time,travel.end_time,travel.member_id  FROM `jeol_travelsheet_log_tbl` as travel join jeol_employee_tbl as emp on travel.member_id=emp.id WHERE  travel.status!='Not Submitted' and year(travel.claim_date) = '$curr_year' order by travel.claim_date desc";

			$data['emp_data'] = $this->db->query($sql)->result_array();
		} else {
			$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
			$table = 'jeol_employee_tbl';
			$this->db->select('*');
			$this->db->where($con . " !=", 0);
			$data['sql_report_person'] = $this->db->get($table)->result_array();
		}


		$data['year'] = $curr_year;
		$data['view'] = 'admin/schedular/local_travel_log_sheet';
		$this->load->view('layout', $data);
	}

	public function local_claim($curr_year = "2023")
	{


		if ($this->input->method() == "post") :
			$select_sheet_id = $this->input->post('sub_admin_list');
			$count = count($select_sheet_id);
			if ($this->input->post('submitbuttonname') == 'Approved') {
				$data = array(
					'status' => "Approved"
				);
				$sheet_id_new = array();
				$emp_id_new = array();
				for ($i = 0; $i < $count; $i++) {
					$new = explode('_', $select_sheet_id[$i]);
					$sheet_id_new[] = $new[0];
					$emp_id_new[] = $new[1];

					// $this->mdl_travel->update_travelsheet_claim($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelclainexp_tbl', $data);

					// $this->mdl_travel->update_travel_submit_claim($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelclaimsheet_tbl', $data);
				}

				// $data['travels'] = $this->mdl_travel->get_all_monthEmpsubmitclaim($this->input->post('sheet_id'), $this->input->post('emp_id'));

				// /* Email Templates */
				// $emp_count = count($emp_id_new);
				// $new_emp_id = array();
				// for ($h = 0; $h < $emp_count; $h++) {
				// 	if (!in_array($emp_id_new[$h], $new_emp_id)) {
				// 		$new_emp_id[] =  $emp_id_new[$h];
				// 	}
				// }
				// $claim_emp_id = count($new_emp_id);
				// for ($p = 0; $p < $claim_emp_id; $p++) {
				// 	$table = "jeol_travel_mails";
				// 	$data = jeol_reporting_mail($new_emp_id[$p], $table);
				// 	//dump($data);
				// 	$query = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $new_emp_id[$p] . "'"));
				// 	$query_tl = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata('user_id') . "'"));
				// 	$this->email->from(ADMIN_FROM, $query_tl['emp_name']);
				// 	$this->email->to($query['emp_email']);
				// 	//$this->email->to($data[0]);
				// 	//$list = array(ADMIN_CC, ADMIN_CC_TWO);
				// 	$this->email->cc($data[1]);
				// 	$this->email->subject('Local Claim Approval Email');
				// 	$sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 1848));
				// 	$mailtemp = $sql->row();
				// 	$msg1 = $mailtemp->description;

				// 	$query_sheet = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_travelclaimsheet_tbl` WHERE `sheet_id`='" . $this->input->post('sheet_id') . "'"));

				// 	$messagebody = str_replace("Placeholder1", $query['emp_name'], $msg1);
				// 	$messagebody1 = str_replace("Placeholder2", $query_tl['emp_name'], $messagebody);
				// 	$messagebody2 = str_replace("Placeholder3", $query_sheet['ttl_duration'], $messagebody1);

				// 	//$messagebody3=str_replace("Placeholder4",$query['emp_name'],$messagebody2);
				// 	$this->email->message($messagebody2);


				// 	$this->email->send();
				// }
			} else {
				$data = array(
					'status' => "Rejected"
				);
				$sheet_id_new = array();
				$emp_id_new = array();
				for ($i = 0; $i < $count; $i++) {
					$new = explode('_', $select_sheet_id[$i]);
					$sheet_id_new[] = $new[0];
					$emp_id_new[] = $new[1];

					// $this->mdl_travel->update_travelsheet_claim($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelclainexp_tbl', $data);

					// $this->mdl_travel->update_travel_submit_claim($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelclaimsheet_tbl', $data);
				}
				// $data['travels'] = $this->mdl_travel->get_all_monthEmpsubmitclaim($this->input->post('sheet_id'), $this->input->post('emp_name'));
				// $data['main_content'] = 'travel_management_subadminsearch_claim';
				// $this->load->view('includes/page_template', $data);

				// $query = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $new_emp_id[$p] . "'"));
				// $query_tl = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata('user_id') . "'"));
				// $this->email->from(ADMIN_FROM, $query_tl['emp_name']);
				// $this->email->to($query['emp_email']);
				// //$this->email->to($data[0]);
				// //$list = array(ADMIN_CC, ADMIN_CC_TWO);
				// //$this->email->cc($data[1]);
				// $this->email->subject('Local Claim Sheet Rejection Email');
				// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 20120));
				// $mailtemp = $sql->row();
				// $msg1 = $mailtemp->description;

				// $query_sheet = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_travelclaimsheet_tbl` WHERE `sheet_id`='" . $this->input->post('sheet_id') . "'"));

				// $messagebody = str_replace("Placeholder1", $query['emp_name'], $msg1);
				// $messagebody1 = str_replace("Placeholder2", $query_tl['emp_name'], $messagebody);
				// $messagebody2 = str_replace("Placeholder3", $query_sheet['ttl_duration'], $messagebody1);
				// //$messagebody3=str_replace("Placeholder4",$query['emp_name'],$messagebody2);
				// $this->email->message($messagebody2);


				// $this->email->send();

			}
		endif;
		if ($this->session->userdata('group_id') == '6') {

			$sql = "SELECT travel.sheet_id,emp.emp_name,travel.start_date,travel.end_date,travel.ttl_duration,travel.status,travel.member_id  FROM `jeol_travelclaimsheet_tbl` as travel join jeol_employee_tbl as emp on travel.member_id=emp.id WHERE  travel.status!='Not Submitted' and year(travel.claim_date) = '$curr_year' order by  travel.ttl_duration asc";
			$data['emp_data'] = $this->db->query($sql)->result_array();
		} else {
			$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
			$this->db->select('*');
			$this->db->from('jeol_employee_tbl');
			$this->db->where($con . " !=", 0);
			$query = $this->db->get();
			$data['sql_report_person'] = $query->result_array();
		}



		$data['year'] = $curr_year;
		$data['view'] = 'admin/schedular/local_claim';
		$this->load->view('layout', $data);
	}

	public function domestic_travel_claim($curr_year = "2023")
	{

		if ($this->input->method() == "post") :
			$select_sheet_id = $this->input->post('sub_admin_list');
			$count = count($select_sheet_id);
			if ($this->input->post('submitbuttonname') == 'Approved') {
				$data = array(
					'status' => "Approved"
				);
				$sheet_id_new = array();
				$emp_id_new = array();
				for ($i = 0; $i < $count; $i++) {
					$new = explode('_', $select_sheet_id[$i]);
					$sheet_id_new[] = $new[0];
					$emp_id_new[] = $new[1];

					// $this->mdl_travel->update_travelsheet($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelexp_tbl', $data);

					// $this->mdl_travel->update_travel_submit($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelsheet_tbl', $data);
				}

				// $data['travels'] = $this->mdl_travel->get_all_monthEmpsubmit($this->input->post('sheet_id'), $this->input->post('emp_id'));
				// $this->db->where('sheet_id', $this->input->post('sheet_id'));
				// $this->db->where('member_id', $this->input->post('emp_id'));
				// $this->db->where('Status !=', 'NOT SUBMITTED');
				// $query = $this->db->get('jeol_travelexp_tbl');
				// $data['travels'] = $query->result_array();

				// $emp_count = count($emp_id_new);
				// $new_emp_id = array();
				// for ($h = 0; $h < $emp_count; $h++) {
				// 	if (!in_array($emp_id_new[$h], $new_emp_id)) {
				// 		$new_emp_id[] = $emp_id_new[$h];
				// 	}
				// }
				// $count_new_emp_id = count($new_emp_id);
				// for ($p = 0; $p < $count_new_emp_id; $p++) {
				// $query = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $new_emp_id[$p] . "'"));
				// $query_tl = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata('user_id') . "'"));
				// $this->email->from(ADMIN_FROM, $query_tl['emp_name']);
				// $this->email->to($query['emp_email']);
				//$this->email->to($data[0]);
				//$list = array(ADMIN_CC, ADMIN_CC_TWO);
				// $this->email->cc($data[1]);
				// $this->email->subject('Domestic Travel Claim Sheet Approval Email');
				// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 1));
				// $mailtemp = $sql->row();
				// $msg1 = $mailtemp->description;

				// $query_sheet = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_travelsheet_tbl` WHERE `sheet_id`='" . $this->input->post('sheet_id') . "'"));

				// $messagebody = str_replace("Placeholder1", $query['emp_name'], $msg1);
				// $messagebody1 = str_replace("Placeholder2", $query_tl['emp_name'], $messagebody);
				// $messagebody2 = str_replace("Placeholder3", $query_sheet['start_date'], $messagebody1);
				// $messagebody3 = str_replace("Placeholder4", $query_sheet['end_date'], $messagebody2);
				// $this->email->message($messagebody3);


				// $this->email->send();
				// }
			} else {
				$data = array(
					'status' => "Rejected"
				);
				$sheet_id_new = array();
				$emp_id_new = array();
				for ($i = 0; $i < $count; $i++) {
					$new = explode('_', $select_sheet_id[$i]);
					$sheet_id_new[] = $new[0];
					$emp_id_new[] = $new[1];
					// $this->mdl_travel->update_travelsheet($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelexp_tbl', $data);


					// $this->mdl_travel->update_travel_submit($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelsheet_tbl', $data);
				}
				// $data['travels'] = $this->mdl_travel->get_all_monthEmpsubmit($this->input->post('sheet_id'), $this->input->post('emp_id'));
				// $emp_count = count($emp_id_new);
				// $new_emp_id = array();
				// for ($h = 0; $h < $emp_count; $h++) {
				// 	if (!in_array($emp_id_new[$h], $new_emp_id)) {
				// 		$new_emp_id[] = $emp_id_new[$h];
				// 	}
				// }

				// $count_new_emp_id = count($new_emp_id);
				// for ($p = 0; $p < $count_new_emp_id; $p++) {
				// $table = "jeol_travel_mails";
				// $data = jeol_reporting_mail($new_emp_id[$p], $table); /* Email Templates */ //$query=mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='".$this->input->post(' emp_id')."'")); $query=mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='".$new_emp_id[$p]."'"));
				// $query_tl = mysql_fetch_array(mysql_query(" SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata(' user_id') . "'"));
				// $this->email->from(ADMIN_FROM, $query_tl['emp_name']);
				// //$this->email->to($query['emp_email']);
				// $this->email->to($query['emp_email']);
				// //$list = array(ADMIN_CC, ADMIN_CC_TWO);
				// //$this->email->cc($data[1]);
				// $this->email->subject('Domestic Travel Claim Sheet Rejection Email');
				// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 2));
				// $mailtemp = $sql->row();
				// $msg1 = $mailtemp->description;

				// $query_sheet = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_travelsheet_tbl` WHERE `sheet_id`='" . $this->input->post('sheet_id') . "'"));

				// $messagebody = str_replace("Placeholder1", $query['emp_name'], $msg1);
				// $messagebody1 = str_replace("Placeholder2", $query_tl['emp_name'], $messagebody);
				// $messagebody2 = str_replace("Placeholder3", $query_sheet['start_date'], $messagebody1);
				// $messagebody3 = str_replace("Placeholder4", $query_sheet['end_date'], $messagebody2);
				// //$messagebody3=str_replace("Placeholder4",$query['emp_name'],$messagebody2);
				// $this->email->message($messagebody3);


				// $this->email->send();
				// }
			}
		endif;

		if ($this->session->userdata('group_id') == '6') {
			$sql = "SELECT travel.sheet_id,emp.emp_name,travel.start_date,travel.end_date,travel.status,travel.emp_status,travel.end_time_type,travel.start_time_type,travel.start_time,travel.end_time,travel.member_id  FROM `jeol_travelsheet_tbl` as travel join jeol_employee_tbl as emp on travel.member_id=emp.id WHERE  travel.status!='Not Submitted' and travel.sheet_type='0' and year(travel.claim_date) = '$curr_year' order by travel.status desc";

			$data['emp_data'] = $this->db->query($sql)->result_array();
		} else {
			$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
			$this->db->select('*');
			$this->db->from('jeol_employee_tbl');
			$this->db->where($con . " !=", 0);
			$data['sql_report_person'] = $this->db->get()->result_array();
		}


		$data['year'] = $curr_year;
		$data['view'] = 'admin/schedular/domestic_travel_claim';
		$this->load->view('layout', $data);
	}

	public function overseas_travel_claim($curr_year = "2023")
	{
		if ($this->input->method() == "post") :
			$select_sheet_id = $this->input->post('sub_admin_list');
			$count = count($select_sheet_id);
			if ($this->input->post('submitbuttonname') == 'Approved') {
				$data = array(
					'status' => "Approved"
				);
				$sheet_id_new = array();
				$emp_id_new = array();
				for ($i = 0; $i < $count; $i++) {
					$new = explode('_', $select_sheet_id[$i]);
					$sheet_id_new[] = $new[0];
					$emp_id_new[] = $new[1];

					// $this->mdl_travel->update_travelsheet($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelexp_tbl', $data);

					// $this->mdl_travel->update_travel_submit($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelsheet_tbl', $data);
				}

				// $data['travels'] = $this->mdl_travel->get_all_monthEmpsubmit($this->input->post('sheet_id'), $this->input->post('emp_id'));
				// $this->db->where('sheet_id', $this->input->post('sheet_id'));
				// $this->db->where('member_id', $this->input->post('emp_id'));
				// $this->db->where('Status !=', 'NOT SUBMITTED');
				// $query = $this->db->get('jeol_travelexp_tbl');
				// $data['travels'] = $query->result_array();

				// $emp_count = count($emp_id_new);
				// $new_emp_id = array();
				// for ($h = 0; $h < $emp_count; $h++) {
				// 	if (!in_array($emp_id_new[$h], $new_emp_id)) {
				// 		$new_emp_id[] = $emp_id_new[$h];
				// 	}
				// }
				// $count_new_emp_id = count($new_emp_id);
				// for ($p = 0; $p < $count_new_emp_id; $p++) {
				// $query = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $new_emp_id[$p] . "'"));
				// $query_tl = mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata('user_id') . "'"));
				// $this->email->from(ADMIN_FROM, $query_tl['emp_name']);
				// $this->email->to($query['emp_email']);
				//$this->email->to($data[0]);
				//$list = array(ADMIN_CC, ADMIN_CC_TWO);
				// $this->email->cc($data[1]);
				// $this->email->subject('Domestic Travel Claim Sheet Approval Email');
				// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 1));
				// $mailtemp = $sql->row();
				// $msg1 = $mailtemp->description;

				// $query_sheet = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_travelsheet_tbl` WHERE `sheet_id`='" . $this->input->post('sheet_id') . "'"));

				// $messagebody = str_replace("Placeholder1", $query['emp_name'], $msg1);
				// $messagebody1 = str_replace("Placeholder2", $query_tl['emp_name'], $messagebody);
				// $messagebody2 = str_replace("Placeholder3", $query_sheet['start_date'], $messagebody1);
				// $messagebody3 = str_replace("Placeholder4", $query_sheet['end_date'], $messagebody2);
				// $this->email->message($messagebody3);


				// $this->email->send();
				// }
			} else {
				$data = array(
					'status' => "Rejected"
				);
				$sheet_id_new = array();
				$emp_id_new = array();
				for ($i = 0; $i < $count; $i++) {
					$new = explode('_', $select_sheet_id[$i]);
					$sheet_id_new[] = $new[0];
					$emp_id_new[] = $new[1];
					// $this->mdl_travel->update_travelsheet($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelexp_tbl', $data);


					// $this->mdl_travel->update_travel_submit($sheet_id_new[$i], $data);
					$this->db->where('sheet_id', $sheet_id_new[$i]);
					$this->db->update('jeol_travelsheet_tbl', $data);
				}
				// $data['travels'] = $this->mdl_travel->get_all_monthEmpsubmit($this->input->post('sheet_id'), $this->input->post('emp_id'));
				// $emp_count = count($emp_id_new);
				// $new_emp_id = array();
				// for ($h = 0; $h < $emp_count; $h++) {
				// 	if (!in_array($emp_id_new[$h], $new_emp_id)) {
				// 		$new_emp_id[] = $emp_id_new[$h];
				// 	}
				// }

				// $count_new_emp_id = count($new_emp_id);
				// for ($p = 0; $p < $count_new_emp_id; $p++) {
				// $table = "jeol_travel_mails";
				// $data = jeol_reporting_mail($new_emp_id[$p], $table); /* Email Templates */ //$query=mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='".$this->input->post(' emp_id')."'")); $query=mysql_fetch_array(mysql_query("SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='".$new_emp_id[$p]."'"));
				// $query_tl = mysql_fetch_array(mysql_query(" SELECT emp_name,emp_email FROM `jeol_employee_tbl` WHERE id='" . $this->session->userdata(' user_id') . "'"));
				// $this->email->from(ADMIN_FROM, $query_tl['emp_name']);
				// //$this->email->to($query['emp_email']);
				// $this->email->to($query['emp_email']);
				// //$list = array(ADMIN_CC, ADMIN_CC_TWO);
				// //$this->email->cc($data[1]);
				// $this->email->subject('Domestic Travel Claim Sheet Rejection Email');
				// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 2));
				// $mailtemp = $sql->row();
				// $msg1 = $mailtemp->description;

				// $query_sheet = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_travelsheet_tbl` WHERE `sheet_id`='" . $this->input->post('sheet_id') . "'"));

				// $messagebody = str_replace("Placeholder1", $query['emp_name'], $msg1);
				// $messagebody1 = str_replace("Placeholder2", $query_tl['emp_name'], $messagebody);
				// $messagebody2 = str_replace("Placeholder3", $query_sheet['start_date'], $messagebody1);
				// $messagebody3 = str_replace("Placeholder4", $query_sheet['end_date'], $messagebody2);
				// //$messagebody3=str_replace("Placeholder4",$query['emp_name'],$messagebody2);
				// $this->email->message($messagebody3);


				// $this->email->send();
				// }
			}
		endif;

		if ($this->session->userdata('group_id') == '6') {
			$sql = "SELECT travel.sheet_id,emp.emp_name,travel.start_date,travel.end_date,travel.status,travel.member_id  FROM `jeol_travelsheet_tbl` as travel join jeol_employee_tbl as emp on travel.member_id=emp.id WHERE  travel.status!='Not Submitted' and travel.sheet_type='1' and year(travel.claim_date) = '$curr_year' ";

			$data['emp_data'] = $this->db->query($sql)->result_array();
		} else {
			$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
			$this->db->select('*');
			$this->db->from('jeol_employee_tbl');
			$this->db->where($con . " !=", 0);
			$data['sql_report_person'] = $this->db->get()->result_array();
		}


		$data['year'] = $curr_year;
		$data['view'] = 'admin/schedular/overseas_travel_claim';
		$this->load->view('layout', $data);
	}

	public function my_overseas_travel_claim()
	{
		$emp_id = $this->session->userdata('user_id');
		$this->db->select('travel.sheet_id, emp.emp_name, travel.start_date, travel.claim_date, travel.end_time_type, travel.start_time_type, travel.start_time, travel.end_time, travel.end_date, travel.status, travel.member_id');
		$this->db->from('jeol_travelsheet_tbl AS travel');
		$this->db->join('jeol_employee_tbl AS emp', 'travel.member_id=emp.id');
		$this->db->where('travel.member_id', $emp_id);
		$this->db->where('travel.sheet_type', '1');
		$data['sql_mon_filter'] = $this->db->get()->result_array();


		$data['view'] = 'admin/schedular/my_overseas_travel_claim';
		$this->load->view('layout', $data);
	}

	public function add_my_overseas_travel_claim()
	{
		if ($this->input->post('submit')) {

			// Upload Document Here
			$path = 'uploads';
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv|pdf|png|jpg';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('upload_file')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$additional_documents = array('upload_data' => $this->upload->data());
			}

			$data = array(
				'start_date' => date("Y-m-d h:i", strtotime($this->input->post('start_date'))),
				'end_date' => date("Y-m-d h:i", strtotime($this->input->post('end_date'))),
				'member_id' => $this->session->userdata('user_id'),
				'company_id' => 1,
				'purpose' => $this->input->post('purpose'),
				'services_report' => $this->input->post('services_report'),
				'claim_date' => date("Y-m-d", strtotime($this->input->post('claim_date'))),
				'ttl_duration' => $this->input->post('ttl_duration'),
				'country' => $this->input->post('country'),
				'status' => 'Not Submitted',
				'start_time_type' => $this->input->post('start_time_type'),
				'upload_file' => $additional_documents['upload_data']['file_name'],
				'end_time_type' => $this->input->post('end_time_type'),
				'end_time' => $this->input->post('end_time'),
				'start_time' => $this->input->post('start_time'),
				'sheet_type' => 1
			);
			$this->db->insert('jeol_travelsheet_tbl', $data);
			$insert_id = $this->db->insert_id();

			// Save Additional Data
			$Description_array = $this->input->post('Description');
			for ($i = 0; $i < sizeof($Description_array); $i++) {

				$travel_date_final = $this->input->post('travel_date')[$i];
				$Amount_final = $this->input->post('Amount')[$i];
				$Description_final = $this->input->post('Description')[$i];
				$acc_code_final = $this->input->post('acc_code')[$i];
				$paymnet_by_final = $this->input->post('paymnet_by')[$i];
				$reference = $this->input->post('reference')[$i];
				$Company_final = $this->input->post('Company')[$i];
				$Model_no_final = $this->input->post('model_no')[$i];


				if (!empty($Description_final)) :
					// Uploasd Image here
					$_FILES['docs[]']['name']     = $_FILES['docs']['name'][$i];
					$_FILES['docs[]']['type']     = $_FILES['docs']['type'][$i];
					$_FILES['docs[]']['tmp_name'] = $_FILES['docs']['tmp_name'][$i];
					$_FILES['docs[]']['error']     = $_FILES['docs']['error'][$i];
					$_FILES['docs[]']['size']     = $_FILES['docs']['size'][$i];


					$path = 'uploads';
					$config['upload_path'] = $path;
					$config['allowed_types'] = 'xlsx|xls|csv|pdf|png|jpg';
					$config['remove_spaces'] = TRUE;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('docs[]')) {
						$error = array('error' => $this->upload->display_errors());
					} else {
						$doc_data = $this->upload->data();
					}

					$data = array(
						'travel_date' => date("Y-m-d", strtotime($travel_date_final)),
						'Amount' => $Amount_final,
						'Description' => $Description_final,
						'acc_code' => $acc_code_final,
						'paymnet_by' => $paymnet_by_final,
						'reference' => $reference,
						'sheet_id' => $insert_id,
						'member_id' => $this->session->userdata('user_id'),
						'Company' => $Company_final,
						'model_no' => $Model_no_final,
						'reg_date' => date("Y-m-d H:i:s"),
						'ref_doc' => $doc_data['file_name'],
						'Status' => 'Not Submitted',
						'sheet_type' => 1
					);
					$this->db->insert('jeol_travelexp_tbl', $data);
				endif;
			}
			redirect(base_url('admin/users/my_domestic_travel_claim'));
		}
		$data['customers'] = $this->db->get('customer')->result_array();
		$data['view'] = 'admin/schedular/add_my_overseas_travel_claim';
		$this->load->view('layout', $data);
	}


	public function my_domestic_travel_claim()
	{
		$emp_id = $this->session->userdata('user_id');
		$this->db->select('travel.sheet_id, emp.emp_name, travel.start_date, travel.claim_date, travel.end_time_type, travel.start_time_type, travel.start_time, travel.end_time, travel.end_date, travel.status, travel.member_id');
		$this->db->from('jeol_travelsheet_tbl AS travel');
		$this->db->join('jeol_employee_tbl AS emp', 'travel.member_id=emp.id');
		$this->db->where('travel.member_id', $emp_id);
		$this->db->where('travel.sheet_type', '0');
		$data['sql_mon_filter'] = $this->db->get()->result_array();


		$data['view'] = 'admin/schedular/my_domestic_travel_claim';
		$this->load->view('layout', $data);
	}


	public function view_domestic_travel_claim($id)
	{

		// $data['customers'] = $this->db->get('customer')->result_array();

		$data['view_data'] = $this->db->get_where('jeol_travelsheet_tbl', array('sheet_id =' => $id))->row_array();

		$data['view_amount_data'] = $this->db->get_where('jeol_travelexp_tbl', array('sheet_id =' => $data['view_data']['sheet_id']))->result_array();

		$data['customers'] = $this->db->get('customer')->result_array();

		$data['view'] = 'admin/schedular/view_my_domestic_travel_claim';
		$this->load->view('layout', $data);
	}

	public function add_my_domestic_travel_claim()
	{
		if ($this->input->post('submit')) {

			// Upload Document Here
			$path = 'uploads';
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv|pdf|png|jpg';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('upload_file')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$additional_documents = array('upload_data' => $this->upload->data());
			}

			$data = array(
				'start_date' => date("Y-m-d h:i", strtotime($this->input->post('start_date'))),
				'end_date' => date("Y-m-d h:i", strtotime($this->input->post('end_date'))),
				'member_id' => $this->session->userdata('user_id'),
				'company_id' => 1,
				'purpose' => $this->input->post('purpose'),
				'services_report' => $this->input->post('services_report'),
				'claim_date' => date("Y-m-d", strtotime($this->input->post('claim_date'))),
				'ttl_duration' => $this->input->post('ttl_duration'),
				'country' => $this->input->post('country'),
				'status' => 'Not Submitted',
				'start_time_type' => $this->input->post('start_time_type'),
				'upload_file' => $additional_documents['upload_data']['file_name'],
				'end_time_type' => $this->input->post('end_time_type'),
				'end_time' => $this->input->post('end_time'),
				'start_time' => $this->input->post('start_time')
			);
			$this->db->insert('jeol_travelsheet_tbl', $data);
			$insert_id = $this->db->insert_id();

			// Save Additional Data
			$Description_array = $this->input->post('Description');
			for ($i = 0; $i < sizeof($Description_array); $i++) {

				$travel_date_final = $this->input->post('travel_date')[$i];
				$Amount_final = $this->input->post('Amount')[$i];
				$Description_final = $this->input->post('Description')[$i];
				$acc_code_final = $this->input->post('acc_code')[$i];
				$paymnet_by_final = $this->input->post('paymnet_by')[$i];
				$reference = $this->input->post('reference')[$i];
				$Company_final = $this->input->post('Company')[$i];
				$Model_no_final = $this->input->post('model_no')[$i];


				if (!empty($Description_final)) :
					// Uploasd Image here
					$_FILES['docs[]']['name']     = $_FILES['docs']['name'][$i];
					$_FILES['docs[]']['type']     = $_FILES['docs']['type'][$i];
					$_FILES['docs[]']['tmp_name'] = $_FILES['docs']['tmp_name'][$i];
					$_FILES['docs[]']['error']     = $_FILES['docs']['error'][$i];
					$_FILES['docs[]']['size']     = $_FILES['docs']['size'][$i];


					$path = 'uploads';
					$config['upload_path'] = $path;
					$config['allowed_types'] = 'xlsx|xls|csv|pdf|png|jpg';
					$config['remove_spaces'] = TRUE;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('docs[]')) {
						$error = array('error' => $this->upload->display_errors());
					} else {
						$doc_data = $this->upload->data();
					}

					$data = array(
						'travel_date' => date("Y-m-d", strtotime($travel_date_final)),
						'Amount' => $Amount_final,
						'Description' => $Description_final,
						'acc_code' => $acc_code_final,
						'paymnet_by' => $paymnet_by_final,
						'reference' => $reference,
						'sheet_id' => $insert_id,
						'member_id' => $this->session->userdata('user_id'),
						'Company' => $Company_final,
						'model_no' => $Model_no_final,
						'reg_date' => date("Y-m-d H:i:s"),
						'ref_doc' => $doc_data['file_name'],
						'Status' => 'Not Submitted'
					);
					$this->db->insert('jeol_travelexp_tbl', $data);
				endif;
			}
			redirect(base_url('admin/users/my_domestic_travel_claim'));
		}
		$data['customers'] = $this->db->get('customer')->result_array();
		$data['view'] = 'admin/schedular/add_my_domestic_travel_claim';
		$this->load->view('layout', $data);
	}

	public function my_schedule()
	{
		// $data['schedule'] = $this->db->get('jeol_timesheet_tbl')->result_array();
		$user_id = $this->session->userdata['user_id'];
		$data['schedule'] = $this->db->get_where('jeol_timesheet_tbl', array('emp_id =' => $user_id))->result_array();

		$data['view'] = 'admin/schedule/index';
		$this->load->view('layout', $data);
	}
	public function del_schedule($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('schedule');
			redirect(base_url('admin/users/my_schedule'));
		}
	}

	public function add_schedule($id = 0)
	{
		if ($id != 0) {
			$data['schedule'] = $this->db->get_where('jeol_timesheet_tbl', array('id =' => $id))->row_array();
			$data['department'] = $this->db->get_where('customer_department', array('id =' => $data['schedule']['department']))->result_array();
			$data['project'] = $this->db->get_where('reports', array('id =' => $data['schedule']['project']))->result_array();
		}
		if ($this->input->post('submit')) {

			// Upload Document Here
			$path = 'uploads';
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv|pdf|png|jpg';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('document')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$additional_documents = array('upload_data' => $this->upload->data());
			}


			// 
			$emp_id = $this->session->userdata('user_id');
			$start_final = date('Y-m-d', strtotime($this->input->post('s_date')));
			$final_date = date('Y-m-d', strtotime($this->input->post('final_date')));
			$ins_date = date('Y-m-d', strtotime($this->input->post('ins_start')));
			$insend_date = date('Y-m-d', strtotime($this->input->post('ins_end')));
			$data = array(
				'date' => $start_final,
				'company' => $this->input->post('company'),
				'description' => $this->input->post('description'),
				'company_services' => $this->input->post('company_services'),
				'meeting_time' => $this->input->post('meeting_time'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'final_date' => $final_date,
				'ins_start' => $ins_date,
				'ins_end' => $insend_date,
				'project_code' => $this->input->post('project_code'),
				'visit' => $this->input->post('visit'),
				'start_date_ampm' => $this->input->post('start_date_ampm'),
				'end_date_ampm' => $this->input->post('end_date_ampm'),
				'Feedback' => $this->input->post('Feedback'),
				'add_date' => date('Y-m-d'),
				'upload' => $additional_documents['upload_data']['file_name'],
				'status' => 'Not Submitted',
				'emp_id' => $emp_id

			);


			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_timesheet_tbl', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_timesheet_tbl', $data);
			}

			redirect(base_url('admin/users/my_schedule'));
		}
		$data['customer_data'] = $this->db->get('customer')->result_array();
		$data['id'] = $id;
		$data['view'] = 'admin/schedule/add_schedule';
		$this->load->view('layout', $data);
	}

	public function ajax_data()
	{
		$cust_id =  $this->input->get('cust_id');
		$cust_dept =  $this->input->get('cust_dept');
		$company_id =  $this->input->get('company_id');
		if (!empty($cust_dept)) {

			$departments = $this->db->get_where('reports', array('cust_depart =' => $cust_dept, 'cust_id' => $company_id))->result_array();

			if (!empty($departments)) {
				foreach ($departments as $key => $value) {
					$result[] = array(
						'id' => $value['id'],
						'name' => $value['instrument']
					);
				}
			}
			echo json_encode($result);
		} else {

			$departments = $this->db->get_where('customer_department', array('cust_id =' => $cust_id))->result_array();
			if (!empty($departments)) {
				foreach ($departments as $key => $value) {
					$result[] = array(
						'id' => $value['id'],
						'name' => $value['cust_depart']
					);
				}
			}
			echo json_encode($result);
		}
	}

	public function upload_docs($customer_id)
	{

		if ($customer_id != 0) {
			// Upload Files Here
			if ($this->input->post('submit')) {

				// Upload Document Here
				// print_r($_FILES); die;

				$count = count($_FILES['docs']['name']);
				// // echo $count; die;
				for ($i = 0; $i < $count; $i++) {

					$_FILES['docs[]']['name']     = $_FILES['docs']['name'][$i];
					$_FILES['docs[]']['type']     = $_FILES['docs']['type'][$i];
					$_FILES['docs[]']['tmp_name'] = $_FILES['docs']['tmp_name'][$i];
					$_FILES['docs[]']['error']     = $_FILES['docs']['error'][$i];
					$_FILES['docs[]']['size']     = $_FILES['docs']['size'][$i];


					$path = 'uploads';
					$config['upload_path'] = $path;
					$config['allowed_types'] = 'xlsx|xls|csv|pdf|png|jpg';
					$config['remove_spaces'] = TRUE;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('docs[]')) {
						$error = array('error' => $this->upload->display_errors());
					} else {
						$doc_data = $this->upload->data();
					}
					// print_r($doc_data);
					$data = array(
						'customer_id' => $customer_id,
						'file_name' => $doc_data['file_name']
					);
					$this->db->insert('customer_docs', $data);
				}

				// Mail Here to all admins
				$adminsMails = $this->db->get_where('ci_users', array('group_id =' => 6))->result_array();

				foreach ($adminsMails as $key => $value) {

					$to = $this->db->get_where('jeol_employee_tbl', array('emp_code =' => $value['email']))->row()->emp_email;
					// $to = "";

					$this->email->to($to);
					// $this->email->cc($data[1]);
					$this->email->subject('New Order Received');
					// $sql = $this->db->get_where('jeol_template_tbl', array('add_date' => 205));
					// $mailtemp = $sql->row();
					// $msg1 = $mailtemp->description;

					// $messagebody = str_replace("{employee_name}", $sql_reporting_person['emp_name'], $msg1);
					$messagebody = "PO Has Been Uploaded By " . $value['firstname'] . '  ' . $value['lastname'];
					$this->email->message($messagebody);
					$this->email->send();
				}
				redirect(base_url('admin/customer/emp_customers'));
			}
		}

		$data['id'] = $customer_id;
		$data['view'] = 'admin/schedule/add_media';
		$this->load->view('layout', $data);
	}
}
