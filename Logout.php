<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct() {
	   	parent::__construct();
    }

	
	public function index()
	{
		$user_role = $this->session->userdata('ep_user_role'); 
		if( $user_role == "super_admin")
		{	
			session_destroy();
			redirect(base_url('Login/SuperAdmin'));
		}
		else{
			session_destroy();
			redirect(base_url('Login'));
		}
	}
}