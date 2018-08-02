<?php

class WishModel extends CI_Model {
	
	
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
       
        if(isset($param['item'])&& $param['item']!='')
        {
            $where .= " AND item_name like '%".$param['item']."%' ";
        }
        
        
      
        $comp_id = $this->session->userdata('ep_company_id');
		   
		$sql = "SELECT COUNT(id) AS TotalrecordCount FROM  `kf_wish_list` wish  left join `kf_user` user on wish.user_id=user.user_id left join `kf_item` item on wish.item_id=item.item_id left join `kf_unit_master` unit on wish.unit_id=unit.unit_id where 1 $where";

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
       
        if(isset($param['item'])&& $param['item']!='')
        {
            $where .= " AND item_name like '%".$param['item']."%' ";
        }
        

         $sql = "SELECT * FROM  kf_wish_list wish  left join kf_user user on wish.user_id=user.user_id left join kf_item item on wish.item_id=item.item_id left join kf_unit_master unit on wish.unit_id=unit.unit_id where 1 $where";
       
		  
                $recordSet = $this->db->query($sql);
                $data['result'] = $recordSet->result_array();
                return $data;


    }

    

    function edit_data($table,$field,$val,$update_val) {

       $this->db->where($field,$val)->update($table,$update_val);
    }

}
?>