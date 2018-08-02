<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     function generate_unique_pass()
    {
        $ci =& get_instance();
        $unique = mt_rand(1000000,9999999999);
        $unique = mt_rand(A,z);
        return $unique;

    }

    
    /**
    * user helper page
    * 
    * @param1       
    * @return       login page
    * @access       public
    * @author       D.M
    * @copyright    N/A
    * @link         application/helper.
    * @since        4.04.2017
    * @deprecated   N/A
    */

    function get_encript_id($pass) {
        $id_encode = base64_encode($pass);
        return urlencode($id_encode);
    }
    function get_decript_id($pass) 
    {
        $id_encode = urldecode($pass);
        return base64_decode($id_encode);
    }

    /**
    * user helper page
    * 
    * @param1       
    * @return       login page
    * @access       public
    * @author       D.M
    * @copyright    N/A
    * @link         application/helper.
    * @since        4.04.2017
    * @deprecated   N/A
    */

    function check_login()
    {
        $ci =& get_instance();
        if($ci->session->userdata('kf_login_session') ==true)
        {
            return "true";
        }
        else
        {
            redirect(base_url()."Login");
        }
    }
   

    function getNameTable($table,$col,$field='',$value='',$field2='',$value2='')
    {
        $ci =& get_instance();
        $query="SELECT ".$col." FROM `".$table."` where 1 ";
        if($field!='' && $value!='')
        {
          $query.="AND ".$field."='".$value."' ";
        }
        if($field2!='' && $value2!='')
        {
          $query.="AND ".$field2."='".$value2."' ";
        }
        $recordSet = $ci->db->query($query);
        if($recordSet->num_rows() > 0)
        {
            $row = $recordSet->row_array();
            return $row[$col];
        }
        else
        {
            return "";
        }
    }

    

        /**
    * user helper page
    * 
    * @param1       
    * @return       
    * @access       public
    * @author       S.G
    * @copyright    N/A
    * @link         application/helper.
    * @since        28.04.2017
    * @deprecated   N/A
    */  

    function change_dateformat($date_form) // d-m-y to y-m-d  
    {

    if($date_form=='')
    {
    $dateformat='';

    return $dateformat;

    }
    else if($date_form=='0000-00-00')
    {

        $dateformat='N/A';

        return $dateformat;

    }   
 
    else{

        $date1=explode("-",$date_form);

        $dateformat=$date1[2]."-".$date1[1]."-".$date1[0];

        return $dateformat;

    }

    

}


    /**
    * user helper page
    * 
    * @param1       
    * @return       full name
    * @access       public
    * @author       P.B
    * @copyright    N/A
    * @link         application/helper.
    * @since        28.04.2017
    * @deprecated   N/A
    */  

    function getFullNameTable($table,$col,$col1,$field='',$value='')
    {
        $ci =& get_instance();
        
        $query="SELECT ".$col.",".$col1." FROM ".$table." where 1 ";
        if($field!='' && $value!='')
        {
          $query.="AND ".$field."='".$value."' ";
        }
        $recordSet = $ci->db->query($query);
        if($recordSet->num_rows() > 0)
        {
            $row = $recordSet->row_array();
            $name=$row[$col]." ".$row[$col1];
            return $name;
        }
        else
        {
            return "";
        }
    }

    /**
    * user helper page
    * 
    * @param1       
    * @return       return value
    * @access       public
    * @author       P.B
    * @copyright    N/A
    * @link         application/helper.
    * @since        28.04.2017
    * @deprecated   N/A
    */  

    function checkNull($data)
    {
        if($data!='')
        {
            $return_data=$data;
        }
        else
        {
            $return_data='N/A';
        }

        return $return_data;
    }


	function current_url_name()
	{
		$current_url = current_url();
        $url = explode('/',$current_url);
		return $url[4];
	}


//NUMBER CONVERTION
		function convert_number($number) {
			$ci =& get_instance();
		if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");
		}
		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */
		$res = "";
		if ($Gn) {
			$res .= convert_number($Gn) .  "Million";
		}
		if ($kn) {
			$res .= (empty($res) ? "" : " ") .convert_number($kn) . " Thousand";
		}
		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .convert_number($Hn) . " Hundred";
		}
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}
			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];
				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}
		if (empty($res)) {
			$res = "zero";
		}
		return $res;
	}

    
	function getwhere1($table,$field,$value)
    {
        $ci =& get_instance();
        
        $query="SELECT * FROM `".$table."` where 1 ";
        if($field!='' && $value!='')
        {
          $query.="AND ".$field."=".$value;
        }
        $recordSet = $ci->db->query($query);
        if($recordSet->num_rows() > 0)
        {
            $row = $recordSet->row_array();
            
            return $row;
        }
        else
        {
            return "";
        }
    }
	
	 function login_user_state()
	{
		 $ci =& get_instance();
		 $state_id = $ci->session->userdata('gst_login_user_state');
		 return $state_id;
	}

 
	function get_total_item_count_price($order_id)
	{
		$ci =& get_instance();
		$sql = " SELECT *, order_item.price as myprice FROM  kf_order orders left join kf_user user on user.user_id=orders.user_id left join  kf_order_items order_item on order_item.order_id=orders.order_id left join kf_item item on  order_item.item_id=item.item_id left join kf_item_price_unit price on price.id=order_item.unit_price_id left join kf_unit_master unit on unit.unit_id=price.unit_id where orders.order_id=".$order_id;
		$result = $ci->db->query($sql)->result_array();

        // echo "<pre>";
        // print_r($result);
        
		$response='';
		$grand_total = 0;
	    if(!empty($result))
		{
			foreach($result as $k=>$val)
			{
				$count = $k+1;
				$total =   $val['myprice'];
				$grand_total = $grand_total + $total;
			}
			$response['total_item'] = $count;
			$response['total_amount'] = $grand_total;
			return $response;
		}
		else
		{
			return $response;
		}
	}
	function get_order_item_list($order_id)
	{
		$ci =& get_instance();
		$sql = " SELECT * FROM  kf_order orders left join kf_user user on user.user_id=orders.user_id left join  kf_order_items order_item on order_item.order_id=orders.order_id left join kf_item item on  order_item.item_id=item.item_id left join kf_item_price_unit price on price.id=order_item.unit_price_id left join kf_unit_master unit on unit.unit_id=price.unit_id where orders.order_id=".$order_id;
		$result = $ci->db->query($sql)->result_array();
		
	    if(!empty($result))
		{
			return $result;
		}
		else
		{
			return 0;
		}
	}

    function get_paid_item_count_price($order_id)
    {
        $ci =& get_instance();
        $sql = " SELECT * FROM  kf_order orders left join kf_order_items order_item on order_item.order_id=orders.order_id left join kf_item item on  order_item.item_id=item.item_id left join kf_item_price_unit price on price.id=order_item.unit_price_id left join kf_unit_master unit on unit.unit_id=price.unit_id where orders.payment_status=1 and orders.order_id=".$order_id;
        $result = $ci->db->query($sql)->result_array();
        $response='';
        $grand_total = 0;
        
        if(!empty($result))
        {
            foreach($result as $k=>$val)
            {
                $count = $k+1;
                $total = $val['quantity'] *  $val['price'];
                $grand_total = $grand_total + $total;
            }
            $response['total_item'] = $count;
            $response['total_amount'] = $grand_total;
            return $response;
        }
        else
        {
            return $response;
        }
    }
	
    //////////////////////////////////////////////
/* End of file file_helper.php */
/* Location: ./system/helpers/file_helper.php */
