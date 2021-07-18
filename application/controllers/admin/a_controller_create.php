<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class A_controller_create extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("Model_create");
 		$this->load->model("Model_read");
 		$this->load->model("Model_update");

		date_default_timezone_set("Asia/Manila");
 	}

	// = = = PRODUCTS
	public function new_product() {
		$name = $this->input->post("inp_name");
		$type_id = $this->input->post("inp_type_id");
		$description = $this->input->post("inp_description");
		$price = $this->input->post("inp_price");
		$qty = $this->input->post("inp_qty");

		if ($name == NULL || $type_id == NULL || $description == NULL || $price == NULL || $qty == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$img = NULL;

			$product_folder = "product_". (intval($this->db->count_all("products")) + 1);

			$config["upload_path"] = "./uploads/". $product_folder;
			$config["allowed_types"] = "gif|jpg|png";
			$config["max_size"] = 2000;
			$config["encrypt_name"] = TRUE;

			$this->load->library("upload", $config);
			if (!is_dir("uploads/". $product_folder)) {
				mkdir("./uploads/". $product_folder, 0777, TRUE);
			}

			if (isset($_FILES["inp_img"])) {
				if (!$this->upload->do_upload("inp_img")) {
					$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
				} else {
					$img = $this->upload->data("file_name");
				}
			}

			$data = array(
				"name" => $name,
				"img" => $img,
				"type_id" => $type_id,
				"description" => $description,
				"price" => $price,
				"qty" => $qty,
				"type" => "NORMAL",
				"date_added" => date("Y-m-d H:i:s"),
				"visibility" => "0",
				"status" => "1"
			);
			if ($this->Model_create->create_product($data)) {
				$this->session->set_flashdata("alert", array("success", "Product is successfully added."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/products");
	}
	// = = = TYPES
	public function new_type() {
		$name = $this->input->post("inp_name");
		$description = $this->input->post("inp_description");
		$price_range = $this->input->post("inp_price_range");

		if ($name == NULL || $description == NULL || $price_range == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$img = NULL;

			$type_folder = "type_". (intval($this->db->count_all("types")) + 1);

			$config["upload_path"] = "./assets/img/featured/". $type_folder;
			$config["allowed_types"] = "gif|jpg|png";
			$config["max_size"] = 2000;
			$config["encrypt_name"] = TRUE;

			$this->load->library("upload", $config);

			if (!is_dir("assets/img/featured/". $type_folder)) {
				mkdir("./assets/img/featured/". $type_folder, 0777, TRUE);
			}

			if (isset($_FILES["inp_img"])) {
				if (!$this->upload->do_upload("inp_img")) {
					$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
				} else {
					$img = $this->upload->data("file_name");
				}
			}

			$data = array(
				"name" => $name,
				"img" => $img,
				"description" => $description,
				"price_range" => $price_range,
				"featured" => "0",
				"status" => "1"
			);
			if ($this->Model_create->create_type($data)) {
				$this->session->set_flashdata("alert", array("success", "Type is successfully added."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/types");
	}
	// = = = ORDERS
	public function new_order() {
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

		if ($user_email == NULL || $description == NULL || $date == NULL  || $time == NULL || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL || count($items) < 1) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$user_info = $this->Model_read->get_user_acc_wemail($user_email);
			if ($user_info->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "User Email does not exist."));
			} else {
				$user_id = $user_info->row_array()["user_id"];
				$data = array(
					"user_id" => $user_id,
					"description" => $description,
					"date_time" => $date ." ". $time,
					"zip_code" => $zip_code,
					"country" => $country,
					"province" => $province,
					"city" => $city,
					"street" => $street,
					"address" => $address,
					"state" => "0",
					"status" => "1"
				);
				if ($this->Model_create->create_order($data)) {
					$order_id = $this->db->insert_id();

					foreach ($items as $row) {
						$product_info = $this->Model_read->get_product_wid($row["product_id"])->row_array();
						$data_product["qty"] = $product_info["qty"] - $row["qty"];
						$this->Model_update->update_product($row["product_id"], $data_product);

						$row["order_id"] = $order_id;
						$row["type"] = "NORMAL";
						$this->Model_create->create_order_item($row);
					}

					$this->session->set_flashdata("alert", array("success", "Order is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/orders");
	}
	// = = = ORDERS CUSTOM
	public function new_order_custom() {
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

		$custom_description = $this->input->post("inp_custom_description");
		$type_id = $this->input->post("inp_type_id");
		$size = $this->input->post("inp_size");
		$img_count = $this->input->post("inp_img_count");


		if ($user_email == NULL || $description == NULL || $date == NULL  || $time == NULL || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL || $custom_description == NULL || $type_id == NULL || $size == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$user_info = $this->Model_read->get_user_acc_wemail($user_email);
			if ($user_info->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "User Email does not exist."));
			} else {
				$user_id = $user_info->row_array()["user_id"];
				$data = array(
					"user_id" => $user_id,
					"description" => $description,
					"date_time" => $date ." ". $time,
					"zip_code" => $zip_code,
					"country" => $country,
					"province" => $province,
					"city" => $city,
					"street" => $street,
					"address" => $address,
					"state" => "0",
					"status" => "1"
				);
				if ($this->Model_create->create_order($data)) {
					$order_id = $this->db->insert_id();

					$img = NULL;

					$product_folder = "custom_". (intval($this->db->count_all("products_custom")) + 1);

					$config["upload_path"] = "./uploads/". $product_folder;
					$config["allowed_types"] = "gif|jpg|png";
					$config["max_size"] = 2000;
					$config["encrypt_name"] = TRUE;

					$this->load->library("upload", $config);
					if (!is_dir("uploads/". $product_folder)) {
						mkdir("./uploads/". $product_folder, 0777, TRUE);
					}

					for ($i = 1; $i <= $img_count; $i++) {
						if (isset($_FILES["inp_img_". $i])) {
							if (!$this->upload->do_upload("inp_img_". $i)) {
								$this->session->set_flashdata("alert", array("warning", $this->upload->display_errors()));
							} else {
								$img .= $this->upload->data("file_name");
								$img .= ($i < $img_count ? "/" : "");
							}
						}
					}

					$data_product = array(
						"description" => $custom_description,
						"type_id" => $type_id,
						"size" => $size,
						"img" => $img,
						"status" => "1"
					);
					if ($this->Model_create->create_product_custom($data_product)) {
						$product_id = $this->db->insert_id();
						$data_item = array(
							"order_id" => $order_id,
							"product_id" => $product_id,
							"type" => "CUSTOM"
						);
						$this->Model_create->create_order_item($data_item);

						$this->session->set_flashdata("alert", array("success", "Order is successfully added."));
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
	// = = = ORDERS BOTH
	public function new_order_payment() {
		$order_id = $this->input->post("inp_id");
		$description = $this->input->post("inp_description");
		$date = $this->input->post("inp_date");
		$time = $this->input->post("inp_time");
		$amount = $this->input->post("inp_amount");

		if ($order_id == NULL || $description == NULL || $date == NULL  || $time == NULL || $amount == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$order = $this->Model_read->get_order_general_wid($order_id);

			if ($order->num_rows() > 0) {
				$order_info = $order->row_array();
				$img = NULL;

				$user_folder = "user_". $order_info["user_id"];
				$payment_folder = "order_". $order_id;

				$config["upload_path"] = "./uploads/users/". $user_folder ."/payments/". $payment_folder;
				$config["allowed_types"] = "gif|jpg|png";
				$config["max_size"] = 2000;
				$config["encrypt_name"] = TRUE;

				$this->load->library("upload", $config);
				if (!is_dir("uploads/users/". $user_folder)) {
					mkdir("./uploads/users/". $user_folder, 0777, TRUE);
				}
				if (!is_dir("uploads/users/". $user_folder ."/payments")) {
					mkdir("./uploads/users/". $user_folder ."/payments", 0777, TRUE);
				}
				if (!is_dir("uploads/users/". $user_folder ."/payments/". $payment_folder)) {
					mkdir("./uploads/users/". $user_folder ."/payments/". $payment_folder, 0777, TRUE);
				}

				if (isset($_FILES["inp_img_proof"])) {
					if (!$this->upload->do_upload("inp_img_proof")) {
						$this->session->set_flashdata("notice", array("warning", $this->upload->display_errors()));
					} else {
						$img = $this->upload->data("file_name");
					}
				}

				$data = array(
					"order_id" => $order_id,
					"description" => $description,
					"img" => $img,
					"date_time" => $date ." ". $time,
					"amount" => $amount,
					"status" => "1"
				);

				if ($this->Model_create->create_order_payment($data)) {
					$this->session->set_flashdata("alert", array("success", "Order Payment is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again." ));
			}
		}
		if ($this->input->post("payment_submit") == "Submit Payment for Order") {
			redirect("admin/orders");
		} else {
			redirect("admin/orders_custom");
		}
	}
	// = = = USERS
	public function new_user_account() {
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

		if ($name_last == NULL || $name_first == NULL || $gender == NULL || $email == NULL || $contact_num == NULL || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			if ($this->Model_read->get_user_acc_wemail($email)->num_rows() > 0) {
				$this->session->set_flashdata("alert", array("warning", "Email is aready registered."));
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
					"address" => $address,

					"password" => password_hash($password, PASSWORD_BCRYPT),
					"status" => "1"
				);
				if ($this->Model_create->create_user_account($data)) {
					$this->session->set_flashdata("alert", array("success", "User is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/users");
	}
	// = = = ADMINS
	public function new_admin_account() {
		$name = $this->input->post("inp_name");
		$email = $this->input->post("inp_email");
		$password = $this->input->post("inp_password");

		if ($name == NULL || $email == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			if ($this->Model_read->get_adm_acc_wemail($email)->num_rows() > 0) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been registered."));
			} else {
				$data = array(
					"name" => $name,
					"email" => $email,
					"password" => password_hash($password, PASSWORD_BCRYPT),
					"status" => "1"
				);
				if ($this->Model_create->create_adm_account($data)) {
					$this->session->set_flashdata("alert", array("success", "Account is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/accounts");
	}

}