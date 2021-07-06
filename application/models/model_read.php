<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_read extends CI_Model {


	public function get_orders_custom($state) {
		$where_state = ($state != "ALL" ? "AND state = '$state'" : "");
		$query = "SELECT * FROM orders AS o WHERE status = '1' $where_state AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM')";
		return $this->db->query($query);
	}
	public function get_order_custom_wid($id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND status = '1' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM')";
		return $this->db->query($query);
	}
	public function get_order_custom_to_pay_wid_user_id($id, $user_id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND user_id = '$user_id' AND state = '1' AND status = '1' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'CUSTOM')";
		return $this->db->query($query);
	}
	public function get_product_custom_wid($id) {
		$query = "SELECT * FROM products_custom WHERE custom_id = '$id'";
		return $this->db->query($query);
	}

	public function get_products() {
		return $this->db->get_where("products", array("status" => "1", "type" => "NORMAL"));
	}
	public function get_products_user() {
		$query = "SELECT * FROM products AS p WHERE status = '1' AND visibility = '1' AND EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id)";
		return $this->db->query($query);
	}
	public function get_products_user_view($search, $type, $page) {
		// $this->db->select("*");
		// $this->db->from("products AS p");
		// $this->db->where("EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id)", NULL, FALSE);
		// $this->db->where(array(
		// 	"status" => "1",
		// 	"visibility" => "1"
		// ));
		// $this->db->like("name", $search);
		// $this->db->or_like("description", $search);
		// $this->db->order_by("date_added", "DESC");
		// $this->db->limit(10);
		// return $this->db->get();
		$search_query = (!is_null($type) && !empty($type) ? "AND type_id = '$type' " : "") . (!is_null($search) ? "AND (name LIKE '%$search%' OR description LIKE '%$search%') " : "");
		$pg_no = (!is_null($page) && !empty($page) ? $page * 10 : 0);

		$query = "SELECT * FROM products AS p WHERE status = '1' AND visibility = '1'$search_query AND EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id) ORDER BY p.date_added DESC LIMIT 10 OFFSET $pg_no";
		return $this->db->query($query);
	}
	public function get_product_wid($id) {
		return $this->db->get_where("products", array("product_id" => $id));
	}
	public function get_product_wid_user($id) {
		$query = "SELECT * FROM products AS p WHERE product_id = '$id' AND status = '1' AND visibility = '1' AND EXISTS(SELECT * FROM types AS t WHERE p.type_id = t.type_id)";
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
		return $this->db->get_where("types", array("status" => "1"));
	}
	public function get_types_user_view() {
		$query = "SELECT * FROM types AS t WHERE status = '1' AND EXISTS(SELECT * FROM products AS p WHERE t.type_id = p.type_id AND visibility = '1')";
		return $this->db->query($query);
	}
	public function get_type_wid($id) {
		return $this->db->get_where("types", array("type_id" => $id));
	}
	public function get_types_user() {
		return $this->db->get_where("types", array("status" => "1", "featured" => "1"));
	}

	public function get_orders($state) {
		$where_state = ($state != "ALL" ? "AND state = '$state'" : "");
		$query = "SELECT * FROM orders AS o WHERE status = '1' $where_state AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'NORMAL')";
		return $this->db->query($query);
	}
	public function get_order_wid($id) {
		$query = "SELECT * FROM orders AS o WHERE order_id = '$id' AND status = '1' AND EXISTS(SELECT * FROM orders_items AS oi WHERE o.order_id = oi.order_id AND type = 'NORMAL')";
		return $this->db->query($query);
	}
	public function get_order_wuser_id($id, $state) {
		$where_state = ($state != "ALL" ? array("state" => $state) : array());
		return $this->db->get_where("orders", array_merge(array("user_id" => $id, "status" => "1"), $where_state));
	}
	public function get_order_states_wuser_id($id) {
		$this->db->select("state");
		return $this->db->get_where("orders", array("user_id" => $id, "status" => "1"));
	}
	public function get_order_items_worder_id($id) {
		return $this->db->get_where("orders_items", array("order_id" => $id));
	}
	public function get_order_items_qty_price_worder_id($id) {
		$this->db->select("qty, price");
		return $this->db->get_where("orders_items", array("order_id" => $id));
	}

	public function get_order_all_wid_user_id($id, $user_id) {
		return $this->db->get_where("orders", array("order_id" => $id, "user_id" => $user_id));
	}
	public function get_order_items_wid_user_id($id, $user_id, $type) {
		$query = "SELECT * FROM orders_items AS oi WHERE order_id = '$id' AND type = '$type' AND EXISTS(SELECT * FROM orders AS o WHERE o.order_id = oi.order_id AND user_id = '$user_id' AND status = '1')";
		return $this->db->query($query);
	}

	public function get_order_payments_worder_id($order_id) {
		return $this->db->get_where("orders_payments", array("order_id" => $order_id));
	}

	public function get_user_accounts() {
		return $this->db->get_where("user_accounts", array("status" => "1"));
	}
	public function get_user_acc_wid($id) {
		return $this->db->get_where("user_accounts", array("user_id" => $id));
	}
	public function get_user_acc_wemail($email) {
		return $this->db->get_where("user_accounts", array("email" => $email, "status" => "1"));
	}
	public function search_user_emails($search) { // unused
		$this->db->select("email");
		$this->db->from("user_accounts");
		$this->db->where("status", "1");
		$this->db->like("email", $search, "both");
		$this->db->limit(5);
		return $this->db->get();
	}

	public function get_adm_accounts() {
		return $this->db->get_where("admin_accounts", array("status" => "1"));
	}
	public function get_adm_acc_wid($id) {
		return $this->db->get_where("admin_accounts", array("admin_id" => $id));
	}
	public function get_adm_acc_wemail($email) {
		return $this->db->get_where("admin_accounts", array("email" => $email));
	}
}
