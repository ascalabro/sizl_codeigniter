<?php

class Model_JWPlayer extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getIntroPlaylist() {
        return file_get_contents("assets/js/custom.json");
    }

}

?>
