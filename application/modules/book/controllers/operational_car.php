<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Operational_car extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Book Management';
		$data['small_header']   = 'Operational Car';
		$data['data']			= $this->db->query("select * from operational_car")->result();
		$this->page->view('operational_car_index',$data);	
	}    
	
	public function detail($code){
		$data['big_header']   	= 'Operatonal Car';
		$data['small_header']   = 'Booking Schedule';
		$data['data']			= $this->db->query("select a.*,b.brand,b.type,b.capacity,b.color from h_book_operational_car a join operational_car b on a.v_num = b.v_num where a.v_num = '$code'")->result();
		$this->page->view('operational_car_detail',$data);	
	}  
	
	function save(){
		$sess = $this->session->userdata('sess_login');
		$data = array(
		'v_num'			=> $this->input->post('v_num'),
		'book_date'		=> $this->input->post('book_date').' '.$this->input->post('start_time'),
		'end_time_est'	=> $this->input->post('book_date').' '.$this->input->post('end_time'),
		'user_id'		=> $sess->id,
		'destination'	=> $this->input->post('dest'),
		'driver'		=> $this->input->post('driver'),
		'username'		=> $sess->username
		);
		if($this->input->post('id')==''){
			if($this->db->insert('h_book_operational_car',$data)){
				echo 'S';
			}else{
				echo 'F';
			}
		}else{
			$this->db->where('id',$this->input->post('id'));
			if($this->db->update('h_book_operational_car',$data)){
				echo 'S';
			}else{
				echo 'F';
			}
		}

	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('meeting_room');
	}
	
	function getData(){
		$q = $this->db->query("select * from h_book_meeting_room")->result();
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