<?php

class Login extends MX_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->load->view('template/login');
	}
	
	function auth(){
		$user = $this->input->post('username');
		$pass = md5($this->input->post('password'));
		$q = $this->db->query("select * from user_login where username = '$user' and password  = '$pass'");
		//var_dump($q->row());exit;
		if($q->num_rows()>0){
			$this->session->set_userdata('sess_login',$q->row());
			$sess = $this->session->userdata('sess_login');
			$check = $this->db->query("select distinct(trx_number) as trxnum from stationery_cart where status = 0 and userid = '".$sess->id."'");
			if($check->num_rows()>0){
				$this->session->set_userdata('trxnum',$check->row()->trxnum);
			}else{
				$this->session->set_userdata('trxnum',date('hYimsd'));
			}
			redirect('dashboard');
		}else{
			echo "<script>
			alert('Wrong Username Or Password!');
			document.location.href='".base_url()."login';
			</script>";
		}
	}
	
	function logout(){
		$this->session->destroy();
		redirect('dashboard');
	}
}