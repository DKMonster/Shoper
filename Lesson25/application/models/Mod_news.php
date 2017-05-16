<?php

class Mod_news extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/* ************************************ *
	 *                                      *
	 *                 News                 *
	 *                                      *
	 * ************************************ */
	// 取得消息清單
	function get_all() {
		return $this->db->get('news_main')->result_array();
	}

	// 取得特定消息
	function get_once($id) {
		$this->db->where('id', $id);
		return $this->db->get('news_main')->row_array();
	}

	function get_news() {
		$this->db->where('release_date <= ', date('Y-m-d'));
		return $this->db->get('news_main')->result_array();
	}

	function get_total() {
		return $this->db->count_all_results('news_main');
	}

	// 新增消息
	function insert($dataArray) {
		return $this->db->insert('news_main', $dataArray);
	}

	// 更新消息
	function update($id, $dataArray) {
		$this->db->where('id', $id);
		return $this->db->update('news_main', $dataArray);
	}

	// 刪除消息
	function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('news_main');
	}
}

?>