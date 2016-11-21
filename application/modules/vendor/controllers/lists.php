<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Lists extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'Operational Car';
		$data['data']			= $this->db->query("select * from operational_car")->result();
		$this->page->view('operational_car_index',$data);	
	}    
	
	function save(){
		$data = array(
		'v_num'			=> $this->input->post('v_num'),
		'brand'			=> $this->input->post('brand'),
		'type'			=> $this->input->post('type'),
		'color'			=> $this->input->post('color'),
		'capacity'		=> $this->input->post('capacity')
		);
		if($this->input->post('id')==''){
			$this->db->insert('operational_car',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('operational_car',$data);
		}

	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('operational_car');
	}
	
	function getData(){
		$q = $this->db->query("select * from operational_car")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->v_num,
		$row->brand,
		$row->type,
		$row->color,
		$row->capacity.' Persons',
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
		$data = $this->db->get('operational_car')->row();
		echo json_encode($data);
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */