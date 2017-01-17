<?php 


class Process extends CI_Model{


	function login()
	{

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


}


 ?>