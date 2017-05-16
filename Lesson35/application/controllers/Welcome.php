<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('mod_product');
		$this->load->model('mod_news');
		$this->load->model('mod_category');
		$this->load->model('mod_order');
		$this->load->model('mod_contact');
		$this->load->model('mod_qa');
		$this->load->model('mod_member');
	}

	function index() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper",
			'path'=> 'store',
			'page'=> 'store.php',
			'menu'=> 'store'
			);

		$view_data['feature'] = $this->mod_product->get_feature();

		$view_data['cart'] = $this->cart->contents(true);

		$this->load->view('layout', $view_data);
	}

	function news() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - News",
			'path'=> 'news',
			'page'=> 'news.php',
			'menu'=> 'news'
			);

		$view_data['news'] = $this->mod_news->get_news();

		$view_data['cart'] = $this->cart->contents(true);

		$this->load->view('layout', $view_data);
	}

	function about() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - About",
			'path'=> 'about',
			'page'=> 'about.php',
			'menu'=> 'about'
			);

		$view_data['cart'] = $this->cart->contents(true);

		$this->load->view('layout', $view_data);
	}

	function products($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Products",
			'path'=> 'products'.'/'.$id,
			'page'=> 'products.php',
			'menu'=> 'products'
			);

		$limit = 2;

		if($this->input->get('per_page')) {
			$pervious = $this->input->get('per_page');
		}else{
			$pervious = 1;
		}

		$view_data['category_link'] = $id;

		$view_data['list'] = $this->mod_product->get_products_all($id, $limit, $pervious);

		$view_data['total'] = $this->mod_product->get_products_total($id);

		$view_data['pagination'] = $this->pagination($view_data['path'], $view_data['total'], $limit);

		$view_data['category'] = $this->mod_category->get_all();
		$view_data['total_all'] = $this->mod_product->get_total();

		$view_data['cart'] = $this->cart->contents(true);

		$this->load->view('layout', $view_data);
	}

	function product($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Product",
			'path'=> 'product',
			'page'=> 'product.php',
			'menu'=> 'product'
			);

		$view_data['product'] = $this->mod_product->get_once($id);

		$view_data['image_list'] = $this->mod_product->get_image_list($id);

		$view_data['cart'] = $this->cart->contents(true);

		if($view_data['product']) {
			$this->load->view('layout', $view_data);
		}else{
			redirect(base_url());
		}
	}

	function order() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Order",
			'path'=> 'order',
			'page'=> 'order.php',
			'menu'=> 'order'
			);

		if($this->input->post('rule') == 'order') {
			$cart = $this->cart->contents(true);

			$dataOrderMain = array(
				'id'=> uniqid(),
				'buy_name'=> $this->input->post('order_name'),
				'buy_phone'=> $this->input->post('order_phone'),
				'buy_email'=> $this->input->post('order_email'),
				'buy_addr'=> $this->input->post('order_addr'),
				'buy_remark'=> $this->input->post('order_remark'),
				'payment'=> 1,
				'create_date'=> date('Y-m-d'),
				'create_time'=> date('H:i:s'),
				'update_date'=> date('Y-m-d'),
				'update_time'=> date('H:i:s')
				);
			if(sizeof($cart) == 0) {
				$view_data['sys_code'] = 500;
				$view_data['sys_msg'] = '您的購物車尚無任何商品。';
			}else{
				if($dataOrderMain['buy_name'] != '' && $dataOrderMain['buy_phone'] != '' 
					&& $dataOrderMain['buy_email'] != '' && $dataOrderMain['buy_addr'] != '') {

					foreach ($cart as $key => $value) {
						# code...
						$dataOrderSub[$key]['id'] = uniqid();
						$dataOrderSub[$key]['order_id'] = $dataOrderMain['id'];
						$dataOrderSub[$key]['product_id'] = $value['id'];
						$dataOrderSub[$key]['product_name'] = $value['name'];
						$dataOrderSub[$key]['product_price'] = $value['qty'];
						$dataOrderSub[$key]['product_qty'] = $value['price'];
						$dataOrderSub[$key]['product_photo'] = $value['options']['image'];
					}

					$this->mod_order->insert($dataOrderMain);
					$this->mod_order->insert_sub($dataOrderSub);
					$this->cart->destroy();

					redirect(base_url('complete/'.$dataOrderMain['id']));
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '您的表單尚未填寫完成。';
				}
			}
		}

		$view_data['cart'] = $this->cart->contents(true);

		$this->load->view('layout', $view_data);
	}

	function complete($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Complete",
			'path'=> 'complete',
			'page'=> 'complete.php',
			'menu'=> 'complete'
			);

		if($this->mod_order->chk_exist($id)) {

			$view_data['order'] = $this->mod_order->get_once($id);

			$view_data['cart'] = $this->cart->contents(true);

			$this->load->view('layout', $view_data);
			
		}else{
			redirect(base_url('store'));
		}
	}

	function contact() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Contact",
			'path'=> 'contact',
			'page'=> 'contact.php',
			'menu'=> 'contact'
			);

		if($this->input->post('rule') == 'send') {
			$data = array(
				'id'=> uniqid(),
				'name'=> $this->input->post('name'),
				'phone'=> $this->input->post('phone'),
				'email'=> $this->input->post('email'),
				'message'=> $this->input->post('message'),
				'create_date'=> date('Y-m-d'),
				'create_time'=> date('H:i:s')
				);

			if($data['name'] != '' && $data['phone'] != '' && $data['email'] != '' && $data['message'] != '') {
				if($this->mod_contact->insert($data)) {
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '訊息寄送成功';
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '訊息寄送發生錯誤...';
				}
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '您的表單尚未填寫完成。';
			}

		}

		$view_data['cart'] = $this->cart->contents(true);

		$this->load->view('layout', $view_data);
	}

	function qa() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Q&A",
			'path'=> 'qa',
			'page'=> 'qa.php',
			'menu'=> 'qa'
			);

		$view_data['cart'] = $this->cart->contents(true);

		$view_data['qa'] = $this->mod_qa->get_all();

		$this->load->view('layout', $view_data);
	}

	function search() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Search",
			'path'=> 'search',
			'page'=> 'search.php',
			'menu'=> 'search'
			);

		if($this->input->get('rule') == 'search') {
			$id = $this->input->get('id');

			if($this->mod_order->chk_exist($id)) {

				$view_data['order'] = $this->mod_order->get_once($id);

				$view_data['sys_code'] = 200;
				$view_data['sys_msg'] = '查詢成功...';

			}else{

				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '查無此訂單...';

			}
		}

		$view_data['cart'] = $this->cart->contents(true);

		$this->load->view('layout', $view_data);
	}

	function login() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Login",
			'path'=> 'login',
			'page'=> 'login.php',
			'menu'=> 'login'
			);

		if($this->mod_member->chk_login_status()) {
			redirect(base_url('member'));
		}else{
			if($this->input->post('rule') == 'login') {
				$email = $this->input->post('email');
				$password = $this->input->post('pwd');

				if($this->mod_member->chk_login($email, $password)) {
					$this->mod_member->do_login($email);
					$view_data['sys_code'] = 200;
					$view_data['sys_msg'] = '登入成功！';
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '登入失敗...信箱密碼錯誤。';
				}
			}

			$view_data['cart'] = $this->cart->contents(true);

			$this->load->view('layout', $view_data);
		}
	}

	function register() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Register",
			'path'=> 'register',
			'page'=> 'register.php',
			'menu'=> 'register'
			);

		if($this->mod_member->chk_login_status()) {
			redirect(base_url('member'));
		}else{
			if($this->input->post('rule') == 'register') {
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
								$this->mod_member->do_login($dataArray['email']);
								redirect(base_url('member'));
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

			$view_data['cart'] = $this->cart->contents(true);

			$this->load->view('layout', $view_data);
		}
	}

	function logout() {
		if($this->mod_member->logout()) {
			redirect(base_url('login'));
		}
	}

	function forget() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Forget",
			'path'=> 'forget',
			'page'=> 'forget.php',
			'menu'=> 'forget'
			);

		if($this->mod_member->chk_login_status()) {
			redirect(base_url('member'));
		}else{

			if($this->input->post('rule') == 'forget') {
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$user = $this->mod_member->get_once_by_email($email);
				if($email != '' && $phone != '') {
					if($user) {
						if($user['phone'] == $phone) {
							$this->session->set_flashdata('newpwd', $user['id']);
							$view_data['sys_code'] = 200;
							$view_data['sys_msg'] = '驗證完成，請嘗試輸入新密碼。';
						}else{
							$view_data['sys_code'] = 404;
							$view_data['sys_msg'] = '手機輸入錯誤...';
						}
					}else{
						$view_data['sys_code'] = 404;
						$view_data['sys_msg'] = '查無此信箱...';
					}
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '您的表單尚未填寫完成。';
				}
			}else if($this->input->post('rule') == 'new') {
				$id = $this->input->post('id');
				$user = $this->mod_member->get_once($id);
				if($user) {
					$dataArray = array('password'=> $this->input->post('password'));
					if($dataArray['password'] != '' && $this->input->post('confirmPassword') != '') {
						
						if($dataArray['password'] === $this->input->post('confirmPassword')) {
							$dataArray['password'] = sha1($dataArray['password']);

							if($this->mod_member->update($id, $dataArray)) {
								$view_data['sys_code'] = 200;
								$view_data['sys_msg'] = '密碼更新成功，請透過新密碼進行登入。';
							}else{
								$view_data['sys_code'] = 500;
								$view_data['sys_msg'] = '發生錯誤，更新失敗。';
							}
						}else{
							$view_data['sys_code'] = 404;
							$view_data['sys_msg'] = '密碼不一致。';
						}
					}else{
						$view_data['sys_code'] = 404;
						$view_data['sys_msg'] = '您的表單尚未填寫完成。';
					}
				}else{
					$view_data['sys_code'] = 404;
					$view_data['sys_msg'] = '發生錯誤，查無此用戶...';
				}
			}


			$view_data['cart'] = $this->cart->contents(true);

			$this->load->view('layout', $view_data);
		}
	}

	function member() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Member",
			'path'=> 'member',
			'page'=> 'member.php',
			'menu'=> 'member'
			);

		if($this->mod_member->chk_login_status()) {
			$view_data['cart'] = $this->cart->contents(true);

			$this->load->view('layout', $view_data);
		}else{
			redirect(base_url('login'));
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