<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sub_category extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'sub_category';
		$data['category']		= $this->db->query("
			SELECT *
				FROM category 
				")->result();
		$data['data']			= $this->db->query("
			SELECT d.*,
					u.id,
					u.username,
					c.category_name
			FROM (
				SELECT *
				FROM sub_category 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			LEFT JOIN category AS c
				ON d.category_fk = c.id_category
				")->result();
		$this->page->view('sub_category_index',$data);	
	}    
	
	function save(){
		$data = array(
		'category_fk'			=> $this->input->post('category_fk'),
		'sub_category_name'		=> $this->input->post('sub_category'),
		'description'			=> $this->input->post('description'),
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_sub_category')==''){
			$this->db->insert('sub_category',$data);
		}else{
			$this->db->where('id_sub_category',$this->input->post('id_sub_category'));
			$this->db->update('sub_category',$data);
		}

	}
	
	function delete($id_sub_category){
		$this->db->where('id_sub_category',$id_sub_category);
		$this->db->delete('sub_category');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT d.*,
					u.id,
					u.username,
					c.category_name
			FROM (
				SELECT *
				FROM sub_category 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			LEFT JOIN category AS c
				ON d.category_fk = c.id_category
			")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->category_name,
		$row->sub_category_name,
		$row->description,
		$row->create_date,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_sub_category.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_sub_category.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_sub_category){
		$this->db->where('id_sub_category',$id_sub_category);
		$data = $this->db->get('sub_category')->row();
		echo json_encode($data);
	}

}

/* End of file sub_category.php */
/* Location: ./application/modules/master_data/controllers/sub_category.php */