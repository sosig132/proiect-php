<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  @property form_validation $form_validation 
 *  @property User_model $user
 *  @property encryption $encryption

 */

class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
    }

    public function index(){
        if(!$this->session->userdata('authenticated')){
            $this->load->view('templates/header');
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        }
        else{
            redirect(base_url('main'));
        }
    }
    

    //session authentication

    public function login(){
        
        $email_or_phone = $this->input->post('emailphone');
        $password = $this->input->post('password');
        
        $user = new User_model();

        $logged_user = $user->login($email_or_phone, $password);
        if($logged_user){

            $auth_userdetails=[
                'id' => $logged_user->id,
                'name'=> $logged_user->name,
                'email'=> $logged_user->email,
                'phone'=> $logged_user->phone,
                'avatar'=> $logged_user->avatar
            ];
        
            

            $this->session->set_userdata('authenticated','1');
            $this->session->set_userdata('auth_user', $auth_userdetails);


            redirect(base_url('main'));
        }
        else{
            $this->session->set_flashdata('login_failed', 'Invalid email/phone or password');
            redirect(base_url('login'));
        }
    }
}
?>