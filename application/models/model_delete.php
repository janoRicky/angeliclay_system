<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_delete extends CI_Model {

	public function delete_product($id) {
		return $this->db->delete("products", array("product_id" => $id));
	}

	public function delete_type($id) {
		return $this->db->delete("types", array("type_id" => $id));
	}

	public function delete_order($id) {
		return $this->db->delete("orders", array("order_id" => $id));
	}
	public function delete_order_item_worder_id($id) {
		return $this->db->delete("orders_items", array("order_id" => $id));
	}

	public function delete_user_account($id) {
		return $this->db->delete("user_accounts", array("user_id" => $id));
	}

	public function delete_adm_account($id) {
		return $this->db->delete("admin_accounts", array("admin_id" => $id));
	}
}
