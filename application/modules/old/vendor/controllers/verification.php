<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Verification extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'Stationery';
		$data['data']			= $this->db->query("select * from stationery")->result();
		$this->page->view('stationery_index',$data);	
	}    
	
	function save(){
		$data = array(
		'item_code'			=> $this->input->post('item_code'),
		'item_name'			=> $this->input->post('item_name'),
		'unit'				=> $this->input->post('unit')
		);
		if($this->input->post('id')==''){
			$this->db->insert('stationery',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('stationery',$data);
		}

	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('stationery');
	}
	
	function getData(){
		$q = $this->db->query("select * from stationery")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->item_code,
		$row->item_name,
		$row->unit,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id){
		$this->db->where('id',$id);
		$data = $this->db->get('stationery')->row();
		echo json_encode($data);
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */