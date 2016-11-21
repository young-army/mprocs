<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Company extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'Company';
		$data['data']			= $this->db->query("
			SELECT c.*,
					u.id,
					u.username
			FROM (
				SELECT *
				FROM company 
			) AS c
			LEFT JOIN user_login AS u
				ON c.id_users_fk = u.id
				")->result();
		$this->page->view('company_form',$data);	
	}    
	
	function save(){
		$data = array(
		'company_code'			=> $this->input->post('company_code'),
		'company_name'			=> $this->input->post('company_name'),
		'street'				=> $this->input->post('street'),
		'postal_code'			=> $this->input->post('postal_code'),
		'city'					=> $this->input->post('city'),
		'telephone'				=> $this->input->post('telephone'),
		'fax'					=> $this->input->post('fax'),
		'email'					=> $this->input->post('email'),
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_company')==''){
			$this->db->insert('company',$data);
		}else{
			$this->db->where('id_company',$this->input->post('id_company'));
			$this->db->update('company',$data);
		}

	}
	
	function delete($id_company){
		$this->db->where('id_company',$id_company);
		$this->db->delete('company');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT c.*,
					u.id,
					u.username
			FROM (
				SELECT *
				FROM company 
			) AS c
			LEFT JOIN user_login AS u
				ON c.id_users_fk = u.id
			")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->company_code,
		$row->company_name,
		$row->create_date,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_company.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_company.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_company){
		$this->db->where('id_company',$id_company);
		$data = $this->db->get('company')->row();
		echo json_encode($data);
	}

}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */