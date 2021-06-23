<?php 
 defined("BASEPATH") OR exit("No direct script access allowed");

 class controller_main extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");

 		date_default_timezone_set("Asia/Manila");
 	}
	public function index() {
		redirect("home");
	}

	public function view_u_home() {
		$head["title"] = "Home - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$this->load->view("user/u_home", $data);
	}
	public function view_u_products() {
		$head["title"] = "Products - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$data["tbl_products"] = $this->model_read->get_products_user();

		$this->load->view("user/u_products", $data);
	}
	public function view_u_product() {
		$id = $this->input->get("id");

		$head["title"] = "Product #$id - Angeliclay Ordering System";
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
	public function view_u_custom() {
		$head["title"] = "Custom - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			$this->session->set_flashdata("notice", array("warning", "Please log-in first."));
			redirect("login");
		} else {
			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["types"][$row["type_id"]] = $row["type"];
			}

			$user_details = $this->model_read->get_user_acc_wid($this->session->userdata("user_id"));
			if ($user_details->num_rows() < 1) {
				session_destroy();
				redirect("home");
			} else {
				$data["account_details"] = $user_details->row_array();
				$this->load->view("user/u_custom", $data);
			}
		}
	}
	public function view_u_cart() {
		$head["title"] = "Cart - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if ($this->session->has_userdata("cart")) {
			$data["cart"] = $this->session->userdata("cart");
			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["types"][$row["type_id"]] = $row["type"];
			}
		} else {
			$data["cart"] = array();
		}

		$this->load->view("user/u_cart", $data);
	}
	public function view_u_submit_order() {
		$head["title"] = "Place Order - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			$this->session->set_flashdata("notice", array("warning", "Please log-in first."));
			redirect("login");
		} else {
			$user_details = $this->model_read->get_user_acc_wid($this->session->userdata("user_id"));
			if ($user_details->num_rows() < 1) {
				session_destroy();
				redirect("home");
			} else {
				$data["account_details"] = $user_details->row_array();
				$this->load->view("user/u_submit_order", $data);
			}
		}
	}
	public function view_u_login() {
		$head["title"] = "Login - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$this->load->view("user/u_login", $data);
	}
	public function view_u_register() {
		$head["title"] = "Register - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$this->load->view("user/u_register", $data);
	}
	public function user_logout() {
		session_destroy();
		redirect("login");
	}
	public function view_u_account() {
		$head["title"] = "Account - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$user_details = $this->model_read->get_user_acc_wid($this->session->userdata("user_id"));
			if ($user_details->num_rows() < 1) {
				session_destroy();
				redirect("home");
			} else {
				$data["account_details"] = $user_details->row_array();
				$this->load->view("user/u_account", $data);
			}
		}
	}
	public function view_u_account_details() {
		$head["title"] = "Account Details - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$user_details = $this->model_read->get_user_acc_wid($this->session->userdata("user_id"));
			if ($user_details->num_rows() < 1) {
				session_destroy();
				redirect("home");
			} else {
				$data["account_details"] = $user_details->row_array();
				$this->load->view("user/u_account_details", $data);
			}
		}
	}
	public function view_u_my_orders() {
		$state = ($this->input->get("state") != NULL ? $this->input->get("state") : "ALL");

		$head["title"] = "My Orders - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		if (!$this->session->has_userdata("user_in")) {
			redirect("home");
		} else {
			$data["states"] = array(
				"PENDING", 
				"ACCEPTED / WAITING FOR PAYMENT", 
				"IN PROGRESS", 
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);

			$data["my_orders"] = $this->model_read->get_order_wuser_id($this->session->userdata("user_id"), $state);
			$this->load->view("user/u_my_orders", $data);
		}
	}
	public function view_u_my_order_details() {
		$id = $this->input->get("id");

		$head["title"] = "Order Details - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("user/template/u_t_head", $head);

		$order = $this->model_read->get_order_all_wid_user_id($id, $this->session->userdata("user_id"));
		if ($id == NULL || $order->num_rows() < 1) {
			redirect("my_orders");
		} else {
			$order_items = $this->model_read->get_order_items_wid_user_id($id, $this->session->userdata("user_id"), "CUSTOM");
			$type = "CUSTOM";
			if ($order_items->num_rows() < 1) {
				$order_items = $this->model_read->get_order_items_wid_user_id($id, $this->session->userdata("user_id"), "NORMAL");
				$type = "NORMAL";
			}
			$data["states"] = array(
				"PENDING", 
				"ACCEPTED / WAITING FOR PAYMENT", 
				"IN PROGRESS", 
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);
			
			$data["my_order"] = $order->row_array();
			$data["order_items"] = $order_items;
			$data["type"] = $type;

			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["types"][$row["type_id"]] = $row["type"];
			}

			$this->load->view("user/u_my_order_details", $data);
		}
	}

	public function test() {
		$head["title"] = "test - Angeliclay Ordering System";
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
		if (!$this->session->has_userdata("admin_in")) {
			// set log-in error message
			$this->session->set_flashdata("login_alert", array("warning", "Please log-in first."));
			redirect("admin");
		}
	}

	public function view_a_login() {
		// check if user is already logged in, if yes return to dashboard
		if (!$this->session->has_userdata("admin_in")) {
			$head["title"] = "Login - Angeliclay Ordering System";
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
		$head["title"] = "Dashboard - Angeliclay Ordering System";
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

		$head["title"] = "Products - Angeliclay Ordering System";
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
			$head["title"] = "Products/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Products/View", "link" => "products");

			$data["row_info"] = $row_info->row_array();
			
			$type = $this->model_read->get_type_wid($data["row_info"]["type_id"]);
			$data["row_info"]["type_name"] = ($type->num_rows() > 0 ? $type->row_array()["type"] : NULL);

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
			$head["title"] = "Products/Edit - Angeliclay Ordering System";
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

		$head["title"] = "Types - Angeliclay Ordering System";
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
			$head["title"] = "Types/View - Angeliclay Ordering System";
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
			$head["title"] = "Types/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Types/Edit", "link" => "types");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_types_update", $data);
		}
	}
// = = = ORDERS
	public function view_a_orders() {
		$this->admin_login_check();

		$state = $this->input->get("state");

		$head["title"] = "Orders - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array("text" => "Orders", "link" => "orders");

		$data["tbl_orders"] = $this->model_read->get_orders(!is_null($state) ? $state : "ALL");
		$data["tbl_products"] = $this->model_read->get_products_user();
		foreach ($this->model_read->get_types()->result_array() as $row) {
			$data["tbl_types"][$row["type_id"]] = $row["type"];
		}

		$data["states"] = array(
			"PENDING", 
			"ACCEPTED / WAITING FOR PAYMENT", 
			"IN PROGRESS", 
			"SHIPPED", 
			"RECEIVED", 
			"CANCELLED"
		);

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
			$head["title"] = "Orders/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Orders/View", "link" => "orders");

			$data["row_info"] = $row_info->row_array();
			$data["tbl_order_items"] = $this->model_read->get_order_items_worder_id($id);

			$data["states"] = array(
				"PENDING", 
				"ACCEPTED / WAITING FOR PAYMENT", 
				"IN PROGRESS", 
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);

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
			$head["title"] = "Orders/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Orders/Edit", "link" => "orders");

			$data["row_info"] = $row_info->row_array();
			$data["tbl_order_items"] = $this->model_read->get_order_items_worder_id($id);
			$data["tbl_products"] = $this->model_read->get_products_user();
			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["type"];
			}

			$this->load->view("admin/a_orders_update", $data);
		}
	}
// = = = ORDERS CUSTOM
	public function view_a_orders_custom() {
		$this->admin_login_check();

		$state = $this->input->get("state");

		$head["title"] = "Custom Orders - Angeliclay Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array("text" => "Orders", "link" => "orders_custom");

		$data["tbl_orders_custom"] = $this->model_read->get_orders_custom(!is_null($state) ? $state : "ALL");
		foreach ($this->model_read->get_types()->result_array() as $row) {
			$data["tbl_types"][$row["type_id"]] = $row["type"];
		}

		$data["states"] = array(
			"PENDING", 
			"ACCEPTED / WAITING FOR PAYMENT", 
			"IN PROGRESS", 
			"SHIPPED", 
			"RECEIVED", 
			"CANCELLED"
		);

		$this->load->view("admin/a_orders_custom", $data);
	}
	public function view_a_orders_custom_view() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_order_custom_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Order ID does not exist."));
			redirect("admin/orders_custom");
		} else {
			$head["title"] = "Custom Orders/View - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Orders/View", "link" => "orders_custom");

			$data["row_info"] = $row_info->row_array();
			$data["order_item_info"] = $this->model_read->get_order_items_worder_id($data["row_info"]["order_id"])->row_array();
			$data["product_info"] = $this->model_read->get_product_custom_wid($data["order_item_info"]["product_id"])->row_array();

			// $type = $this->model_read->get_type_wid($data["product_info"]["type_id"]);
			// $data["product_info"]["type_name"] = ($type->num_rows() > 0 ? $type->row_array()["type"] : NULL);
			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["type"];
			}

			$data["states"] = array(
				"PENDING", 
				"ACCEPTED / WAITING FOR PAYMENT", 
				"IN PROGRESS", 
				"SHIPPED", 
				"RECEIVED", 
				"CANCELLED"
			);


			$this->load->view("admin/a_orders_custom_view", $data);
		}
	}
	public function view_a_orders_custom_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$row_info = $this->model_read->get_order_custom_wid($id);

		if ($id == NULL || $row_info->num_rows() < 1) {
			$this->session->set_flashdata("alert", array("warning", "Order ID does not exist."));
			redirect("admin/orders_custom");
		} else {
			$head["title"] = "Custom Orders/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Orders/Edit", "link" => "orders_custom");

			$data["row_info"] = $row_info->row_array();
			$data["order_item_info"] = $this->model_read->get_order_items_worder_id($data["row_info"]["order_id"])->row_array();
			$data["product_info"] = $this->model_read->get_product_custom_wid($data["order_item_info"]["product_id"])->row_array();
			foreach ($this->model_read->get_types()->result_array() as $row) {
				$data["tbl_types"][$row["type_id"]] = $row["type"];
			}

			$this->load->view("admin/a_orders_custom_update", $data);
		}
	}
// = = = USERS
	public function view_a_users() {
		$this->admin_login_check();

		$head["title"] = "Users - Angeliclay Ordering System";
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
			$head["title"] = "Users/View - Angeliclay Ordering System";
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
			$head["title"] = "Users/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Users/Edit", "link" => "users");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_users_update", $data);
		}
	}
// = = = ADMINS
	public function view_a_accounts() {
		$this->admin_login_check();

		$head["title"] = "Accounts - Angeliclay Ordering System";
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
			$head["title"] = "Accounts/View - Angeliclay Ordering System";
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
			$head["title"] = "Accounts/Edit - Angeliclay Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Accounts/Edit", "link" => "accounts");

			$data["row_info"] = $row_info->row_array();

			$this->load->view("admin/a_accounts_update", $data);
		}
	}

	// UTILITY
	public function search_emails() {
		$this->admin_login_check();

		$search = $this->input->get("search");

		if (strlen($search) > 0) {
			
			$result = $this->model_read->search_user_emails($search)->result_array();

			foreach ($result as $row) {
				$emails[] = $row["email"];
			}

			echo json_encode($emails);
		}
	}
}