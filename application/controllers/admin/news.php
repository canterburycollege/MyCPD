<?php

/**
 * Controller for Admin News
 * 
 * @author rh
 */
class News extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }
    
    public function index(){
        $this->load->view('admin/news');
    }
}

?>
