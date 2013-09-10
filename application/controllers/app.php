<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		//$this->load->helper('email');
        $this->load->library('email');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}
	
	public function index()
	{
		$this->_is_logged_in();
	}
	
	function mailer($from,$name,$to,$cc,$bcc,$subject,$message){
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'dendimukti@gmail.com';
		$config['smtp_pass'] = '*************';
		$config['priority'] = 1;
		$config['mailtype'] = 'text';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		$this->email->from($from, $name);
		$this->email->to($to); 		
		$this->email->cc($cc); 
		$this->email->bcc($bcc); 
		$this->email->subject($subject);
		$this->email->message($message);	
		
		//$this->email->send();
		
		if(!$this->email->send()) {
			show_error($this->email->print_debugger());
		}
	}
	public function _is_logged_in(){
		
		$this->load->helper('url');		
		$sess=$this->session->userdata('stat');
		if($sess==1)
			$this->homelog();
		else if($sess==2)
			redirect('admin','refresh');
		else
			$this->formLogin();
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
			$data['username'] = $this->input->cookie('username');
			$data['password'] = $this->input->cookie('password');			
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
						$data=$this->member->dataLogIn($usr,$this->member->encr($pwd));
						$this->session->set_userdata('stat','1');
						$this->session->set_userdata('id',$data['id']);
						
						if(isset($_POST['rememberme'])){
							
							$this->input->set_cookie('username', $usr);
							$this->input->set_cookie('password', $pwd);
							//setcookie('password', $pwd, 1209600);
						}
						
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
					if($this->member->cekPwd($this->session->userdata('id'),$this->member->encr($pwd))){
						if($newpass!=$pwdconf)
							redirect("app/resetPwd/unmacthpwd");
						else{
							$data=$this->member->changePass($this->session->userdata('id'),$this->member->encr($newpass));
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
	
	function forgotPassword($pesan=""){
		if($this->session->userdata('stat')==null){
			$data['judul'] = "Forgot Your Password ?";	
			if($pesan=="notExistEmail")
				$data['pesan'] = "This Email Address doesn't Registered";
			else if($pesan=="invalid")
				$data['pesan'] = "Email Format is Invalid";
			$this->load->view('forgot-password', $data);
		}else
			$this->notFound();			
	}
	
	function procForgotPassword(){
		if($this->session->userdata('stat')==null){
			$this->load->library('form_validation');
			$this->load->model('member');
			
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
								
				if ($this->form_validation->run() == FALSE)		
					redirect("app/forgotPassword/invalid");
				else{
					$from="dendimukti@gmail.com";
					$name="company";
					$to=$this->input->post('email');
					$cc="";
					$bcc="";
					$subj="new password";
					$msg=$this->member->kode();
					$dat=$this->member->dataMemberByEmail($to);
					if ($this->member->cekEmail($to)){
						$this->mailer($from,$name,$to,$cc,$bcc,$subj,$msg);
						$this->member->changePass($dat['id'][0],$this->member->encr($msg));
						redirect("app/formLogin");
					}else
						redirect("app/forgotPassword/notExistEmail");

					redirect('app');
				}								
			}else
				$this->notFound();
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
					$this->member->signUp($usr,$this->member->encr($pwd),$first,$last,$email);
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
	/*
	function listdomain($page=1){
		if($this->session->userdata('stat')==null)
			$this->domain_nl($page);
		else if($this->session->userdata('stat')==1)
			$this->domain_l($page);	
	}
	*/
	function domain_l($page){
		if($this->session->userdata('stat')==2)
			$this->forbid();
		else{
			$this->load->model('adm');
			$this->load->model('member');
			$dat=$this->member->dataMember($this->session->userdata('id'));
			
			$limit=($page-1)*10;
			
			$data= $this->adm->dataDomain('',$limit,10);
			
			$jml=$this->adm->getTotDomain();
			$hal=0;
			for($i=0;$i<=$jml;$i=$i+10)
				$hal++;
			$data['totpage']=$hal;
			$data['page']=$page;
			//$data['page']=($this->adm->getTotDomain()-($this->adm->getTotDomain() % 10) /10) + 1;
			$dat['judul'] = "Domain";
			$dat['log'] = true;
			$dat['admin'] = false;
			$this->load->view('index-navbar', $dat);
			$this->load->view('index-sidebar', $dat);
 			$this->load->view('domainlist', $data);
			$this->load->view('index-footer');
		}
	}
	
	function domain_nl($page){
		if($this->session->userdata('stat')==2)
			$this->forbid();
		else{
			$this->load->model('adm');
			$this->load->model('member');
			$dat=$this->member->dataMember($this->session->userdata('id'));		
			
			$limit=($page-1)*10;
				
			$data= $this->adm->dataDomain('',$limit,10);
			
			$jml=$this->adm->getTotDomain();
			$hal=0;
			for($i=0;$i<=$jml;$i=$i+10)
				$hal++;
			$data['totpage']=$hal;
			$data['page']=$page;
			//$data['page']=($this->adm->getTotDomain()-($this->adm->getTotDomain() % 10) /10) + 1;
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
	

	
	function forbid(){		
		$this->load->view('403');
	}
	
	function notFound(){		
		$this->load->view('404');
	}
}
