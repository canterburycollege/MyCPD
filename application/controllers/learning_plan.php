<?php

/**
 * Controller for Learning plan
 * 
 * Loads models and views required by Learning Plan
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

    /**
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('auth_user_model');
        $this->load->model('employee_model');
        $this->load->model('learning_plan_model');
        $this->employee_id = $this->auth_user_model->get_auth_user()->employee_id;
    }

    /**
     * Loads page used for creating a new Learning Plan Detail
     * 
     * @uses helper->form
     * @uses library->form_validation
     * 
     * @param integer $learning_plan_id Learning plan header row id
     */
    public function create_detail($learning_plan_id) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['learning_plan_id'] = $learning_plan_id;
        $data['priorities'] = $this->learning_plan_model->get_priority_options();
        $data['targets'] = $this->learning_plan_model->get_target_options($learning_plan_id);
        $data['title'] = 'Create a Learning Plan Activity/Event';

        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
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

            $this->learning_plan_model->create_learning_plan_detail($form_data);
            
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
     * Loads page to delete a given learning plan detail row
     * 
     * @param integer $id Learning plan detail row id
     */
    public function delete_detail($id) {
        $this->load->view('learning_plan/delete_detail');
    }

    /**
     * Index page for this controller
     */
    public function index() {
        $data['user']['employee_id'] = $this->auth_user_model->get_auth_user();
        $this->load->view('templates/header');
        $this->load->view('learning_plan/index', $data);
        $this->load->view('templates/footer');
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
        if(empty($employee)){        
            show_error($err_msg . ': cannot find employee_id ('
                    . $this->employee_id . ') in database');       
        }
        
        $learning_plan_id =
            $this->learning_plan_model->get_latest_learning_plan($this->employee_id);
        if(empty($learning_plan_id)){
            /**
             * @todo Goto create new learning plan page
             */
            show_error($err_msg . ': cannot find latest learning plan in database');
        }
        
        $learning_plans = 
            $this->learning_plan_model->get_learning_plans($this->employee_id);
        if(empty($learning_plans)){
            show_error($err_msg . ': cannot find any learning plans in database');
        }
        
        $learning_plan = 
            $this->learning_plan_model->get_learning_plan($learning_plan_id);
        if(empty($learning_plan)){
            show_error($err_msg . ': cannot find learning plan in database');
        }
        
        $data['employee'] = $employee;
        $data['learning_plans'] = $learning_plans;
        $data['learning_plan'] = $learning_plan;

        //$this->load->view('templates/header', $data);
        $this->load->view('learning_plan/view', $data);
        //$this->load->view('templates/footer');
    }

}

/* End of file learning_plan.php */
/* Location: ./controllers/learning_plan.php */