<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Logout extends CI_Controller{

    public function __construct(){

        parent::__construct();
        
    }

    public function logout(){
        $this->session->unset_userdata('authenticated');
        $this->session->unset_userdata('auth_user');
        redirect(base_url('login'));
    }
}

?>