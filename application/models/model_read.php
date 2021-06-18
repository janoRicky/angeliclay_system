<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_read extends CI_Model {


	public function get_orders_custom() {
		$query = "SELECT * FROM orders AS o WHERE status = 'ACTIVE' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM')";
		return $this->db->query($query);
	}
	public function get_order_custom_wid($id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND status = 'ACTIVE' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM')";
		return $this->db->query($query);
	}
	public function get_product_custom_wid($id) {
		$query = "SELECT * FROM products_custom WHERE custom_id = '$id'";
		return $this->db->query($query);
	}

	public function get_products() {
		return $this->db->get_where("products", array("status" => "ACTIVE", "type" => "NORMAL"));
	}
	public function get_products_user() {
		$query = "SELECT * FROM products AS p WHERE status = 'ACTIVE' AND qty > 0 AND EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id)";
		return $this->db->query($query);
	}
	public function get_product_wid($id) {
		return $this->db->get_where("products", array("product_id" => $id));
	}
	public function get_product_wid_user($id) {
		$query = "SELECT * FROM products AS p WHERE product_id = '$id' AND status = 'ACTIVE' AND qty > 0 AND EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id)";
		return $this->db->query($query);
	}
	public function get_product_desc_wid($id) {
		$this->db->select("description");
		return $this->db->get_where("products", array("product_id" => $id));
	}
	public function get_product_wtype($id) {
		return $this->db->get_where("products", array("type_id" => $id));
	}

	public function get_types() {
		return $this->db->get_where("types", array("status" => "ACTIVE"));
	}
	public function get_type_wid($id) {
		return $this->db->get_where("types", array("type_id" => $id));
	}

	public function get_orders() {
		$query = "SELECT * FROM orders AS o WHERE status = 'ACTIVE' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'NORMAL')";
		return $this->db->query($query);
	}
	public function get_order_wid($id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND status = 'ACTIVE' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'NORMAL')";
		return $this->db->query($query);
	}
	public function get_order_wuser_id($id) {
		return $this->db->get_where("orders", array("status" => "ACTIVE"));
	}
	public function get_order_items_worder_id($id) {
		return $this->db->get_where("orders_items", array("order_id" => $id));
	}

	public function get_user_accounts() {
		return $this->db->get_where("user_accounts", array("status" => "ACTIVE"));
	}
	public function get_user_acc_wid($id) {
		return $this->db->get_where("user_accounts", array("user_id" => $id));
	}
	public function get_user_acc_wemail($email) {
		return $this->db->get_where("user_accounts", array("email" => $email, "status" => "ACTIVE"));
	}
	public function search_user_emails($search) { // unused
		$this->db->select("email");
		$this->db->from("user_accounts");
		$this->db->where("status", "ACTIVE");
		$this->db->like("email", $search, "both");
		$this->db->limit(5);
		return $this->db->get();
	}

	public function get_adm_accounts() {
		return $this->db->get_where("admin_accounts", array("status" => "ACTIVE"));
	}
	public function get_adm_acc_wid($id) {
		return $this->db->get_where("admin_accounts", array("admin_id" => $id));
	}
	public function get_adm_acc_wemail($email) {
		return $this->db->get_where("admin_accounts", array("email" => $email));
	}
}
