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
			$this->session->set_flashdata('error',true);
			$this->session->set_flashdata('msg','Woah! Something went wrong');
			redirect('home/');
		}
	}

	public function register()
	{
		if($this->input->post('register'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('fname','First Name','required');
			$this->form_validation->set_rules('lname','Last Name','required');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run())
			{
				echo 'success';
			}
			else
			{
				$this->session->set_flashdata('error',true);
				$this->session->set_flashdata('register',true);
				$this->session->set_flashdata('fname',form_error('fname','<p class="red-text">','</p>'));
				$this->session->set_flashdata('lname',form_error('lname','<p class="red-text">','</p>'));
				$this->session->set_flashdata('email',form_error('email','<p class="red-text">','</p>'));
				$this->session->set_flashdata('password',form_error('password','<p class="red-text">','</p>'));

				redirect('home/');
			}
		}
		else
		{
			redirect('home/');
		}
	}
}
