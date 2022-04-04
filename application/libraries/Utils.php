<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utils {

	private $ci;

	public function __construct() {
      $this->ci =& get_instance();
    }

    public function SendEmail($html,$sender,$sender_password,$sender_from,$subject,$send_to) {

    	$this->ci->load->library('email');
    	$config['mailtype'] = 'html';
	    $config['protocol'] = 'smtp';
	    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
	    $config['smtp_user'] = $sender;
	    $config['smtp_pass'] = $sender_password;
	    $config['smtp_port'] = 465;
	    $config['newline'] = "\r\n";
	    $config['charset'] = 'utf-8';

	    $this->ci->email->initialize($config);
	    $this->ci->email->from($sender, $sender_from);
	    $this->ci->email->to(strtolower($send_to));
	    $this->ci->email->subject($subject);
	    $this->ci->email->message($html);
    	$send = $this->ci->email->send();

    	return $send;


    }

    public function IDRtoDollar($total) {

    	$dollar = $total / 14601;
    	return (float) $dollar;
    }

    public function explode2($data) {

    	$this->ci->load->model('UsersModel','Users');
    	$temp = array();
    	$exp = explode(',',$data);
    	foreach($exp as $key => $value) {
    		$temp[] = $this->ci->Users->AdditionalCost($value);
    	}

    	$imp = implode(',',$temp);
    	return $imp;
    	//$this->ci->maintence->Debug($temp);
    }
}