<?php 
 defined("BASEPATH") OR exit("No direct script access allowed");

 class controller_main extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");

 		date_default_timezone_set('Asia/Manila');
 	}
	public function index() {
		redirect("home");
	}

	public function view_u_home() {
		$head["title"] = "Home - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$this->load->view("user/u_home", $data);
	}
	public function view_u_products() {
		$head["title"] = "Home - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$data["tbl_products"] = $this->model_read->get_products_user();

		$this->load->view("user/u_products", $data);
	}
	public function view_u_product() {
		$id = $this->input->get("id");

		$head["title"] = "Product #$id - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$product = $this->model_read->get_product_wid_user($id);

		if ($id == NULL || $product->num_rows() < 1) {
			redirect("products");
		} else {
			$data["product_details"] = $product->row_array();
			$data["type"] = $this->model_read->get_type_wid($data["product_details"]["type_id"])->row_array()["type"];
			$this->load->view("user/u_product", $data);
		}
	}
	public function view_u_cart() {
		$head["title"] = "Cart - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (isset($_SESSION["cart"])) {
			$data["cart"] = $_SESSION["cart"];
		} else {
			$data["cart"] = array();
		}

		$this->load->view("user/u_cart", $data);
	}
	public function view_u_login() {
		$head["title"] = "Login - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$this->load->view("user/u_login", $data);
	}

	public function test() {
		$head["title"] = "test - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$this->load->view("user/test", $data);
	}


	// ADMIN
	public function admin_logout() {
		// destroy session values
		session_destroy();
		redirect("admin");
	}
	public function admin_login_check() {
		// check if admin is logged in, sessions are set on a_controller_login
		if (!isset($_SESSION["admin_in"])) {
			// set log-in error message
			$this->session->set_flashdata("login_alert", array("warning", "Please log-in first."));
			redirect("admin");
		}
	}

	public function view_a_login() {
		// check if user is already logged in, if yes return to dashboard
		if (!isset($_SESSION["admin_in"])) {
			$head["title"] = "Login - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);

			$this->load->view("admin/a_login", $data);
		} else {
			redirect("admin/dashboard");
		}
	}
	public function view_a_dashboard() {
		// check if user is logged in
		$this->admin_login_check();

		// used in admin/template/a_t_head
		$head["title"] = "Dashboard - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		// used in navbar
		$data["nav"] = array("text" => "Dashboard", "link" => "dashboard");

		// data array values can be used as variables on the php page
		// $data["nav"] can be used in a_dashboard as $nav
		// $nav will have the value array("text" => "Dashboard", "link" => "dashboard")
		$this->load->view("admin/a_dashboard", $data);
	}
	// = = = PRODUCTS
	public function view_a_products() {
		$this->admin_login_check();

		$head["title"] = "Products - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array("text" => "Products", "link" => "products");

		$data["tbl_products"] = $this->model_read->get_products();
		foreach ($this->model_read->get_types()->result_array() as $row) {
			$data["tbl_types"][$row["type_id"]] = $row["type"];
		}

		$this->load->view("admin/a_products", $data);
	}
	public function view_a_products_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_product_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Product ID does not exist."));
			redirect("admin/products");
		} else {
			$head["title"] = "Products/View - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Products/View", "link" => "products");

			$data["row_info"] = $row_info->row_array();
			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["type"];
			}

			$this->load->view("admin/a_products_view", $data);
		}
	}
	public function view_a_products_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_product_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Product ID does not exist."));
			redirect("admin/products");
		} else {
			$head["title"] = "Products/Edit - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Products/Edit", "link" => "products");

			$data["row_info"] = $row_info->row_array();
			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["type"];
			}

			$this->load->view("admin/a_products_update", $data);
		}
	}
	// = = = TYPES
	public function view_a_types() {
		$this->admin_login_check();

		$head["title"] = "Types - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array("text" => "Types", "link" => "types");

		$data["tbl_types"] = $this->model_read->get_types();

		$this->load->view("admin/a_types", $data);
	}
	public function view_a_types_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_type_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Type ID does not exist."));
			redirect("admin/types");
		} else {
			$head["title"] = "Types/View - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Types/View", "link" => "types");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_types_view", $data);
		}
	}
	public function view_a_types_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_type_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Type ID does not exist."));
			redirect("admin/types");
		} else {
			$head["title"] = "Types/Edit - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Types/Edit", "link" => "types_edit");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_types_update", $data);
		}
	}
	// = = = ORDERS
	public function view_a_orders() {
		$this->admin_login_check();

		$head["title"] = "Orders - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array("text" => "Orders", "link" => "orders");

		$data["tbl_orders"] = $this->model_read->get_orders();
		$data["tbl_products"] = $this->model_read->get_products_user();
		foreach ($this->model_read->get_types()->result_array() as $row) {
			$data["tbl_types"][$row["type_id"]] = $row["type"];
		}

		$this->load->view("admin/a_orders", $data);
	}
	public function view_a_orders_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_order_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Order ID does not exist."));
			redirect("admin/orders");
		} else {
			$head["title"] = "Orders/View - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Orders/View", "link" => "orders");

			$data["row_info"] = $row_info->row_array();
			$data["tbl_order_items"] = $this->model_read->get_order_items_wid($id);

			$this->load->view("admin/a_orders_view", $data);
		}
	}
	public function view_a_orders_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_order_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Order ID does not exist."));
			redirect("admin/orders");
		} else {
			$head["title"] = "Orders/Edit - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Orders/Edit", "link" => "orders_edit");

			$data["row_info"] = $row_info->row_array();
			$data["tbl_order_items"] = $this->model_read->get_order_items_wid($id);
			$data["tbl_products"] = $this->model_read->get_products_user();
			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["type"];
			}

			$this->load->view("admin/a_orders_update", $data);
		}
	}
	// = = = USERS
	public function view_a_users() {
		$this->admin_login_check();

		$head["title"] = "Users - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array("text" => "Users", "link" => "users");

		$data["tbl_users"] = $this->model_read->get_user_accounts();

		$this->load->view("admin/a_users", $data);
	}
	public function view_a_users_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_user_acc_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "User ID does not exist."));
			redirect("admin/users");
		} else {
			$head["title"] = "Users/View - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Users/View", "link" => "users");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_users_view", $data);
		}
	}
	public function view_a_users_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_user_acc_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "User ID does not exist."));
			redirect("admin/users");
		} else {
			$head["title"] = "Users/Edit - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Users/Edit", "link" => "users_edit");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_users_update", $data);
		}
	}
	// = = = ADMINS
	public function view_a_accounts() {
		$this->admin_login_check();

		$head["title"] = "Accounts - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array("text" => "Accounts", "link" => "accounts");

		$data["tbl_accounts"] = $this->model_read->get_adm_accounts();

		$this->load->view("admin/a_accounts", $data);
	}
	public function view_a_accounts_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_adm_acc_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Admin ID does not exist."));
			redirect("admin/accounts");
		} else {
			$head["title"] = "Accounts/View - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Accounts/View", "link" => "accounts");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_accounts_view", $data);
		}
	}
	public function view_a_accounts_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_adm_acc_wid($id);

		// if id of the account is non-existent, redirect to accounts page
		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Admin ID does not exist."));
			redirect("admin/accounts");
		} else {
			$head["title"] = "Accounts/Edit - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Accounts/Edit", "link" => "accounts_edit");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_accounts_update", $data);
		}
	}

}