<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adm extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function logIn($usr,$pwd)
    {    	
    	$query = $this->db->query("select * from admin where username='$usr' and password='$pwd'");
		if ($query->num_rows() > 0)
			return true;			
		else 
			return false;			
    }

	function dataAdmin($usr="")
    {    
    	$query = $this->db->query("select * from admin where username='".$usr."'");
    	$data="";
    		
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $data['id'][]=$row->id;
		      $data['usr_adm'][]=$row->username;
		      $data['first'][]=$row->first_nm;
		      $data['last'][]=$row->last_nm;
		      $data['email'][]=$row->email;
		      $data['status'][]=$row->status; 
		   }
		}
		return $data;
    }

	function dataDomain($id="",$limit=0,$offset=10)
    {
    	$q="";
    	if(!empty($id))
    		$q=" where id='$id'";
    	
    	$data="";
    	$query = $this->db->query("select * from domain ".$q." limit ".$limit.",".$offset);    	
    		
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $data['id'][]=$row->id;
		      $data['domain'][]=$row->domain;
		      $data['status'][]=$row->status; 
		   }
		}
		return $data;
    }
    
    function getTotDomain(){
		$data="";
		
    	$query = $this->db->query("select * from domain");
		$data=$query->num_rows();	
		return $data;
	}
	
    function changePass($id,$newpwd)
    {
        $this->db->query("update admin set password='$newpwd' where id='$id'");
    }
    
	function cekPwd($id,$pwd)
    {    	
    	$query = $this->db->query("select * admin member where id='$id' and password='".md5("program cinta".hash('sha512',$pwd))."'");
		if ($query->num_rows() > 0)
			return true;			
		else 
			return false;			
    }
    
}