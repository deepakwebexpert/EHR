<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Helper extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = 'Helper Classes';
		$data['view'] = 'admin/helper-classes';
		$this->load->view('layout', $data);
	}

	// get leave employee list in desc order

 

		function get_employe_leave_desc($id=false){
   
			if($id !=''){
   
						//echo "ok"; die;
   
				$table = "jeol_employee_tbl";
   
				$jeol->ci= & get_instance();
   
			   $jeol->ci->db->select('*');
   
			   $jeol->ci->db->where('id',$id);
   
						   
   
			   $user_detail = $jeol->ci->db->get($table)->row_array();
   
						  // print"<pre>"; print_r($user_detail); die;
   
			   return $user_detail;
   
			}
   
		}
   
	
}
