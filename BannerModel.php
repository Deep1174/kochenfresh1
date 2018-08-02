<?php

class BannerModel extends CI_Model {
    
    
    function __construct()
    {
        parent::__construct();      
    }
 

    function record_count($param)
    {
        $data=[];
        $where = '';
      
      $sql = "SELECT COUNT(DISTINCT id) AS TotalrecordCount FROM  `kf_offer`    WHERE  1   $where";

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
       $sql="SELECT * FROM `kf_offer` where 1   $where  ORDER BY id DESC LIMIT ".$start.",".$limit ;
          
                $recordSet = $this->db->query($sql);
                $data['result'] = $recordSet->result_array();
                return $data;


    }

    

    function edit_data($table,$field,$val,$update_val) {

       $this->db->where($field,$val)->update($table,$update_val);
    }
     public function data_insert($table,$data)
    {
        $this->db->insert($table,$data);
    }

}
?>