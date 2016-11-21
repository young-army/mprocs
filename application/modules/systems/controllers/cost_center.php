<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Cost_center extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('sess_login')){
			redirect('login');
		}
		$this->page->use_directory();
	}
	
	public function index(){
		$data['big_header']   	= 'Cost Center';
		$data['small_header']   = 'Management';
		$data['data']			= $this->db->query("select a.*,b.company_name from cost_center a join company b on a.company_code = b.company_code")->result();
		$data['company']		= $this->db->query("select * from company")->result();
		$data['datatable']		= true;
		$data['form']			= true;
		$this->page->view('cost_center_index',$data);	
	}    
	
	function save(){
		$data = array(
		'company_code'		=> $this->input->post('company'),
		'cost_center'		=> $this->input->post('cost_center'),
		'description'		=> $this->input->post('description'),
		'valid_from'		=> $this->input->post('valid_from'),
		'valid_to'			=> $this->input->post('valid_until'),
		'mng_name'			=> $this->input->post('manager'),
		'mng_email'			=> $this->input->post('mng_email'),
		'change_date'		=> date('Y-m-d h:i:s')
		);
		if($this->input->post('id')==''){
			$this->db->insert('cost_center',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('cost_center',$data);
		}

	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('cost_center');
	}
	
	function getData(){
		$q = $this->db->query("select a.*,b.company_name from cost_center a join company b on a.company_code = b.company_code")->result();
		$no   = 1;
		foreach($q as $row){
		$data[] = array(
		$no,
		$row->company_name,
		$row->cost_center,
		$row->description,
		$row->valid_from,
		$row->valid_to,
		$row->mng_name,
		$row->mng_email,
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
		$data = $this->db->get('cost_center')->row();
		echo json_encode($data);
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */