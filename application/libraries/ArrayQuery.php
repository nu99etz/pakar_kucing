<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ArrayQuery {

	private $ci;

	public function __construct() {
      $this->ci =& get_instance();
    }

    public function arrQuery($data,$showboth = false) {
    	$a_return = array();
    	foreach($data as $datas) {
    		list(, $t_col) = @each($datas);
    		if(count($datas) > 1) {
    			list(, $t_val) = each($datas);
    		} else {
    			$t_val = $t_col;
    		}
    		$a_return[$t_col] = ($showboth ? $t_col . ' - ' : '') . $t_val;
    	}

    	return $a_return;
    }
}