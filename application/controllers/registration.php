<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_register');
    }

    public function index() {
        $data['view'] = 'view_registration';
        $this->load->view('default', $data);
    }

    public function register_user() {
        $this->load->library('form_validation');
        $this->load->helper('creditcard_helper');
        // Rules for becoming a member
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|min_length[6]|max_length[50]|valid_email|is_unique[mem_users.username]|is_unique[new_users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]|matches[password_conf]|xss_clean');
        $this->form_validation->set_rules('password_conf', 'Password Match', 'trim|required|min_length[6]|max_length[50]|matches[password]|xss_clean');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[14]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[14]|xss_clean');
        $this->form_validation->set_rules('billing_address', 'Billing Address', 'trim|required|min_length[3]|max_length[89]|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state_prov', 'State/Province', 'required');
        $this->form_validation->set_rules('postal', 'Postal Code', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric|min_length[10]|');
//            $this->form_validation->set_rules('card_brand','Card Type','required');
//            $this->form_validation->set_rules('expiry_date','Expire Date','');
//            $this->form_validation->set_rules('card_number','Card Number','required|trim|required|min_length[15]|max_length[20]|xss_clean|numeric');
//            $this->form_validation->set_rules('card_number','Card Number','required|trim|required|min_length[15]|max_length[20]|xss_clean|numeric');
//            $this->form_validation->set_rules('card_number','Card Number','required|trim|required|min_length[15]|max_length[20]|xss_clean|numeric');

        $data['elliot'] = put_it("him and her");



        if ($this->form_validation->run() == FALSE) {
            // user didn't validate, send him back to register form and show errors
            $data['view'] = 'view_registration';
            $this->load->view('default', $data);
        } else {


            // returns users first name if successful
            $result = $this->model_register->insert_user();

            if ($result) {
                $data['view'] = 'view_reg_success';
                $data['firstname'] = $result;
                $this->load->view('default', $data);
            }
        }
    }
    
    public function validate_email($email_address, $email_code){
        $email_code = trim($email_code);
        
        $validated = $this->model_register->validate_email($email_address, $email_code);
        
        if ($validated === TRUE){
            $data['view'] = 'view_email_validated';
            $this->load->view('default', $data);
        } else {
            echo "Error giving email activation confirmation contact sysadmin";
        }
    }

}

?>
