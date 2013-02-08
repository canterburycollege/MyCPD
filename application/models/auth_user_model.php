<?php

class Auth_user_model extends CI_Model {

    public function __construct() {
        //$this->load->database();
    }
    
    /**
     * Query db for authorised user details
     * 
     * @return object
     */
    public function get_auth_user() {
        
        $data = new stdClass();
        $data->employee_id = 3; // set for testing
        
        return $data;
    }
    
}

/* End of file auth_user_model.php */
/* Location: ./models/auth_user_model.php */

