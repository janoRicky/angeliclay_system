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
		$name = $this->input->post("inp_name");
		$type_id = $this->input->post("inp_type_id");
		$description = $this->input->post("inp_description");
		$price = $this->input->post("inp_price");
		$qty = $this->input->post("inp_qty");

		if ($product_id == NULL || $name == NULL || $type_id == NULL || $description == NULL || $price == NULL || $qty == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {

			$row_info = $this->model_read->get_product_wid($product_id)->row_array();

			$img = $row_info["img"];

			$product_folder = "product_". $product_id;

			$config["upload_path"] = "./uploads/". $product_folder;
			$config["allowed_types"] = "gif|jpg|png";
			$config["max_size"] = 2000;
			$config["encrypt_name"] = TRUE;

			$this->load->library("upload", $config);

			if (!is_dir("uploads")) {
				mkdir("./uploads", 0777, TRUE);
			}
			if (!is_dir("uploads/". $product_folder)) {
				mkdir("./uploads/". $product_folder, 0777, TRUE);
			}

			if (!empty($_FILES["inp_img"]["name"])) {
				if (!$this->upload->do_upload("inp_img")) {
					$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
					redirect("admin/products");
				} else {
					unlink("./uploads/". $product_folder ."/". $row_info["img"]);
					$img = $this->upload->data("file_name");
				}
			}

			$data = array(
				"name" => $name,
				"img" => $img,
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
	public function edit_product_visibility() {
		$product_id = $this->input->post("inp_id");
		$submit = $this->input->post("inp_submit");

		if ($product_id == NULL || $submit == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			if ($submit == "Set to Invisible") {
				$visibility = 0;
			} else {
				$visibility = 1;
			}
			$data = array(
				"visibility" => $visibility
			);

			if ($this->model_update->update_product($product_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "Product visibility is successfully updated."));
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

		$zip_code = $this->input->post("inp_zip_code");
		$country = $this->input->post("inp_country");
		$province = $this->input->post("inp_province");
		$city = $this->input->post("inp_city");
		$street = $this->input->post("inp_street");
		$address = $this->input->post("inp_address");

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

		if ($user_email == NULL || $description == NULL || $date == NULL || $time == NULL || count($items) < 1 || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL) {
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
					"time" => $time,
					"zip_code" => $zip_code,
					"country" => $country,
					"province" => $province,
					"city" => $city,
					"street" => $street,
					"address" => $address
				);
				if ($this->model_update->update_order($order_id, $data)) {

					$order_items = $this->model_read->get_order_items_worder_id($order_id);
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
						$row["type"] = "NORMAL";
						$this->model_create->create_order_item($row);
					}

					$this->session->set_flashdata("alert", array("success", "Order is successfully updated."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/orders");
	}
	public function edit_order_state() {
		$order_id = $this->input->post("inp_id");
		$state = $this->input->post("inp_state");

		if ($state == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"state" => $state
			);
			if ($this->model_update->update_order($order_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "State is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/orders");
	}
	// = = = ORDERS CUSTOM
	public function edit_order_custom() {
		$order_id = $this->input->post("inp_id");
		$user_email = $this->input->post("inp_user_email");
		$description = $this->input->post("inp_description");
		$date = $this->input->post("inp_date");
		$time = $this->input->post("inp_time");

		$zip_code = $this->input->post("inp_zip_code");
		$country = $this->input->post("inp_country");
		$province = $this->input->post("inp_province");
		$city = $this->input->post("inp_city");
		$street = $this->input->post("inp_street");
		$address = $this->input->post("inp_address");

		$product_id = $this->input->post("inp_product_id");
		$custom_description = $this->input->post("inp_custom_description");
		$type_id = $this->input->post("inp_type_id");
		$size = $this->input->post("inp_size");
		$img_count = $this->input->post("inp_img_count");

		$order_item_id = $this->input->post("inp_order_item_id");
		$qty = $this->input->post("inp_qty");
		$price = $this->input->post("inp_price");


		if ($user_email == NULL || $description == NULL || $date == NULL || $time == NULL || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL) {
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
					"time" => $time,
					"zip_code" => $zip_code,
					"country" => $country,
					"province" => $province,
					"city" => $city,
					"street" => $street,
					"address" => $address
				);
				if ($this->model_update->update_order($order_id, $data)) {

					$row_info = $this->model_read->get_product_custom_wid($product_id)->row_array();

					$imgs = explode("/", $row_info["img"]);
					$img = NULL;

					$product_folder = "custom_". $product_id;

					$config["upload_path"] = "./uploads/". $product_folder;
					$config["allowed_types"] = "gif|jpg|png";
					$config["max_size"] = 2000;
					$config["encrypt_name"] = TRUE;

					$this->load->library("upload", $config);

					if (!is_dir("uploads")) {
						mkdir("./uploads", 0777, TRUE);
					}
					if (!is_dir("uploads/". $product_folder)) {
						mkdir("./uploads/". $product_folder, 0777, TRUE);
					}

					for ($i = 1; $i <= $img_count; $i++) {
						if (!empty($_FILES["inp_img_". $i]["name"])) {
							if (!$this->upload->do_upload("inp_img_". $i)) {
								$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
								redirect("admin/orders_custom");
							} else {
								if (isset($imgs[$i - 1])) {
									unlink("./uploads/". $product_folder ."/". $imgs[$i - 1]);
								}
								$imgs[$i - 1] = $this->upload->data("file_name");
							}
						} elseif ($this->input->post("inp_img_". $i ."_check") == 0) {
							$imgs[$i - 1] = "";
						}
						// elseif the checker is 0, then remove the image from the list
						// else there is no new changes don't change anything
						$img .= ($imgs[$i - 1] != "" ? $imgs[$i - 1] : "") . (($i < $img_count && $imgs[$i - 1] != "") ? "/" : "");
					}

					$data_product = array(
						"description" => $custom_description,
						"type_id" => $type_id,
						"size" => $size,
						"img" => $img
					);
					if ($this->model_update->update_product_custom($product_id, $data_product)) {
						$data_item = array(
							"qty" => $qty,
							"price" => $price
						);
						$this->model_update->update_order_item($order_id, $data_item);

						$this->session->set_flashdata("alert", array("success", "Order is successfully updated."));
					} else {
						$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
					}
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/orders_custom");
	}
	public function edit_order_state_custom() {
		$order_id = $this->input->post("inp_id");
		$state = $this->input->post("inp_state");

		if ($state == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"state" => $state
			);
			if ($this->model_update->update_order($order_id, $data)) {
				$this->session->set_flashdata("alert", array("success", "State is successfully updated."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/orders_custom");
	}
	// = = = USERS
	public function edit_user_account() {
		$user_id = $this->input->post("inp_id");

		$name_last = $this->input->post("inp_name_last");
		$name_first = $this->input->post("inp_name_first");
		$name_middle = $this->input->post("inp_name_middle");
		$name_extension = $this->input->post("inp_name_extension");

		$gender = $this->input->post("inp_gender");
		$email = $this->input->post("inp_email");
		$contact_num = $this->input->post("inp_contact_num");

		$zip_code = $this->input->post("inp_zip_code");
		$country = $this->input->post("inp_country");
		$province = $this->input->post("inp_province");
		$city = $this->input->post("inp_city");
		$street = $this->input->post("inp_street");
		$address = $this->input->post("inp_address");

		$password = $this->input->post("inp_password");


		if ($user_id == NULL || $name_last == NULL || $name_first == NULL || $gender == NULL || $email == NULL || $contact_num == NULL || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$acc_info = $this->model_read->get_user_acc_wid($user_id)->row_array();
			if ($this->model_read->get_user_acc_wemail($email)->num_rows() > 0 && $acc_info["email"] != $email) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been used."));
			} else {
				$data = array(
					"name_last" => $name_last,
					"name_first" => $name_first,
					"name_middle" => $name_middle,
					"name_extension" => $name_extension,
					
					"gender" => $gender,
					"email" => $email,
					"contact_num" => $contact_num,

					"zip_code" => $zip_code,
					"country" => $country,
					"province" => $province,
					"city" => $city,
					"street" => $street,
					"address" => $address
				);
				if ($password != NULL) {
					$data["password"] = password_hash($password, PASSWORD_BCRYPT);
				}

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
			$acc_info = $this->model_read->get_adm_acc_wid($admin_id)->row_array();
			if ($this->model_read->get_adm_acc_wemail($email)->num_rows() > 0 && $acc_info["email"] != $email) {
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
					if ($this->session->has_userdata("admin_email") && $this->session->userdata("admin_id") == $admin_id) {
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