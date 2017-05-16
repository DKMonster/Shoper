<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('mod_manager');
	}
}

?>