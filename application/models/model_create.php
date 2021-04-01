<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_create extends CI_Model {

	public function create_adm_account($data) {
		return $this->db->insert("adm_accounts", $data);
	}
}
