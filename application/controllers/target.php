<?php

/**
 * Controller for targets
 * 
 * Loads models and views required by targets
 * 
 */
class Target extends CI_Controller {

    /**
     * Name of current controller, used in error messages
     * @var string
     */
    private $controller = 'controller/target';

    public function __construct() {
        parent::__construct();
        $this->load->model('target_model');
    }

    public function index() {
        $data['targets'] = $this->target_model->get_targets();
        $data['title'] = 'Targets';

        $this->load->view('target/index', $data);
    }

    public function view() {
        $err_msg = $this->controller . '/view()';

        $data['targets'] = $this->target_model->get_targets();
        $this->load->view('target/view', $data);
    }

}