<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
                $data['view'] = 'view_home';
                $this->load->view('default',$data);
	}
}
?>
