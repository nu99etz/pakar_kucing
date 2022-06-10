<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class DashboardController extends MainController
{
    public function index()
	{
		if (!$this->session->userdata('logged')) {
            redirect('auth/');
        }
        $layout = 'dashboard/index';
		$this->getLayout($layout);
	}
}