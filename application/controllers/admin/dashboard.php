<?php

/**
 * Controller for Admin Dashboard
 * 
 * Loads models and views required for admin functions e.g. maintaining users 
 * etc.
 *
 * @author rh
 */
class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }
    
    public function index(){
        $this->load->view('admin/dashboard');
    }
}

?>
