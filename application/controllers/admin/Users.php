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
}
