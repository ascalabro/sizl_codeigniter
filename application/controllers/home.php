<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

class Home extends CI_Controller {
    
    private $logged_in;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in')){
            $this->logged_in = TRUE;
        } else {
            $this->logged_in = FALSE;
        }
    }

    public function index() {
        $data['view'] = 'view_home';
        $data['logged_in'] = $this->logged_in;
        $this->load->view('default', $data);
    }

}

?>
