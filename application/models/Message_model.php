<?php


class Message_model extends CI_Model{
    public $id;
    public $content;
    public $created_at;
    public $user_id;

    public function __construct(){
        parent::__construct();
    }

    public function get_messages(){

        //we do an inner join because we only want info about users that have posted messages

        $this->db->select('messages.*, users.name, users.avatar');
        $this->db->from('messages');
        $this->db->join('users', 'users.id = messages.user_id', 'inner');
        $this->db->order_by('messages.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_message($id){
        $this->db->where('id', $id);
        return $this->db->delete('messages');
    }



    public function post_message($user_id){
        $this->content = $this->input->post('content');
        $this->created_at = date('Y-m-d H:i:s');
        $this->user_id = $user_id;
        return $this->db->insert('messages', $this);
    }
    
}