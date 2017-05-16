<?php

class Mod_category extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->model('mod_product');
	}

	/* ************************************ *
	 *                                      *
	 *               Category               *
	 *                                      *
	 * ************************************ */
	// 取得分類清單
	function get_all() {
		$res = $this->db->get('category_main')->result_array();
		return $this->mod_product->get_category_products_total($res);
	}

	// 取得特定分類
	function get_once($id) {
		$this->db->where('id', $id);
		return $this->db->get('category_main')->row_array();
	}

	function get_total() {
		return $this->db->count_all_results('category_main');
	}

	// 新增分類
	function insert($dataArray) {
		return $this->db->insert('category_main', $dataArray);
	}

	// 更新分類
	function update($id, $dataArray) {
		$this->db->where('id', $id);
		return $this->db->update('category_main', $dataArray);
	}

	// 刪除分類
	function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('category_main');
	}
}

?>