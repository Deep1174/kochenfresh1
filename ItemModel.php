<?php

class ItemModel extends CI_Model {
	
	
	function __construct()
    {
        parent::__construct();		
    }

    function record_count($param)
    {
        $where = '';
        if(isset($param['item_name'])&& $param['item_name']!='')
        {
            $where .= " AND item_name  like '%".$param['item_name']."%' ";
        }
       
        if(isset($param['cat_id'])&& $param['cat_id']!='')
        {
            $where .= " AND item.cat_id  =".$param['cat_id'];
        }
        
        if(isset($param['Sub_cat_id'])&& $param['Sub_cat_id']!='')
        {
            $where .= " AND item.sub_cat_id  =".$param['Sub_cat_id'];
        }
       
        $sql = "SELECT COUNT(DISTINCT item_id) AS TotalrecordCount FROM  `kf_item` item   left join kf_category cat on cat.cat_id=item.cat_id  WHERE  1 and item.status =1  $where";

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
       
        $where = '';
        if(isset($param['item_name'])&& $param['item_name']!='')
        {
            $where .= " AND item_name  like '%".$param['item_name']."%' ";
        }
       
        if(isset($param['cat_id'])&& $param['cat_id']!='')
        {
            $where .= " AND item.cat_id =".$param['cat_id'];
        }
        
        if(isset($param['Sub_cat_id'])&& $param['Sub_cat_id']!='')
        {
            $where .= " AND item.sub_cat_id=".$param['Sub_cat_id'];
        }
		
        

         $sql = "SELECT item.*,cat.cat_name as cat_name FROM  `kf_item` item   left join kf_category cat on cat.cat_id=item.cat_id  WHERE  1 AND item.status = '1' $where ORDER BY  cat.cat_name ASC , item.item_name ASC  LIMIT ".$start.",".$limit ;
	   
        $data['result'] = $this->db->query($sql)->result_array();
      //  echo"<pre>";print_r($data['result']);exit;
		return $data;
    }

    function edit_data($table,$field,$val,$update_val) {
       $this->db->where($field,$val)->update($table,$update_val);
    }
}
?>