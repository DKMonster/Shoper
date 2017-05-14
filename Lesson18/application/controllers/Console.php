<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('mod_manager');
		$this->load->model('mod_member');
		$this->load->model('mod_category');
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
			'path'=> 'console/manager',
			'page'=> 'manager_list.php',
			'menu'=> 'manager'
			);

		$view_data['list'] = $this->mod_manager->get_all();

		$view_data['total'] = $this->mod_manager->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'], $view_data['total'], 10);

		$this->load->view('console/layout', $view_data);
	}

	function manager_insert() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Manager",
			'path'=> 'console/manager/insert',
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
			'path'=> 'console/manager/update/'.$id,
			'page'=> 'manager_update.php',
			'menu'=> 'manager'
			);
		if($this->input->post('rule') == 'update') {
			$id = $this->input->post('id');
			$dataArray = array(
				'email'=> $this->input->post('email'),
				'nickname'=> $this->input->post('nickname'),
				'phone'=> $this->input->post('phone')
				);
			if($dataArray['email'] != '' && $dataArray['nickname'] != '') {

				if(!$this->mod_manager->chk_repeat_email($id, $dataArray['email'])) {
					if(($this->input->post('password') != '' && $this->input->post('password') === $this->input->post('confirmPassword')) 
						|| $this->input->post('password') == '') {

						if( $this->input->post('password') != '' && $this->input->post('password') === $this->input->post('confirmPassword') ) {
							$dataArray['password'] = sha1($this->input->post('password'));
						}
					
						if($this->mod_manager->update($id, $dataArray)) {
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

	/* ************************************ *
	 *                                      *
	 *               Member                 *
	 *                                      *
	 * ************************************ */
	function member_list() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Member",
			'path'=> 'console/member',
			'page'=> 'member_list.php',
			'menu'=> 'member'
			);

		$view_data['list'] = $this->mod_member->get_all();

		$view_data['total'] = $this->mod_member->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'], $view_data['total'], 10);

		$this->load->view('console/layout', $view_data);
	}

	function member_insert() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Member",
			'path'=> 'console/member/insert',
			'page'=> 'member_insert.php',
			'menu'=> 'member'
			);

		if($this->input->post('rule') == 'insert') {
			$dataArray = array(
				'email'=> $this->input->post('email'),
				'password'=> $this->input->post('password'),
				'nickname'=> $this->input->post('nickname'),
				'phone'=> $this->input->post('phone'),
				'address'=> $this->input->post('address')
				);
			if($dataArray['email'] != '' && $dataArray['password'] != ''
				&& $dataArray['nickname'] != '' && $this->input->post('confirmPassword') != '') {
				
				if($dataArray['password'] === $this->input->post('confirmPassword')) {

					if(!$this->mod_member->get_once_by_email($dataArray['email'])) {

						$dataArray['id'] = uniqid();
						$dataArray['password'] = sha1($dataArray['password']);
						$dataArray['create_date'] = date('Y-m-d');
						$dataArray['create_time'] = date('H:i:s');

						if($this->mod_member->insert($dataArray)) {
							$view_data['sys_code'] = 200;
							$view_data['sys_msg'] = '新增成功！';
							redirect(base_url('console/member'));
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

	function member_update($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Manager",
			'path'=> 'console/member/update/'.$id,
			'page'=> 'member_update.php',
			'menu'=> 'member'
			);
		if($this->input->post('rule') == 'update') {
			$id = $this->input->post('id');
			$dataArray = array(
				'email'=> $this->input->post('email'),
				'nickname'=> $this->input->post('nickname'),
				'phone'=> $this->input->post('phone'),
				'address'=> $this->input->post('address')
				);
			if($dataArray['email'] != '' && $dataArray['nickname'] != '') {

				if(!$this->mod_member->chk_repeat_email($id, $dataArray['email'])) {
					if(($this->input->post('password') != '' && $this->input->post('password') === $this->input->post('confirmPassword')) 
						|| $this->input->post('password') == '') {

						if( $this->input->post('password') != '' && $this->input->post('password') === $this->input->post('confirmPassword') ) {
							$dataArray['password'] = sha1($this->input->post('password'));
						}
					
						if($this->mod_member->update($id, $dataArray)) {
							$view_data['sys_code'] = 200;
							$view_data['sys_msg'] = '更新成功！';
							redirect(base_url('console/member'));
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
		$view_data['res'] = $this->mod_member->get_once($id);
		
		if($view_data['res']) {
			$this->load->view('console/layout', $view_data);
		}else{
			redirect(base_url('console/member'));
		}
	}

	/* ************************************ *
	 *                                      *
	 *               Category               *
	 *                                      *
	 * ************************************ */
	function category_list() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Category",
			'path'=> 'console/category',
			'page'=> 'category_list.php',
			'menu'=> 'category'
			);

		$view_data['list'] = $this->mod_category->get_all();

		$view_data['total'] = $this->mod_category->get_total();

		$view_data['pagination'] = $this->pagination($view_data['path'], $view_data['total'], 10);

		$this->load->view('console/layout', $view_data);
	}

	function category_insert() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Category",
			'path'=> 'console/category/insert',
			'page'=> 'category_insert.php',
			'menu'=> 'category'
			);

		if($this->input->post('rule') == 'insert') {
			$dataArray = array(
				'type'=> $this->input->post('type')
				);
			if($dataArray['type'] != '') {
				$dataArray['id'] = uniqid();
				if($this->mod_category->insert($dataArray)) {
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '新增成功！';
					redirect(base_url('console/category'));
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '新增失敗，發生錯誤。';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';
			}
		}
		$this->load->view('console/layout', $view_data);
	}

	function category_update($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Console Category",
			'path'=> 'console/category/update/'.$id,
			'page'=> 'category_update.php',
			'menu'=> 'category'
			);
		if($this->input->post('rule') == 'update') {
			$id = $this->input->post('id');
			$dataArray = array(
				'type'=> $this->input->post('type')
				);
			if($dataArray['type'] != '') {
				if($this->mod_category->update($id, $dataArray)) {
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '更新成功！';
					redirect(base_url('console/category'));
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '更新失敗，發生錯誤。';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';
			}
		}
		$view_data['res'] = $this->mod_category->get_once($id);
		
		if($view_data['res']) {
			$this->load->view('console/layout', $view_data);
		}else{
			redirect(base_url('console/category'));
		}
	}

	/* ************************************ *
	 *                                      *
	 *               Pagination             *
	 *                                      *
	 * ************************************ */
	function pagination($uri, $total, $per) {
		// 載入分頁套件
		$this->load->library('pagination');

		$config['base_url'] = base_url($uri);
		$config['total_rows'] = $total;
		$config['per_page'] = $per;
		// 顯示實際頁面數
		$config['use_page_numbers'] = TRUE;
		// 實際顯示Page在網址上
		$config['page_query_string'] = TRUE;
		// 分頁的左右兩邊加入Tag標籤
		$config['full_tag_open'] = '<div class="ui right floated pagination menu">';
		$config['full_tag_close'] = '</div>';
		// 自訂起始分頁連結名稱
		$config['first_link'] = '第一頁';
		$config['first_tag_open'] = '<li class="item">';
		$config['first_tag_close'] = '</li>';
		// 自訂結束分頁連結名稱
		$config['last_link'] = '最後一頁';
		$config['last_tag_open'] = '<li class="item">';
		$config['last_tag_close'] = '</li>';
		// 自訂下一頁連結名稱
		$config['next_link'] = '<i class="right chevron icon"></i>';
		$config['next_tag_open'] = '<li class="icon item">';
		$config['next_tag_close'] = '</li>';
		// 自訂上一頁連結名稱
		$config['prev_link'] = '<i class="left chevron icon"></i>';
		$config['prev_tag_open'] = '<li class="icon item">';
		$config['prev_tag_close'] = '</li>';
		// 自訂目前分頁連結名稱
		$config['cur_tag_open'] = '<li class="item active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		// 自訂其他分頁連結名稱
		$config['num_tag_open'] = '<li class="item">';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
}

?>