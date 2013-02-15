<?php

class Auth_user_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->test_auth_user();
    }
    
    /**
     * Query db for authorised user details
     * 
     * @return object
     */
    public function get_auth_user() {
        
        $data = new stdClass();
        $data->employee_id = 1; // set for testing
        
        return $data;
    }
    
    /**
     * For testing/demo
     * 
     * Insert dummy row with id=1, if doesn't already exist
     */
    public function test_auth_user(){
        
        $affected_rows = 0;
        $test_id = 1;
        $tbl = 'mycpd.employee';
        $row = array(
            'id' => $test_id,
            'display_name' => 'Treesa Green',
            'moodle_user_id' => '99',
            'mycpd_access_group' => 'test'
        );
        
        // check if row already exists and insert, if not
        $query = $this->db->get_where($tbl, array('id'=>$test_id), 1, 0);
        if($query->num_rows() == 0){
            $this->db->insert($tbl, $row);
            $affected_rows = $this->db->affected_rows();
        }
        // echo msg if test row inserted (should really return msg!)
        if($affected_rows > 0){
            //echo "<p>Test msg : {$affected_rows} test row inserted into employee table</p>";
        } else {
            //echo '<p>Test msg : test employee already exists in employee table</p>';
        }
    }
    
}

/* End of file auth_user_model.php */
/* Location: ./models/auth_user_model.php */

