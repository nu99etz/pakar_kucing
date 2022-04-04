<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maintence {

	private $ci;

	public function __construct() {
		$this->ci =& get_instance();
	}

	public function Debug($data) {
		
		if(is_array($data) || is_object($data)) {
			echo "<pre>";
			print_r($data);
			echo "</pre>";
		} else if(!is_array($data)){
			var_dump($data);
		}
		die();
	}
}
