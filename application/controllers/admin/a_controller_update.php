<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class a_controller_update extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_create");
 		$this->load->model("model_read");
 		$this->load->model("model_update");
 		$this->load->model("model_delete");
 	}

	// = = = PRODUCTS
	public function edit_product() {
		$product_id = $this->input->post("inp_id");
		$type_id = $this->input->post("inp_type_id");
		$description = $this->input->post("inp_description");
		$price = $this->input->post("inp_price");
		$qty = $this->input->post("inp_qty");

		if ($product_id == NULL || $type_id == NULL || $description == NULL || $price == NULL || $qty == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"type_id" => $type_id,
				"description" => $description,
				"price" => $price,
				"qty" => $qty
			);
			if ($this->model_update->update_product($product_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Product info is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/products");
	}
	// = = = TYPES
	public function edit_type() {
		$type_id = $this->input->post("inp_id");
		$type = $this->input->post("inp_type");

		if ($type_id == NULL || $type == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"type" => $type
			);
			if ($this->model_update->update_type($type_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Type info is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/types");
	}
	// = = = ORDERS
	public function edit_order() {
		$order_id = $this->input->post("inp_id");
		$user_email = $this->input->post("inp_user_email");
		$description = $this->input->post("inp_description");
		$date = $this->input->post("inp_date");
		$time = $this->input->post("inp_time");

		$items_no = $this->input->post("items_no");
		$items = array();

		for ($i = 1; $i < $items_no + 1; $i++) {
			$prd_id = $this->input->post("item_". $i ."_id");
			$prd_qty = $this->input->post("item_". $i ."_qty");
			$prd_price = $this->input->post("item_". $i ."_price");

			if ($prd_id != NULL && $prd_qty != NULL && $prd_price != NULL) {
				$items[] = array(
					"product_id" => $prd_id,
					"qty" => $prd_qty,
					"price" => $prd_price
				);
			}
		}

		if ($user_email == NULL || $description == NULL || $date == NULL || $time == NULL || count($items) < 1) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$user_info = $this->model_read->get_user_acc_wemail($user_email);
			if ($user_info->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "User Email does not exist."));
			} else {
				$user_id = $user_info->row_array()["user_id"];
				$data = array(
					"user_id" => $user_id,
					"description" => $description,
					"date" => $date,
					"time" => $time
				);
				if ($this->model_update->update_order($order_id, $data)) {

					$order_items = $this->model_read->get_order_items_wid($order_id);
					foreach ($order_items->result_array() as $row) { // restore stock before deleting order
						$product_info = $this->model_read->get_product_wid($row["product_id"])->row_array();
						$data_product["qty"] = $product_info["qty"] + $row["qty"];
						$this->model_update->update_product($row["product_id"], $data_product);
					}
					$this->model_delete->delete_order_item_worder_id($order_id);

					foreach ($items as $row) {
						$product_info = $this->model_read->get_product_wid($row["product_id"])->row_array();
						$data_product["qty"] = $product_info["qty"] - $row["qty"];
						$this->model_update->update_product($row["product_id"], $data_product);

						$row["order_id"] = $order_id;
						$this->model_create->create_order_item($row);
						$test[] = $row;
					}

					$this->session->set_flashdata("alert", array("success", "Order is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/orders");
	}
	// = = = USERS
	public function edit_user_account() {
		$user_id = $this->input->post("inp_id");
		$name = $this->input->post("inp_name");
		$gender = $this->input->post("inp_gender");
		$email = $this->input->post("inp_email");
		$contact_num = $this->input->post("inp_contact_num");
		$address = $this->input->post("inp_address");
		$password = $this->input->post("inp_password");

		if ($user_id == NULL || $name == NULL || $gender == NULL || $email == NULL || $contact_num == NULL || $address == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$acc_info = $this->model_read->get_user_acc_w_id($user_id)->row_array();
			if ($this->model_read->get_user_acc_w_email($email)->num_rows() > 0 && $acc_info["email"] != $email) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been used."));
			} else {
				$data = array(
					"name" => $name,
					"gender" => $gender,
					"email" => $email,
					"contact_num" => $contact_num,
					"address" => $address,
					"password" => password_hash($password, PASSWORD_BCRYPT)
				);
				if ($this->model_update->update_user_account($user_id, $data)) {
					$this->session->set_flashdata("alert", array("success", "Account info is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/users");
	}
	// = = = ADMINS
	public function edit_admin_account() {
		$admin_id = $this->input->post("inp_id");
		$name = $this->input->post("inp_name");
		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		if ($admin_id == NULL || $name == NULL || $email == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			// if email is already used and if the previous email is not the same with new email, show error
			$acc_info = $this->model_read->get_adm_acc_w_id($admin_id)->row_array();
			if ($this->model_read->get_adm_acc_w_email($email)->num_rows() > 0 && $acc_info["email"] != $email) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been used."));
			} else {
				// set values to be updated on the database table
				$data = array(
					"name" => $name,
					"email" => $email,
					"password" => password_hash($password, PASSWORD_BCRYPT)
				);
				if ($this->model_update->update_adm_account($admin_id, $data)) {
					// update admin info
					if (isset($_SESSION["admin_email"]) && $_SESSION["admin_id"] == $admin_id) {
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