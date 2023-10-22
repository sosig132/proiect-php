<?php


class Message_model extends CI_Model{
    public $id;
    public $content;
    public $created_at;
    public $user_id;

    public function __construct(){
        parent::__construct();
    }
    public function get_by_user_id($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('messages');
        return $query->result();
    }

    /*public function post_message(){
        $this->content = $this->input->post('content');
        $this->created_at = date('Y-m-d H:i:s');
        $this->user_id = $this->session->userdata('user_id');
        $this->db->insert('messages', $this);
    }*/
    public function post_message($user_id){
        $this->content = $this->input->post('content');
        $this->created_at = date('Y-m-d H:i:s');
        $this->user_id = $user_id;
        $this->db->insert('messages', $this);
    }
    
}