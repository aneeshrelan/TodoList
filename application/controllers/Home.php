<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('logged'))
		{
			redirect('user/');
		}
	}

	public function index()
	{
		
		$this->load->view('login');
	}

	public function login()
	{
		//check if form POSTed
		if($this->input->post('login'))
		{
			$this->load->library('form_validation'); //load form validation library


			// check for valid email address and required email & password
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');


			if($this->form_validation->run())
			{
				//data validation success

				$result = $this->process->login();

				if($result != null)
				{ 
					//email-pass match, set session with name and userid

					$this->session->set_userdata('logged',true);
					$this->session->set_userdata('id',$result["id"]);
					$this->session->set_userdata('fname',$result["fname"]);

					redirect('user/');
				}
				else
				{
					//login failed - incorrect email/password
					
					$this->session->set_flashdata('error',true);
					$this->session->set_flashdata('msg','<p class="red-text center-align">Email and Password do not match</p>');
					redirect('home/');
				}
			}
			else
			{
				//data validation - fail

				$this->session->set_flashdata('error',true);
				$this->session->set_flashdata('msg',form_error('email','<p class="red-text center-align">','</p>') . form_error('password','<p class="red-text center-align">','</p>'));
				redirect('home/');
			}
		}
		else
		{
			// function access without form post
			$this->session->set_flashdata('error',true);
			$this->session->set_flashdata('msg','Woah! Something went wrong');
			redirect('home/');
		}
	}

	public function register()
	{
		//check if register form POSTed
		if($this->input->post('register'))
		{
			$this->load->library('form_validation');

			//all fields required, check for valid email address and confirm password match

			$this->form_validation->set_rules('fname','First Name','required');
			$this->form_validation->set_rules('lname','Last Name','required');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('cnfPassword','Password Confirmation','required|matches[password]');


			if($this->form_validation->run())
			{
				//data validation - success

				switch ($this->process->register()) {
					case -1:
							//email address already exists error

							$this->session->set_flashdata('error',true);
							$this->session->set_flashdata('register',true);
							$this->session->set_flashdata('msg',"Email Address already exists.");
							redirect('home/');
						break;


					case 0:
							//failed to insert in database

							$this->session->set_flashdata('error',true);
							$this->session->set_flashdata('register',true);
							$this->session->set_flashdata('msg', "Invalid Error Occurred. Try Again");
						break;


					case 1:
							//registration successfull

						$this->session->set_flashdata('success',true);
						redirect('home/');
						break;
				}
			}
			else
			{
				//data validation - fail

				$this->session->set_flashdata('error',true);
				$this->session->set_flashdata('register',true);
				$this->session->set_flashdata('fname',form_error('fname','<p class="red-text">','</p>'));
				$this->session->set_flashdata('lname',form_error('lname','<p class="red-text">','</p>'));
				$this->session->set_flashdata('email',form_error('email','<p class="red-text">','</p>'));
				$this->session->set_flashdata('password',form_error('password','<p class="red-text">','</p>'));
				$this->session->set_flashdata('cnfPassword',form_error('cnfPassword','<p class="red-text">','</p>'));

				redirect('home/');
			}
		}
		else
		{
			//function access without form post
			redirect('home/');
		}
	}
}
