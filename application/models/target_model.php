<?php

class Target_model extends CI_Model {

    /**
     *
     * @var string Target status table name
     */
    protected $tbl_target_status = 'target_status';
    
        /**
     *
     * @var string Targets table name
     */
    protected $tbl_targets = 'target';


        protected $employee_id;
    
    public function __construct() {
        $this->load->database();
                $this->load->model('auth_user_model');
        $this->load->model('employee_model');
        $this->employee_id = $this->auth_user_model->get_auth_user()->employee_id;
    }

    public function get_targets($id = FALSE) {
        if ($id===FALSE) {
        $query = $this->db->get('v_targets_with_status');
        return $query->result_array();} else {
            $query = $this->db->get_where('v_targets_with_status', array('id' => $id));
        return $query->result_array();
        }
        
    }

    
    public function set_target() {
        $this->load->helper('url');

        //$slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'status_id' => $this->input->post('target_status'),
            'employee_id' => $this->employee_id = $this->auth_user_model->get_auth_user()->employee_id,
            'target_date' => $this->input->post('target_date')
        );

        return $this->db->insert('targets', $data);
    }

    /**
     * Query db for array of target status
     * 
     * @return array Array of status objects
     */
    public function get_status_options() {

        $data = array();
        $this->db
                ->order_by('sort_order', 'asc');
        $query = $this->db->get($this->tbl_target_status);
        foreach ($query->result() as $row) {
            $rows[$row->id] = $row->title;
        }

        return $rows;
    }

   public function delete_target($id) {
       $this->db->delete('targets', array('id' => $id)); 
   }
}