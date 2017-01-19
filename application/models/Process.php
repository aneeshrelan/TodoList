<?php 


class Process extends CI_Model{


	function login()
	{
		$email = $this->input->post('email',TRUE);
		$pass = sha1($this->input->post('password'));

		$this->db->select('id');
		$query = $this->db->get_where('users',array('email' => $email, 'password' => $pass));

		if($query->num_rows() == 1)
		{
			return $query->row('id');
		}
		
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

		$query = $this->db->get_where('users',array('email' => $email));

		if($query->num_rows() > 0)
		{
			return -1;
		}
		else
		{
			if($this->db->insert('users',$data) == 1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}


	function newTodo()
	{
		$title = $this->input->post('todo_title',TRUE);
		$descr = $this->input->post('todo_descr',TRUE);
		$deadline = DateTime::createFromFormat("j F, Y", $this->input->post('todo_deadline',TRUE))->format('Y-m-d');




		$user_id = $this->session->userdata('id');

		$data = array('user_id' => $user_id,
					  'title' => $title,
					  'description' => $descr,
					  'deadline' => $deadline);

		if($this->db->insert('todos',$data) == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getTodo()
	{
		$user_id = $this->session->userdata('id');


		$query = $this->db->get_where('todos', array('user_id' => $user_id));

		return json_encode($query->result_array());
	}

	function completeToggle($todo_id, $value)
	{
		$user_id = $this->session->userdata('id');

		// $this->db->where('user_id',$user_id)->where('id',$todo_id);
		// $this->db->update('todos',array('completed' => $value));

		echo $todo_id + " " + $user_id + " " + $value;		

	}


}


 ?>