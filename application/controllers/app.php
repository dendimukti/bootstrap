<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		//$this->load->helper('email');
		$this->load->helper('url');
		
	}
	
	public function index()
	{
		$this->_is_logged_in();
	}
	
	
	public function _is_logged_in(){
		
		$this->load->helper('url');		
		$sess=$this->session->userdata('stat');
		if($sess==1)
			$this->homelog();
		else if($sess==2)
			redirect('admin','refresh');
		else
			$this->home();
	}
	
	function logout(){
			if($this->session->userdata('stat')>0){
				$this->session->sess_destroy();
				redirect('app/');
			}
			else	
				$this->notFound();
			
	}
	
	function formLogin($pesan=""){		
		if($this->session->userdata('stat')==null){
			$data['judul'] = "Log In";
		
			if($pesan=="required")
				$data['pesan'] = "Invalid Input";
			else if($pesan=="wrong")
				$data['pesan'] = "Check Your Username and Password";
				
			$this->load->view('sign-in', $data);
		}else
			$this->notFound();
	}
	
	function Login(){
		if($this->session->userdata('stat')==null){
			$this->load->library('form_validation');
			$this->load->model('member');			
			
			if($this->input->post('submit'))
			{				
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() == FALSE)
					redirect('app/formLogin/required');
				else{
					$usr=$this->input->post('username');
					$pwd=$this->input->post('password');
					if($this->member->logIn($usr,$pwd)){
						$data=$this->member->dataLogIn($usr,$this->encr($pwd));
						$this->session->set_userdata('stat','1');
						$this->session->set_userdata('id',$data['id']);
						redirect('app/');				
					}
					else
						redirect('app/formLogin/wrong');
				}	
				
			}else
				$this->notFound();
		}else
			$this->notFound();
	}
	
	function resetPwd($pesan=""){
		if($this->session->userdata('stat')==1){
			$data['judul'] = "Reset Password";
			
			if($pesan=="required")
				$data['pesan'] = "Fill The Form Correctly";
			else if($pesan=="unmacthpwd")
				$data['pesan'] = "Check Your New Password";
			else if($pesan=="wrongpassword")
				$data['pesan'] = "Invalid Old Password";
				
			$this->load->view('reset-password', $data);	
		}else
			$this->forbid();		
	}
	
	
	
	function procResetPwd(){
		if($this->session->userdata('stat')==1){
			$this->load->library('form_validation');
			$this->load->model('member');			
			
			if($this->input->post('submit'))
			{				
				$this->form_validation->set_rules('newpass', 'New Password', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('passconf', 'Confirmation Password', 'required');
				
				if ($this->form_validation->run() == FALSE)
					redirect('app/resetPwd/required');
				else{
					$newpass=$this->input->post('newpass');
					$pwdconf=$this->input->post('passconf');
					$pwd=$this->input->post('password');
					if($this->member->cekPwd($this->session->userdata('id'),$this->encr($pwd))){
						if($newpass!=$pwdconf)
							redirect("app/resetPwd/unmacthpwd");
						else{
							$data=$this->member->changePass($this->session->userdata('id'),$this->encr($newpass));
							redirect('app/account/');					
						}				
					}
					else
						redirect('app/resetPwd/wrongpassword');
				}				
			}else
				$this->notFound();
		}else
			$this->notFound();
	}
	
	function signUp($pesan=""){
		if($this->session->userdata('stat')==null){
			$data['judul'] = "Sign Up";	
			if($pesan=="invalidEmail")
				$data['pesan'] = "Invalid Email Format";
			else if($pesan=="unmacthpwd")
				$data['pesan'] = "Check Your Password";
			else if($pesan=="invalid")
				$data['pesan'] = "Fill The Form Correctly";
			else if($pesan=="existEmail")
				$data['pesan'] = "This Email Already Registered, Try Another Email";
			else if($pesan=="existUsr")
				$data['pesan'] = "This Usename Already Exist, Try Another Username";
				
			$this->load->view('sign-up', $data);
		}else
			$this->notFound();			
	}
	
	function procSignUp($pesan=""){		
		if($this->session->userdata('stat')==null){
			$this->load->library('form_validation');
			$this->load->model('member');
			
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('agreement', 'Agreement', 'required');
								
				if ($this->form_validation->run() == FALSE)		
					redirect("app/signUp/invalid");
				else{
					$usr=$this->input->post('username');
					$pwd=$this->input->post('password');
					$pwdconf=$this->input->post('passconf');
					$first=$this->input->post('first_name');
					$last=$this->input->post('last_name');
					$email=$this->input->post('email');
					
					if ($this->member->cekEmail($email))
						redirect("app/signUp/existEmail");
					if ($this->member->cekUsr($usr))
						redirect("app/signUp/existUsr");
					if($pwd!=$pwdconf)
						redirect("app/signUp/unmacthpwd");
					
				//	$this->mailer($email,"Activating Account","Test");
					$this->member->signUp($usr,$this->encr($pwd),$first,$last,$email);
					redirect('app');
				}					
								
			}else
				$this->notFound();
		}else
			$this->notFound();
		
	}
	
	function account($id=""){
		if($this->session->userdata('stat')==1){
			$this->load->model('member');
			$data=$this->member->dataMember($this->session->userdata('id'));
			$data['judul'] = "Your Account";
			$data['log'] = true;
			$data['admin'] = false;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
			$this->load->view('userEdit', $data);
			$this->load->view('index-footer');
		}else
			$this->forbid();		
	}
	
	function home(){		
		if($this->session->userdata('stat')==null){			
			$data['judul'] = "Home";
			$data['log'] = false;
			$data['admin'] = false;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
			$this->load->view('index-content', $data);
			$this->load->view('index-footer');
		}else
			redirect('app');	
		
	}
	
	function homelog(){	
		if($this->session->userdata('stat')==1){
			$this->load->model('member');
			$data=$this->member->dataMember($this->session->userdata('id'));
			$data['judul'] = "Home";
			$data['log'] = true;
			$data['admin'] = false;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
			$this->load->view('index-content', $data);
			$this->load->view('index-footer');
		}
		else
			$this->forbid();		
	}
	
	function listdomain(){
		if($this->session->userdata('stat')==null)
			$this->domain_nl();
		else if($this->session->userdata('stat')==1)
			$this->domain_l();	
	}
	
	function domain_l(){
		if($this->session->userdata('stat')==2)
			$this->forbid();
		else{
			$this->load->model('adm');
			$this->load->model('member');
			$dat=$this->member->dataMember($this->session->userdata('id'));
			$data= $this->adm->dataDomain();
			$dat['judul'] = "Domain";
			$dat['log'] = true;
			$dat['admin'] = false;
			$this->load->view('index-navbar', $dat);
			$this->load->view('index-sidebar', $dat);
 			$this->load->view('domainlist', $data);
			$this->load->view('index-footer');
		}
	}
	
	function domain_nl(){
		if($this->session->userdata('stat')==2)
			$this->forbid();
		else{
			$this->load->model('adm');
			$this->load->model('member');
			$dat=$this->member->dataMember($this->session->userdata('id'));
			$data= $this->adm->dataDomain();
			$dat['judul'] = "Domain";
			$dat['log'] = false;
			$dat['admin'] = false;
			$this->load->view('index-navbar', $dat);
			$this->load->view('index-sidebar', $dat);
 			$this->load->view('domainlist', $data);
			$this->load->view('index-footer');
		}
	}
	
	function editMember($pesan=""){		
		if($this->session->userdata('stat')==1){
			$this->load->model('member');
			$data=$this->member->dataMember($this->session->userdata('id'));
			
			if($pesan=="invalidEmail")
				$data['pesan'] = "Invalid Email Format";
			else if($pesan=="required")
				$data['pesan'] = "Fill The Form Correctly";
				
			$data['judul'] = "Your Account";
			$data['log'] = true;
			$data['admin'] = false;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
			$this->load->view('userEdit', $data);
			$this->load->view('index-footer');
		}else
			$this->forbid();
	}
	
	
	function procEditMember(){		
		if($this->session->userdata('stat')==1){
			$this->load->library('form_validation');
			$this->load->model('member');
			$id=$this->session->userdata('id');
			if($this->input->post('submit')){				
				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				//$this->form_validation->set_rules('address', 'Address', 'required');
				
				if ($this->form_validation->run() == FALSE){
					redirect("app/editMember/required");
				}					
				else{
					if($this->input->post('submit'))
					{
						$first=$this->input->post('first_name');
						$last=$this->input->post('last_name');
						$email=$this->input->post('email');
						$addr=$this->input->post('address');				
						
						$this->member->editMember($id,$first,$last,$email,$addr);
						redirect('app/account/');
					}
				}
			}else
				$this->notFound();
		}else
			$this->notFound();
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
