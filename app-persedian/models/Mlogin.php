<?php 

/**
* 
*/
class Mlogin extends CI_model
{
 
public function login_admin($username,$password)
	{
	 return $this->db->query("SELECT * FROM
	 	rn_admin where username='$username' AND password='$password'
	 	limit 1
	 	");
	}

}