<?php 
 defined("BASEPATH") OR exit("No direct script access allowed");

 class u_controller_login extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 	}
	// public function user_login_verification() {
	// 	$email = $this->input->post("inp_email", TRUE);
	// 	$password = $this->input->post("inp_password", TRUE);
	// 	if ($email == NULL || $password == NULL) {
	// 		$this->session->set_flashdata("login_alert", array("warning", "One or more inputs are empty."));
	// 	} else {
	// 		$account = $this->model_read->get_adm_acc_w_email($email);
	// 		if ($account->num_rows() < 1) {
	// 			$this->session->set_flashdata("login_alert", array("warning", "Account does not exist."));
	// 		} else {
	// 			$account_info = $account->row_array();
	// 			if (password_verify($password, $account_info["password"])) {
	// 				$data = array(
	// 					"admin_id" => $account_info["id"],
	// 					"admin_name" => $account_info["name"],
	// 					"admin_email" => $account_info["email"],
	// 					"admin_in" => TRUE
	// 				);
	// 				$this->session->set_userdata($data);
	// 				redirect("admin/dashboard");
	// 			} else {
	// 				$this->session->set_flashdata("login_alert", array("warning", "Password is incorrect."));
	// 			}
	// 		}
	// 	}
	// 	redirect("admin");
	// }
}