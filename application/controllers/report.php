<?php

class Report extends CI_Controller {

    /**
     * Name of current controller, used in error messages
     * @var string
     */
    private $controller = 'controller/report';
    private $employee_id;


    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url_helper'));
        $this->load->model(array(
            'auth_user_model', 'employee_model'));
        $this->load->model('news_model');
        
        $this->employee_id =
                $this->auth_user_model->get_auth_user()->id;
    }
    
    public function index(){
        $employee =
                $this->employee_model->get_employee($this->employee_id);
        if (empty($employee)) {
            show_error($err_msg . ': cannot find employee_id ('
                    . $this->employee_id . ') in database');
        }
        
        $data['employee'] = $employee;
        $this->load->view('learning_plan/report', $data);
    }
}
?>
