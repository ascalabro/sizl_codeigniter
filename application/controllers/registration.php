<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function index()
	{
                $data['view'] = 'view_registration';
                $this->load->view('default',$data);
	}
}
?>
