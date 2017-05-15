<?php

class Mod_contact extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/* ************************************ *
	 *                                      *
	 *               Contact                *
	 *                                      *
	 * ************************************ */
	// 取得聯絡清單
	function get_all() {
		return $this->db->get('contact_main')->result_array();
	}

	// 取得特定聯絡
	function get_once($id) {
		$this->db->where('id', $id);
		return $this->db->get('contact_main')->row_array();
	}

	function get_total() {
		return $this->db->count_all_results('contact_main');
	}

	// 新增聯絡
	function insert($dataArray) {
		return $this->db->insert('contact_main', $dataArray);
	}

	// 更新聯絡
	function update($id, $dataArray) {
		$this->db->where('id', $id);
		return $this->db->update('contact_main', $dataArray);
	}

	// 刪除聯絡
	function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('contact_main');
	}
}

?>