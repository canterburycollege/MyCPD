<?php

class Auth_user_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->test_auth_user();
    }

    /**
     * Query db for authorised user details
     * 
     * @return object
     */
    public function get_auth_user() {
        $logged_in_user = $this->get_logged_in_user();
        $ldap_username = $logged_in_user->username;
        
        $data = $this->get_employee($ldap_username);
        if (empty($data)) {
            show_error('cannot find user ('
                    . $ldap_username . ') in database');
        }
        
        ##$data = new stdClass();
        ##$data->id = 1; // set for testing

        return $data;
    }
    
    /**
     * Query db for employee details
     * 
     * @return object 
     */
    private function get_employee($ldap_username){
        $query = $this->db->get_where('employee',array('ldap_username'=>$ldap_username));
        $row = $query->row();
        return $row;
    }

    /**
     * Get logged in client username (Active Directory user) from apache server.
     * 
     * This a copy taken 2008-08-21 from http://siphon9.net/loune/f/ntlm.php.txt 
     * to make sure the code is not lost.
     * For more information see:
     * http://blogs.msdn.com/cellfish/archive/2008/08/26/getting-the-logged-on-windows-user-in-your-apache-server.aspx
     * NTLM specs http://davenport.sourceforge.net/ntlm.html
     */
    private function get_logged_in_user() {
        $headers = apache_request_headers();

        if (!isset($headers['Authorization'])) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: NTLM');
            exit;
        }

        $auth = $headers['Authorization'];

        if (substr($auth, 0, 5) == 'NTLM ') {
            $msg = base64_decode(substr($auth, 5));
            if (substr($msg, 0, 8) != "NTLMSSP\x00")
                die('error header not recognised');

            if ($msg[8] == "\x01") {
                $msg2 = "NTLMSSP\x00\x02" . "\x00\x00\x00\x00" . // target name len/alloc
                        "\x00\x00\x00\x00" . // target name offset
                        "\x01\x02\x81\x01" . // flags
                        "\x00\x00\x00\x00\x00\x00\x00\x00" . // challenge
                        "\x00\x00\x00\x00\x00\x00\x00\x00" . // context
                        "\x00\x00\x00\x00\x30\x00\x00\x00"; // target info len/alloc/offset

                header('HTTP/1.1 401 Unauthorized');
                header('WWW-Authenticate: NTLM ' . trim(base64_encode($msg2)));
                exit;
            } else if ($msg[8] == "\x03") {

                function get_msg_str($msg, $start, $unicode = true) {
                    $len = (ord($msg[$start + 1]) * 256) + ord($msg[$start]);
                    $off = (ord($msg[$start + 5]) * 256) + ord($msg[$start + 4]);
                    if ($unicode)
                        return str_replace("\0", '', substr($msg, $off, $len));
                    else
                        return substr($msg, $off, $len);
                }

                $data = new stdClass();
                $data->username = get_msg_str($msg, 36);
                $data->domain = get_msg_str($msg, 28);
                $data->workstation = get_msg_str($msg, 44);

                return $data;
            }
        }
    }

    /**
     * Force moodle login & get user details
     * 
     * Attributes include id, username(ldap), firstname, lastname, email
     * 
     * @return object Moodle user details (return NULL, if not logged in)
     */
    private function get_moodle_user() {

        /**
         * @todo make sure moodle path is correct!
         */
        // call moodle config file
        require_once '../../config.php';
        // force login
        require_login();
        $user_object = $DB->get_record('user', array('id' => $USER->id));

        return $user_object;
    }

    /**
     * For testing/demo
     * 
     * Insert dummy row with id=1, if doesn't already exist
     */
    public function test_auth_user() {

        $affected_rows = 0;
        $test_id = 1;
        $tbl = 'mycpd.employee';
        $row = array(
            'id' => $test_id,
            'display_name' => 'Treesa Green',
            'moodle_user_id' => '99',
            'mycpd_access_group' => 'test'
        );

        // check if row already exists and insert, if not
        $query = $this->db->get_where($tbl, array('id' => $test_id), 1, 0);
        if ($query->num_rows() == 0) {
            $this->db->insert($tbl, $row);
            $affected_rows = $this->db->affected_rows();
        }
        // echo msg if test row inserted (should really return msg!)
        if ($affected_rows > 0) {
            //echo "<p>Test msg : {$affected_rows} test row inserted into employee table</p>";
        } else {
            //echo '<p>Test msg : test employee already exists in employee table</p>';
        }
    }

}

/* End of file auth_user_model.php */
/* Location: ./models/auth_user_model.php */

