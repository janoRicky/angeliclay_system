<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_delete extends CI_Model {

	public function delete_adm_account($id) {
		return $this->db->delete("adm_accounts", array("id" => $id));
	}
}
