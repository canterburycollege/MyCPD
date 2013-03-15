<?php
/**
 * Class to represent an Faculty 
 * 
 * Interacts with database
 */
class Faculty_model extends CI_Model {
    
    protected $tbl_faculty = 'faculty';

    public function __construct() {
        $this->load->database();
    }
    
    /**
     * Add new faculty to db
     * 
     * @param array $data Array of key=>value pairs containing data to be added
     */
    public function create($data){
        $this->db->insert($this->tbl_faculty, $data);
        return $this->db->affected_rows();
    }
    
    /**
     * Delele faculty from db
     * 
     * @param integer $id Faculty row id
     */
    public function delete($id){
        $this->db->delete($this->tbl_faculty, array('id' => $id));
        return $this->db->affected_rows();
    }


    /**
     * Query db for a complete Faculty object
     * 
     * @param integer $id Faculty row id
     * @return object An Faculty object
     */
    public function get_faculty($id) {
        
        $query = $this->db->get_where($this->tbl_faculty, array('id' => $id));
        $faculty = $query->row();
       
        return $faculty;
    }
    
    /**
     * Query db for array of faculties to use as select options
     * 
     * @return array Array of faculty objects
     */
    public function get_faculty_options() {

        $data = array();
        $this->db
                ->order_by('title', 'asc');
        $query = $this->db->get($this->tbl_faculty);
        foreach ($query->result() as $row) {
            $rows[$row->id] = $row->title;
        }

        return $rows;
    }
    
    /**
     * Query db for a list of faculties
     * @return array of Faculty objects
     */
    public function get_faculties() {
        
        $rows = array();
        $query = $this->db->get($this->tbl_faculty);
        
        foreach ($query->result() as $row){
            $rows[] = $row;
        }
        
        return $rows;
    }
    
    /**
     * Edit faculty in db
     * 
     * @param integer $id Faculty row id
     * @param array $data Array of key=>value pairs containing data to be edited
     */
    public function update($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->tbl_faculty, $data);
        return $this->db->affected_rows();
    }
    
}

/* End of file faculty_model.php */
/* Location: ./models/faculty_model.php */

