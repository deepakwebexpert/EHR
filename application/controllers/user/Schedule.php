<?php defined('BASEPATH') or exit('No direct script access allowed');
class Schedule extends UR_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{

		$data['schedule'] = $this->db->get('schedule')->result_array();
		$data['view'] = 'user/schedule/index';
		$this->load->view('layout', $data);
	}

	public function del_schedule($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('schedule');
			redirect(base_url('user/schedule/index'));
		}
	}

	public function add_schedule($id = 0)
	{
		if ($id != 0) {
			$data['schedule'] = $this->db->get_where('schedule', array('id =' => $id))->row_array();
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


			$data = array(
				'user_id' => $this->session->userdata['user_id'],
				'start_date' => $this->input->post('start_date'),
				'start_time_appm' => $this->input->post('start_time_appm'),
				'end_date' => $this->input->post('end_date'),
				'end_time_appm' => $this->input->post('end_time_appm'),
				'company' => $this->input->post('company'),
				'department' => $this->input->post('department'),
				'project' => $this->input->post('project'),
				'product_segment' => $this->input->post('product_segment'),
				'meeting_agenda' => $this->input->post('meeting_agenda'),
				'description' => $this->input->post('description'),
				'service_type' => $this->input->post('service_type'),
				'visit_count' => $this->input->post('visit_count'),
				'document' => $additional_documents['upload_data']['file_name']

			);
			

			if ($id == 0) {
				// Insert
				$this->db->insert('schedule', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('schedule', $data);
			}

			redirect(base_url('user/schedule'));
		}
		$data['customer_data'] = $this->db->get('customer')->result_array();
		$data['id'] = $id;
		$data['view'] = 'user/schedule/add_schedule';
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
}
