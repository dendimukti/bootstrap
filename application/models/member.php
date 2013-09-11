<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Model {
	function __construct()
    {
        parent::__construct();
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
    
    function kode($long=10){
		$data=array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$kode="";
		for($a=1;$a<=$long;$a++)
			$kode .= $data[rand(0,35)];
		return $kode;
	}
	
	function generate_kode($kd){
		$enc=$this->encr($kd);
		$que_cek=mysql_query("select * from member where password='$enc'");
		$data=mysql_num_rows($que_cek);
		if($data==0)
			return $kd;
		else
			$this->generate_kode($this->kode(10));
	}
	
	function generate_reg_kode($kd){
		$que_cek=mysql_query("select * from member where reg_code='$kd'");
		$data=mysql_num_rows($que_cek);
		if($data==0)
			return $kd;
		else
			$this->generate_kode($this->kode(20));
	}
    
    	
	function encr($pwd){
		$enc=md5("program cinta".hash('sha512',$pwd));
		$data=substr($enc,0,50);
		return $data;
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
    
    function dataMemberByEmail($email)
    {    
   		$query = $this->db->query("select * from member where email='".$email."'");
    	$data="";	
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

    function signUp($usr,$pwd,$first,$last,$email,$reg_code)
    {		
        $this->db->query("insert into member values('','$usr','$pwd','$first','$last','0','$email',now(),'','$reg_code')");
    }

    function changePass($id,$newpwd)
    {
        $this->db->query("update member set password='$newpwd' where id='$id'");
    }
    
    function editMember($id,$first,$last,$email,$addr)
    {
        $this->db->query("update member set first_nm='$first', last_nm='$last', email='$email', address='$addr' where id='$id'");
    }
    
    function activateMember($reg)
    {
    	$query = $this->db->query("select * from member where reg_code='".$reg."'");
    	$data=false;	
		if ($query->num_rows() > 0)
		{
		   $data = true;
		   $this->db->query("update member set status='1' where reg_code='$reg'");
		}
        return $data;
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
    

    
    
}