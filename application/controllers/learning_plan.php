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
 * @uses model auth_user_model
 * @uses model employee_model
 * @uses model learning_plan_model
 * 
 */
class Learning_plan extends CI_Controller {

    /**
     * Name of current controller, used in error messages
     * @var string
     */
    private $controller = 'controller/learning_plan';
    
    /**
     * @todo set up constant for current year
     *
     * @var integer 
     */
    private $current_year = '2012';

    /**
     *
     * @var integer
     */
    protected $employee_id;

    /**
     * 
     */
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

    /**
     * Creating a new learning plan header
     * 
     * @param integer $employee_id 
     * @param integer $academic_year 
     */
    public function create_header($employee_id, $academic_year) {
        
        $form_data = array(
            'employee_id' => $employee_id,
            'academic_year' => $academic_year
            );
        
        $this->learning_plan_model->create_header($form_data);
    }

    /**
     * Loads page used for creating a new Learning Plan Detail (e.g. activity)
     * 
     * @param integer $learning_plan_id Learning plan header row id
     */
    public function create_detail($learning_plan_id) {

        $data['learning_plan_id'] = $learning_plan_id;
        $data['priorities'] = $this->learning_plan_model->get_priority_options();
        $data['targets'] = $this->learning_plan_model->get_target_options($learning_plan_id);
        $data['title'] = 'Create a Learning Plan Activity/Event';

        $this->form_validation
                ->set_rules('title', 'Title', 'required')
                ->set_rules('learning_outcomes', 'Learning outcomes', 'required')
        ;

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('learning_plan/create_detail', $data);
        } else {
            $form_data = array(
                'learning_plan_id' => $learning_plan_id,
                'title' => $this->input->post('title'),
                'learning_outcomes' => $this->input->post('learning_outcomes'),
                'learning_plan_target_id' => $this->input->post('learning_plan_target_id'),
                'priority_type_id' => $this->input->post('priority_type_id'),
                'target_date' => $this->input->post('target_date')
            );

            $this->learning_plan_model->create_detail($form_data);

            // get extra data to load view page
            $employee = $this->employee_model->get_employee($this->employee_id);
            $data['employee'] = $employee;
            $data['learning_plans'] =
                    $this->learning_plan_model->get_learning_plans($this->employee_id);
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

    /**
     * Loads page to delete a given learning plan detail row
     * 
     * @param integer $id Learning plan detail row id
     */
    public function delete_detail($id) {
        $this->load->view('learning_plan/delete_detail');
    }

    /**
     * Loads page to update given learning plan detail row
     * 
     * @param integer $id Learning plan detail row id
     */
    public function update_detail($id) {
        $this->load->view('learning_plan/update_detail');
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

        $learning_plan_list =
                $this->learning_plan_model->get_header_list($this->employee_id);
        if (empty($learning_plan_list)) {
            $this->create_header($this->employee_id,$this->current_year);
        }

        $learning_plan_id =
                $this->learning_plan_model->get_latest_header_id($this->employee_id);
        if (empty($learning_plan_id)) {
            $this->create_header($this->employee_id);
        }

        $learning_plan =
                $this->learning_plan_model->get_learning_plan($learning_plan_id);
        if (empty($learning_plan)) {
            show_error($err_msg . ': cannot find learning plan in database');
        }

        $data['employee'] = $employee;
        $data['learning_plan_list'] = $learning_plan_list;
        $data['learning_plan'] = $learning_plan;

        //$this->load->view('templates/header', $data);
        $this->load->view('learning_plan/view', $data);
        //$this->load->view('templates/footer');
    }

}

/* End of file learning_plan.php */
/* Location: ./controllers/learning_plan.php */