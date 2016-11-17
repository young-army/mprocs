<?php

class Dashboard extends MX_Controller{
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
	}
	
	function index(){
		$data['big_header']   	= 'Dashboard Monitoring';
		$data['small_header']   = 'Booking Status';
		$data['header']			= 'template/header';
		$data['menu']			= 'template/sidebar';
		$data['content']		= 'template/dashboard';
		$this->load->view('template/template',$data);
	}
}