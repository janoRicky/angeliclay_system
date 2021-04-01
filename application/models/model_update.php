<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_update extends CI_Model {

	public function update_adm_account($id, $data) {
		$this->db->where("id", $id);
		return $this->db->update("adm_accounts", $data);
	}
}
