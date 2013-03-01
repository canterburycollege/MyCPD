<?php

class Report extends CI_Controller {

    /**
     * Name of current controller, used in error messages
     * @var string
     */
    private $controller = 'controller/report';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url_helper'));
        $this->load->model(array(
            'auth_user_model', 'employee_model'));

        $this->employee_id =
                $this->auth_user_model->get_auth_user()->employee_id;
    }
    
    public function index(){
        $data = array();
        $this->load->view('learning_plan/report', $data);
    }
}
?>