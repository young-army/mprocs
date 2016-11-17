<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_company');
	}
	
	public function index() {		
		
		$this->page->view('company_form', array (
			'add'		=> $this->page->base_url('/add'),
			'delete'	=> $this->page->base_url('/multi_delete'),
			'grid'		=> $this->model_company->get_company(),
		));
	}
	
	private function form($action = 'insert', $id = 0){
		if ($this->agent->referrer() == '') redirect($this->page->base_url());
		
		$title = '';
		if($this->uri->segment(3) == 'add'){ 
			$title = 'Add';
			$button = 'Save Data';
		} else {
			$title = 'Edit';
			$button = 'Update Data';
		}
		
		$this->page->view('company_form', array (
			'ttl'		=> $title,
			'btn'		=> $button,
			'back'		=> $this->agent->referrer(),
			'act'		=> $this->page->base_url("/{$action}/{$id}"),
			'rc'		=> $this->model_company->by_id_company($id),
			'cal'		=> $this->model_company->get_data('calendar_header'),
		));
	}
	
	public function add(){
		$this->form();
	}
	
	public function edit($id){
		$this->form('update', $id);
	}
	
	public function insert(){		
		if ( ! $this->input->post()) show_404();
		
		//$calender_code = preg_replace('/\s+/', ' ',ucwords($this->input->post('calender_code')));
		$calender_code = $this->input->post('calender_code');
		//$position_name = ucwords($this->input->post('position_name'));
		$company_code    = $this->input->post('company_code');

	/*	$row_data 	= $this->db->get_where('company', array('calender_code'=> $calender_code, 'flag' => '1'))->row();
		if ($row_data) {
			$this->session->set_flashdata('duplicate', 'failed');
			redirect($this->page->base_url('/add'));
		}
		else{*/
		$data = array(
			'company_code'	=> $this->input->post('company_code'),
			'company_name'	=> $this->input->post('company_name'),
			'country' 		=> $this->input->post('country'),
			'calender_code'	=> $this->input->post('calender_code'),
			//'currency' 	=> $this->input->post('currency'),
			//'language' 	=> $this->input->post('language'),
			'chrt_acc' 		=> $this->input->post('chrt_acc'),
			'tax_number' 	=> $this->input->post('tax_number'),
			'street' 		=> $this->input->post('street'),
			'house_number' 	=> $this->input->post('house_number'),
			'postal_code' 	=> $this->input->post('postal_code'),
			'city' 			=> $this->input->post('city'),
			'telephone' 	=> $this->input->post('telephone'),
			'fax' 			=> $this->input->post('fax'),
			'email' 		=> $this->input->post('email'),
			'change_date' 	=> date('Y-m-d'),
			'change_time'	=> date('H:i:s'),
			'id_users_fk'	=> $this->session->userdata('users')->id_users,
			'flag'			=> '1',
		);
		//var_dump($data);exit;
		$this->db->insert('company', $data);
		redirect($this->page->base_url());
		//var_dump($data);exit;
	/*}*/
	}
	
	public function update($id){		
		if ( ! $this->input->post()) show_404();
		
		$data = array(
			'company_code'	=> $this->input->post('company_code'),
			'company_name'	=> $this->input->post('company_name'),
			'calender_code'	=> $this->input->post('calender_code'),
			'country' 		=> $this->input->post('country'),
			//'currency' 	=> $this->input->post('currency'),
			//'language' 	=> $this->input->post('language'),
			'chrt_acc' 		=> $this->input->post('chrt_acc'),
			'tax_number' 	=> $this->input->post('tax_number'),
			'street' 		=> $this->input->post('street'),
			'house_number' 	=> $this->input->post('house_number'),
			'postal_code' 	=> $this->input->post('postal_code'),
			'city' 			=> $this->input->post('city'),
			'telephone' 	=> $this->input->post('telephone'),
			'fax' 			=> $this->input->post('fax'),
			'email' 		=> $this->input->post('email'),
			'change_date' 	=> date('Y-m-d'),
			'change_time'	=> date('H:i:s'),
			'id_users_fk'	=> $this->session->userdata('users')->id_users,
			'flag'			=> '1',
		);				
		$this->db->where('id', $id);
		$this->db->update('company', $data);	
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();
		if ($this->agent->referrer() == '') show_404();
		$query = $this->db->query("select company_code from company where id='$id'")->result();
		foreach ($query as $row ) {
			$company_fk = $row->company_code;
		}
		$checkdelete_eg = $this->db->query(" select 
			a.company_fk
			from 
			employee_group a
			where 
			a.company_fk='$company_fk' AND a.flag='1' 
			")->result();

		$checkdelete_es = $this->db->query(" select 
			b.company_fk
			from 
			employee_subgroup b
			where 
			b.company_fk='$company_fk' AND b.flag='1' 
			")->result();
		$checkdelete_grade = $this->db->query(" select 
			c.company_fk
			from 
			grade c
			where 
			c.company_fk='$company_fk' AND c.flag='1' 
			")->result();
		$checkdelete_p = $this->db->query(" select 
			d.company_fk
			from 
			position d
			where 
			d.company_fk='$company_fk' AND d.flag='1' 
			")->result();
		$checkdelete_basic_benefit = $this->db->query(" select 
			d.company_fk
			from 
			basic_benefit d
			where 
			d.company_fk='$company_fk' AND d.flag='1' 
			")->result();
		$checkdelete_basic_pay = $this->db->query(" select 
			d.company_fk
			from 
			basic_pay d
			where 
			d.company_fk='$company_fk' AND d.flag='1' 
			")->result();
		$checkdelete_department = $this->db->query(" select 
			d.company_fk
			from 
			department d
			where 
			d.company_fk='$company_fk' AND d.flag='1' 
			")->result();
		$checkdelete_eo = $this->db->query(" select 
			d.company_fk
			from 
			employee_organization d
			where 
			d.company_fk='$company_fk' AND d.flag='1' 
			")->result();
		$checkdelete_leave_ess = $this->db->query(" select 
			d.company_fk
			from 
			leave_ess d
			where 
			d.company_fk='$company_fk' AND d.flag='1' 
			")->result();
		$checkdelete_leave_assign = $this->db->query(" select 
			d.company_fk
			from 
			leave_assign d
			where 
			d.company_fk='$company_fk' AND d.flag='1' 
			")->result();
		$checkdelete_timesheet = $this->db->query(" select 
			d.company_fk
			from 
			timesheet d
			where 
			d.company_fk='$company_fk' AND d.flag='1' 
			")->result();
		$checkdelete_timesheet_ess = $this->db->query(" select 
			d.company_fk
			from 
			timesheet_ess d
			where 
			d.company_fk='$company_fk'
			")->result();

		if ($checkdelete_eg OR $checkdelete_es OR $checkdelete_grade OR $checkdelete_p OR $checkdelete_basic_benefit OR $checkdelete_basic_pay OR $checkdelete_department OR $checkdelete_eo OR $checkdelete_leave_ess OR $checkdelete_leave_assign OR $checkdelete_timesheet OR $checkdelete_timesheet_ess) {
			$this->session->set_flashdata('validation_master', 'failed');
			redirect($this->page->base_url());
		}
		else{
		$data = array ('flag' => '0');
		$this->db->where('id', $id);
		$this->db->update('company', $data);
		
		redirect($this->agent->referrer());
		//echo "qqqqqqqqqqqqqqqqq";
		}
	}
	
	public function options_company($id){
		$company = $this->db->order_by('company_name', 'ASC')->get_where('company', array('flag' => '1'));
		return options($company, 'company_code', $id, 'company_name');
	}
	public function options_calender_company($id){
		$company = $this->db->where('flag','1')->get('company');
		return options($company, 'id', $id, 'company_name' );
	}

}

/* End of file company.php */
/* Location: ./application/modules/master_data/controllers/company.php */