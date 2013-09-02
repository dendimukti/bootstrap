<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
    
    function logIn($usr,$pwd)
    {    	
    	$query = $this->db->query("select * from admin where username='$usr' and password='".md5("program cinta".hash('sha512',$pwd))."'");
		if ($query->num_rows() > 0)
			return true;			
		else 
			return false;			
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