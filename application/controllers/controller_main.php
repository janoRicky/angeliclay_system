<?php 
 defined("BASEPATH") OR exit("No direct script access allowed");

 class controller_main extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 	}
	public function index() {
		redirect("admin");
	}
	public function admin_logout() {
		// destroy session values
		session_destroy();
		redirect("admin");
	}
	public function admin_login_check() {
		// check if admin is logged in, sessions are set on controller_login
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
	public function view_a_accounts() {
		$this->admin_login_check();

		$head["title"] = "Accounts - Luna Likha Ordering System";
		$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
		$data["nav"] = array("text" => "Accounts", "link" => "accounts");

		// information gathered from the database can be converted to arrays
		// the data on tbl_accounts can be used ON THE PAGE it is sent by
		// $tbl_accounts->result_array() to obtain all the data on the table into array form
		$data["tbl_accounts"] = $this->model_read->get_adm_accounts();

		$this->load->view("admin/a_accounts", $data);
	}
	public function view_a_accounts_edit() {
		$this->admin_login_check();

		$id = $this->input->get("id");

		$acc_info = $this->model_read->get_adm_acc_w_id($id);

		// if id of the account is non-existent, redirect to accounts page
		if ($id == NULL || $acc_info->num_rows() < 1) {
			redirect("admin/accounts");
		} else {
			$head["title"] = "Accounts/Edit - Luna Likha Ordering System";
			$data["template_head"] = $this->load->view("admin/template/a_t_head", $head);
			$data["nav"] = array("text" => "Accounts/Edit", "link" => "accounts_edit");

			$data["id"] = $id;

			$data["account_info"] = $acc_info->row_array();

			$this->load->view("admin/a_accounts_update", $data);
		}
	}

}