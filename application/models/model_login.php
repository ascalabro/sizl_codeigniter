<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class model_login extends CI_Model {
    
    public function login_user() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $domain = $this->input->post('domain');
        $ip = $this->input->post('ip');
        
        $members_sql = "SELECT user_id, buyer_first_name, buyer_last_name, buyer_email, buyer_country, passwordhash FROM " . $domain . "_users WHERE buyer_email = '{$email}' LIMIT 1";
        $result = $this->db->query($members_sql);
        $row = $result->row();
        
        if ($result->num_rows() === 1) {
            if($row->passwordhash === md5($password)){
                // authenticated, now update the user's session 
                $session_data = array(
                    'user_id'   =>  $row->user_id,
                    'firstname' =>  $row->buyer_first_name,
                    'lastname' =>  $row->buyer_last_name,
                    'email' =>  $row->buyer_email,
                    'country' =>  $row->buyer_country
                );
                $this->set_session($session_data);
                return 'logged_in';
            } else {
                return 'incorrect_password';
            }
        } else {
            // test if the user is a new member and not activated yet
            $newuser_sql = "SELECT buyer_email FROM new_users WHERE buyer_email = '{$email}' LIMIT 1";
            $result = $this->db->query($newuser_sql);
            return $result->num_rows() === 1 ? 'not_activated' : 'email_not_found' ;
        } 
    }
    
    private function set_session($session_data) {
        $sess_data = array(
            'user_id' => $session_data['user_id'],
            'firstname' => $session_data['firstname'],
            'lastname' => $session_data['lastname'],
            'email' => $session_data['email'],
            'country' => $session_data['country'],
            'logged_in' => 1
        );
        $this->session->set_userdata($sess_data);
    }
}

?>
