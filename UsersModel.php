<?php

class UsersModel extends CI_Model {
	
	
	function __construct()
    {
        parent::__construct();		
    }
 

    function record_count($param)
    {
        $data=[];
        $where = '';
      if(isset($param['name'])&& $param['name']!='')
        {
            $where .= " AND name  like '%".$param['name']."%' ";
        }
       if(isset($param['lastname'])&& $param['lastname']!='')
        {
            $where .= " AND lastname  like '%".$param['lastname']."%' ";
        }
       
        if(isset($param['email'])&& $param['email']!='')
        {
            $where .= " AND email like '%".$param['email']."%' ";
        }
        if(isset($param['status'])&& $param['status']!='')
        {
            $where .= " AND status like '%".$param['status']."%' ";
        }
        
      
           $comp_id = $this->session->userdata('ep_company_id');
		   
			     $sql = "SELECT COUNT(DISTINCT user_id) AS TotalrecordCount FROM  `kf_user`    WHERE  1   $where";

        
       
     
        $recordSet = $this->db->query($sql);
            if ($recordSet)
            {
                $row = $recordSet->row();
                $total_rows = $row->TotalrecordCount;
            } 
            
        return $total_rows;
    }
    
    public function all_data_list($limit,$start,$param)
    {
        $data=[];
        $where = '';
       // echo"<pre>";print_r($param);
        if(isset($param['name'])&& $param['name']!='')
        {
            $where .= " AND name  like '%".$param['name']."%' ";
        }
        if(isset($param['lastname'])&& $param['lastname']!='')
        {
            $where .= " AND lastname  like '%".$param['lastname']."%' ";
        }
       
        if(isset($param['email'])&& $param['email']!='')
        {
            $where .= " AND email like '%".$param['email']."%' ";
        }
        if(isset($param['status'])&& $param['status']!='')
        {
            $where .= " AND status like '%".$param['status']."%' ";
        }
       
        
			$sql="SELECT * FROM `kf_user` where 1   $where  ORDER BY user_id DESC LIMIT ".$start.",".$limit ;
		  
                $recordSet = $this->db->query($sql);
                $data['result'] = $recordSet->result_array();
                return $data;


    }

    

    function edit_data($table,$field,$val,$update_val) {

       $this->db->where($field,$val)->update($table,$update_val);
    }

}
?>