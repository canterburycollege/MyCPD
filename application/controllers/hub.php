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
    private $controller = 'controller/hub';

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('hub_model');
        $this->load->model('news_model');
    }

    public function index() {
        //$data['targets'] = $this->target_model->get_targets();
        //$data['title'] = 'Targets';
        //$this->load->view('hub/index', $data);
    }

    public function view() {
        $err_msg = $this->controller . '/view()';
        $this->load->view('hub/view');
    }

}

