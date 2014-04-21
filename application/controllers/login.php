<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Angelo
 */
class login extends CI_Controller {
    
    public function index()
	{
                $data['view'] = 'view_login';
                $this->load->view('default',$data);
	}
        
}

?>
