<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }
    
    function logIn($usr,$pwd)
    {    	
    	$query = $this->db->query("select * from member where username='$usr' and password='".md5("program cinta".hash('sha512',$pwd))."'");
		if ($query->num_rows() > 0)
			return true;			
		else 
			return false;			
    }
    
    function dataLogIn($usr,$pwd)
    {    	
    	$query = $this->db->query("select * from member where username='$usr' and password='".md5("program cinta".hash('sha512',$pwd))."'");
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $data['id']=$row->id;
		      $data['usr']=$row->username;
		      $data['first']=$row->first_nm;
		      $data['last']=$row->last_nm;
		      $data['email']=$row->email;
		      $data['status']=$row->status;
		      $data['join']=$row->join_date;  
		   }
		}	
		return $data;		
    }
    
    function dataMember($id="",$limit=0,$offset=0)
    {    
    	if($id!="")
    		$query = $this->db->query("select * from member where id='".$id."'");
    	else
    		$query = $this->db->query("select * from member limit ".$limit.",".$offset);
    		
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $data['id']=$row->id;
		      $data['usr']=$row->username;
		      $data['first']=$row->first_nm;
		      $data['last']=$row->last_nm;
		      $data['email']=$row->email;
		      $data['status']=$row->status;
		      $data['join']=$row->join_date;  
		   }
		}
		return $data;		
    }

    function signUp($usr,$pwd,$first,$last,$email,$now)
    {		
        $this->db->query("insert into member values('','$usr','$pwd','$first','$last','0','$email','$now')");
    }

    function changePass($id,$newpwd)
    {
        $this->db->query("update member set password='$newpwd' where id='$id'");
    }
    
    function editMember($id,$first,$last,$email)
    {
        $this->db->query("update member set first_nm='$first', last_nm='$last', email='$email' where id='$id'");
    }
    
	function cekPwd($id,$pwd)
    {    	
    	$query = $this->db->query("select * from member where id='$id' and password='".md5("program cinta".hash('sha512',$pwd))."'");

		if ($query->num_rows() > 0)
			return true;			
		else 
			return false;			
    }
    
    function mailer($email,$subject,$message){
		$this->email->from('your@example.com', 'Your Name');
		$this->email->to($email); 		
		$this->email->subject($subject);
		$this->email->message($message);	
		
		$this->email->send();
	}
    
    
}