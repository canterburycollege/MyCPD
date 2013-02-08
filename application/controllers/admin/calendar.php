<?php

/**
 * Controller for Admin Calendar
 *
 * @author rh
 */
class Calendar extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }
    
    public function index(){
        $this->load->view('admin/calendar');
    }
}

?>
