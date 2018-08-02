<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ContactModel extends CI_Model {
	
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
        $rowdCount = $this->db->count_all('kf_contact_us');
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
    
    public function all_data_list($limit,$start,$search_term,$search_status){

        $where = '';
        if(isset($search_status) && $search_status != ''){
            $where .= " AND `status` = '".trim($search_status)."'";
        }
        if(isset($search_term) && $search_term != '') {
            $where .= " AND `id` like '%".trim($search_term)."%' ";
            $where .= " OR `name` like '%".trim($search_term)."%' ";
            $where .= " OR `email` like '%".trim($search_term)."%' ";
            $where .= " OR `phn_no` like '%".trim($search_term)."%' ";
        }

        $sql = "SELECT * FROM `kf_contact_us` WHERE 1 $where ORDER BY `id` DESC LIMIT ".$start.",".$limit ;
        $data = $this->db->query($sql)->result_array();
        //echo "<pre>";print_r($data);exit();
        return $data;
    }
}
?>