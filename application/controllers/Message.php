<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  @property form_validation $form_validation 
 *  @property User_model $user
 *  @property Message_model $message
 *  @property encryption $encryption

 */

class Message extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Message_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
    }

    public function index(){

        if($this->session->userdata('authenticated')){
            $data['messages'] = $this->Message_model->get_messages();

            $this->load->view('templates/header');
            $this->load->view('pages/main', $data);
            $this->load->view('templates/footer');
        }
        else{
            redirect(base_url('login'));
        }
    }
    
    public function post_message(){
        
        $this->form_validation->set_rules('content', 'Message', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message_failed', 'Message cannot be empty.');
            redirect(base_url('main'));
        }

        //we get message and user_id that posted the message

        $message = $this->input->post('content');
        $user_id = $this->session->userdata('auth_user')['id'];

        $message = new Message_model();

        $checking = $message->post_message($user_id);

        if($checking){
            redirect(base_url('main'));
        }
        else{
            $this->session->set_flashdata('message_failed', 'Message failed to post.');
            redirect(base_url('main'));
        }
    }

    public function delete_message($message_id) {
        $message = new Message_model();
        $checking = $message->delete_message($message_id);
        
        if($checking){

            redirect(base_url('main'));
        }
        else{
            $this->session->set_flashdata('message_failed', 'Message failed to delete.');
            redirect(base_url('main'));
        }
    }
}
?>