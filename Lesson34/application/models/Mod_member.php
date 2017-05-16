<?php

class Mod_member extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	// 確認會員是否登入
	function chk_login_status() {
		return $this->session->userdata('user_login_status');
	}

	// 確認會員信箱密碼是否存在
	function chk_login($email, $pwd) {
		$this->db->where('email', $email);
		$this->db->where('password', sha1($pwd));
		// 透過藉由信箱密碼下去比對是否存在
		if($this->db->count_all_results('user_main') == 0) {
			// 不存在
			return false;
		}else{
			// 存在
			return true;
		}
	}

	// 會員進行登入
	function do_login($email) {
		$user = $this->get_once_by_email($email);

		$session_arr = array(
			'user_name'=> $user['nickname'],
			'user_email'=> $user['email'],
			'user_id'=> $user['id'],
			'user_login_status'=> true
			);

		// 登入資訊保存到Session
		$this->session->set_userdata($session_arr);

		$this->set_last_login($user['id']);

		return true;
	}

	// 取得會員資料
	function get_once_by_email($email) {
		$this->db->where('email', $email);
		return $this->db->get('user_main')->row_array();
	}

	// 確認Email是否重複
	function chk_repeat_email($id, $email) {
		$this->db->where('email', $email);
		$this->db->where('id !=', $id);
		return $this->db->get('user_main')->row_array();
	}

	// 設定最後登入時間
	function set_last_login($id) {
		$dataArray = array(
			'last_date'=> date('Y-m-d'),
			'last_time'=> date('H:i:s')
			);
		$this->db->where('id', $id);
		return $this->db->update('user_main', $dataArray);
	}

	// 會員登出
	function logout() {
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_login_status');
		return true;
	}

	/* ************************************ *
	 *                                      *
	 *               Manager                *
	 *                                      *
	 * ************************************ */
	// 取得會員清單
	function get_all() {
		$this->db->select('id, email, nickname');
		return $this->db->get('user_main')->result_array();
	}

	// 取得特定會員
	function get_once($id) {
		$this->db->select('id, email, nickname, phone, address');
		$this->db->where('id', $id);
		return $this->db->get('user_main')->row_array();
	}

	function get_total() {
		return $this->db->count_all_results('user_main');
	}

	// 新增會員
	function insert($dataArray) {
		return $this->db->insert('user_main', $dataArray);
	}

	// 更新會員
	function update($id, $dataArray) {
		$this->db->where('id', $id);
		return $this->db->update('user_main', $dataArray);
	}

	// 刪除會員
	function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('user_main');
	}
}

?>