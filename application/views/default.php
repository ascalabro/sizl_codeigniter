<?php
$data['result'] = isset($result) ? $result : null;
$this->load->view('includes/header');
$this->load->view($view, $data);
$this->load->view('includes/footer');
?>
