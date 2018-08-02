<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	public function index()
	{
		if(check_login())
		{
			$data['content']="dashboard";
			$this->load->view('layout_home',$data);
		}
	}
	
	/**
    * check  Login credential
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
	
	public function save()
	{
		if(check_login())
		{
		$data = $this->input->post();
		echo "<pre>";print_r($data);
		$md5_convert_data = md5(trim($data['Password']));
     	$salt_key = get_encript_id(trim($data['Password']));
        $password = $md5_convert_data.$salt_key;   
        if($data['captcha'] != $data['capcha_code'])
		{
			$this->session->set_flashdata('fail', 'Capcha not matched');
			redirect(base_url('Login/SuperAdmin'));
		}
		
		$login_details = $this->db->where('password',$password)->where('user_id',$data['email'])->get('ep_user')->result_array();
		//echo "<pre>";print_r($login_details);
		if(!empty($login_details))
		{
			$this->session->set_userdata('ep_login_session',true);
			$this->session->set_userdata('ep_user_id',$login_details[0]['id']);
			$this->session->set_userdata('ep_user_id',$login_details[0]['user_id']);
			$this->session->set_userdata('ep_user_role',$login_details[0]['role']);
			redirect(base_url('Dashboard'));
		}
		}
	}
}
