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
        $this->load->helper('url_helper');
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

    public function create()
{
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$data['title'] = 'Create a target';
	$data['target_status'] = $this->target_model->get_status_options();
	$this->form_validation->set_rules('title', 'Title', 'required');
	$this->form_validation->set_rules('description', 'Description', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{
		$this->load->view('target/create', $data);
		
	}
	else
	{
		$this->target_model->set_target();
		$this->load->view('target/success');
	}
}
    
}