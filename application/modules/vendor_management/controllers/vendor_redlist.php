<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_redlist extends MX_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Master Data';
		$data['small_header']   = 'Vendor Redlist';
		$data['datatable']		= true;
		$data['form']			= true;
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
				FROM vendor_redlist 
			) AS d
			LEFT JOIN user_login AS u
				ON d.id_users_fk = u.id
			LEFT JOIN vendor AS v
				ON v.vendor_code = d.vendor_fk
				")->result();
		$this->page->view('vendor_redlist_index',$data);	
	}    
	
	function save(){
		
		$vendor_fk = $this->input->post('vendor_fk');
		$query_redlist = $this->db->query("select * from vendor_redlist where vendor_fk = 'VE000002            '")->result();
			//$query_blacklist = $this->db->query("select * from vendor_blacklist where vendor_fk = '$vendor_fk'")->result();
			if ($query_redlist) {
			echo "<script>
			alert('Vendor Another Procces');
			document.location.href='".base_url()."vendor_redlist';
			</script>";
			//redirect('vendor/vendor_blacklist');
			}
			

		$data = array(
		'vendor_fk'				=> $this->input->post('vendor_fk'),
		'start_date'			=> date('Y-m-d'),
		'remark'				=> $this->input->post('reason'),
		'status_redlist'		=> 'Waiting',
		'id_users_fk'			=> '1',
		'flag'					=>$this->input->post('flag'),
		'create_date'			=> date('Y-m-d')
		);
		if($this->input->post('id_vendor_redlist')==''){
		

			$this->db->insert('vendor_redlist',$data);
		
		}else{
				$data_h = array(
				'vendor_fk'				=> $this->input->post('vendor_fk'),
				'start_date'			=> date('Y-m-d'),
				'remark'				=> $this->input->post('reason'),
				//'status_redlist'		=> 'Waiting',
				'id_users_fk'			=> '1',
				'flag'					=>$this->input->post('flag'),
				'create_date'			=> date('Y-m-d')
				);
			$this->db->where('id_vendor_redlist',$this->input->post('id_vendor_redlist'));
			$this->db->update('vendor_redlist',$data_h);
		}
	

	}
	
	function approve($id){
		$this->db->query("update vendor_redlist set status_redlist = 'Approved' where id_vendor_redlist = '$id'");
		redirect('vendor_managementvendor_redlist');
	}


	function delete($id_vendor_redlist){
		$this->db->where('id_vendor_redlist',$id_vendor_redlist);
		$this->db->delete('vendor_redlist');
	}
	
	function getData(){
		$q = $this->db->query("
			SELECT d.*,
					u.id,
					u.username,
					v.vendor_name
			FROM (
				SELECT *
				FROM vendor_redlist 
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
		$row->status_redlist,
		$row->create_date,
		$row->username,
		'<button class="btn btn-primary btn-xs" onclick="edit(\''.$row->id_vendor_redlist.'\')"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger btn-xs" onclick="del(\''.$row->id_vendor_redlist.'\')"><i class="fa fa-trash"></i></button>'
		);
		$no++; }
		if($data){
		echo json_encode($data);
		}
	}
	
	function getDetail($id_vendor_redlist){
		$this->db->where('id_vendor_redlist',$id_vendor_redlist);
		$data = $this->db->get('vendor_redlist')->row();
		echo json_encode($data);
	}

}

/* End of file vendor_redlist.php */
/* Location: ./application/modules/master_data/controllers/vendor_redlist.php */