<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		//unauthorized access without log-in, redirect to home

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
		//destroy session to properly logout
		session_destroy();
		redirect('home/');
	}

	public function newTodo()
	{
		//check if new todo form POSTed
		if($this->input->post('todo_submit'))
		{
			$this->load->library('form_validation');

			//validation rules - Title required and date picked from datepicker

			$this->form_validation->set_rules('todo_title','Title','required');
			$this->form_validation->set_rules('todo_deadline','Deadline','required|callback_date_check');

			if($this->form_validation->run())
			{
				//data validation - success


				//check if selected date is a valid one
				$parsed = date_parse_from_format("j F, Y", $this->input->post('todo_deadline',TRUE));
				if(checkdate($parsed["month"], $parsed["day"], $parsed["year"]))
				{
					//date is valid
					if($this->process->newTodo())
					{
						//todo added to database
						$this->session->set_flashdata('success',TRUE);
						$this->session->set_flashdata('msg','TODO Added');

						redirect('user/');
					}
					else
					{
						//database insert error for new todo
						echo "Invalid Error Occurred. Could not add TODO";
						die();
					}
				}
				else
				{
					//invalid date submitted

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
				//data validation - fail

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
			//function access without form post
			redirect('user/');
		}
	}

	function date_check($str)
	{
		//callback function for date check by regex: DD MonthName, Year

		if(1 !== preg_match('/[0-9]{1,2}\s(January|February|March|April|May|June|July|August|September|October|November|December),\s[0-9]{4}/',$str))
		{

			//date not as per regex

			$this->form_validation->set_message('date_check','Invalid Deadline Date Entered');
			return FALSE;
		}
		else
		{
			//date regex validated
			return TRUE;
		}
	}

	function getTodo()
	{
		//allow only ajax calls to this function, if not show 404 error

		if($this->input->is_ajax_request())
			echo $this->process->getTodo();
		else
			show_404();
	}

	public function completeToggle()
	{
		//allow only ajax calls, else 404
		if($this->input->is_ajax_request())
		{
			$todo_id = $this->input->post('id',TRUE);
			$value = $this->input->post('val',TRUE);

			if($value == "0" || $value == "1")
			{
				//value can be 0 or 1, not completed or completed respectively

				if($this->process->completeToggle($todo_id, $value))
				{
					//echo 1 for success
					echo "1";
				}
				else
				{
					//echo 0 for fail
					echo "0";
				}
			}
			else
			{
				//invalid value, echo 0 for fail
				echo "0";
			}
		}
		else
			show_404();
	}

	public function deleteTodo()
	{
		//allow only ajax calls
		if($this->input->is_ajax_request())
		{

			$todo_id = $this->input->post('id',TRUE);

			if($this->process->deleteTodo($todo_id))
			{
				//delete successfull, echo 1 for success
				echo "1";
			}
			else
			{
				//delete fail, echo 0 for failure
				echo "0";
			}
		}
		else
			show_404();
	}

	public function editTodo()
	{
		//check if edit form POSTed
		if($this->input->post('todo_submit'))
		{
			$this->load->library('form_validation');

			//title required for editing
			$this->form_validation->set_rules('todo_title','Title','required');
			$this->form_validation->set_rules('todo_deadline','Deadline','required|callback_date_check');


			if($this->form_validation->run())
			{
				//data validation success

				//check date for valid format from datepicker
				$parsed = date_parse_from_format("j F, Y", $this->input->post('todo_deadline',TRUE));
				if(checkdate($parsed["month"], $parsed["day"], $parsed["year"]))
				{
					//valid date

					if($this->process->editTodo())
					{
						//edit todo successfull	

						$this->session->set_flashdata('success',TRUE);
						$this->session->set_flashdata('msg','TODO Modified');

						redirect('user/');
					}
					else
					{
						//edit todo failure

						echo "Invalid Error Occurred. Could not modify TODO";
						die();
					}
				}
				else
				{
					//date not as per format

					$this->session->set_flashdata('error_edit',TRUE);
					$this->session->set_flashdata('msg',"<p class='red-text center-align'>Invalid Deadline Date</p>");
					$this->session->set_flashdata('title',$this->input->post('todo_id',TRUE));
					$this->session->set_flashdata('title',$this->input->post('todo_title',TRUE));
					$this->session->set_flashdata('descr',$this->input->post('todo_descr',TRUE));
					$this->session->set_flashdata('deadline',$this->input->post('todo_deadline',TRUE));
					redirect('user/');
				}
				
			}
			else
			{
				//data validation - fail

				$this->session->set_flashdata('error_edit',TRUE);
				$this->session->set_flashdata('msg',validation_errors("<p class='red-text center-align'>","</p>"));
				$this->session->set_flashdata('title',$this->input->post('todo_id',TRUE));
				$this->session->set_flashdata('title',$this->input->post('todo_title',TRUE));
				$this->session->set_flashdata('descr',$this->input->post('todo_descr',TRUE));
				$this->session->set_flashdata('deadline',$this->input->post('todo_deadline',TRUE));
				redirect('user/');
				

			}
		}
		else
		{
			//function access without form post
			redirect('user/');
		}
	}




}