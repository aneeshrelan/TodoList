<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		print_r($this->input->post());
	}

	public function register()
	{
		print_r($this->input->post());
	}
}
