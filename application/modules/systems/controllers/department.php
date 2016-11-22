<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MX_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'Department';
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
				FROM department 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			LEFT JOIN company AS c
				ON d.company_code_fk = c.company_code
				")->result();
		$this->page->view('department_index',$data);	
	}    
	
	function save(){
		$data = array(
		'company_code_fk'			=> $this->input->post('company_code_fk'),
		'department_code'			=> $this->input->post('department_code'),
		'department_name'			=> $this->input->post('department_name'),
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_department')==''){
			$this->db->insert('department',$data);
		}else{
			$this->db->where('id_department',$this->input->post('id_department'));
			$this->db->update('department',$data);
		}

	}
	
	function delete($id_department){
		$this->db->where('id_department',$id_department);
		$this->db->delete('department');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT d.*,
					u.id,
					u.username,
					c.company_name
			FROM (
				SELECT *
				FROM department 
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
		$row->department_code,
		$row->department_name,
		$row->create_date,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_department.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_department.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_department){
		$this->db->where('id_department',$id_department);
		$data = $this->db->get('department')->row();
		echo json_encode($data);
	}

}

/* End of file department.php */
/* Location: ./application/modules/master_data/controllers/department.php */