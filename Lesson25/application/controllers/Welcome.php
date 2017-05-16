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

		$this->load->view('layout', $view_data);
	}

	function about() {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - News",
			'path'=> 'about',
			'page'=> 'about.php',
			'menu'=> 'about'
			);

		$this->load->view('layout', $view_data);
	}

	function products($id) {
		// 頁面資訊
		$view_data = array(
			'title'=> "Shoper - Products",
			'path'=> 'products',
			'page'=> 'products.php',
			'menu'=> 'products'
			);

		$view_data['category_link'] = $id;

		$view_data['list'] = $this->mod_product->get_products_all($id);

		$view_data['total'] = $this->mod_product->get_products_total($id);

		$view_data['pagination'] = $this->pagination($view_data['path'], $view_data['total'], 10);

		$view_data['category'] = $this->mod_category->get_all();

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