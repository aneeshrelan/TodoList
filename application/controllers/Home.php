<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		
		if($this->input->post('login'))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run())
			{

				echo 'success';
			}
			else
			{
				$this->session->set_flashdata('error',true);
				$this->session->set_flashdata('msg',form_error('email','<p class="red-text center-align">','</p>') . form_error('password','<p class="red-text center-align">','</p>'));
				redirect('home/');
			}
		}
		else
		{
			echo 'no';
		}
	}

	public function register()
	{
		print_r($this->input->post());
	}
}
