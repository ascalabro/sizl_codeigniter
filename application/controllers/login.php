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
            $data['view'] = 'view_login';
            $this->load->view('default', $data);
        }
        else {
            // initial checks on data are ok, now check the db for valid credentials or not
            $result = $this->model_login->login_user();
            switch ($result) {
                case 'logged_in':
                    // authenticated, send to logged in homepage
                    redirect('/','location');
                    break;
                case 'incorrect_password':
                    $data['view'] = 'view_login';
                    $this->load->view('default', $data);
                    break;
                case 'not_activated':
                    $data['view'] = 'view_login';
                    $this->load->view('default', $data);
                    break;
                case 'email_not_found':
                    $data['view'] = 'view_login';
                    $this->load->view('default', $data);
                    break;
            }
        }
    }
}

?>
