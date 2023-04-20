<?php defined('BASEPATH') or exit('No direct script access allowed');
class Appraisal extends MY_Controller
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
		$data['department'] = $this->db->get('jeol_attribute_tbl')->result_array();
		$data['view'] = 'admin/appraisal/appraisal';
		$this->load->view('layout', $data);
	}

	public function del_appraisal($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('jeol_attribute_tbl');
			redirect(base_url('admin/appraisal'));
		}
	}

	public function add_appraisal($id = 0)
	{
		if ($id != 0) $data['department'] = $this->db->get_where('jeol_attribute_tbl', array('id =' => $id))->row_array();
		if ($this->input->post('submit')) {
			$data = array(
				'attribute_title' => $this->input->post('attribute_title'),
				'status' => $this->input->post('status')
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_attribute_tbl', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_attribute_tbl', $data);
			}

			redirect(base_url('admin/appraisal'));
		}
		$data['id'] = $id;
		$data['view'] = 'admin/appraisal/add_appraisal';
		$this->load->view('layout', $data);
	}

	public function attribute_details()
	{
		// Employee data here
		$data['department'] = $this->db->get('jeol_attributedesc_tbl')->result_array();
		$data['view'] = 'admin/appraisal/attribute_details';
		$this->load->view('layout', $data);
	}

	public function del_attribute_details($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('jeol_attributedesc_tbl');
			redirect(base_url('admin/appraisal/attribute_details'));
		}
	}

	public function add_attribute_details($id = 0)
	{
		if ($id != 0) $data['department'] = $this->db->get_where('jeol_attributedesc_tbl', array('id =' => $id))->row_array();
		if ($this->input->post('submit')) {
			$data = array(
				'emp_type' => $this->input->post('emp_type'),
				'attribute_name' => $this->input->post('attribute_name'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'weightage' => $this->input->post('weightage'),
				'type' => $this->input->post('type'),
				'group' => 0
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_attributedesc_tbl', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_attributedesc_tbl', $data);
			}

			redirect(base_url('admin/appraisal/attribute_details'));
		}
		$data['id'] = $id;
		$data['attribute'] = $this->db->get('jeol_attribute_tbl')->result_array();
		$data['view'] = 'admin/appraisal/add_attribute_details';
		$this->load->view('layout', $data);
	}

	public function salaryrange()
	{
		// Salary data here
		$data['department'] = $this->db->get('info_salary_range')->result_array();
		$data['view'] = 'admin/appraisal/salaryrange';
		$this->load->view('layout', $data);
	}

	public function del_salaryrange($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('info_salary_range');
			redirect(base_url('admin/appraisal/salaryrange'));
		}
	}

	public function add_salaryrange($id = 0)
	{
		if ($id != 0) $data['department'] = $this->db->get_where('info_salary_range', array('id =' => $id))->row_array();

		if ($this->input->post('submit')) {
			$data = array(
				'min_salary' => $this->input->post('min_salary'),
				'max_salary' => $this->input->post('max_salary'),
				'designation' => $this->input->post('designation'),
				'med_salary' => 0,
				'division' => 0
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('info_salary_range', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('info_salary_range', $data);
			}

			redirect(base_url('admin/appraisal/salaryrange'));
		}
		$data['id'] = $id;
		$data['designation'] = $this->db->get('jeol_hr_tbl')->result_array();
		$data['view'] = 'admin/appraisal/add_salarychange';
		$this->load->view('layout', $data);
	}
	public function assign_bonus()
	{
		// Salary data here
		$data['department'] = $this->db->get('jeol_apprasial_member')->result_array();
		$data['view'] = 'admin/appraisal/assign_bonus';
		$this->load->view('layout', $data);
	}
	public function del_assign_bonus($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
			$this->db->delete('jeol_apprasial_member');
			redirect(base_url('admin/appraisal/assign_bonus'));
		}
	}

	public function add_assign_bonus($id = 0)
	{
		if ($id != 0) $data['department'] = $this->db->get_where('jeol_apprasial_member', array('id =' => $id))->row_array();

		if ($this->input->post('submit')) {
			$data = array(
				'app_employee' => $this->input->post('app_employee'),
				'app_teamleader' => $this->input->post('app_teamleader'),
				'app_member' => $this->input->post('app_member'),
				'sheet_id' => $this->input->post('sheet_id'),
				'last_increment' => $this->input->post('last_increment'),
				'sess_year' => $this->input->post('sess_year'),
				'app_member_status' => 'Done',
				'app_teamleader_status' => 'Pending',
				'app_employee_status' => 'Pending',
			);

			if ($id == 0) {
				// Insert
				$this->db->insert('jeol_apprasial_member', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('jeol_apprasial_member', $data);
			}

			redirect(base_url('admin/appraisal/assign_bonus'));
		}
		$data['id'] = $id;
		$data['employee'] = $this->db->get('jeol_employee_tbl')->result_array();
		$data['attribute'] = $this->db->get('jeol_attribute_tbl')->result_array();
		$data['view'] = 'admin/appraisal/add_assign_bonus';
		$this->load->view('layout', $data);
	}

	public function appraisal_bonus_info()
	{
		// Salary data here
		$data['increment'] = $this->db->get('yam_variableinc_card')->result_array();

		// Appraisal Rating
		$data['jeol_score_card'] = $this->db->get('jeol_score_card')->result_array();

		// Appraisal Rating
		$data['jeol_score_card_bonus'] = $this->db->get('jeol_score_card_bonus')->result_array();


		$data['view'] = 'admin/appraisal/appraisal_bonus_info';
		$this->load->view('layout', $data);
	}

	public function edit_appraisal_bonus_info($id = 0)
	{
		if ($id != 0) $data['increment'] = $this->db->get_where('yam_variableinc_card', array('id =' => $id))->row_array();

		if ($this->input->post('submit')) {
			$data = array(
				'yan_a_plus' => $this->input->post('yan_a_plus'),
				'yan_a' => $this->input->post('yan_a'),
				'yan_b' => $this->input->post('yan_b'),
				'yan_c' => $this->input->post('yan_c'),
				'yan_d' => $this->input->post('yan_d')
			);

			if ($id == 0) {
				// Insert
				// $this->db->insert('yam_variableinc_card', $data);
			} else {
				// Update
				$this->db->where('id', $id);
				$this->db->update('yam_variableinc_card', $data);
			}

			redirect(base_url('admin/appraisal/appraisal_bonus_info'));
		}
		$data['id'] = $id;
		$data['view'] = 'admin/appraisal/edit_appraisal_bonus_info';
		$this->load->view('layout', $data);
	}

	public function edit_appraisal_rating()
	{
		$data['jeol_score_card'] = $this->db->get('jeol_score_card')->result_array();

		if ($this->input->post('submit')) {
			// For Grade Score
			$grade_score = $this->input->post('grade_score');
			foreach ($grade_score as $key => $value) {

				$this->db->where('id', $key);
				$this->db->update('jeol_score_card', ['grade_score' => $value]);
			}


			// Score From
			$score_from = $this->input->post('score_from');
			foreach ($score_from as $key => $value) {

				$this->db->where('id', $key);
				$this->db->update('jeol_score_card', ['score_from' => $value]);
			}


			// Score To
			$score_to = $this->input->post('score_to');
			foreach ($score_to as $key => $value) {

				$this->db->where('id', $key);
				$this->db->update('jeol_score_card', ['score_to' => $value]);
			}

			redirect(base_url('admin/appraisal/appraisal_bonus_info'));
		}
		$data['id'] = $id;
		$data['view'] = 'admin/appraisal/edit_appraisal_rating';
		$this->load->view('layout', $data);
	}



	public function edit_bonus_rating()
	{
		$data['jeol_score_card_bonus'] = $this->db->get('jeol_score_card_bonus')->result_array();

		if ($this->input->post('submit')) {
			// For Grade Score
			$grade_score = $this->input->post('grade_score');
			foreach ($grade_score as $key => $value) {

				$this->db->where('id', $key);
				$this->db->update('jeol_score_card_bonus', ['grade_score' => $value]);
			}


			// Score From
			$score_from = $this->input->post('score_from');
			foreach ($score_from as $key => $value) {

				$this->db->where('id', $key);
				$this->db->update('jeol_score_card_bonus', ['score_from' => $value]);
			}


			// Score To
			$score_to = $this->input->post('score_to');
			foreach ($score_to as $key => $value) {

				$this->db->where('id', $key);
				$this->db->update('jeol_score_card_bonus', ['score_to' => $value]);
			}

			// Month To
			$bonus_month = $this->input->post('bonus_month');
			foreach ($bonus_month as $key => $value) {

				$this->db->where('id', $key);
				$this->db->update('jeol_score_card_bonus', ['bonus_month' => $value]);
			}
			redirect(base_url('admin/appraisal/appraisal_bonus_info'));
		}
		$data['id'] = $id;
		$data['view'] = 'admin/appraisal/edit_bonus_rating';
		$this->load->view('layout', $data);
	}
}
