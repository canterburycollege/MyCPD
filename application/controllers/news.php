<?php

/**
 * Controller for hub
 * 
 * Loads models and views required by hub
 * 
 */
class News extends CI_Controller {

    /**
     * Name of current controller, used in error messages
     * @var string
     */
    private $controller = 'controller/news';

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('news_model');
    }

    public function index() {
        $data['news'] = $this->news_model->get_news();
    }

    public function view() {
        $err_msg = $this->controller . '/view()';
        $data['news'] = $this->news_model->get_news();
        $this->load->view('news/view', $data);
    }

public function update()
{
	$err_msg = $this->controller . '/update()';
        $this->load->helper('form');
	$this->load->library('form_validation');
	$data['title'] = 'Update news message';
        $data['news'] = $this->news_model->get_news();
        

        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() === FALSE) {
                    $this->load->view('news/update', $data);
;
        } else {
            $this->news_model->set_news();
            $this->load->view('news/success');
        }
        
        
}

}