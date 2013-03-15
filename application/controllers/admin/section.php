<?php

/**
 * Controller for Section maintenance
 * 
 * Loads models and views required for admin functions 
 *
 * @author rh
 */
class Section extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url_helper'));
        $this->load->library('form_validation');
        $this->load->model(array('section_model','faculty_model'));

        $this->form_validation
                ->set_error_delimiters('<div class="form_error">', '</div>');
    }
    
    public function create(){
        $this->form_validation
                ->set_rules('title', 'Title', 'required')
                ->set_rules('manager', 'Section Manager', 'required')
                ->set_rules('faculty_id', 'Faculty', 'required')
        ;
        
        $data['faculties'] = $this->faculty_model->get_faculty_options();

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/create_section', $data);
        } else {
            $form_data = array(
                'title' => $this->input->post('title'),
                'manager' => $this->input->post('manager'),
                'faculty_id' => $this->input->post('faculty_id')
            );

            $rows_inserted = $this->section_model->create($form_data);
            if ($rows_inserted < 1) {
                /**
                 * @todo Redirect to error page
                 */
                echo '@todo - create redirect to error page, when insert fails';
            } else {
                redirect('/admin/section/index', 'refresh');
            }
        }
    }
    
    public function delete($id){
        $rows_deleted = $this->section_model->delete($id);
        if ($rows_deleted < 1) {
            /**
             * @todo Redirect to error page
             */
            echo '@todo - redirect to error page, when record not deleted';
        } else {
            redirect('/admin/section/index', 'refresh');
        }
    }
    
    public function index(){
        $sections =
                $this->section_model->get_sections();
        if (empty($sections)) {
            //show_error('ERROR : cannot find any sections in database');
        }

        $data['sections'] = $sections;

        //$this->load->view('templates/header', $data);
        $this->load->view('admin/section', $data);
    }
    
    public function update($id){
        $data['id'] = $id;
        $data['section'] = $this->section_model->get_section($id);

        $this->form_validation
                ->set_rules('title', 'Title', 'required')
                ->set_rules('manager', 'Section Manager', 'required')
        ;

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/update_section',$data);
        } else {
            $form_data = array(
                'title' => $this->input->post('title'),
                'manager' => $this->input->post('manager')
            );

            $rows_inserted = $this->section_model->update($id,$form_data);
            if ($rows_inserted < 1) {
                /**
                 * @todo Redirect to error page
                 */
                echo '@todo - redirect to error page, when record is not updated';
            } else {
                redirect('/admin/section/index', 'refresh');
            }
        }
    }
}

?>
