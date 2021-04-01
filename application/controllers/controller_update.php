<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class controller_update extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 		$this->load->model("model_update");
 	}

	public function edit_admin_account() {
		$id = $this->input->post("inp_id");
		$name = $this->input->post("inp_name");
		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		if ($name == NULL || $email == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} elseif (strlen($name) > 60 || strlen($email) > 60 || strlen($password) > 60) {
			$this->session->set_flashdata("alert", array("warning", "Input cannot be longer than 60."));
		} else {
			// if email is already used and if the previous email is not the same with new email, show error
			$acc_info = $this->model_read->get_adm_acc_w_id($id)->row_array();
			if ($this->model_read->get_adm_acc_w_email($email)->num_rows() > 0 && $acc_info["email"] != $email) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been used."));
			} else {
				// set values to be updated on the database table
				$data = array(
					"name" => $name,
					"email" => $email,
					"password" => password_hash($password, PASSWORD_BCRYPT)
				);
				if ($this->model_update->update_adm_account($id, $data)) {
					// update admin info
					if (isset($_SESSION["admin_email"]) && $_SESSION["admin_id"] == $id) {
						$data = array(
							"admin_name" => $name,
							"admin_email" => $email
						);
						$this->session->set_userdata($data);
					}
					$this->session->set_flashdata("alert", array("success", "Account info is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/accounts");
	}

}