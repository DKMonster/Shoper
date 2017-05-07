<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('mod_manager');
	}

	function index() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Dashboard",
			'path'=> 'console/index',
			'page'=> 'dashboard.php',
			'menu'=> 'dashboard'
			);

		if($this->mod_manager->chk_login_status()) {
			$this->load->view('console/layout', $view_data);
		}else{
			redirect(base_url('console/login'));
		}
	}

	function login() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Login",
			'path'=> 'console/login',
			'page'=> 'console/login.php'
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

		$this->load->view($view_data['path'], $view_data);
	}

	function logout() {
		if($this->mod_manager->logout()) {
			redirect(base_url('console/login'));
		}
	}

	/* ************************************ *
	 *                                      *
	 *               Manager                *
	 *                                      *
	 * ************************************ */
	function manager_list() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Manager",
			'path'=> 'console/index',
			'page'=> 'manager_list.php',
			'menu'=> 'manager'
			);

		$view_data['list'] = $this->mod_manager->get_all();

		$this->load->view('console/layout', $view_data);
	}

	function manager_insert() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Manager",
			'path'=> 'console/index',
			'page'=> 'manager_insert.php',
			'menu'=> 'manager'
			);

		if($this->input->post('rule') == 'insert') {
			$dataArray = array(
				'email'=> $this->input->post('email'),
				'password'=> $this->input->post('password'),
				'nickname'=> $this->input->post('nickname'),
				'phone'=> $this->input->post('phone')
				);
			if($dataArray['email'] != '' && $dataArray['password'] != ''
				&& $dataArray['nickname'] != '' && $this->input->post('confirmPassword') != '') {
				
				if($dataArray['password'] === $this->input->post('confirmPassword')) {

					if(!$this->mod_manager->get_once_by_email($dataArray['email'])) {

						$dataArray['id'] = uniqid();
						$dataArray['password'] = sha1($dataArray['password']);
						$dataArray['create_date'] = date('Y-m-d');
						$dataArray['create_time'] = date('H:i:s');

						if($this->mod_manager->insert($dataArray)) {
							$view_data['sys_code'] = 200;
							$view_data['sys_msg'] = '新增成功！';
							redirect(base_url('console/manager'));
						}else{
							$view_data['sys_code'] = 404;
							$view_data['sys_msg'] = '新增失敗，發生錯誤。';
						}
					}else{
						$view_data['sys_code'] = 404;
						$view_data['sys_msg'] = '信箱重複。';
					}
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '密碼不一致。';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';
			}
		}
		$this->load->view('console/layout', $view_data);
	}

	function manager_update($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Manager",
			'path'=> 'console/index',
			'page'=> 'manager_update.php',
			'menu'=> 'manager'
			);
		if($this->input->post('rule') == 'update') {
			$dataArray = array(
				'email'=> $this->input->post('email'),
				'nickname'=> $this->input->post('nickname'),
				'phone'=> $this->input->post('phone')
				);
			if($dataArray['email'] != '' && $dataArray['nickname'] != '') {

				if(!$this->mod_manager->get_once_by_email($dataArray['email'])) {
					if(($this->input->post('password') != '' && $this->input->post('password') === $this->input->post('confirmPassword')) 
						|| $this->input->post('password') == '') {

						if( $this->input->post('password') != '' && $this->input->post('password') === $this->input->post('confirmPassword') ) {
							$dataArray['password'] = sha1($this->input->post('password'));
						}
					
						if($this->mod_manager->update($this->input->post('id'), $dataArray)) {
							$view_data['sys_code'] = 200;
							$view_data['sys_msg'] = '更新成功！';
							redirect(base_url('console/manager'));
						}else{
							$view_data['sys_code'] = 404;
							$view_data['sys_msg'] = '更新失敗，發生錯誤。';
						}
					}else{
						$view_data['sys_code'] = 404;
						$view_data['sys_msg'] = '密碼不一致。';
					}
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '信箱重複。';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';
			}
		}
		$view_data['res'] = $this->mod_manager->get_once($id);
		
		if($view_data['res']) {
			$this->load->view('console/layout', $view_data);
		}else{
			redirect(base_url('console/manager'));
		}
	}
}

?>