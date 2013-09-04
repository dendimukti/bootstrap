<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class proc extends CI_Controller {
	
	public function __construct(){
		parent::__construct();		
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		//$this->load->helper('email');
		$this->load->helper('url');
	}
	
	public function index(){
	//	$this->app->forbid();
	}
	
	
}