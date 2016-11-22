<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_vendor extends CI_Model {
public $vendor_name = '';

public function by_id_vendor($id){
		$datasrc = $this->db->query("
			SELECT d.*,
												u.id,
												u.username,
												c.company_name
										FROM (
											SELECT *
											FROM vendor where id_vendor = '{$id}'
										) AS d
										LEFT JOIN user_login AS u
											ON d.id_users_fk = u.id
										LEFT JOIN company AS c
											ON d.company_code_fk = c.company_code
				
		");
		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}	

}

/* End of file model_vendor.php */
/* Location: ./application/modules/vendor/models/model_vendor.php */