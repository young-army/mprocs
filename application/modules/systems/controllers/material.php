<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends MX_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'material';
		$data['company']		= $this->db->query("
			SELECT *
				FROM company 
				")->result();
		$data['data']			= $this->db->query("
			SELECT d.*,
					u.id,
					u.username
			FROM (
				SELECT *
				FROM material 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
				")->result();
		$this->page->view('material_index',$data);	
	}    
	
	function save(){
		$data = array(
		'code_material'			=> $this->input->post('material_code'),
		'material_name'			=> $this->input->post('material_name'),
		'jenis'					=> $this->input->post('jenis'),
		'type'          		=> $this->input->post('type'),
		'flag'					=> '1',
		'id_users_fk'			=> '1',
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_material')==''){
			$this->db->insert('material',$data);
		}else{
			$this->db->where('id_material',$this->input->post('id_material'));
			$this->db->update('material',$data);
		}

	}
	
	function delete($id_material){
		$this->db->where('id_material',$id_material);
		$this->db->delete('material');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT d.*,
					u.id,
					u.username
			FROM (
				SELECT *
				FROM material 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->code_material,
		$row->material_name,
		$row->jenis,
		$row->type,
		$row->create_date,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_material.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_material.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_material){
		$this->db->where('id_material',$id_material);
		$data = $this->db->get('material')->row();
		echo json_encode($data);
	}

}

/* End of file material.php */
/* Location: ./application/modules/master_data/controllers/material.php */