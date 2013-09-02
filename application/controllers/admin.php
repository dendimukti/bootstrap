<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {	
	
	public function __construct(){
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
	}
	
	public function index()
	{
		if($this->session->userdata('stat')==null)
			$this->loginAdministrator();
		else if($this->session->userdata('stat')==2)	
			$this->home();
		else
			redirect('app');
	}
	
	function loginAdministrator($pesan=""){
		if($this->session->userdata('stat')==2)
			$this->notFound();
		else if($this->session->userdata('stat')==1)
			$this->forbid();
		else{
			$data['judul'] = "Log In Administrator";	
			$data['pesan'] = $pesan;
			$this->load->view('sign-in', $data);	
		}
	}
	
	function procLoginAdmin(){
		if($this->session->userdata('stat')==null){		
			$this->load->library('form_validation');
			$this->load->model('admin');			
			if($this->input->post('submit'))
			{		
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				if ($this->form_validation->run() == FALSE)		
					redirect('admin/loginAdministrator/required');
				else{
					$usr=$this->input->post('username');
					$pwd=$this->input->post('password');
					if($this->admin->logIn($usr,$pwd)){
						$this->session->set_userdata('stat','2');
						redirect('admin/home');				
					}
					else
						redirect('admin/loginAdministrator/invalid');
				}				
			}else
				$this->notFound();			
		}else
			$this->notFound();		
	}
	
	function logout(){
			if($this->session->userdata('log')==2){
				$this->session->sess_destroy();				
				redirect('admin/loginAdministrator');
			}else{
				$this->notFound();
			}				
	}
	
	function home(){		
		if($this->session->userdata('stat')!=2)
			$this->forbid();
		else{
			$data['judul'] = "Home Admin";
			$data['log'] = false;
			$data['admin'] = true;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
 			$this->load->view('index-content', $data);
		}	
	}
	
	function members($limit=0,$offset=10){		
		if($this->session->userdata('stat')!=2)
			$this->forbid();
		else{
			$data= $this->admin->dataMember("",$limit,$offset);
			$data['judul'] = "Members";
			$data['log'] = false;
			$data['admin'] = true;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
 			$this->load->view('users', $data);
		}
	}
	
	function forbid(){
		$this->load->view('403');
	}
	
	function notFound(){		
		$this->load->view('404');
	}

}