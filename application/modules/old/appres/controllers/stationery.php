<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Stationery extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$sess = $this->session->userdata('sess_login');
		$data['big_header']   	= 'Reservation And Approval';
		$data['small_header']   = 'Stationery';
		$data['data']			= $this->db->query("select trx_number,status,userid from Stationery_cart where userid = '".$sess->id."' group by trx_number,status,userid")->result();
		$this->page->view('stationery_index',$data);	
	}    
	
	public function detail($code){
		$data['big_header']   	= 'Reservation And Approval';
		$data['small_header']   = 'Stationery';
		$data['data']			= $this->db->query("select a.trx_number,a.total,a.status,b.* from stationery_cart a join stationery b on a.item_code = b.item_code where a.trx_number = '$code'")->result();
		$this->page->view('stationery_cart_d',$data);
	}  
	
	function getCount($trx){
		echo $this->db->query("select * from stationery_cart where trx_number = '$trx'")->num_rows();
	} 
	
	function approve($trxnum){
		$this->db->query("update stationery_cart set status = '2' where trx_number = '$trxnum'");
		redirect('appres/stationery');
	}
	
	function save(){
		$sess = $this->session->userdata('sess_login');
		$data = array(
		'trx_number'	=> $this->input->post('trx_number'),
		'item_code'		=> $this->input->post('item_code'),
		'total'			=> $this->input->post('total'),
		'userid'		=> $sess->id
		);
		if($this->input->post('id')==''){
			if($this->db->insert('stationery_cart',$data)){
				echo 'S';
			}else{
				echo 'F';
			}
		}else{
			$this->db->where('id',$this->input->post('id'));
			if($this->db->update('stationery_cart',$data)){
				echo 'S';
			}else{
				echo 'F';
			}
		}

	}
	
	function cart($trxnum = ''){
		$sess = $this->session->userdata('sess_login');
		$data['big_header']   	= 'Book Management';
		$data['small_header']   = 'Stationery Cart';
		if($trxnum==''){
		$data['data']			= $this->db->query("select distinct(trx_number) as trxnum from stationery_cart where userid = '".$sess->id."'")->result();
			$this->page->view('stationery_cart_h',$data);
		}else{
			$data['data']			= $this->db->query("select a.trx_number,a.total,a.status,b.* from stationery_cart a join stationery b on a.item_code = b.item_code where a.trx_number = '$trxnum'")->result();
			$this->page->view('stationery_cart_d',$data);
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