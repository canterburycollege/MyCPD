<?php
/**
 * Controller for Activity
 * 
 * Loads models and views required by Activity
 * 
 * @uses helper form
 * @uses helper url_helper
 * @uses library form_validation
 * 
 * @uses model auth_user_model
 * @uses model employee_model
 * @uses model learning_plan_model
 * 
 */
class Learning_plan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url_helper'));
        $this->load->library('form_validation');
        $this->load->model(array(
            'auth_user_model','employee_model','learning_plan_model'));

        $this->form_validation
            ->set_error_delimiters('<div class="form_error">', '</div>');

        $this->employee_id = 
                $this->auth_user_model->get_auth_user()->employee_id;
    }
    
    public function create(){
        
    }
    
    public function delete($id){
        
    }
    
    public function edit($id){
        
    }
    
    public function view($id){
        
    }
}
?>
