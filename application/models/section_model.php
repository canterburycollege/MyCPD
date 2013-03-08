<?php
/**
 * Class to represent an Section 
 * 
 * Interacts with database
 */
class Section_model extends CI_Model {
    
    protected $tbl_section = 'section';

    public function __construct() {
        $this->load->database();
    }
    
    /**
     * Add employee to section
     * 
     * @param integer $employee_id 
     */
    public function add_employee($employee_id){
        /** 
         * @todo add code 
         */
    }
    
    /**
     * Add new section to db
     * 
     * @param array $data Array of key=>value pairs containing data to be added
     */
    public function create($data){
        $this->db->insert($this->tbl_section, $data);
        return $this->db->affected_rows();
    }
    
    /**
     * Delele section from db
     * 
     * @param integer $id Section row id
     */
    public function delete($id){
        $this->db->delete($this->tbl_section, array('id' => $id));
        return $this->db->affected_rows();
    }


    /**
     * Query db for a complete Section object
     * 
     * @param integer $id Section row id
     * @return object An Section object
     */
    public function get_section($id) {
        
        $query = $this->db->get_where($this->tbl_section, array('id' => $id));
        $section = $query->row();
       
        return $section;
    }
    
    /**
     * Remove employee from section
     * 
     * @param integer $employee_id 
     */
    public function remove_employee($employee_id){
        /** 
         * @todo add code 
         */
    }
    
    /**
     * Edit section in db
     * 
     * @param integer $id Section row id
     * @param array $data Array of key=>value pairs containing data to be edited
     */
    public function update($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->tbl_section, $data);
        return $this->db->affected_rows();
    }
    
}

/* End of file section_model.php */
/* Location: ./models/section_model.php */

