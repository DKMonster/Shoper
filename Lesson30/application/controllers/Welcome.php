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

			if($this->mod_contact->insert($data)) {
				$view_data['sys_code'] = 200;
				$view_data['sys_msg'] = '訊息寄送成功';
			}else{
				$view_data['sys_code'] = 404;
				$view_data['sys_msg'] = '訊息寄送發生錯誤...';
			}
		}

		$view_data['cart'] = $this->cart->contents(true);

		$this->load->view('layout', $view_data);
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