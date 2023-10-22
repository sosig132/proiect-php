<?php
/**
 *  @property encryption $encryption    
 *  
 */

class User_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->library('encryption');
    }


    

    public function register($data){
        
        return $this->db->insert('users', $data);
    }

    public function login($identifier, $password){
        $key = $this->config->item('encryption_key');

        $this->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' =>$this->config->item('encryption_key')
            )
        );

        $this->db->where('email', $identifier);
        $this->db->or_where('phone', $identifier);
        $query = $this->db->get('users');
        $user = $query->row();
        if($user){
            if( $this->encryption->decrypt($password) == $user->password){
                return $user;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function get_users(){
        $this->db->where('avatar !=', NULL);
        $query = $this->db->get('users');
        return $query->result();
    }


}