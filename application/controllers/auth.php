<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function auth(){
		if($this->session->userdata('stat')==null){
			redirect('auth/login');
		}else{
			redirect('app/home');
		}
	}
}