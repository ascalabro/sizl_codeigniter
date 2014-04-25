<?php

class Model_user extends CI_Model {
    
    private $email_code;

    public function __construct() {
        parent::__construct();
    }

    public function insert_user() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $billing_address = $this->input->post('billing_address');
        $city = $this->input->post('city');
        $state_prov = $this->input->post('state_prov');
        $postal = $this->input->post('postal');
        $country = $this->input->post('country');
        $phone = $this->input->post('phone');

        $sql = "INSERT INTO new_users (
                    username,
                    passwordhash,
                    buyer_first_name,
                    buyer_last_name,
                    buyer_address,
                    buyer_city,
                    buyer_state,
                    buyer_country,
                    buyer_zip,
                    buyer_phone,
                    buyer_email)
                VALUES (" . $this->db->escape($email) . ","
                . $this->db->escape(md5($password)) . ","
                . $this->db->escape($first_name) . ","
                . $this->db->escape($last_name) . ","
                . $this->db->escape($billing_address) . ","
                . $this->db->escape($city) . ","
                . $this->db->escape($state_prov) . ","
                . $this->db->escape($country) . ","
                . $this->db->escape($postal) . ","
                . $this->db->escape($phone) . ","
                . $this->db->escape($email) . ")";
        $result = $this->db->query($sql);

        if ($this->db->affected_rows() === 1) {
            // EMAIL THE GUY IN CHARGE OF PAYMENTS GET PAYMENT AFTER USER HAS BEEN ADDED
            $this->set_session($first_name,$last_name,$country, $email);
            $this->send_validation_email();
            return $first_name;
        } else {
            /*  Notify the admin by email that the user registration
             *  isn't working. This should never happen because of validation in controller
             */
            $this->load->library('email');
            $this->email->from('admin@a.com', 'Freight Forum Admin');
            $this->email->to('supportdesk@ex.com');
            $this->email->subject('Problem inserting user');
            
            if (isset($email)){
                
            }
        }
    }
    
    public function set_session($first_name, $last_name, $country, $email){
        $sql = "SELECT user_id, reg_time FROM new_users WHERE username = '" . $email . "' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();
        
        $sess_data = array(
            'user_id'   =>   $row->user_id,
            'firstname' =>   $first_name,
            'lastname'  =>   $last_name,
            'country'   =>   $country,
            'email'     =>   $email,
            'logged_in' =>   0
        );
        $this->email_code = md5((string)$row->reg_time);
        $this->session->set_userdata($sess_data);
    }
    
    private function send_validation_email() {
        $this->load->library('email');
        $email = $this->session->userdata('email');
        
        $this->email->set_mailtype('html');
        $this->email->from($this->config->item('noreply_email'),'Freight Forum');
        $this->email->to('angelo@affableitsolutions.com');
        $this->email->subject('Please activate your account at Freight Forum');
        
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
            <meta http-equiv="Content-Type" content="text/html; charset-utf-8" />
            </head><body>';
        $message .= '<p>Dear ' . $this->session->userdata('firstname') . ',</p>';
        // the link we send will look like /register/validate_email/john@doe.com/d2724727247sdfasdf73477a4f
        $message .= '<p>Thanks for registering on Sizl.tv! Please <strong><a href="' . base_url() . 'register/validate_email/' . $email . '/' . 
                $this->email_code . '">click here</a></strong> to activate your account. After you activate you are activated.';
        $message .= '<p>thank you!</p>';
        $message .= '<p> The Team at Sizl.tv</p>';
        $message .= '</body></html>';
        
        $this->email->message($message);
    }
    
    public function validate_email($email_address, $email_code){
        
    }

}

?>
