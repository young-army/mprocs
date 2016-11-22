<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_blacklist extends MX_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'Vendor Blacklist';
		$data['vendor']		= $this->db->query("
			SELECT *
				FROM vendor 
				")->result();
		$data['data']			= $this->db->query("
			SELECT d.*,
					u.id,
					u.username,
					v.vendor_name
			FROM (
				SELECT *
				FROM vendor_blacklist 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			LEFT JOIN vendor AS v
				ON v.vendor_code = d.vendor_fk
				")->result();
		$this->page->view('vendor_blacklist_index',$data);	
	}    
	
	function save(){
		$data = array(
		'vendor_fk'				=> $this->input->post('vendor_fk'),
		'start_date'			=> date('Y-m-d'),
		'remark'				=> $this->input->post('reason'),
		'status_blacklist'		=> 'Waiting',
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_vendor_blacklist')==''){
			$this->db->insert('vendor_blacklist',$data);
		}else{
				$data_h = array(
				'vendor_fk'				=> $this->input->post('vendor_fk'),
				'start_date'			=> date('Y-m-d'),
				'remark'				=> $this->input->post('reason'),
				//'status_redlist'		=> 'Waiting',
				'id_users_fk'			=> '1',
				'flag'					=>$this->input->post('flag'),
				'create_date'			=> date('Y-m-d'),
				'flag'					=> '1'
				);
			$this->db->where('id_vendor_blacklist',$this->input->post('id_vendor_blacklist'));
			$this->db->update('vendor_blacklist',$data_h);
		}

	}
	
	function approve($id){
		$this->db->query("update vendor_blacklist set status_blacklist = 'Approved' where id_vendor_blacklist = '$id'");
		redirect('vendor_managementvendor_blacklist');
	}
	function cancel($id){
		$this->db->query("update vendor_blacklist set status_blacklist = 'Cancel' where id_vendor_blacklist = '$id'");
		redirect('vendor_managementvendor_blacklist');
	}
	function rejected($id){
		$this->db->query("update vendor_blacklist set status_blacklist = 'Rejected' where id_vendor_blacklist = '$id'");
		redirect('vendor_managementvendor_blacklist');
	}


	function delete($id_vendor_blacklist){
		$this->db->where('id_vendor_blacklist',$id_vendor_blacklist);
		$this->db->delete('vendor_blacklist');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT d.*,
					u.id,
					u.username,
					v.vendor_name
			FROM (
				SELECT *
				FROM vendor_blacklist 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			LEFT JOIN vendor AS v
				ON v.vendor_code = d.vendor_fk
			")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->vendor_fk,
		$row->vendor_fk,
		$row->vendor_name,
		$row->create_date,
		$row->remark,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_vendor_blacklist.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_vendor_blacklist.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_vendor_blacklist){
		$this->db->where('id_vendor_blacklist',$id_vendor_blacklist);
		$data = $this->db->get('vendor_blacklist')->row();
		echo json_encode($data);
	}

}

/* End of file vendor_blacklist.php */
/* Location: ./application/modules/master_data/controllers/vendor_blacklist.php */