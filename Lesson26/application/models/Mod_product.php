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
		$res = $this->db->get('product_main')->result_array();
		return $res;
	}

	// 取得商品清單
	function get_products_all($id, $limit, $pervious) {
		if($id != 'all') {
			$this->db->where('product_main.category', $id);
		}
		$this->db->limit($limit);
		$this->db->offset(($pervious-1)*$limit);
		$res = $this->db->get('product_main')->result_array();
		return $res;
	}

	// 取得特定商品
	function get_once($id) {
		$this->db->where('id', $id);
		return $this->db->get('product_main')->row_array();
	}

	function get_total() {
		return $this->db->count_all_results('product_main');
	}

	function get_products_total($id) {
		if($id != 'all') {
			$this->db->where('category', $id);
		}
		return $this->db->count_all_results('product_main');
	}

	function get_category_products_total($res) {
		foreach ($res as $key => $value) {
			# code...
			$this->db->where('category', $value['id']);
			$res[$key]['total'] = $this->db->count_all_results('product_main');
		}
		return $res;
	}

	function get_image_list($id) {
		$this->db->where('product_id', $id);
		return $this->db->get('product_img')->result_array();
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