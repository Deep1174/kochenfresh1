<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		error_reporting(0);
        parent::__construct();
		$this->load->model('CommonModel');
    }

	/**
    * load Login page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       D.M 
    * @copyright    N/A
    * @link         inventory/login
    * @since        4.11.2016
    * @deprecated   N/A
    */

	public function SuperAdmin()
	{
		if($this->session->userdata('ep_login_session') == true)
		{
			redirect(base_url('Dashboard'));
		}
		else
		{
			$data['financial_year'] =$this->db->where('status',1)->get('ep_financial_year')->result_array();
			$this->load->view('login');
	    }
	}

	/**
    * load Login page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       M.K.Sah 
    * @copyright    N/A
    * @link         inventory/login
    * @since        16.11.2017
    * @deprecated   N/A
    */
    
	public function index()
	{
		if($this->session->userdata('ep_login_session') == true) {
			redirect(base_url('Dashboard'));
		} else {
			$this->load->view('admin_login');
	    }
	}
	
	
	/**
    * check  Login credential
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       M.K.Sah
    * @copyright    N/A
    * @link         inventory/login
    * @since        16.11.2017
    * @deprecated   N/A
    */
	
	public function save()
	{
		$data = $this->input->post();
		//echo "<pre>";print_r($data);exit();
		
		$md5_convert_data 	= md5(trim($data['Password']));
     	$salt_key 			= get_encript_id(trim($data['Password']));
        $password 			= $md5_convert_data.$salt_key;   
        if($data['captcha'] != $data['capcha_code'])
		{
			$this->session->set_flashdata('fail', 'Capcha not matched. Please try again.');
			if($data['super_admin'] == "super_admin")
			{
				redirect(base_url('Login/SuperAdmin'));
			}
			else{
				redirect(base_url('Login'));
			}
		}
		
		$login_details = $this->db->where('password',$password)->where('user_id',$data['email'])->get('kf_admin_user')->result_array();
		//echo "<pre>";print_r($login_details);exit();
		
		if(!empty($login_details))
		{
			if($data['super_admin'] == "super_admin" && $login_details[0]['role']=="admin")
			{
				$this->session->set_flashdata('fail', 'Super admin credential not matched .');
				redirect(base_url('Login/SuperAdmin'));
			}
			$this->session->set_userdata('kf_login_session',true);
			$this->session->set_userdata('kf_user_id',$login_details[0]['id']);
			$this->session->set_userdata('kf_email',$login_details[0]['user_id']);
			$this->session->set_userdata('kf_user_role',$login_details[0]['role']);
			
			redirect(base_url('Dashboard'));
		}
		else
		{
			$this->session->set_flashdata('fail', 'Admin credential not matched .');
			redirect(base_url('Login'));
		}
	}
}
