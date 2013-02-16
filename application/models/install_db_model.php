<?php

class Install_db_model extends CI_Model {
    
    private $tbl_priority_type = 'priority_type';
    private $tbl_target_status = 'target_status';

    public function __construct() {
        $this->load->database();
    }

    public function create_database() {
        
    }

    /** 
     * 
     * @return integer Number of rows inserted
     */
    public function add_priority_types() {

        $data = array(
            array(
                'description' => 'High',
                'sort_order' => '1'
            ),
            array(
                'description' => 'Medium',
                'sort_order' => '2'
            ),
            array(
                'description' => 'Low',
                'sort_order' => '3'
            )
        );

        $this->db->insert_batch($this->tbl_priority_type, $data);
        return $this->db->affected_rows();
    }

    /**
     * 
     * @return integer Number of rows inserted
     */
    public function add_target_statuses() {
        
        /**
         * @todo Add real data!
         */
        $data = array(
            array(
                'title' => 'Status 1',
                'sort_order' => '1'
            ),
            array(
                'title' => 'Status 2',
                'sort_order' => '2'
            ),
            array(
                'title' => 'Status 3',
                'sort_order' => '3'
            )
        );
        
        $this->db->insert_batch($this->tbl_target_status, $data);
        return $this->db->affected_rows();
    }

}

?>
