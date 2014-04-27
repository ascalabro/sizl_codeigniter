<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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
            if ($row->passwordhash === md5($this->config->item('salt') . $password)) {
                // authenticated, now update the user's session 
                $session_data = array(
                    'user_id' => $row->user_id,
                    'firstname' => $row->buyer_first_name,
                    'lastname' => $row->buyer_last_name,
                    'email' => $row->buyer_email,
                    'country' => $row->buyer_country
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
            return $result->num_rows() === 1 ? 'not_activated' : 'email_not_found';
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

    public function email_exists($email) {
        $sql = "SELECT buyer_first_name, buyer_email FROM mem_users WHERE buyer_email = '{$email}' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();

        return ($result->num_rows() === 1 && $row->buyer_email) ? $row->buyer_first_name : FALSE;
    }

    public function verify_reset_password_code($email, $code) {
        $sql = "SELECT buyer_first_name, buyer_email FROM mem_users WHERE buyer_email = '{$email}' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();

        if ($result->num_rows() === 1) {
            return ($code == md5($this->config->item('salt') . $row->buyer_first_name));
        } else {
            return FALSE;
        }
    }

    public function send_reset_password_email($email, $firstname) {
        $email_code = md5($this->config->item('salt') . $firstname);
        $mail_to_send_to = $email;
        $from = "no-reply@sizl.tv";
        $headers = "From: " . "no-reply@sizl.tv";
        $subject = "Reset your password at Sizl.tv";
        $Header = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $Header .= 'From: <no-reply@sizl.tv>' . "\r\n";

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
            <meta http-equiv="Content-Type" content="text/html; charset-utf-8" />
            </head><body>';
        $message .= '<p>Dear ' . $firstname . ',</p>';
        // the link we send will look like /login/reset_password_form/john@doe.com/d2724727247sdfasdf73477a4f
        $message .= '<p>You requested to reset your password! Please <strong><a href="' . base_url() . 'login/reset_password_form/' . $email . '/' .
                $email_code . '">click here</a></strong> to reset your password. ';
        $message .= '<p>Thank You!</p>';
        $message .= '<p> The Team at Sizl.tv</p>';
        $message .= '</body></html>';
        mail($mail_to_send_to, $subject, $message, $Header);
    }
    
    public function update_password() {
        $email = $this->input->post('email');
        $new_password = md5($this->config->item('salt') . $this->input->post('password'));
        
        $sql = "UPDATE mem_users SET passwordhash = '{$new_password}' WHERE buyer_email = '{$email}' LIMIT 1";
        $this->db->query($sql);
        
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>
