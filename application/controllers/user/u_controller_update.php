<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class U_controller_update extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_read");
 		$this->load->model("Model_update");
 	}

	public function user_details_update() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$name_last = $this->input->post("inp_name_last");
		$name_first = $this->input->post("inp_name_first");
		$name_middle = $this->input->post("inp_name_middle");
		$name_extension = $this->input->post("inp_name_extension");

		$gender = $this->input->post("inp_gender");

		if ($user_id == NULL || $name_last == NULL || $name_first == NULL || $gender == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"name_last" => $name_last,
				"name_first" => $name_first,
				"name_middle" => $name_middle,
				"name_extension" => $name_extension,
				
				"gender" => $gender
			);

			if ($this->Model_update->update_user_account($user_id, $data)) {
				$this->session->set_flashdata("notice", array("success", "Personal info is successfully updated."));
			} else {
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("account");
	}
	public function user_account_update() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		if ($user_id == NULL || $email == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$acc_info = $this->Model_read->get_user_acc_wid($user_id)->row_array();
			if ($this->Model_read->get_user_acc_wemail($email)->num_rows() > 0 && $acc_info["email"] != $email) {
				$this->session->set_flashdata("notice", array("warning", "Email has already been used."));
			} else {
				$data = array(
					"email" => $email
				);
				if ($password != NULL) {
					$data["password"] = password_hash($password, PASSWORD_BCRYPT);
				}

				if ($this->Model_update->update_user_account($user_id, $data)) {
					$this->session->set_flashdata("notice", array("success", "Account info is successfully updated."));
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("account");
	}
	public function user_address_update() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$zip_code = $this->input->post("inp_zip_code");
		$country = $this->input->post("inp_country");
		$province = $this->input->post("inp_province");
		$city = $this->input->post("inp_city");
		$street = $this->input->post("inp_street");
		$address = $this->input->post("inp_address");

		if ($user_id == NULL || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"zip_code" => $zip_code,
				"country" => $country,
				"province" => $province,
				"city" => $city,
				"street" => $street,
				"address" => $address
			);

			if ($this->Model_update->update_user_account($user_id, $data)) {
				$this->session->set_flashdata("notice", array("success", "Address info is successfully updated."));
			} else {
				$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("account");
	}
	public function user_contact_update() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);

		$contact_num = $this->input->post("inp_contact_num");

		if ($user_id == NULL || $contact_num == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$acc_info = $this->Model_read->get_user_acc_wid($user_id)->row_array();
			if ($this->Model_read->get_user_acc_wemail($email)->num_rows() > 0 && $acc_info["email"] != $email) {
				$this->session->set_flashdata("notice", array("warning", "Email has already been used."));
			} else {
				$data = array(
					"contact_num" => $contact_num
				);

				if ($this->Model_update->update_user_account($user_id, $data)) {
					$this->session->set_flashdata("notice", array("success", "Contact info is successfully updated."));
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("account");
	}
}