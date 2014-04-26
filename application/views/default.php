<?php
$data['result'] = isset($result) ? $result : null;
$data['logged_in'] = isset($logged_in) ? $logged_in : null;
$data['error'] = isset($error) ? $error : null;
$this->load->view('includes/header');
$this->load->view($view, $data);
$this->load->view('includes/footer');
?>
