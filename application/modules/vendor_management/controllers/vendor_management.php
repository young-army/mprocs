<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_management extends CI_Controller {
public $vendor_name = '';
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){

		$data['big_header'] = 'Dashboard';
		$data['small_header'] = 'Vendor Management';

		$this->page->view('vendor_management_index', $data);	
	}    
	

}

/* End of file vendor.php */
/* Location: ./application/modules/master_data/controllers/vendor.php */