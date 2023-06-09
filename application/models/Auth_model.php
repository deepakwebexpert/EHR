<?php
class Auth_model extends CI_Model
{

	public function login($data)
	{
		$query = $this->db->get_where('ci_users', array('email' => $data['email']));
		if ($query->num_rows() == 0) {
			return false;
		} else {
			//Compare the password attempt with the password we have stored.
			$result = $query->row_array();
			// Compare Password using md5 here
			// $validPassword = password_verify($data['password'], $result['password']);
			$submittedPassword = md5($data['password']);
			// echo $result['password'] . "<br>";
			// echo $submittedPassword;
			// die;
			if ($submittedPassword == $result['password']) $validPassword = TRUE;
			else $validPassword = FALSE;
			if ($validPassword) {
				return $result = $query->row_array();
			}
		}
	}
	//--------------------------------------------------------------------
	public function register($data)
	{
		$this->db->insert('ci_users', $data);
		return true;
	}
	//--------------------------------------------------------------------
	public function email_verification($code)
	{
		$this->db->select('email, token, is_active');
		$this->db->from('ci_users');
		$this->db->where('token', $code);
		$query = $this->db->get();
		$result = $query->result_array();
		$match = count($result);
		if ($match > 0) {
			$this->db->where('token', $code);
			$this->db->update('ci_users', array('is_verify' => 1, 'token' => ''));
			return true;
		} else {
			return false;
		}
	}
	//============ Check User Email ============
	function check_user_mail($email)
	{
		$result = $this->db->get_where('ci_users', array('email' => $email));

		if ($result->num_rows() > 0) {
			$result = $result->row_array();
			return $result;
		} else {
			return false;
		}
	}
	//============ Update Reset Code Function ===================
	public function update_reset_code($reset_code, $user_id)
	{
		$data = array('password_reset_code' => $reset_code);
		$this->db->where('id', $user_id);
		$this->db->update('ci_users', $data);
	}

	//============ Activation code for Password Reset Function ===================
	public function check_password_reset_code($code)
	{

		$result = $this->db->get_where('ci_users',  array('password_reset_code' => $code));
		if ($result->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	//============ Reset Password ===================
	public function reset_password($id, $new_password)
	{
		$data = array(
			'password_reset_code' => '',
			'password' => $new_password
		);
		$this->db->where('password_reset_code', $id);
		$this->db->update('ci_users', $data);
		return true;
	}
	//--------------------------------------------------------------------
	public function get_admin_detail()
	{
		$id = $this->session->userdata('admin_id');
		$query = $this->db->get_where('ci_users', array('id' => $id));
		return $result = $query->row_array();
	}
	//--------------------------------------------------------------------
	public function update_admin($data)
	{
		$id = $this->session->userdata('admin_id');
		$this->db->where('id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}
	//--------------------------------------------------------------------
	public function change_pwd($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}

	// Check Recaptcha
	public function check_recaptcha_status()
	{
		$this->db->select('recaptcha_status');
		$this->db->where('id', 1);
		$status = $this->db->get('ci_general_settings')->row_array()['recaptcha_status'];
		if ($status == '1')
			return true;
		else
			return false;
	}
}
