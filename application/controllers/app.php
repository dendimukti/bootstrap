<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('email');
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
				$data['pesan'] = "Unmached Password";
				
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
						$data=$this->member->dataLogIn($usr,$pwd);
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
			$data['pesan'] = $pesan;
			$this->load->view('reset-password', $data);	
		}else
			$this->forbid();
		
	}
	
	function signUp($pesan=""){
		if($this->session->userdata('stat')==null){
			$data['judul'] = "Sign Up";	
			if($pesan=="invalidEmail")
				$data['pesan'] = "Invalid Email Format";
			else if($pesan=="unmacthpwd")
				$data['pesan'] = "Check Password";
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
				
				if ($this->form_validation->run() == FALSE)		
					redirect("app/signUp/invalid");
				else{
					$usr=$this->input->post('username');
					$pwd=$this->input->post('password');
					$pwdconf=$this->input->post('passconf');
					$first=$this->input->post('first_name');
					$last=$this->input->post('last_name');
					$email=$this->input->post('email');
					$now=time();
				
					if (!valid_email($email))
						redirect("app/signUp/invalidEmail");
					if($pwd==$pwdconf)
						redirect("app/signUp/unmacthpwd");
					
					$this->mailer($email,"Activating Account","Test");
					$this->member->signUp($usr,$pwd,$first,$last,$email,$now);
					redirect('app/account');
				}					
								
			}else
				$this->notFound();
		}else
			$this->notFound();
		
	}
	
	function procEditMember($id){		
		if($this->session->userdata('stat')==1){
			$this->load->library('form_validation');
			$this->load->model('member');
			
			if($this->input->post('submit')){				
				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				
				if ($this->form_validation->run() == FALSE)
					redirect("app/procEditMember/".$id);
				else{
					if($this->input->post('submit'))
					{
						$first=$this->input->post('first_name');
						$last=$this->input->post('last_name');
						$email=$this->input->post('email');
						
						if (!valid_email($email))
							redirect("app/procEditMember/invalidEmail");
						
						$this->member->editMember($id,$first,$last,$email);
						redirect('app/account');
					}
				}
			}else
				$this->notFound();
		}else
			$this->notFound();
	}
	
	function account($id){
		if($this->session->userdata('stat')==1){
			$data['judul'] = "Your Account";
			$data['log'] = true;
			$data['admin'] = false;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
			$this->load->view('user', $data);
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
		}else
			redirect('app');	
		
	}
	
	function homelog(){		
		if($this->session->userdata('stat')==1){
			$data=$this->member->dataMember($this->session->userdata('id'));
		$data['judul'] = "Home";
		$data['log'] = true;
		$data['admin'] = false;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
			$this->load->view('index-content', $data);
		}
		else
			$this->forbid();		
	}
	
	function editMember(){		
		if($this->session->userdata('stat')==1){
			$data['judul'] = "Edit Data Member";
			$data['log'] = true;
			$data['admin'] = false;
			$this->load->view('index-navbar', $data);
			$this->load->view('index-sidebar', $data);
			$this->load->view('user', $data);
		}else
			$this->forbid();
	}
	
	function forbid(){		
		$this->load->view('403');
	}
	
	function notFound(){		
		$this->load->view('404');
	}
	
}
