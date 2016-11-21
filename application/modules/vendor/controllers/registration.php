<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Registration extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Vendor Management';
		$data['small_header']   = 'Registration';
		$this->page->view('vendor_form',$data);	
	}    
	
	function save(){
		$data = array(
		'room_code'		=> $this->input->post('room_code'),
		'room_name'		=> $this->input->post('room_name'),
		'floor'			=> $this->input->post('floor'),
		'capacity'		=> $this->input->post('capacity')
		);
		if($this->input->post('id')==''){
			$this->db->insert('meeting_room',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('meeting_room',$data);
		}

	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('meeting_room');
	}
	
	function getData(){
		$q = $this->db->query("select * from meeting_room")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->room_code,
		$row->room_name,
		$row->floor,
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
		$data = $this->db->get('meeting_room')->row();
		echo json_encode($data);
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */