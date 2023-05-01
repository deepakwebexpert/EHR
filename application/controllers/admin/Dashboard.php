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

		$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
		$this->db->select('*');
		$this->db->from('jeol_employee_tbl');
		$this->db->where($con . " !=", 0);
		$query = $this->db->get();
		$ids = $query->result_array();
		$tl_ids[] = $this->session->userdata('user_id');


		foreach ($ids as $key => $value) $tl_ids[] = $value['id'];


		// var_dump($this->general_settings); exit();
		$data['all_projects'] = $this->db->get('reports')->num_rows();

		// Tl Data
		$data['tl_all_projects'] = $this->db->get('reports')->num_rows();
		$this->db->from('reports');
		$this->db->where_in('created_by', $tl_ids);
		$data['tl_all_projects'] = $this->db->get()->num_rows();


		$data['expired_projects'] = $this->db->get_where('reports', array("status" => 'In-Active'))->num_rows();

		// TL Expired Project
		$data['tl_all_projects'] = $this->db->get('reports')->num_rows();
		$this->db->from('reports');
		$this->db->where_in('created_by', $tl_ids);
		$this->db->where('status', "In-Active");
		$data['tl_expired_projects'] = $this->db->get()->num_rows();


		$data['exp_1_month'] = $this->db->select('*')->from('reports')->where('Date(created_at) <= DATE_ADD(NOW(), INTERVAL 30 DAY)')->where('Date(created_at) > NOW()')->get()->num_rows();

		// TL Expired Project 1 month
		$data['tl_all_projects'] = $this->db->get('reports')->num_rows();
		$this->db->from('reports');
		$this->db->where_in('created_by', $tl_ids);
		$this->db->where('Date(created_at) <= DATE_ADD(NOW(), INTERVAL 30 DAY)');
		$this->db->where('Date(created_at) > NOW()');
		$data['tl_exp_1_month'] = $this->db->get()->num_rows();



		$data['employees'] = $this->db->get_where('jeol_employee_tbl', array("emp_status" => 'Active'))->num_rows();


		$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
		$this->db->select('*');
		$this->db->from('jeol_employee_tbl');
		$this->db->where($con . " !=", 0);
		$data['tl_employees'] = $this->db->get()->num_rows();


		// TL schedulede Clients
		$this->db->from('customer');
		$this->db->where_in('created_by', $tl_ids);
		$this->db->where('status', 0);
		$data['tl_scheduled_clients'] = $this->db->get()->result_array();


		$data['scheduled_clients'] = $this->db->get_where('customer', array('status =' => 0))->result_array();

		// Tl project expire in 10 days
		$data['tl_project_expired_in_10_days'] = $this->db->select('*')->from('reports')->where('Date(created_at) <= DATE_ADD(NOW(), INTERVAL 10 DAY)')->where('Date(created_at) > NOW()')->where_in('created_by', $tl_ids)->get()->result_array();


		// Admin
		$data['project_expired_in_10_days'] = $this->db->select('*')->from('reports')->where('Date(created_at) <= DATE_ADD(NOW(), INTERVAL 10 DAY)')->where('Date(created_at) > NOW()')->get()->result_array();


		// Tl AMC expired in 10 days
		$data['tl_amc_expired_in_10_days'] = $this->db->select('*')->from('reports')->where('Date(amc_end_date) <= DATE_ADD(NOW(), INTERVAL 10 DAY)')->where('Date(amc_end_date) > NOW()')->where_in('created_by', $tl_ids)->get()->result_array();


		$data['amc_expired_in_10_days'] = $this->db->select('*')->from('reports')->where('Date(amc_end_date) <= DATE_ADD(NOW(), INTERVAL 10 DAY)')->where('Date(created_at) > NOW()')->get()->result_array();


		$data['group_id'] =  $this->session->all_userdata()['group_id'];
		$user_id = $this->session->all_userdata()['user_id'];

		$data['calendar'] = $this->db->get_where('jeol_timesheet_tbl', array("emp_id" => $user_id))->result();



		// Employee Last 10 Projects
		$data['emp_last_10_projects'] = $this->db->select('*')->from('reports')->where('created_by', $this->session->userdata('user_id'))->get()->result_array();

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
