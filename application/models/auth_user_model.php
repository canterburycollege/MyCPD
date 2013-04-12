<?php

class Auth_user_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->test_auth_user();
    }

    /**
     * Query db for authorised user details
     * 
     * @return object Contains details from employee table.
     */
    public function get_auth_user() {
        $logged_in_user = $this->get_logged_in_user();
        $ldap_username = $logged_in_user->username;
        
        $data = $this->get_employee($ldap_username);
        if (empty($data)) {
            show_error('cannot find user ('
                    . $ldap_username . ') in database');
        }

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
}

/* End of file auth_user_model.php */
/* Location: ./models/auth_user_model.php */