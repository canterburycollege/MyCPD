<?php

/**
 * Controller for Admin Dashboard
 *
 * @author rh
 */
class Learning_plan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }
    
    public function index(){
        $this->load->view('admin/learning_plan');
    }
}

?>
