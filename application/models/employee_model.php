<?php
/**
 * Class to represent an Employee 
 * 
 * Interacts with database
 */
class Employee_model extends CI_Model {
    
    protected $tbl_employee = 'employee';

    public function __construct() {
        $this->load->database();
    }
    
    /**
     * Add new employee to db
     * 
     * @param array $data Array of key=>value pairs containing data to be added
     */
    public function create_employee($data){
        
    }
    
    /**
     * Delele employee from db
     * 
     * @param integer $id Employee row id
     */
    public function delete_employee($id){
        
    }


    /**
     * Query db for a complete Employee object
     * 
     * @param integer $id Employee row id
     * @return object An Employee object
     */
    public function get_employee($id) {
        
        $query = $this->db->get_where($this->tbl_employee, 
                array('id' => $id));
        $employee = $query->row();
       
        return $employee;
    }
    
    /**
     * Edit employee in db
     * 
     * @param integer $id Employee row id
     * @param array $data Array of key=>value pairs containing data to be edited
     */
    public function update_employee($id,$data){
        
    }
    
}

/* End of file employee_model.php */
/* Location: ./models/employee_model.php */

