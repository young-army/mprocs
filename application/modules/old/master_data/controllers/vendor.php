<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'vendor';
		$data['company']		= $this->db->query("
			SELECT *
				FROM company 
				")->result();
		$data['data']			= $this->db->query("
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
		$this->page->view('vendor_index',$data);	
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