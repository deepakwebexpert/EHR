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
		// Employee data here
		$data['department'] = $this->db->get('customer')->result_array();
		$data['view'] = 'admin/customer/customer';
		$this->load->view('layout', $data);
	}

	public function add_customer($id = 0)
	{
		if ($id != 0) $data['customer'] = $this->db->get_where('customer', array('id =' => $id))->row_array();
		if ($this->input->post('submit')) {
			$data = array(
				'cust_name' => $this->input->post('cust_name'),
				'cust_location' => $this->input->post('cust_location'),
				'cust_address' => $this->input->post('cust_address')
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('customer', $data);
				$insert_id = $this->db->insert_id();

				$this->db->where('id', $insert_id);
				$this->db->update('customer', array("cust_id" => "JIC00" . $insert_id));
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('customer', $data);
			}

			redirect(base_url('admin/customer'));
		}
		$data['id'] = $id;
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
		$data['reports'] = $this->db->get('reports')->result_array();
		$data['view'] = 'admin/customer/reports';
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
				'additional_documents' => $additional_documents['upload_data']['file_name'],
				'amc_amount' => $this->input->post('amc_amount'),
				'amc_duration' => $this->input->post('amc_duration'),
				'amc_start_date' => $this->input->post('amc_start_date'),
				'amc_end_date' => $this->input->post('amc_end_date'),
				'visit_count' => $this->input->post('visit_count'),
				'pm_breakdown_count' => $this->input->post('pm_breakdown_count'),
				'status' => $this->input->post('status'),
				'required_document' => $additional_documents['upload_data']['file_name'],

			);

			if ($id == 0) {
				// Insert
				$this->db->insert('reports', $data);
			} else {
				// Update
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
}
