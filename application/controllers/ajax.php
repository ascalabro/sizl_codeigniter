<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getIntroVid(){
        $this->load->model('model_JWPlayer');
        $playlist_json = $this->model_JWPlayer->getIntroVid();
        echo $playlist_json;
    }
}
