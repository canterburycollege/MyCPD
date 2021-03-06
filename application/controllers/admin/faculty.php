<?php

/**
 * Controller for Faculty maintenance
 * 
 * Loads models and views required for admin functions 
 *
 * @author rh
 */
class Faculty extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url_helper'));
        $this->load->library('form_validation');
        $this->load->model(array('faculty_model'));

        $this->form_validation
                ->set_error_delimiters('<div class="form_error">', '</div>');
    }

    public function create() {
        $this->form_validation
                ->set_rules('title', 'Title', 'required')
                ->set_rules('manager', 'Faculty Head', 'required')
        ;

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/create_faculty');
        } else {
            $form_data = array(
                'title' => $this->input->post('title'),
                'manager' => $this->input->post('manager')
            );

            $rows_inserted = $this->faculty_model->create($form_data);
            if ($rows_inserted < 1) {
                /**
                 * @todo Redirect to error page
                 */
                echo 'error message';
            } else {
                redirect('/admin/faculty/index', 'refresh');
            }
        }
    }

    public function delete($id) {
        $rows_deleted = $this->faculty_model->delete($id);
        if ($rows_deleted < 1) {
            /**
             * @todo Redirect to error page
             */
            echo '@todo - redirect to error page, when record not deleted';
        } else {
            redirect('/admin/faculty/index', 'refresh');
        }
    }

    public function index() {
        $faculties =
                $this->faculty_model->get_faculties();
        if (empty($faculties)) {
            show_error($err_msg . ': cannot find any faculties in database');
        }

        $data['faculties'] = $faculties;

        //$this->load->view('templates/header', $data);
        $this->load->view('admin/faculty', $data);
    }

    public function update($id) {
        $data['id'] = $id;
        $data['faculty'] = $this->faculty_model->get_faculty($id);

        $this->form_validation
                ->set_rules('title', 'Title', 'required')
                ->set_rules('manager', 'Faculty Head', 'required')
        ;

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/update_faculty',$data);
        } else {
            $form_data = array(
                'title' => $this->input->post('title'),
                'manager' => $this->input->post('manager')
            );

            $rows_inserted = $this->faculty_model->update($id,$form_data);
            if ($rows_inserted < 1) {
                /**
                 * @todo Redirect to error page
                 */
                echo '@todo - redirect to error page, when record is not updated';
            } else {
                redirect('/admin/faculty/index', 'refresh');
            }
        }
    }

}

?>
