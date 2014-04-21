<?php

class Model_JWPlayer extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getIntroVid() {
        return json_encode($this->config->item('introPlaylist'));
    }

}

?>
