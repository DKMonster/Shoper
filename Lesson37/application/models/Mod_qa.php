<?php

class Mod_qa extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/* ************************************ *
	 *                                      *
	 *                 Q&A                  *
	 *                                      *
	 * ************************************ */
	// 取得問題清單
	function get_all() {
		return $this->db->get('qa_main')->result_array();
	}

	// 取得特定問題
	function get_once($id) {
		$this->db->where('id', $id);
		return $this->db->get('qa_main')->row_array();
	}

	function get_total() {
		return $this->db->count_all_results('qa_main');
	}

	// 新增問題
	function insert($dataArray) {
		return $this->db->insert('qa_main', $dataArray);
	}

	// 更新問題
	function update($id, $dataArray) {
		$this->db->where('id', $id);
		return $this->db->update('qa_main', $dataArray);
	}

	// 刪除問題
	function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('qa_main');
	}
}

?>