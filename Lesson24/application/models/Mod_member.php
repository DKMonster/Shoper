<?php

class Mod_member extends CI_Model {
	public function __construct() {
		parent::__construct();
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