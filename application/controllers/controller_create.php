<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class controller_create extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 		$this->load->model("model_create");
 	}

	public function new_admin_account() {
		$name = $this->input->post("inp_name");
		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		if ($name == NULL || $email == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} elseif (strlen($name) > 60 || strlen($email) > 60 || strlen($password) > 60) {
			$this->session->set_flashdata("alert", array("warning", "Input cannot be longer than 60."));
		} else {
			if ($this->model_read->get_adm_acc_w_email($email)->num_rows() > 0) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been used."));
			} else {
				$data = array(
					"name" => $name,
					"email" => $email,
					"password" => password_hash($password, PASSWORD_BCRYPT)
				);
				if ($this->model_create->create_adm_account($data)) {
					$this->session->set_flashdata("alert", array("success", "Account is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/accounts");
	}

}