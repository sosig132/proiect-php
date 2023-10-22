<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  
 *  @property form_validation $form_validation
 *  @property upload $upload
 *  @property encryption $encryption
 */


class Register extends CI_Controller{
    public $CI;
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('encryption');
        $this->load->helper(array('form','url'));
    }

    public function index(){

        $this->load->view('templates/header');
        $this->load->view('auth/register');
        $this->load->view('templates/footer');

    }
    
    public function avatar_check($image) {
        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $temp_file = $_FILES['avatar']['tmp_name'];
            if (getimagesize($temp_file) === false) {
                $this->form_validation->set_message('avatar_check', 'Please select a valid image.');
                return false;
            }
        } else {
            $this->form_validation->set_message('avatar_check', 'Avatar upload failed: ' . $_FILES['avatar']['error']);
            return false;
        }
    
        return true;
    }

    public function phone_check($number){
        if($number[0]!='0'){
            $this->form_validation->set_message('phone_check', 'Phone numbers should start with 0. We only accept Romanian phone numbers.');
            return false;
        }
        else{
            return true;
        }
    }
    public function register(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|numeric|exact_length[10]|is_unique[users.phone]|callback_phone_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[16]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('avatar', 'Avatar', '');
        if($this->form_validation->run() == FALSE){
            $this->index();
        }

        $this->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' =>$this->config->item('encryption_key')
            )
        );


        $data = array(
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'password' => $this->encryption->encrypt($this->input->post('password')),
        );
        $avatar_uploaded = !empty($_FILES['avatar']['name']);
        
        if($avatar_uploaded){
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE; 

            if(!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

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
    
        $register_user = new User_model();
        $checking = $register_user->register($data);
        if($checking){
            $this->session->set_flashdata('success', 'Registered Successfully');


            redirect(base_url('login'));
        }
        else{
            $this->session->set_flashdata('error', 'Registration Failed');
            $error = $this->upload->display_errors();
                echo $error;
            }
            
        
    }
}
?>