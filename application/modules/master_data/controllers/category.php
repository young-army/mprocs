<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'category';
		$data['data']			= $this->db->query("
			SELECT d.*,
					u.id,
					u.username
			FROM (
				SELECT *
				FROM category 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
				")->result();
		$this->page->view('category_index',$data);	
	}    
	
	function save(){
		$data = array(
		'category_name'			=> $this->input->post('category'),
		'description'			=> $this->input->post('description'),
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_category')==''){
			$this->db->insert('category',$data);
		}else{
			$this->db->where('id_category',$this->input->post('id_category'));
			$this->db->update('category',$data);
		}

	}
	
	function delete($id_category){
		$this->db->where('id_category',$id_category);
		$this->db->delete('category');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT d.*,
					u.id,
					u.username
			FROM (
				SELECT *
				FROM category 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->category_name,
		$row->description,
		$row->create_date,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_category.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_category.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_category){
		$this->db->where('id_category',$id_category);
		$data = $this->db->get('category')->row();
		echo json_encode($data);
	}

}

/* End of file category.php */
/* Location: ./application/modules/master_data/controllers/category.php */