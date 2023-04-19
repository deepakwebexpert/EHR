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
			// print_r($ids); die;
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


				'<a title="Restore" class="update btn btn-sm btn-primary" href="' . base_url('admin/users/restore/' . $row['id']) . '"> <i class="material-icons">restore</i></a>',

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
					'goup_id' => $this->input->post('group_id'),
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
					'goup_id' => $this->input->post('group_id'),
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
}
