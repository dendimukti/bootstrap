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
			$this->load->view('sign-in-admin', $data);	
		}
	}
	
	function procLoginAdmin(){
		if($this->session->userdata('stat')==null){		
			$this->load->library('form_validation');
			$this->load->model('adm');			
			if($this->input->post('submit'))
			{		
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				if ($this->form_validation->run() == FALSE)		
					redirect('admin/loginAdministrator/required');
				else{
					$usr=$this->input->post('username');
					$pwd=$this->input->post('password');
					if($this->adm->logIn($usr, $this->encr($pwd))){
						$this->session->set_userdata('stat','2');
						$this->session->set_userdata('usr',$usr);
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
			$this->load->model('adm');
			$data=$this->adm->dataAdmin($this->session->userdata('usr'));
			$data['judul'] = "Home Admin";
			$data['log'] = false;
			$data['admin'] = true;			
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
 			$this->load->view('index-content', $data);
			$this->load->view('index-footer');
		}	
	}
	
	function members($page=1){		
		if($this->session->userdata('stat')!=2)
			$this->forbid();
		else{
			$this->load->model('member');
			$this->load->model('adm');
			$dat=$this->adm->dataAdmin($this->session->userdata('usr'));
			
			$limit=($page-1)*10;
			$data= $this->member->dataMember("",$limit,10);
			$jml=$this->member->getTotMember();
			$hal=0;
			for($i=0;$i<=$jml;$i=$i+10)
				$hal++;
			$data['totpage']=$hal;
			$data['page']=$page;
			
			
			$dat['judul'] = "Members";
			$dat['log'] = false;
			$dat['admin'] = true;
			$this->load->view('index-navbar', $dat);
			$this->load->view('index-sidebar', $dat);
 			$this->load->view('users', $data);
			$this->load->view('index-footer');
		}
	}
	
	function domain($page=1){
		if($this->session->userdata('stat')!=2)
			$this->forbid();
		else{
			$this->load->model('adm');
			$dat=$this->adm->dataAdmin($this->session->userdata('usr'));
			
			$limit=($page-1)*10;
			$data= $this->adm->dataDomain('',$limit,10);
			$jml=$this->adm->getTotDomain();
			$hal=0;
			for($i=0;$i<=$jml;$i=$i+10)
				$hal++;
			$data['totpage']=$hal;
			$data['page']=$page;
			
			$dat['judul'] = "Domain";
			$dat['log'] = false;
			$dat['admin'] = true;
			$this->load->view('index-navbar', $dat);
			$this->load->view('index-sidebar', $dat);
 			$this->load->view('domain', $data);
			$this->load->view('index-footer');
		}
	}
	
	function delDomain($id){
		if($this->session->userdata('stat')!=2)
			$this->forbid();
		else{
			$this->load->model('adm');
			$this->adm->deleteDomain($id);
			redirect('admin/domain');
		}
	}
	
	function editDomain($id,$page){
		if($this->session->userdata('stat')!=2)
			$this->forbid();
		else{
			$this->load->model('adm');	
			$data=$this->adm->dataDomain($id);
			$data['admin'] = true;
			$data['page'] = $page;
 			$this->load->view('editDomain', $data);
		}
	}
	
	function procEditDomain(){
		if($this->session->userdata('stat')==2){		
			$this->load->library('form_validation');
			$this->load->model('adm');			
			if($this->input->post('submit'))
			{		
				$this->form_validation->set_rules('domain', 'domain', 'required');
				$this->form_validation->set_rules('status', 'status', 'required');
				if ($this->form_validation->run() == FALSE)		
					redirect('admin/domain');
				else{
					$domain=$this->input->post('domain');
					$status=$this->input->post('status');
					$id=$this->input->post('id');
					$page=$this->input->post('page');
					$this->adm->editDomain($id,$domain,$status);
					redirect('admin/domain/'.$page);					
				}				
			}else
				$this->notFound();			
		}else
			$this->notFound();
	}
	
	function addDomain(){
		if($this->session->userdata('stat')==2){		
			$this->load->library('form_validation');
			$this->load->model('adm');			
			if($this->input->post('submit'))
			{		
				$this->form_validation->set_rules('domain', 'domain', 'required');
				if ($this->form_validation->run() == FALSE)		
					redirect('admin/domain#baten');
				else{
					$domain=$this->input->post('domain');
					$page=$this->input->post('page');
					$this->adm->addDomain($domain);
					redirect('admin/domain/'.$page);					
				}				
			}else
				$this->notFound();			
		}else
			$this->notFound();	
	}
	
	function newDomain($page){
		if($this->session->userdata('stat')!=2)
			$this->forbid();
		else{
			$dat['admin'] = true;
			$dat['page'] = $page;
 			$this->load->view('newDomain', $dat);
		}
	}
	
	function encr($pwd){
		$enc=md5("program cinta".hash('sha512',$pwd));
		$data=substr($enc,0,50);
		return $data;
	}
	
	function forbid(){
		$this->load->view('403');
	}
	
	function notFound(){		
		$this->load->view('404');
	}

}