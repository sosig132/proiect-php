<?php

class Home extends CI_Controller {
    public function index() {
        $this->load->view('templates/header');
        $this->load->view('navbar/navbar');
        $this->load->view('pages/home');
        $this->load->view('templates/footer');
    }
}

?>