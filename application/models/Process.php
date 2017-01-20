<?php 


class Process extends CI_Model{


	//login function
	function login()
	{
		$email = $this->input->post('email',TRUE);
		$pass = sha1($this->input->post('password'));	//store pass as sha1 hash

		$this->db->select('id,fname');
		$query = $this->db->get_where('users',array('email' => $email, 'password' => $pass));

		if($query->num_rows() == 1)
		{
			//if unique row (single row) exists, login success, return id and fname
			return $query->row_array();
			
		}
		
		//no match found, return null
		return null;

	}

	function register()
	{
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$pass = $this->input->post('password');

		$data = array('fname' => $fname,
					  'lname' => $lname,
					  'email' => $email,
					  'password' => sha1($pass));

		//check if email already exists
		$query = $this->db->get_where('users',array('email' => $email));

		if($query->num_rows() > 0)
		{
			//email address exists in db, return -1
			return -1;
		}
		else
		{
			if($this->db->insert('users',$data) == 1)
			{
				//db insert success, return 1 for success
				return 1;
			}
			else
			{
				//db insert fail, return 0 for fail
				return 0;
			}
		}
	}


	function newTodo()
	{
		$title = $this->input->post('todo_title',TRUE);
		$descr = $this->input->post('todo_descr',TRUE);

		//convert date from datepicker form to YYYY-MM-DD for database
		$deadline = DateTime::createFromFormat("j F, Y", $this->input->post('todo_deadline',TRUE))->format('Y-m-d');




		$user_id = $this->session->userdata('id');

		$data = array('user_id' => $user_id,
					  'title' => $title,
					  'description' => $descr,
					  'deadline' => $deadline);

		if($this->db->insert('todos',$data) == 1)
		{
			//db insert success, return true for success
			return TRUE;
		}
		else
		{
			//db insert fail, return false for failure
			return FALSE;
		}
	}

	//get all todos of the user
	function getTodo()
	{
		

		$user_id = $this->session->userdata('id');


		$query = $this->db->get_where('todos', array('user_id' => $user_id));


		//return json form for ajax parsing
		return json_encode($query->result_array());
	}

	//mark todo as completed
	function completeToggle($todo_id, $value)
	{


		$user_id = $this->session->userdata('id');

		$this->db->where('user_id',$user_id)->where('id',$todo_id);
		$this->db->update('todos',array('completed' => $value));

		if($this->db->affected_rows() == 1)
		{
			//completed value changed in db, return true for success
			return TRUE;
		}
		else
		{
			//completed value change failure, return false for failure
			return FALSE;
		}

	}

	//delete todo
	function deleteTodo($todo_id)
	{
		$user_id = $this->session->userdata('id');

		$this->db->where('user_id',$user_id)->where('id',$todo_id);
		$this->db->delete('todos');

		if($this->db->affected_rows() == 1)
		{
			//db row deleted, return true for success
			return TRUE;
		}
		else
		{
			//db row delete failure, return true for success
			return FALSE;
		}
	}


	//modify todo data
	function editTodo()
	{
		$todo_id = $this->input->post('todo_id',TRUE);
		$user_id = $this->session->userdata('id');

		$title = $this->input->post('todo_title',TRUE);
		$descr = $this->input->post('todo_descr',TRUE);

		//convert date from datepicker form to YYYY-MM-DD for database
		$deadline = DateTime::createFromFormat("j F, Y", $this->input->post('todo_deadline',TRUE))->format('Y-m-d');	


		$data = array('title' => $title,
					  'description' => $descr,
					  'deadline' => $deadline);

		$this->db->where("user_id",$user_id)->where('id',$todo_id);
		$this->db->update('todos',$data);


		if($this->db->affected_rows() == 1)
		{
			//db update success, return true
			return TRUE;
		}
		else
		{
			//db update failure, return falseg
			return FALSE;
		}

	}


}


 ?>