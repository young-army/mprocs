<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_status extends MX_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'registration_status';
		$data['data']			= $this->db->query("
			SELECT rs.*,
					u.id,
					u.username
			FROM (
				SELECT *
				FROM registration_status 
			) AS rs
			LEFT JOIN user_login AS u
				ON rs.id_users_fk = u.id
				")->result();
		$this->page->view('registration_status_index',$data);	
	}    
	
	function save(){
		$data = array(
		'status'				=> $this->input->post('status'),
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_registration_status')==''){
			$this->db->insert('registration_status',$data);
		}else{
			$this->db->where('id_registration_status',$this->input->post('id_registration_status'));
			$this->db->update('registration_status',$data);
		}

	}
	
	function delete($id_registration_status){
		$this->db->where('id_registration_status',$id_registration_status);
		$this->db->delete('registration_status');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT rs.*,
					u.id,
					u.username
			FROM (
				SELECT *
				FROM registration_status 
			) AS rs
			LEFT JOIN user_login AS u
				ON rs.id_users_fk = u.id
			")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->status,
		$row->create_date,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_registration_status.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_registration_status.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_registration_status){
		$this->db->where('id_registration_status',$id_registration_status);
		$data = $this->db->get('registration_status')->row();
		echo json_encode($data);
	}

}

/* End of file registration_status.php */
/* Location: ./application/modules/master_data/controllers/registration_status.php */