<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged'))
		{
			redirect('home/');
		}
	}

	public function index()
	{
		$this->load->view('userHome');
	}

	public function logout()
	{
		session_destroy();
		redirect('home/');
	}


}