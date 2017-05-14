<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_console extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('mod_manager');
		$this->load->model('mod_member');
		$this->load->model('mod_category');
	}

	/* ************************************ *
	 *                                      *
	 *               Manager                *
	 *                                      *
	 * ************************************ */

	function delete_manager() {
		$id = $this->input->post('id');
		if($this->mod_manager->delete($id)) {
			$dataResponse['sys_code'] = 200;
			$dataResponse['sys_msg'] = '刪除成功！';
		}else{
			$dataResponse['sys_code'] = 200;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。';
		}
		echo json_encode($dataResponse);
	}

	/* ************************************ *
	 *                                      *
	 *               Member                 *
	 *                                      *
	 * ************************************ */

	function delete_member() {
		$id = $this->input->post('id');
		if($this->mod_member->delete($id)) {
			$dataResponse['sys_code'] = 200;
			$dataResponse['sys_msg'] = '刪除成功！';
		}else{
			$dataResponse['sys_code'] = 200;
			$dataResponse['sys_msg'] = '發生錯誤，刪除失敗。';
		}
		echo json_encode($dataResponse);
	}

	/* ************************************ *
	 *                                      *
	 *                                      *
	 *                                      *
	 * ************************************ */
}

?>