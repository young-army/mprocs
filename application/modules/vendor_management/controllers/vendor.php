<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
public $vendor_name = '';
	public function __construct() {
		parent::__construct();
		$this->load->model('model_vendor');
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){

		$title = 'Data';
		$title_d = 'Vendor';

		$this->page->view('vendor_index', array (
			'add'				=> $this->page->base_url('/add'),
			'big_header'		=> $title,
			'small_header'		=> $title_d,
			'add'				=> $this->page->base_url('/add'),
			'index'				=> $this->db->query("
										SELECT d.*,
												u.id,
												u.username,
												c.company_name
										FROM (
											SELECT *
											FROM vendor 
										) AS d
										LEFT JOIN user_login AS u
											ON d.id_users_fk = u.id
										LEFT JOIN company AS c
											ON d.company_code_fk = c.company_code
							")->result(),

			));	
	}    
	
	private function form($action = 'insert', $id = 0){
		if ($this->agent->referrer() == '') redirect($this->page->base_url());
		
		$title = 'Data';
		$title_d = 'Vendor';

		$this->page->view('vendor_form', array (
			'big_header'		=> $title,
			'small_header'		=> $title_d,
			'back'				=> $this->agent->referrer(),
			'act'				=> $this->page->base_url("/{$action}/{$id}"),
			'rc'				=> $this->model_vendor->by_id_vendor($id),
			//'cal'		=> $this->model_company->get_data('calendar_header'),
		));
	}

	public function add(){
		$this->form();
	}

	public function edit($id){
		$this->form('update', $id);
	}

	public function insert(){
		$data = array(
		'register_num'			=> $this->input->post('register_num'),
		//'company_code_fk'		=> $this->input->post('company_code_fk'),
		//'department_code_fk'	=> $this->input->post('department_code_fk'),
		'vendor_code'			=> $this->input->post('vendor_code'),
		'vendor_name'			=> $this->input->post('vendor_name'),
		'vendor_address'		=> $this->input->post('email_address'),
		//'postal_code'			=> $this->input->post('postal_code'),
		'phone'					=> $this->input->post('phone_number'),
		'fax'					=> $this->input->post('fax_number'),
		'email'					=> $this->input->post('email_address'),
		//'country'				=> $this->input->post('country'),
		'npwp'					=> $this->input->post('npwp'),
		//'npwp_address'			=> $this->input->post('npwp_address'),
		//'npwp_postcode'			=> $this->input->post('npwp_postcode'),
		'email_person'			=> $this->input->post('email_person'),
		'status_approved'		=> 'New',
		//'status_approved'		=> $this->input->post('status_approved'),
		//'approved_date'			=> $this->input->post('approved_date'),
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'created_date'			=> date('Y-m-d')
		);
		//var_dump($data);exit;
		if($this->input->post('id_vendor')==''){
			$this->db->insert('vendor',$data);
			redirect($this->page->base_url());
			

		}else{
			$this->db->where('id_vendor',$this->input->post('id_vendor'));
			$this->db->update('vendor',$data);
			redirect($this->page->base_url());
		}
	}

	function approve($id){
		$this->db->query("update vendor set status_approved = 'Approved', status_vendor = 'Active' where id_vendor = '$id'");
		redirect('vendor_management/vendor');
	}

	function save(){
		$data = array(
		'company_code_fk'			=> $this->input->post('company_code_fk'),
		'vendor_code'			=> $this->input->post('vendor_code'),
		'vendor_name'			=> $this->input->post('vendor_name'),
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_vendor')==''){
			$this->db->insert('vendor',$data);
		}else{
			$this->db->where('id_vendor',$this->input->post('id_vendor'));
			$this->db->update('vendor',$data);
		}

	}
	
	function delete($id_vendor){
		$this->db->where('id_vendor',$id_vendor);
		$this->db->delete('vendor');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT d.*,
					u.id,
					u.username,
					c.company_name
			FROM (
				SELECT *
				FROM vendor 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			LEFT JOIN company AS c
				ON d.company_code_fk = c.company_code
			")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->company_name,
		$row->vendor_code,
		$row->vendor_name,
		$row->create_date,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_vendor.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_vendor.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_vendor){
		$this->db->where('id_vendor',$id_vendor);
		$data = $this->db->get('vendor')->row();
		echo json_encode($data);
	}

}

/* End of file vendor.php */
/* Location: ./application/modules/master_data/controllers/vendor.php */