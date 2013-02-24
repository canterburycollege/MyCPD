<?php

/**
 * Represents a Learning Plan
 * 
 * Interacts with database
 */
class Activity_model extends CI_Model {

    protected $tbl_activity = 'activity';
    protected $tbl_cpd_type = 'priority_type';
    protected $tbl_priority_type = 'priority_type';
    protected $tbl_target = 'target';
    protected $v_activity = 'v_activity';

    public function __construct() {
        $this->load->database();
    }

    public function create($data) {
        $this->db->insert($this->tbl_activity, $data);
    }

    public function delete($id) {
        $this->db->delete($this->tbl_activity, array('id' => $id));
        return $this->db->affected_rows();
    }

    public function get_activity($id) {

        $query = $this->db->get_where($this->v_activity, array('id' => $id));

        return $query->result();
    }

    /**
     * Query db for array of cpd types to use as select options
     * 
     * @return array Array of cpd type objects
     */
    public function get_cpd_type_options() {

        $data = array();
        $this->db
                ->order_by('sort_order', 'asc');
        $query = $this->db->get($this->tbl_cpd_type);
        foreach ($query->result() as $row) {
            $rows[$row->id] = $row->description;
        }

        return $rows;
    }

    public function get_employee_activities($employee_id) {
        
        $rows = array();
        $query = $this->db->get_where($this->v_activity, 
                array('employee_id' => $employee_id));
        
        foreach ($query->result() as $row){
            $rows[] = $row;
        }
        
        return $rows;
    }

    /**
     * Query db for array of priorities to use as select options
     * 
     * @return array Array of priority objects
     */
    public function get_priority_options() {

        $data = array();
        $this->db
                ->order_by('sort_order', 'asc');
        $query = $this->db->get($this->tbl_priority_type);
        foreach ($query->result() as $row) {
            $rows[$row->id] = $row->description;
        }

        return $rows;
    }
    
    /**
     * Query db for array of targets to use as select options
     * 
     * @return array Array of target objects
     */
    public function get_target_options($employee_id) {

        $data = array();
        $this->db->where('employee_id', $employee_id);
        $query = $this->db->get($this->tbl_target);
        foreach ($query->result() as $row) {
            $rows[$row->id] = $row->title;
        }

        return $rows;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->tbl_activity, $data);
    }

}

?>
