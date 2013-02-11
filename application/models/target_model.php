<?php

class Target_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_targets() {
        $query = $this->db->get('v_targets_with_status');
        return $query->result_array();
    }

}