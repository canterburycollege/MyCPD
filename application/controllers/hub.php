<?php

/**
 * Controller for hub
 * 
 * Loads models and views required by hub
 * 
 */
class Hub extends CI_Controller {

    /**
     * Name of current controller, used in error messages
     * @var string
     */
    private $employee_id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model(array(
            'auth_user_model', 'employee_model','hub_model','news_model'));
        
        $this->employee_id =
                $this->auth_user_model->get_auth_user()->id;
    }

    public function view() {
        $employee =
                $this->employee_model->get_employee($this->employee_id);
        
        $data['employee'] = $employee;
        $this->load->view('hub/view',$data);
    }

}

