<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_read extends CI_Model {

	public function get_products() {
		return $this->db->get("products");
	}
	public function get_products_user() {
		return $this->db->get_where("products", array("type_id != " => "NULL", "qty > " => "0"));
	}
	public function get_product_wid($id) {
		return $this->db->get_where("products", array("product_id" => $id));
	}
	public function get_product_wid_user($id) {
		return $this->db->get_where("products", array("product_id" => $id, "type_id != " => "NULL"));
	}
	public function get_product_desc_wid($id) {
		$this->db->select("description");
		return $this->db->get_where("products", array("product_id" => $id));
	}
	public function get_product_wtype($id) {
		return $this->db->get_where("products", array("type_id" => $id));
	}

	public function get_types() {
		return $this->db->get("types");
	}
	public function get_type_wid($id) {
		return $this->db->get_where("types", array("type_id" => $id));
	}

	public function get_orders() {
		return $this->db->get("orders");
	}
	public function get_order_wid($id) {
		return $this->db->get_where("orders", array("order_id" => $id));
	}
	public function get_order_items_wid($id) {
		return $this->db->get_where("orders_items", array("order_id" => $id));
	}

	public function get_user_accounts() {
		return $this->db->get("user_accounts");
	}
	public function get_user_acc_wid($id) {
		return $this->db->get_where("user_accounts", array("user_id" => $id));
	}
	public function get_user_acc_wemail($email) {
		return $this->db->get_where("user_accounts", array("email" => $email));
	}

	public function get_adm_accounts() {
		return $this->db->get("admin_accounts");
	}
	public function get_adm_acc_wid($id) {
		return $this->db->get_where("admin_accounts", array("admin_id" => $id));
	}
	public function get_adm_acc_wemail($email) {
		return $this->db->get_where("admin_accounts", array("email" => $email));
	}
}
