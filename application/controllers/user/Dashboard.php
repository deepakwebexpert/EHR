<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends UR_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{

		$data['schedule'] = $this->db->get('schedule')->result_array();
		$data['view'] = 'user/dashboard/index3';
		$this->load->view('layout', $data);
	}

}
