<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_update extends CI_Model {

	public function update_product($id, $data) {
		$this->db->where("product_id", $id);
		return $this->db->update("products", $data);
	}

	public function update_type($id, $data) {
		$this->db->where("type_id", $id);
		return $this->db->update("types", $data);
	}

	public function update_order($id, $data) {
		$this->db->where("order_id", $id);
		return $this->db->update("orders", $data);
	}

	public function update_user_account($id, $data) {
		$this->db->where("user_id", $id);
		return $this->db->update("user_accounts", $data);
	}

	public function update_adm_account($id, $data) {
		$this->db->where("admin_id", $id);
		return $this->db->update("admin_accounts", $data);
	}
}
