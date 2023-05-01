<?php defined('BASEPATH') or exit('No direct script access allowed');
class Customer extends MY_Controller
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

		$status = $_GET['status'];
		if (isset($_GET['status']) and   ($status == 0 || $status == 1))
			$data['department'] = $this->db->get_where('customer', array('status =' => $status))->result_array();

		else  $data['department'] = $this->db->get('customer')->result_array();

		// print_r($data['department']); die;

		$data['view'] = 'admin/customer/customer';
		$this->load->view('layout', $data);
	}

	public function add_customer($id = 0)
	{

		$group_id = $this->session->all_userdata()['group_id'];
		if ($group_id != 6) {
			$status = 0;
			// Pass Customers
			$data['all_customers'] = $this->db->get_where('customer', array('created_by =' => $this->session->all_userdata()['user_id'], 'status' => 0))->result_array();
		} else {
			$status = 1;
			$data['all_customers'] = $this->db->get('customer')->result_array();
		}
		if ($id != 0) $data['customer'] = $this->db->get_where('customer', array('id =' => $id))->row_array();
		if ($this->input->post('submit')) {
			$data = array(
				'cust_name' => $this->input->post('cust_name'),
				'cust_location' => $this->input->post('cust_location'),
				'cust_address' => $this->input->post('cust_address'),
				'created_by' => $this->session->all_userdata()['user_id'],
				'status' => $status
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('customer', $data);
				$insert_id = $this->db->insert_id();

				if (strlen($insert_id) == 1) $inc_id = "JI-" . date("y") . "-000" . $insert_id;
				else if (strlen($insert_id)  == 2) $inc_id = "JI-" . date("y") . "-00" . $insert_id;
				else if (strlen($insert_id) == 3) $inc_id = "JI-" . date("y") . "-0" . $insert_id;
				else if (strlen($insert_id) == 4) $inc_id = "JI-" . date("y") . "-" . $insert_id;


				$this->db->where('id', $insert_id);
				$this->db->update('customer', array("cust_id" => $inc_id));
			} else {
				// Update

				$update_data = array(
					'cust_name' => $this->input->post('cust_name'),
					'cust_location' => $this->input->post('cust_location'),
					'cust_address' => $this->input->post('cust_address'),
					'status' => $this->input->post('status')
				);

				$this->db->where('id', $id);
				$this->db->update('customer', $update_data);
			}

			if ($group_id == 6) redirect(base_url('admin/customer'));
			else redirect(base_url('admin/customer/emp_customers'));
		}

		$data['id'] = $id;
		$data['group_id'] = $group_id;
		$data['view'] = 'admin/customer/add_customer';
		$this->load->view('layout', $data);
	}
	public function customer_del($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('customer');
			redirect(base_url('admin/customer'));
		}
	}

	public function department()
	{
		// Employee data here
		$data['department'] = $this->db->get('customer_department')->result_array();
		$data['view'] = 'admin/customer/department';
		$this->load->view('layout', $data);
	}

	public function department_del($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('customer_department');
			redirect(base_url('admin/customer/department'));
		}
	}

	public function add_department($id = 0)
	{
		if ($id != 0) {
			// $data['customer'] = $this->db->get_where('customer', array('id =' => $id))->row_array();
			$data['customer_dept'] = $this->db->get_where('customer_department', array('id =' => $id))->row_array();
		}
		if ($this->input->post('submit')) {
			$data = array(
				'cust_id' => $this->input->post('cust_id'),
				'cust_depart' => $this->input->post('cust_depart'),
				'end_user_name' => $this->input->post('end_user_name'),
				'contact_no' => $this->input->post('contact_no'),
				'email_id' => $this->input->post('email_id'),
				'cust_location' => $this->input->post('cust_location'),
				'cust_address' => $this->input->post('cust_address')
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('customer_department', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('customer_department', $data);
			}

			redirect(base_url('admin/customer/department'));
		}
		$data['id'] = $id;
		$data['customer_data'] = $this->db->get('customer')->result_array();
		$data['view'] = 'admin/customer/add_department';
		$this->load->view('layout', $data);
	}


	public function reports()
	{
		// Employee data here
		// if (isset($_GET['search']) and !empty($_GET['search'])) {
		// 	$search = $_GET['search'];
		// 	// $this->db->where("(cust_id = '$search' OR id = '$search')");
		// 	$this->db->like('cust_id', $search);
		// 	$this->db->or_like('cust_name', $search);
		// 	$data['reports'] = $this->db->get('reports')->result_array();
		// } else  $data['reports'] = $this->db->get('reports')->result_array();

		if ($this->input->post('submit')) {
			$warranty_status = $this->input->post('warranty_status');
			$amc_status = $this->input->post('amc_status');

			$this->db->where("(warranty_status = '$warranty_status' OR amc_status= '$amc_status' )");
			$data['reports'] = $this->db->where('created_by', $this->session->userdata('user_id'))->get('reports')->result_array();
		} else
			$data['reports'] = $this->db->where('created_by', $this->session->userdata('user_id'))->get('reports')->result_array();

		$data['warranty_status'] = $this->input->post('warranty_status');
		$data['amc_status'] = $this->input->post('amc_status');
		$data['group_id'] = $this->session->all_userdata()['group_id'];
		$data['view'] = 'admin/customer/reports';
		$this->load->view('layout', $data);
	}

	public function reports_amc()
	{
		// Employee data here
		// if (isset($_GET['search']) and !empty($_GET['search'])) {
		// 	$search = $_GET['search'];
		// 	// $this->db->where("(cust_id = '$search' OR id = '$search')");
		// 	$this->db->like('cust_id', $search);
		// 	$this->db->or_like('cust_name', $search);
		// 	$data['reports'] = $this->db->get('reports')->result_array();
		// } else  $data['reports'] = $this->db->get('reports')->result_array();

		if ($this->input->post('submit')) {
			$warranty_status = $this->input->post('warranty_status');
			$amc_status = $this->input->post('amc_status');

			$this->db->where("(warranty_status = '$warranty_status' OR amc_status= '$amc_status' )");
			$data['reports'] = $this->db->get('reports')->result_array();
		} else
			$data['reports'] = $this->db->get('reports')->result_array();

		$data['warranty_status'] = $this->input->post('warranty_status');
		$data['amc_status'] = $this->input->post('amc_status');
		$data['group_id'] = $this->session->all_userdata()['group_id'];
		$data['view'] = 'admin/customer/reports_amc';
		$this->load->view('layout', $data);
	}


	public function search_reports()
	{
		// Employee data here
		if (isset($_GET['search']) and !empty($_GET['search'])) {
			$search = $_GET['search'];
			$this->db->like('cust_id', $search);
			$this->db->or_like('cust_name', $search);
			$data['reports'] = $this->db->get('reports')->result_array();
		} else  $data['reports'] = $this->db->get('reports')->result_array();


		$data['warranty_status'] = $this->input->post('warranty_status');
		$data['amc_status'] = $this->input->post('amc_status');
		$data['group_id'] = $this->session->all_userdata()['group_id'];
		$data['view'] = 'admin/customer/search_reports';
		$this->load->view('layout', $data);
	}
	public function reports_del($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('reports');
			redirect(base_url('admin/customer/reports'));
		}
	}

	public function add_reports($id = 0)
	{
		if ($id != 0) {
			$data['reports'] = $this->db->get_where('reports', array('id =' => $id))->row_array();
			$data['selected_department'] = $this->db->get_where('customer_department', array('id =' => $data['reports']['id']))->row_array();
		}
		if ($this->input->post('submit')) {


			// Upload Document Here
			$path = 'uploads';
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv|pdf|png|jpg';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('additional_documents')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$additional_documents = array('upload_data' => $this->upload->data());
			}

			if (!$this->upload->do_upload('required_documents')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$required_documents = array('upload_data' => $this->upload->data());
			}

			$data = array(
				'cust_id' => $this->input->post('cust_id'),
				'cust_name' => $this->db->get_where('customer', array('cust_id =' => $this->input->post('cust_id')))->row()->cust_name,
				'cust_depart' => $this->input->post('cust_depart'),
				'po_no' => $this->input->post('po_no'),
				'po_value' => $this->input->post('po_value'),
				'instrument' => $this->input->post('instrument'),
				'model_no' => $this->input->post('model_no'),
				'serial_no' => $this->input->post('serial_no'),
				'ld_clause' => $this->input->post('ld_clause'),
				'shipment_date' => $this->input->post('shipment_date'),
				'installation_date' => $this->input->post('installation_date'),
				'warranty_duration' => $this->input->post('warranty_duration'),
				'warranty_start_date' => $this->input->post('warranty_start_date'),
				'warranty_end_date' => $this->input->post('warranty_end_date'),
				'warranty_status' => $this->input->post('warranty_status'),
				'additional_documents' => $additional_documents['upload_data']['file_name'],
				'amc_amount' => $this->input->post('amc_amount'),
				'amc_duration' => $this->input->post('amc_duration'),
				'amc_start_date' => $this->input->post('amc_start_date'),
				'amc_end_date' => $this->input->post('amc_end_date'),
				'amc_status' => $this->input->post('amc_status'),
				'visit_count' => $this->input->post('visit_count'),
				'pm_breakdown_count' => $this->input->post('pm_breakdown_count'),
				'status' => $this->input->post('status'),
				'required_document' => $additional_documents['upload_data']['file_name'],
				'created_by' => $this->session->all_userdata()['user_id']
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('reports', $data);
			} else {
				// Update Data
				$data = array(
					'cust_id' => $this->input->post('cust_id'),
					'cust_name' => $this->db->get_where('customer', array('cust_id =' => $this->input->post('cust_id')))->row()->cust_name,
					'cust_depart' => $this->input->post('cust_depart'),
					'po_no' => $this->input->post('po_no'),
					'po_value' => $this->input->post('po_value'),
					'instrument' => $this->input->post('instrument'),
					'model_no' => $this->input->post('model_no'),
					'serial_no' => $this->input->post('serial_no'),
					'ld_clause' => $this->input->post('ld_clause'),
					'shipment_date' => $this->input->post('shipment_date'),
					'installation_date' => $this->input->post('installation_date'),
					'warranty_duration' => $this->input->post('warranty_duration'),
					'warranty_start_date' => $this->input->post('warranty_start_date'),
					'warranty_end_date' => $this->input->post('warranty_end_date'),
					'warranty_status' => $this->input->post('warranty_status'),
					'additional_documents' => $additional_documents['upload_data']['file_name'],
					'amc_amount' => $this->input->post('amc_amount'),
					'amc_duration' => $this->input->post('amc_duration'),
					'amc_start_date' => $this->input->post('amc_start_date'),
					'amc_end_date' => $this->input->post('amc_end_date'),
					'amc_status' => $this->input->post('amc_status'),
					'visit_count' => $this->input->post('visit_count'),
					'pm_breakdown_count' => $this->input->post('pm_breakdown_count'),
					'status' => $this->input->post('status'),
					'required_document' => $additional_documents['upload_data']['file_name']
				);
				$this->db->where('id', $id);
				$this->db->update('reports', $data);
			}

			redirect(base_url('admin/customer/reports'));
		}
		$data['id'] = $id;
		$data['customer_data'] = $this->db->get('customer')->result_array();
		$data['view'] = 'admin/customer/add_reports';
		$this->load->view('layout', $data);
	}

	public function ajax_data()
	{
		$cust_id =  $this->input->get('cust_id');
		$cust_dept =  $this->input->get('cust_dept');
		if (!empty($cust_dept)) {
			$departments = $this->db->get_where('customer_department', array('id =' => $cust_dept))->row_array();
			echo json_encode($departments);
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

	public function emp_customers()
	{
		// Employee data here
		// $data['department'] = $this->db->get('customer')->result_array();
		$created_by = $this->session->all_userdata()['user_id'];
		// print_r($this->session->all_userdata()); die;
		$data['department'] = $this->db->get_where('customer', array('created_by =' => $created_by))->result_array();
		$data['view'] = 'admin/customer/emp_customer';
		$this->load->view('layout', $data);
	}

	public function tl_customers()
	{


		$con = "find_in_set(" . $this->session->userdata('user_id') . ",report_to)";
		$this->db->select('*');
		$this->db->from('jeol_employee_tbl');
		$this->db->where($con . " !=", 0);
		$result = $this->db->get()->result_array();

		// print_r($result);
		// die;

		foreach ($result as $key => $value) $emp_ids[] = $value['id'];


		$this->db->where_in('created_by', $emp_ids);
		$data['department']  = $this->db->get('customer')->result_array();



		// $created_by = $this->session->all_userdata()['user_id'];
		// // print_r($this->session->all_userdata()); die;
		// $data['department'] = $this->db->get_where('customer', array('created_by =' => $created_by))->result_array();
		$data['view'] = 'admin/customer/tl_customers';
		$this->load->view('layout', $data);
	}

	public function view_po($id = 0)
	{

		$data['images'] = $this->db->get_where('customer_docs', array('customer_id =' => $id))->result_array();
		$data['view'] = 'admin/customer/po_customer';
		$this->load->view('layout', $data);
	}

	public function delete_po($id = 0)
	{

		if ($id != 0) {
			$customer_id  = $this->db->get_where('customer_docs', array('id =' => $id))->row()->customer_id;
			$this->db->where('id', $id);
			$this->db->delete('customer_docs');
			redirect(base_url('admin/customer/view_po/') . $customer_id);
		}
	}

	public function view_report($report_id = 0)
	{

		$report_id = $_GET['report_id'];
		if ($report_id != 0) {
			$data  = $this->db->get_where('reports', array('id =' => $report_id))->row_array();
			// Generate Table Here
			$table = '';
			$table .= "<tr>";
			$table .= "<td>Total Duration(Years):</td>";
			$table .= "<td>" . (new DateTime($data['warranty_start_date']))->diff(new DateTime($data['warranty_end_date']))->format('%y') . "</td>";
			$table .= "</tr>";

			$table .= "<tr>";
			$table .= "<td>No of Visits:</td>";
			$table .= "<td>" . $data['visit_count'] . "</td>";
			$table .= "</tr>";

			$table .= "<tr>";
			$table .= "<td>Warranty Start:	</td>";
			$table .= "<td>" . $data['warranty_start_date'] . "</td>";
			$table .= "</tr>";

			$table .= "<tr>";
			$table .= "<td>Warranty End:	</td>";
			$table .= "<td>"  . $data['warranty_end_date'] . "</td>";
			$table .= "</tr>";

			$table .= "<tr>";
			$table .= "<td>Status:</td>";
			$table .= "<td><b>" . $data['warranty_status'] . "<b></td>";
			$table .= "</tr>";

			echo $table;
		}
	}

	public function view_report_amc($report_id = 0)
	{

		$report_id = $_GET['report_id'];
		if ($report_id != 0) {
			$data  = $this->db->get_where('reports', array('id =' => $report_id))->row_array();
			// Generate Table Here
			$table = '';
			$table .= "<tr>";
			$table .= "<td>Total Duration(Years):</td>";
			$table .= "<td>" . (new DateTime($data['amc_start_date']))->diff(new DateTime($data['amc_end_date']))->format('%y') . "</td>";
			$table .= "</tr>";

			$table .= "<tr>";
			$table .= "<td>No of Visits:</td>";
			$table .= "<td>" . $data['visit_count'] . "</td>";
			$table .= "</tr>";

			$table .= "<tr>";
			$table .= "<td>Amc Start:	</td>";
			$table .= "<td>" . $data['amc_start_date'] .  "</td>";
			$table .= "</tr>";

			$table .= "<tr>";
			$table .= "<td>Amc End:	</td>";
			$table .= "<td>"  . $data['amc_end_date'] . "</td>";
			$table .= "</tr>";


			$table .= "<tr>";
			$table .= "<td>Status:</td>";
			$table .= "<td><b>" . $data['amc_status'] . "</b></td>";
			$table .= "</tr>";

			echo $table;
		}
	}

	public function view_detail($report_id = 0)
	{

		$customer_id = $_GET['customer_id'];
		if ($customer_id != 0) {

			$data  = $this->db->get_where('jeol_travelexp_tbl', array('Company =' => $customer_id))->result_array();
			// Generate Table Here
			$table = '';
			$i = 0;
			foreach ($data as $key => $value) {

				$table .= "<tr>";
				$table .= "<td>" . ++$i . "</td>";
				$table .= "<td>" . $this->db->get_where('jeol_employee_tbl', array('id =' => $value['member_id']))->row()->emp_name . "</td>";
				$table .= "<td>" . $value['reg_date'] . "</td>";
				$table .= "<td>" . $value['Amount'] . "</td>";
				$table .= "</tr>";
			}


			echo $table;
		}
	}
}
