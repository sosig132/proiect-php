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
        
        //INSERT INTO users VALUES($data);

        return $this->db->insert('users', $data);
    }

    public function login($identifier, $password){
        
        //SELECT * FROM users WHERE email = $identifier OR phone = $identifier LIMIT 1;

        $this->db->where('email', $identifier);
        $this->db->or_where('phone', $identifier);
        $this->db->limit(1);
        $query = $this->db->get('users');
        $user = $query->row();

        //checking password against data from db

        if($user){
            if( $this->encryption->decrypt($user->password) == $password){
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

   


}