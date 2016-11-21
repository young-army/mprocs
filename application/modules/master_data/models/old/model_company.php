<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_company extends CI_Model {
	
	public	$company_code  	= '';
	public	$company_name  	= '';
	public  $house_number 	= '';
	public	$street			= '';
	public	$city 			= '';
	public	$postal_code	= '';
	public  $country		= '';
	public  $telephone		= '';
	public	$fax			= '';
	public	$email			= '';
	public  $tax_number		= '';
	public  $chrt_acc		= '';
	public	$change_date	= '';
	public	$change_time	= '';
	public	$nama			= '';
	public	$calender_code			= '';
	
	public function get_data($table) {
		return $this->db->get($table)->result();
	}
	
	public function get_company(){
		$query = "
			Select * from 
				company 
					where flag = '1'
		";
		return $this->db->query($query)->result();
	}
	
	public function by_id_company($id){
		$datasrc = $this->db->query("
			SELECT c.*,
					u.id_users,
					u.name
			FROM (
				SELECT *
				FROM company 
				WHERE id = '{$id}'
			) AS c
			LEFT JOIN users AS u
				ON c.id_users_fk = u.id_users
		");
		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}
	
}
/* End of file model_company.php */
/* Location: ./application/modules/master_data/models/model_company.php */