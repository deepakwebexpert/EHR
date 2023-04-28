<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/dashboard_model', 'dashboard_model');
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{

		// var_dump($this->general_settings); exit();
		$data['all_users'] = $this->dashboard_model->get_all_users();
		$data['active_users'] = $this->dashboard_model->get_active_users();
		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();
		$data['title'] = 'Dashboard';
		$data['group_id'] =  $this->session->all_userdata()['group_id'];
		$user_id = $this->session->all_userdata()['user_id'];
		$data['calendar'] = $this->db->get_where('jeol_timesheet_tbl', array("emp_id" => $user_id))->result();

		$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
		$this->db->select('*');
		$this->db->from('jeol_employee_tbl');
		$this->db->where($con . " !=", 0);
		$query = $this->db->get();
		$ids = $query->result_array();
		foreach ($ids as $key => $value) $tl_ids[] = $value['id'];


		$tl_ids[] = $this->session->userdata('user_id');

		// print_r($tl_ids); die;

		// $data['tl_calendar'] = $this->db->get('jeol_timesheet_tbl')->result();
		$this->db->from('jeol_timesheet_tbl');
		$this->db->where_in('emp_id', $tl_ids);
		$data['tl_calendar'] = $this->db->get()->result();
		
		// print_r($data['tl_calendar']); die;	


		// $data['module'] = $this->db->get_where('schedule', array("par_id" => 0, "status" => 1))->result_array();
		$data['customer_data'] = $this->db->get('customer')->result_array();
		$data['view'] = 'admin/dashboard/index';
		$this->load->view('layout', $data);
	}
	public function permissions()
	{

		$data['department'] = array(6 => "Administrator (HR)", 26 => "Sub Admin (Team Lead)", 28 => "Executive", 29 => "Executive Admin");
		$data['view'] = 'admin/dashboard/permission';
		$this->load->view('layout', $data);
	}

	public function view_permission($id = 0)
	{
		$data['id'] = $id;
		$data['module'] = $this->db->get_where('jeol_modules_tbl', array("par_id" => 0, "status" => 1))->result_array();
		$data['view'] = 'admin/dashboard/view_permission';
		$this->load->view('layout', $data);
	}

	public function ajax_data()
	{
		$group_id = $_GET['group_id'];
		$menu_id = $_GET['menu_id'];
		$sub_menu_id = $_GET['sub_menu_id'];
		$status = $_GET['status'];

		// Update record here
		$checkRecord = $this->db->get_where('tbl_perrmission', array("group_id" => $group_id, "menu_id" => $menu_id, "sub_menu_id" => $sub_menu_id))->num_rows();


		if ($checkRecord == 0) {
			// Insert
			$data = array(
				'group_id' => $group_id,
				'menu_id' => $menu_id,
				'sub_menu_id' => $sub_menu_id,
				'status' => $status
			);

			$this->db->insert('tbl_perrmission', $data);
		} else {
			// Update
			$data = [
				'status' => $status,
			];
			$this->db->where('group_id', $group_id);
			$this->db->where('menu_id', $menu_id);
			$this->db->where('sub_menu_id', $sub_menu_id);
			$this->db->update('tbl_perrmission', $data);
		}

		echo $checkRecord;
	}
}
