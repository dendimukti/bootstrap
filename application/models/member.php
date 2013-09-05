<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->database();
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
    	$query = $this->db->query("select * from member where username='$usr' and password='$pwd'");
    	$data=null;
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
    	$data="";
    	if($id!="")
    		$query = $this->db->query("select * from member where id='".$id."'");
    	else
    		$query = $this->db->query("select * from member limit ".$limit.",".$offset);
    		
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $data['id'][]=$row->id;
		      $data['usr'][]=$row->username;
		      $data['first_name'][]=$row->first_nm;
		      $data['last_name'][]=$row->last_nm;
		      $data['email'][]=$row->email;
		      $data['status'][]=$row->status;
		      $data['join'][]=$row->join_date;  
		      $data['address'][]=$row->address;  
		   }
		}
		return $data;
    }
    
    function getTotMember(){
		$data="";
		
    	$query = $this->db->query("select * from member");
		$data=$query->num_rows();	
		return $data;
	}

    function signUp($usr,$pwd,$first,$last,$email)
    {		
        $this->db->query("insert into member values('','$usr','$pwd','$first','$last','0','$email',now(),'')");
    }

    function changePass($id,$newpwd)
    {
        $this->db->query("update member set password='$newpwd' where id='$id'");
    }
    
    function editMember($id,$first,$last,$email,$addr)
    {
        $this->db->query("update member set first_nm='$first', last_nm='$last', email='$email', address='$addr' where id='$id'");
    }
    
	function cekPwd($id,$pwd)
    {    	
    	$query = $this->db->query("select * from member where id='$id' and password='$pwd'");

		if ($query->num_rows() > 0)
			return true;			
		else 
			return false;			
    }
    
	function cekUsr($usr)
    {    	
    	$query = $this->db->query("select * from member where username='$usr'");

		if ($query->num_rows() > 0)
			return true;			
		else 
			return false;			
    }
    
	function cekEmail($email)
    {    	
    	$query = $this->db->query("select * from member where email='$email'");

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