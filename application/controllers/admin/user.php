<?php

/**
 * Controller for Admin User
 *
 * @author rh
 */
class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }
    
    public function index(){
        $this->load->view('admin/user');
    }
}

?>
