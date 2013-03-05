<?php

class News_model extends CI_Model {

    protected $tbl_news = 'news';
    
    public function __construct() {
        $this->load->database();
    }

    public function get_news() {
        $query = $this->db->get($this->tbl_news);
        return $query->result_array();
   }

 
public function set_news()
{
	$this->load->helper('url');
	
	$data = array(
		'description' => $this->input->post('description')	
	);
	
	return $this->db->update('news', $data);
}
 
}