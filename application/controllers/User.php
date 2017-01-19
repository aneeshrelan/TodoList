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
			$this->form_validation->set_rules('todo_deadline','Deadline','required|callback_date_check');

			if($this->form_validation->run())
			{
				$parsed = date_parse_from_format("j F, Y", $this->input->post('todo_deadline',TRUE));
				if(checkdate($parsed["month"], $parsed["day"], $parsed["year"]))
				{
					if($this->process->newTodo())
					{
						$this->session->set_flashdata('success',TRUE);
						$this->session->set_flashdata('msg','TODO Added');

						redirect('user/');
					}
					else
					{
						echo "Invalid Error Occurred. Could not add TODO";
						die();
					}
				}
				else
				{

					$this->session->set_flashdata('error_new',TRUE);
					$this->session->set_flashdata('msg',"<p class='red-text center-align'>Invalid Deadline Date</p>");
					$this->session->set_flashdata('title',$this->input->post('todo_title',TRUE));
					$this->session->set_flashdata('descr',$this->input->post('todo_descr',TRUE));
					$this->session->set_flashdata('deadline',$this->input->post('todo_deadline',TRUE));
					redirect('user/');
				}
				
			}
			else
			{
				$this->session->set_flashdata('error_new',TRUE);
				$this->session->set_flashdata('msg',validation_errors("<p class='red-text center-align'>","</p>"));
				$this->session->set_flashdata('title',$this->input->post('todo_title',TRUE));
				$this->session->set_flashdata('descr',$this->input->post('todo_descr',TRUE));
				$this->session->set_flashdata('deadline',$this->input->post('todo_deadline',TRUE));
				redirect('user/');
				

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

			$this->form_validation->set_message('date_check','Invalid Deadline Date Entered');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function getTodo()
	{
		if($this->input->is_ajax_request())
			echo $this->process->getTodo();
		else
			show_404();
	}

	public function completeToggle()
	{
		$todo_id = $this->input->post('id',TRUE);
		$value = $this->input->post('val',TRUE);
		$user_id = $this->session->userdata('id');

		echo $todo_id . "-" . $value . "-s" . $user_id;
	}




}