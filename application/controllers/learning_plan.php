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
        $this->load->helper(array('form', 'url_helper'));
        $this->load->library('form_validation');
        $this->load->model(array(
            'activity_model', 'auth_user_model', 'employee_model'));

        $this->form_validation
                ->set_error_delimiters('<div class="form_error">', '</div>');

        $this->employee_id =
                $this->auth_user_model->get_auth_user()->employee_id;
    }

    public function create_activity($employee_id) {
        $data['employee_id'] = $employee_id;
        $data['cpd_types'] = $this->activity_model->get_cpd_type_options();
        $data['priorities'] = $this->activity_model->get_priority_options();
        $data['targets'] = $this->activity_model->get_target_options($employee_id);

        $this->form_validation
                ->set_rules('title', 'Title', 'required')
                ->set_rules('learning_outcomes', 'Learning outcomes', 'required')
        ;

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('learning_plan/create_activity', $data);
        } else {
            $form_data = array(
                'employee_id' => $employee_id,
                'planned_date' => $this->input->post('planned_date'),
                'title' => $this->input->post('title'),
                'learning_outcomes' => $this->input->post('learning_outcomes'),
                'cpd_type_id' => $this->input->post('cpd_type_id'),
                'target_id' => $this->input->post('target_id'),
                'priority_type_id' => $this->input->post('priority_type_id')
            );

            $rows_inserted = $this->activity_model->create($form_data);
            if ($rows_inserted < 1) {
                /**
                 * @todo Redirect to error page
                 */
                echo 'error message';
            } else {
                redirect('/learning_plan/view', 'refresh');
            }
            //$this->load->view('templates/header', $data);
        }
    }

    /**
     * Loads page to create a new target for a given learning plan
     * 
     * @param integer $learning_plan_id 
     */
    public function create_target($learning_plan_id) {
        /**
         * @todo code to create new target
         */
        $this->load->view('learning_plan/create_target');
    }

    public function delete_activity($id) {
        $rows_deleted = $this->activity_model->delete($id);
        if ($rows_deleted < 1) {
            /**
             * @todo Redirect to error page
             */
            echo 'Error message';
        } else {
            redirect('/learning_plan/view', 'refresh');
        }
    }

    public function update_activity($id) {

        $data['id'] = $id;
        $data['activity'] = $this->activity_model->get_activity($id);
        $data['cpd_types'] = $this->activity_model->get_cpd_type_options();
        $data['priorities'] = $this->activity_model->get_priority_options();
        $data['targets'] = $this->activity_model->get_target_options($this->employee_id);

        $this->form_validation
                ->set_rules('planned_date', 'required')
                ->set_rules('title', 'Title', 'required')
                ->set_rules('learning_outcomes', 'Learning outcomes', 'required')
        ;

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('learning_plan/update_activity', $data);
        } else {
            $form_data = array(
                'employee_id' => $this->employee_id,
                'planned_date' => $this->input->post('planned_date'),
                'title' => $this->input->post('title'),
                'learning_outcomes' => $this->input->post('learning_outcomes'),
                'cpd_type_id' => $this->input->post('cpd_type_id'),
                'target_id' => $this->input->post('target_id'),
                'priority_type_id' => $this->input->post('priority_type_id'),
                'completed_date' => $this->input->post('completed_date'),
                'evaluation_url' => $this->input->post('evaluation_url'),
                'hours_of_cpd' => $this->input->post('hours_cpd'),
                'rating' => $this->input->post('rating')
            );

            $rows_updated = $this->activity_model->update($id, $form_data);
            if ($rows_updated < 1) {
                /**
                 * @todo Redirect to error page
                 */
                $this->load->view('learning_plan/update_activity', $data);
            } else {
                redirect('/learning_plan/view', 'refresh');
            }
            //$this->load->view('templates/header', $data);
        }
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