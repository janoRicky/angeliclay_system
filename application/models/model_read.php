<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_read extends CI_Model {

	public function get_adm_accounts() {
		return $this->db->get("adm_accounts");
	}
	public function get_adm_acc_w_id($id) {
		return $this->db->get_where("adm_accounts", array("id" => $id));
	}
	public function get_adm_acc_w_email($email) {
		return $this->db->get_where("adm_accounts", array("email" => $email));
	}
}
