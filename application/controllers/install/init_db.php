<?php

/**
 * Controller to install database and add pre-defined data e.g. priority types
 */
class Init_db extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('install_db_model');
    }
    
    /**
     * Create new mycpd database
     * 
     * This must be done before data can be added
     */
    public function create_db(){
        echo '<p>... create db script will be inserted here... </p>';
        echo '<p>... press back button to return to dashboard...</p>';
    }
    
    /**
     * Add pre-defined data
     */
    public function add_data(){
        /**
         * @todo Add validation to prevent rows being added more than once
         */
        $num_priority_types = $this->install_db_model->add_priority_types();
        echo "<p>-- {$num_priority_types} priority_type rows inserted --</p>";
        
        $num_target_statuses = $this->install_db_model->add_target_statuses();
        echo "<p>-- {$num_target_statuses} target_status rows inserted --</p>";
    }
    
    public function index(){
        $this->load->view('install/dashboard');
    }
    
}
?>
