<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class IpAddressModel extends CI_Model {

	function __construct()
    {
        parent::__construct();		
    }
    
    /**
    * load UsersList page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       M.K.Sah
    * @copyright    N/A
    * @link         UsersPayroll/UsersList
    * @since        20.11.2016
    * @deprecated   N/A
    **/

    public function record_count(){
        $rowdCount = $this->db->count_all('kf_ip_address');
        return $rowdCount;
    }

    /**
    * load UsersList page
    * 
    * @param1       
    * @return       view page
    * @access       public
    * @author       M.K.Sah
    * @copyright    N/A
    * @link         UsersPayroll/UsersList
    * @since        20.11.2016
    * @deprecated   N/A
    **/

    public function all_data_list($limit,$start,$searchStatus,$statusSearch){
        $where = "";
        if(isset($searchStatus) && $searchStatus != ''){
            $where .= "AND `ip_Address` LIKE '%".trim($searchStatus)."%' ";
        }
        if(isset($statusSearch) && $statusSearch !=''){
            $where .= "AND `status` = '".$statusSearch."' ";
        }

        $sql = "SELECT * FROM `kf_ip_address` WHERE 1 $where ORDER BY `id` DESC LIMIT ".$start.",".$limit ;
        $data = $this->db->query($sql)->result_array();
        //echo "<pre>";print_r($data);exit();
        return $data;
    }
}
?>