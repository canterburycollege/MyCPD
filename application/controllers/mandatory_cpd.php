<?php

class Mandatory_cpd extends CI_Controller {

    /**
     * Name of current controller, used in error messages
     * @var string
     */
    private $controller = 'controller/mandatory_cpd';
    private $epmloyee_id;


    protected $employee_id;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url_helper'));
        $this->load->model(array(
            'auth_user_model', 'employee_model', 'mandatory_cpd_model'));
        $this->load->model('news_model');
        $this->employee_id =
                $this->auth_user_model->get_auth_user()->id;
    }
    
    public function index(){
        $err_msg = $this->controller . '/index()';
        
        $employee =
                $this->employee_model->get_employee($this->employee_id);
        if (empty($employee)) {
            show_error($err_msg . ': cannot find employee_id ('
                    . $this->employee_id . ') in database');
        }
        
        $data['employee'] = $employee;
        
        $data['score'] = $this->mandatory_cpd_model->get_score();
        
        
        $this->load->view('learning_plan/mandatory_cpd', $data);
    }
    
    public function lights($value) {
        switch ($value)
        {
            case 0:
                $light="redlight.png";
                echo $light;
                break;
            case 1:
                $light="yellowlight.png";
                echo $light;
                break;
            case 2:
                $light="greenlight.png";
                echo $light;
                break;
        }
    }
    
    
}
    


?>
