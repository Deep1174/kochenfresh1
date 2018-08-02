<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OfferModel extends CI_Model {

	function __construct()
    {
        parent::__construct();		
    }

    /**
    * load Login page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       P.C. 
    * @copyright    N/A
    * @link         KochenFRESH
    * @since        16.11.2017
    * @deprecated   N/A
    */

    public function data_insert($table,$data)
	{
		$this->db->insert($table,$data);
	}

    /**
    * load Login page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       P.C. 
    * @copyright    N/A
    * @link         
    * @since        16.11.2017
    * @deprecated   N/A
    **/
    
    function edit_data($field,$val,$table,$update_val) {
       $this->db->where($field,$val)->update($table,$update_val);
    }
	
    /**
    * load Login page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       P.C 
    * @copyright    N/A
    * @link         KochenFRESH
    * @since        16.11.2017
    * @deprecated   N/A
    **/

	public function get_where($table,$where,$value)
	{
		$result = $this->db->where($where,$value)->get($table)->result_array();
		return $result;
	}

	/**
    * load Login page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       P.C. 
    * @copyright    N/A
    * @link         KochenFRESH
    * @since        16.11.2017
    * @deprecated   N/A
    **/

    function record_count($where,$table,$order_by)
    {
        $data=[];
       $where='';
	   
		   $sql = "SELECT COUNT($order_by) AS TotalrecordCount FROM  $table  WHERE 1  $where";
	   
        
      
        $recordSet = $this->db->query($sql);
            if ($recordSet)
            {
                $row = $recordSet->row();
                $total_rows = $row->TotalrecordCount;
            } 
            
        return $total_rows;
    }
     /**
    * to get all item details
    * 
    * @param1       
    * @return       
    * @access       public
    * @author       P.C 
    * @copyright    N/A
    * @link         KochenFRESH
    * @since        26.07.2017
    * @deprecated   N/A
    */
    public function all_data_list($limit,$start,$where,$table,$order_by)
    {
        $data=[];
       $where='';
       
	   
		   $sql="SELECT * FROM $table  WHERE 1  $where ORDER BY  $order_by DESC  LIMIT ".$start.",".$limit ;  
	  
	   
             
        $recordSet = $this->db->query($sql);
        $data = $recordSet->result_array();
      //  print_r($data); exit();
        return $data;
    }
/**
    * load Login page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       P.C.
    * @copyright    N/A
    * @link         KochenFRESH
    * @since        16.11.2017
    * @deprecated   N/A
    **/

    function sub_cat_record_count($where,$table,$order_by)
    {
        $data=[];
       $where='';
	   
		   $sql = "SELECT COUNT(A.$order_by) AS TotalrecordCount FROM  $table A join $table B on A.cat_id=B.parent_id  WHERE B.parent_id!=0  and B.status=1  $where";
	   
        
      
        $recordSet = $this->db->query($sql);
            if ($recordSet)
            {
                $row = $recordSet->row();
                $total_rows = $row->TotalrecordCount;
            } 
            
        return $total_rows;
    }
     /**
    * to get all item details
    * 
    * @param1       
    * @return       
    * @access       public
    * @author       P.C 
    * @copyright    N/A
    * @link         
    * @since        26.07.2017
    * @deprecated   N/A
    */
    public function sb_cat_all_data_list($limit,$start,$where,$table,$order_by)
    {
        $data=[];
       $where='';
       $comp_id = $this->session->userdata('ep_company_id');
	   
		   $sql="SELECT *,a.cat_name as cat_name,b.cat_name as sub_cat_name FROM $table A join $table B on A.cat_id=B.parent_id  WHERE B.parent_id!=0 and B.status=1  $where ORDER BY  A.$order_by DESC  LIMIT ".$start.",".$limit ;  
	  
	   
             
        $recordSet = $this->db->query($sql);
        $data = $recordSet->result_array();
       // print_r($data); exit();
        return $data;
    }

  function cat_record_count($where,$table,$order_by)
    {
        $data=[];
       $where='';
	   
		   $sql = "SELECT COUNT($order_by) AS TotalrecordCount FROM  $table  WHERE 1   and status=1 and parent_id=0 $where";
	   
        
      
        $recordSet = $this->db->query($sql);
            if ($recordSet)
            {
                $row = $recordSet->row();
                $total_rows = $row->TotalrecordCount;
            } 
            
        return $total_rows;
    }
     /**
    * to get all item details
    * 
    * @param1       
    * @return       
    * @access       public
    * @author       P.C. 
    * @copyright    N/A
    * @link         
    * @since        26.07.2017
    * @deprecated   N/A
    */
    public function cat_all_data_list($limit,$start,$where,$table,$order_by)
    {
        $data=[];
        $where='';
        $sql="SELECT * FROM $table  WHERE 1 and status=1 and parent_id=0   $where ORDER BY  $order_by DESC  LIMIT ".$start.",".$limit ;  
	  
	   
             
        $recordSet = $this->db->query($sql);
        $data = $recordSet->result_array();
      //  print_r($data); exit();
        return $data;
    }
}
?>