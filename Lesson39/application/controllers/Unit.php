<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('mod_manager');
	}

	// function sendMail() {
	// 	$this->email->from('service@shoper.com', 'Service');
	// 	$this->email->to('mylyfwy771@gmail.com');

	// 	$this->email->subject('測試Email');
	// 	$this->email->message('這是一封測試的Email');

	// 	$this->email->send();
	// }
}

?>