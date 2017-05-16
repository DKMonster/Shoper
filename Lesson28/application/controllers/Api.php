<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('mod_product');
	}

	/* ************************************ *
	 *                                      *
	 *                 Cart                 *
	 *                                      *
	 * ************************************ */

	function addToCart() {
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');

		if($this->mod_product->chk_exist($id)) {
			if($this->mod_product->chk_reserve($id, $qty)) {
				$p = $this->mod_product->get_once($id);

				$data = array(
					'id'=> $id,
					'qty'=> $qty,
					'price'=> $p['cost'],
					'name'=> $p['title'],
					'options'=> array(
						'image'=> $p['main_photo']
						)
					);

				$this->cart->insert($data);

				$dataResponse['sys_code'] = 200;
				$dataResponse['sys_msg'] = '商品成功加入購物車！';
			}else{
				$dataResponse['sys_code'] = 500;
				$dataResponse['sys_msg'] = '商品目前已無庫存，請嘗試不同數量...';
			}
		}else{
			$dataResponse['sys_code'] = 404;
			$dataResponse['sys_msg'] = '商品不存在...';
		}

		echo json_encode($dataResponse);
	}

	function removeFromCart() {
		$rowid = $this->input->post('rowid');

		if($this->cart->remove($rowid)) {
			$dataResponse['sys_code'] = 200;
			$dataResponse['sys_msg'] = '商品移除成功！';
		}else{
			$dataResponse['sys_code'] = 404;
			$dataResponse['sys_msg'] = '商品移除失敗...';
		}

		echo json_encode($dataResponse);
	}

	function resetTheCart() {
		$this->cart->destroy();
		$dataResponse['sys_code'] = 200;
		$dataResponse['sys_msg'] = '購物車清空成功！';

		echo json_encode($dataResponse);
	}
}

?>