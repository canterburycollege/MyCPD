<?php

class mandatory_cpd_model extends CI_Model {

    /**
     *
     * @var string Moodle scorm score tracking table name
     */
    protected $tbl_mdl_scorm_scoes_track = 'mdl_scorm_scoes_track';
    
    public function __construct() {
        
    }

    public function get_score() {
        
        $db2 = $this->load->database('moodle', TRUE);
        $query = $db2->query("SELECT mdl_scorm_scoes.title, mdl_scorm_scoes_track.value
                             FROM mdl_scorm_scoes_track INNER JOIN mdl_scorm_scoes ON mdl_scorm_scoes_track.scoid = mdl_scorm_scoes.id
                             WHERE (((mdl_scorm_scoes_track.element)='cmi.core.score.raw') AND ((mdl_scorm_scoes_track.userid)='2528'))
                            ");
        
        
        
        
        return $query->result_array();
    }
}

//Todo
//if id does not exists red light
//if id exists and is <80% yellow light
//if id exists and is >80% green light
