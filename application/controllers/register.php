<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  
 *  @property form_validation $form_validation
 *  @property upload $upload
 *  @property encryption $encryption
 */


class Register extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('encryption');
        $this->load->helper(array('form','url'));
    }

    public function index(){
        if(!$this->session->userdata('authenticated')){
            $this->load->view('templates/header');
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        }
        else{
            redirect(base_url('main'));
        }

    }
    
    
    //if number doesn't begin with 0, it isn't valid
    public function phone_check($number){
        if(strlen($number)==0){
            $this->form_validation->set_message('phone_check', 'Phone number is required.');
            return false;
        }
        if($number[0]!='0'){
            $this->form_validation->set_message('phone_check', 'Phone numbers should start with 0. We only accept Romanian phone numbers.');
            return false;
        }
        else{
            return true;
        }
    }
    public function register(){

        //form validation

        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("phone", "Phone Number", "trim|required|numeric|exact_length[10]|is_unique[users.phone]|callback_phone_check");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|max_length[16]");
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("avatar", "Avatar", "");
        
        
        if($this->form_validation->run() == FALSE){
            $this->index();
        }

        

        else{

            $data = array(
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'password' => $this->encryption->encrypt($this->input->post('password')),
            );

            //checking if avatar was uploaded by user
            
            $avatar_uploaded = !empty($_FILES['avatar']['name']);
            
            if($avatar_uploaded){
                $config['upload_path'] = './uploads';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['encrypt_name'] = TRUE; 

                //if not exists, create directory

                if(!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                //uploading avatar to directory

                if ($this->upload->do_upload('avatar')) {
                    $upload_data = $this->upload->data();
                    $avatar_name = $upload_data['file_name'];
                    $data['avatar'] = $avatar_name;
                } else {
                    $error = $this->upload->display_errors();
                    echo $error;
                    return;
                }    
                
            }
            else{
                $data['avatar'] = 'default.png';
            }
            $register_user = new User_model();
            $checking = $register_user->register($data);
            if($checking){
                $this->session->set_flashdata('success', 'Registered Successfully');


                redirect(base_url('login'));
                echo $this->session->flashdata('error');
            }
            else{
                $this->session->set_flashdata('error', 'Registration Failed');
                $error = $this->upload->display_errors();
                echo $error;
            }
                
        }
    }
}
?>