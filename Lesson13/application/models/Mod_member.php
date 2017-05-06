<?php

class Mod_member extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	function insert($name) {
		return $this->db->insert('member', array('name'=> $name));
	}
}

?>