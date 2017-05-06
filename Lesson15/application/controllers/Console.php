<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('mod_manager');
	}

	function index() {
		if($this->mod_manager->chk_login_status()) {
			$this->load->view('layout');
		}else{
			redirect(base_url('console/login'));
		}
	}

	function login() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console",
			'path'=> 'console/login',
			'page'=> 'login.php'
			);

		if($this->input->post('rule') == 'login') {
			$email = $this->input->post('email');
			$pwd = $this->input->post('password');
			if($this->mod_manager->chk_login($email, $pwd)) {
				// 登入中
				$this->mod_manager->do_login($email);
				redirect(base_url('console'));
			}else{
				$view_data['error'] = '登入失敗，信箱或密碼錯誤';
			}
		}else{
			if($this->mod_manager->chk_login_status()) {
				redirect(base_url('console'));
			}
		}

		$this->load->view('console/login', $view_data);
	}
}

?>