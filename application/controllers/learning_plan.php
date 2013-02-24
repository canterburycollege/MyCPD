<?php

/**
 * Controller for Learning plan
 * 
 * Loads models and views required by Learning Plan
 * 
 * @uses helper form
 * @uses helper url_helper
 * @uses library form_validation
 * 
 * @uses model activity
 * @uses model auth_user_model
 * @uses model employee_model
 * 
 */
class Learning_plan extends CI_Controller {

    /**
     * Name of current controller, used in error messages
     * @var string
     */
    private $controller = 'controller/learning_plan';

    /**
     *
     * @var integer
     */
    protected $employee_id;

    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url_helper'));
        $this->load->library('form_validation');
        $this->load->model(array(
            'activity_model','auth_user_model','employee_model','learning_plan_model'));

        $this->form_validation
            ->set_error_delimiters('<div class="form_error">', '</div>');

        $this->employee_id = 
                $this->auth_user_model->get_auth_user()->employee_id;
    }
    
    
    public function create_activity($employee_id){
        $data['employee_id'] = $learning_plan_id;
        $data['cpd_types'] = $this->activity_model->get_cpd_types();
        $data['priorities'] = $this->activity_model->get_priority_options();
        $data['targets'] = $this->activity_model->get_target_options($employee_id);
        $data['title'] = 'Create a Learning Plan Activity/Event';

        $this->form_validation
                ->set_rules('title', 'Title', 'required')
                ->set_rules('learning_outcomes', 'Learning outcomes', 'required')
        ;

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('learning_plan/create_detail', $data);
        } else {
            $form_data = array(
                'employee_id' => $employee_id,
                'title' => $this->input->post('title'),
                'learning_outcomes' => $this->input->post('learning_outcomes'),
                'target_id' => $this->input->post('target_id'),
                'priority_type_id' => $this->input->post('priority_type_id')
            );

            $this->learning_plan_model->create_detail($form_data);

            // get extra data to load view page
            $employee = $this->employee_model->get_employee($this->employee_id);
            $data['employee'] = $employee;
            $data['learning_plans'] =
                    $this->learning_plan_model->get_header_list($this->employee_id);
            $data['learning_plan'] =
                    $this->learning_plan_model->get_learning_plan($learning_plan_id);

            //$this->load->view('templates/header', $data);
            if (empty($data['learning_plan'])) {
                show_404();
                $err['msg'] = 'No Learning Plan found!';
                $this->load->view('templates/error', $err);
            } else {
                $this->load->view('learning_plan/view', $data);
            }
        }
    }
    
    /**
     * Loads page to create a new target for a given learning plan
     * 
     * @param integer $learning_plan_id 
     */
    public function create_target($learning_plan_id){
        /**
         * @todo code to create new target
         */
        $this->load->view('learning_plan/create_target');
    }
    
    public function delete_activity($id){
        $this->activity_model->delete($id);
        $this->view();
    }

    /**
     * Loads page to view an existing Learning Plan
     */
    public function view() {
        $err_msg = $this->controller . '/view()';

        $employee =
                $this->employee_model->get_employee($this->employee_id);
        if (empty($employee)) {
            show_error($err_msg . ': cannot find employee_id ('
                    . $this->employee_id . ') in database');
        }

        $activities =
                $this->activity_model->get_employee_activities($this->employee_id);
        if (empty($activities)) {
            show_error($err_msg . ': cannot find any activities in database');
        }

        $data['employee'] = $employee;
        $data['activities'] = $activities;

        //$this->load->view('templates/header', $data);
        $this->load->view('learning_plan/view', $data);
        //$this->load->view('templates/footer');
    }

}

/* End of file learning_plan.php */
/* Location: ./controllers/learning_plan.php */