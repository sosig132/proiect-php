<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  @property form_validation $form_validation 
 *  @property User_model $user
 */

class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
    }

    public function index(){
        $this->load->view('templates/header');
        $this->load->view('auth/login');
        $this->load->view('templates/footer');
    }
    
    public function login(){
        
        $email_or_phone = $this->input->post('emailphone');
        $password = $this->input->post('password');
        
        $user = new User_model();

        $logged_user = $user->login($email_or_phone, $password);
        if($logged_user){
            $this->session->set_userdata('user_id', $logged_user->id);
            $this->session->set_userdata('user_name', $logged_user->name);
            $this->session->set_userdata('user_email', $logged_user->email);
            $this->session->set_userdata('user_phone', $logged_user->phone);
            $this->session->set_userdata('user_avatar', $logged_user->avatar);
            redirect('home');
        }
        else{
            $this->session->set_flashdata('login_failed', 'Invalid email/phone or password');
            redirect('login');
        }
    }
}