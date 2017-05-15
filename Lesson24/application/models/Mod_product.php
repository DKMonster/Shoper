<?php

class Mod_product extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/* ************************************ *
	 *                                      *
	 *               Product                *
	 *                                      *
	 * ************************************ */
	// 取得商品清單
	function get_all() {
		return $this->db->get('product_main')->result_array();
	}

	// 取得特定商品
	function get_once($id) {
		$this->db->where('id', $id);
		return $this->db->get('product_main')->row_array();
	}

	function get_total() {
		return $this->db->count_all_results('product_main');
	}

	// 取得精選商品
	function get_feature() {
		$this->db->where('feature', 1);
		$this->db->where('online', 1);
		return $this->db->get('product_main')->result_array();
	}

	// 新增商品
	function insert($dataArray) {
		return $this->db->insert('product_main', $dataArray);
	}

	// 更新商品
	function update($id, $dataArray) {
		$this->db->where('id', $id);
		return $this->db->update('product_main', $dataArray);
	}

	// 刪除商品
	function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('product_main');
	}

	// 上下架商品
	function set_online($id, $num) {
		$this->db->where('id', $id);
		return $this->db->update('product_main', array('online'=> $num));
	}

	// 精選商品
	function set_feature($id, $num) {
		$this->db->where('id', $id);
		return $this->db->update('product_main', array('feature'=> $num));
	}

	function get_sub_all_photo($id) {
		$this->db->where('product_id', $id);
		return $this->db->get('product_img')->result_array();
	}

	function insert_sub_photo($dataArray) {
		return $this->db->insert('product_img', $dataArray);
	}

	function delete_sub_photo($id) {
		$this->db->where('id', $id);
		return $this->db->delete('product_img');
	}
}

?>