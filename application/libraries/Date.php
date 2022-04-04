<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Date {

	private $ci;

	public function __construct() {
      $this->ci =& get_instance();
    }

    public function getMonthNameENGarray() {
    	$month[1] = 'January';
    	$month[2] = 'February';
    	$month[3] = 'March';
    	$month[4] = 'April';
    	$month[5] = 'May';
    	$month[6] = 'June';
    	$month[7] = 'July';
    	$month[8] = 'August';
    	$month[9] = 'Septembre';
    	$month[10] = 'October';
    	$month[11] = 'November';
    	$month[12] = 'December';
    	return $month;
	}
	
	public function getMonthNameIDNarray() {
    	$month[1] = 'Januari';
    	$month[2] = 'Februari';
    	$month[3] = 'Maret';
    	$month[4] = 'April';
    	$month[5] = 'Mei';
    	$month[6] = 'Juni';
    	$month[7] = 'Juli';
    	$month[8] = 'Agustus';
    	$month[9] = 'September';
    	$month[10] = 'Oktober';
    	$month[11] = 'November';
    	$month[12] = 'Desember';
    	return $month;
	}

	public function getDateNameIDNarray($no = null) {
		$date[1] = "Minggu";
		$date[2] = "Senin";
		$date[3] = "Selasa";
		$date[4] = "Rabu";
		$date[5] = "Kamis";
		$date[6] = "Jum'at";
		$date[7] = "Sabtu";
		if(!empty($no)) {
			return $date[$no];
		} else if(empty($no)) {
			return $date;
		}
	}

    public function ordinal($number) {
    	$ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13))
	        return $number. 'th';
	    else
	        return $number. $ends[$number % 10];
    }

    public function getDate($lang,$data) {
    	$ex = explode('-',$data);
    	if($lang == 'ENG') {
    		$month = $this->getMonthNameENGarray();
    		return $month[(int) $ex[1]].' '.$this->ordinal((int) $ex[2]).', '.$ex[0];
    	}
    }
}