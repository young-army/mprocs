<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Meeting_room extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Book Management';
		$data['small_header']   = 'Meeting Room';
		$data['data']			= $this->db->query("select * from meeting_room")->result();
		$this->page->view('meeting_room_index',$data);	
	}    
	
	public function detail($code){
		$data['big_header']   	= 'Meeting Room';
		$data['small_header']   = 'Booking Schedule';
		$data['data']			= $this->db->query("select a.*,b.room_name from h_book_meeting_room a join meeting_room b on a.room_code = b.room_code where a.room_code = '$code'")->result();
		$this->page->view('meeting_room_detail',$data);	
	}  
	
	function save(){
		$sess = $this->session->userdata('sess_login');
		$room = explode('-',$this->input->post('room_descs'));
		$data = array(
		'room_code'		=> $room[0],
		'start_book'	=> $this->input->post('book_date').' '.$this->input->post('start_time'),
		'end_book'		=> $this->input->post('book_date').' '.$this->input->post('end_time'),
		'user_id'		=> $sess->id,
		'contingent'	=> $this->input->post('total_prs'),
		'username'		=> $sess->username
		);
		if($this->input->post('id')==''){
			if($this->db->insert('h_book_meeting_room',$data)){
				echo 'S';
			}else{
				echo 'F';
			}
		}else{
			$this->db->where('id',$this->input->post('id'));
			if($this->db->update('h_book_meeting_room',$data)){
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