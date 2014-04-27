<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('model_login');
    }
    
    public function index(){
        $data['view'] = 'view_login';
        $this->load->view('default',$data);
    }
        
    public function login_user() {
        $this->load->library('form_validation');
        
        // the following login mistakes we can know without even querying the database
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|min_length[6]|max_length[50]|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]');
        
        if ($this->form_validation->run() == FALSE) {
            // user didn't validate login form, send him back to form (and show errors)
            $data['result'] = 'form invalid';
            $data['view'] = 'view_login';
            $this->load->view('default', $data);
        }  else {
            // initial checks on data are ok, now check the db for valid credentials or not
            $result = $this->model_login->login_user();
            switch ($result) {
                case 'logged_in':
                    // authenticated, send to logged in homepage
                    $data['result'] = $result;
                    redirect(site_url());
                    break;
                case 'incorrect_password':
                    $data['result'] = $result;
                    $data['view'] = 'view_login';
                    $this->load->view('default', $data);
                    break;
                case 'not_activated':
                    $data['result'] = $result;
                    $data['view'] = 'view_login';
                    $this->load->view('default', $data);
                    break;
                case 'email_not_found':
                    $data['result'] = $result;
                    $data['view'] = 'view_login';
                    $this->load->view('default', $data);
                    break;
                default:
                    $data['result'] = 'all invalid';
                    $data['view'] = 'view_login';
                    $this->load->view('default', $data);
                    break;
            }
        }
    }
    
    public function reset_password(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $this->load->library('form_validation');
            // first check if its a valid email or not
            $this->form_validation->set_rules('email','Email Address', 'trim|required|min_length[6]|max_length[50]|valid_email|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                // email didn't validate, send back to reset password form and show the errors
                // this will likely never occur due to front end validation done on type="email"
                $data['view'] = 'view_reset_password';
                $data['error'] = 'Please supply a valid email address.';
                $this->load->view('default', $data);
            } else {
                $email = trim($this->input->post('email'));
                $result = $this->model_login->email_exists($email);
                
                if ($result) {
                    // if we found the email, $result is now their first name
                    $this->model_login->send_reset_password_email($email, $result);
                    $data['view'] = 'view_reset_password_sent';
                    $this->load->view('default',$data);
                } else {
                    $data['view'] = 'view_reset_password';
                    $this->load->view('default',$data);
                }
            }
        }
        $data['view'] = 'view_reset_password';
        $this->load->view('default', $data);
    }
    
    public function reset_password_form($email, $email_code){
        if(isset($email, $email_code)) {
            $email = trim($email);
            $email_hash = sha1($email . $email_code);
            $verified = $this->model_login->verify_reset_password_code($email, $email_code);
            
            if ($verified) {
                $data['email_hash'] = $email_hash;
                $data['email_code'] = $email_code;
                $data['email'] = $email;
                $this->load->view('includes/header');
                $this->load->view('view_update_password', $data);
                $this->load->view('includes/footer');
            } else {
                $data['error'] = 'There was a problem with your link. Please click it again or request to reset your password again';
                $data['email'] = $email;
                $this->load->view('includes/header');
                $this->load->view('view_reset_password', $data);
                $this->load->view('includes/footer');
            }
        } else {
            #redirect();
        }
    }
    
    public function update_password() {
        if (!isset($_POST['email'], $_POST['email_hash']) || $_POST['email_hash'] !== sha1($_POST['email'] . $_POST['email_code'] )) {
            // if user is here, he is either a hacker or changed email in the email field, just die no reason to be polite;
            die('Error updating your password');
        }
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email_hash','Email Hash', 'trim|required');
        $this->form_validation->set_rules('email','Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password','Password', 'trim|required|min_length[6]|max_length[50]|matches[password_conf]|xss_clean');
        $this->form_validation->set_rules('password_conf','Confirmed Password', 'trim|required|min_length[6]|max_length[50]|matches[password]|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            // user didn't validate the reset password form, send him back to it and show errors
            $data['view'] = 'view_update_password';
            $this->load->view('default',$data);
        } else {
            // successful update
            // return users first name if success
            $result = $this->model_login->update_password();
            
            if ($result) {
                $data['view'] = 'view_update_password_success';
                $this->load->view('default',$data);
            } else {
                //this should never happen
                $data['view'] = 'view_update_password';
                $data['error'] = 'Error updating your password contact support.';
                $this->load->view('default',$data);
            }
        }
    }
    
}

?>
