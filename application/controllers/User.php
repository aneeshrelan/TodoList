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

	public function newTodo()
	{
		if($this->input->post('todo_submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('todo_title','Title','required');
			$this->form_validation->set_rules('todo_deadline','Deadline','callback_date_check');

			if($this->form_validation->run())
			{
				print_r($this->input->post());
			}
			else
			{
				echo validation_errors();
								print_r($this->input->post());

			}
		}
		else
		{
			redirect('user/');
		}
	}

	function date_check($str)
	{
		if(1 !== preg_match('/[0-9]{1,2}\s(January|February|March|April|May|June|July|August|September|October|November|December),\s[0-9]{4}/',$str))
		{
			$parsed = date_parse_from_format("j F, Y",$str);
			if(!checkdate($parsed["month"], $parsed["day"], $parsed["year"]))
			{
				$this->form_validation->set_message('date_check','Invalid Deadline Date Entered');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}


}