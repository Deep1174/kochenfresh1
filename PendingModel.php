<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PendingModel extends CI_Model {

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
    * @author       M.K.Sah 
    * @copyright    N/A
    * @link         inventory/login
    * @since        16.11.2017
    * @deprecated   N/A
    **/

    function record_count($param)
    {
		//echo"<pre>";print_r($param);exit;
		  
        $data=[];
		    $where=" ";
		/** search section**/
		if(isset($param['order_date']) && $param['order_date']!='')

		{

			$where = " and DATE(orders.order_date) = '".date('Y-m-d',strtotime($param['order_date']))."'";
		}
		//name
		    // $sql = "SELECT COUNT(orders.order_id) AS TotalrecordCount FROM  kf_order orders left join kf_user user on user.user_id=orders.user_id left join  kf_order_items order_item on order_item.order_id=orders.order_id left join kf_item item on  order_item.item_id=item.item_id left join kf_item_price_unit price on price.id=order_item.unit_price_id left join kf_unit_master unit on unit.unit_id=price.unit_id  WHERE 1   $where";
	    
      $sql = "SELECT COUNT(orders.order_id) AS TotalrecordCount FROM  kf_order orders left join kf_user user on user.user_id=orders.user_id  WHERE 1   $where";
        //echo $this->db->last_query();exit();
      
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
    * @author       S.A 
    * @copyright    N/A
    * @link         
    * @since        26.07.2017
    * @deprecated   N/A
    */
    public function all_data_list($limit,$start,$param)
    {
		
      $data=[];
	    $where=" ";
    if(isset($param['order_date']) && $param['order_date']!='')
		{
			
			$where =" and DATE(orders.order_date) ='". date('Y-m-d',strtotime($param['order_date']))."'";
		}
	   
		   //$sql="SELECT  orders.*,user.name,user.email,user.phone   FROM  kf_order orders left join kf_user user on user.user_id=orders.user_id  WHERE 1    $where  ORDER BY  orders.order_id DESC  LIMIT ".$start.",".$limit ; 

      $sql = "SELECT  orders.*,user.name,user.email,user.phone,item.*,price.*,unit.* FROM  kf_order orders left join kf_user user on user.user_id=orders.user_id left join  kf_order_items order_item on order_item.order_id=orders.order_id left join kf_item item on  order_item.item_id=item.item_id left join kf_item_price_unit price on price.id=order_item.unit_price_id left join kf_unit_master unit on unit.unit_id=price.unit_id left join kf_shipping ship on ship.user_id=orders.user_id  WHERE 1 AND orders.payment_status = 0  AND orders.status = 0 $where ORDER BY  orders.order_id DESC  LIMIT ".$start.",".$limit;
             
        $recordSet = $this->db->query($sql);
        $data = $recordSet->result_array();
       //echo"<pre>";print_r($data); exit();
        return $data;
    }

}
?>