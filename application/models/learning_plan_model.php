<?php

/**
 * Represents a Learning Plan
 * 
 * Interacts with database
 */
class Learning_plan_model extends CI_Model {
    
    /**
     *
     * @var string Learning plan header table name
     */
    protected $tbl_learning_plan = 'Learning_plan';
    /**
     *
     * @var string Learning plan detail table name
     */
    protected $tbl_learning_plan_detail = 'Learning_plan_detail';
    /**
     *
     * @var string Learning pla targets table name
     */
    protected $tbl_learning_plan_target = 'Learning_plan_target';
    /**
     *
     * @var string Priorities table name
     */
    protected $tbl_priority_type = 'Priority_type';
    /**
     *
     * @var string Learning plan view name - joins all related tables
     */
    protected $v_learning_plan_detail = 'v_learning_plan_detail';
    

    public function __construct() {
        $this->load->database();
    }
    
    /**
     * Add new learning plan header to db
     * 
     * @param array $data Array of key=>value pairs containing data to be added
     */
    public function create_header($data){
        $this->db->insert($this->tbl_learning_plan, $data);
    }
    
    /**
     * Add new learning plan detail to db
     * 
     * @param array $data Array of key=>value pairs containing data to be added
     */
    public function create_detail($data){
        $this->db->insert($this->tbl_learning_plan_detail, $data); 
    }
    
    /**
     * Delele learning plan header + details from db
     * 
     * @param integer $id Learning plan row id
     */
    public function delete_learning_plan($id){
        // get array of detail row ids
        // foreach detail row id: detete detail row
        // delete header row
        // return message with number of rows deleted
    }
    
    /**
     * Delele learning plan detail from db
     * 
     * @param integer $id Learning plan detail row id
     */
    public function delete_detail($id){
        
    }
    
    /**
     * Query db for list of learning plans (for given employee)
     * 
     * @param integer $employee_id Employee row id
     * @return array Array of learning plan id/year
     */
    public function get_header_list($employee_id){
        
        $data = array();
        $this->db
            ->select('id','academic_year')
            ->where('employee_id', $employee_id)
            ->order_by('academic_year', 'desc');
        $query = $this->db->get($this->tbl_learning_plan);
        foreach ($query->result() as $row){
            $data[] = $row;
        }
        
        return $data;
    }
    
    /**
     * Query db for learning plan with latest year
     * 
     * @param integer $employee_id Employee row id
     * @return integer Learning plan header row id
     */
    public function get_latest_header_id($employee_id){

        $this->db
            ->select('id','academic_year')
            ->where('employee_id', $employee_id)
            ->order_by('academic_year', 'desc')
            ->limit(1,0);
        $query = $this->db->get($this->tbl_learning_plan);
        
        if ($rows = $query->result()) {
            return $rows[0]->id;
        }
    }
    
    /**
     * Query db for a complete Learning Plan object
     * 
     * @param integer $id Learning plan header row id
     * @return object Learning Plan header row
     */
    public function get_learning_plan($id) {
        
        $object = new stdClass();
        $query = $this->db->get_where($this->tbl_learning_plan, 
                array('id' => $id));
        
        $object->header =  $query->row();
        $object->details = $this->get_detail($id);
        
        return $object;
    }
    
    /**
     * Query db Learning Plan detail rows
     * 
     * @param integer $learning_plan_id Learning plan header row id
     * @return array Array of Learning Plan detail rows (objects)
     */
    protected function get_detail($learning_plan_id){
        
        $rows = array();
        $query = $this->db->get_where($this->v_learning_plan_detail, 
                array('learning_plan_id' => $learning_plan_id));
        
        foreach ($query->result() as $row){
            $rows[] = $row;
        }
        
        return $rows;
    }
    
    /**
     * Edit learning plan header in db
     * 
     * @param integer $learning_plan_id
     * @param array $data Array of key=>value pairs containing data to be edited
     */
    public function update_header($learning_plan_id,$data){
        
    }
    
    /**
     * Edit learning plan detail in db
     * 
     * @param integer $learning_plan_detail_id
     * @param array $data Array of key=>value pairs containing data to be edited
     */
    public function update_detail($learning_plan_detail_id,$data){
        
    }
    
    /**
     * Query db for array of priorities
     * 
     * @return array Array of priority objects
     */
    public function get_priority_options(){
        
        $data = array();
        $this->db
            ->order_by('sort_order', 'asc');
        $query = $this->db->get($this->tbl_priority_type);
        foreach ($query->result() as $row){
            $rows[$row->id] = $row->description;
        }
      
        return $rows;
    }
    
    /**
     * Query db for array of targets (for given learning plan)
     * 
     * @param integer $learning_plan_id Learning plan row id
     * @return array Array of targets
     */
    public function get_target_options($learning_plan_id){
        
        $data = array();
        $this->db
                ->order_by('sort_order', 'asc');
        $query = $this->db->get($this->tbl_learning_plan_target);
        foreach ($query->result() as $row){
            $description = $row->sort_order . '. ' . $row->description;
            $rows[$row->id] = $description;
        }
        
        return $rows;
    }

}

/* End of file learning_plan_model.php */
/* Location: ./models/learning_plan_model.php */

