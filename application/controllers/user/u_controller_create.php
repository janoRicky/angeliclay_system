<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class u_controller_create extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_create");
 		$this->load->model("model_read");
 		$this->load->model("model_update");

 		date_default_timezone_set('Asia/Manila');
 	}

	public function user_account_register() {
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
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			if ($this->model_read->get_user_acc_wemail($email)->num_rows() > 0) {
				$this->session->set_flashdata("notice", array("warning", "Email is aready registered."));
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
				if ($this->model_create->create_user_account($data)) {
					$this->session->set_flashdata("notice", array("success", "User is successfully added."));
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("login");
	}

	public function new_order_custom() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);
		$date = date('Y-m-d');
		$time = date('H:i');

		$description = $this->input->post("inp_description");
		$type_id = $this->input->post("inp_type_id");
		$size = $this->input->post("inp_size");
		$img_count = $this->input->post("inp_img_count");

		$zip_code = $this->input->post("inp_zip_code");
		$country = $this->input->post("inp_country");
		$province = $this->input->post("inp_province");
		$city = $this->input->post("inp_city");
		$street = $this->input->post("inp_street");
		$address = $this->input->post("inp_address");


		if ($user_id == NULL || $description == NULL || $type_id == NULL || $size == NULL || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$user_info = $this->model_read->get_user_acc_wid($user_id);
			if ($user_info->num_rows() < 1) {
				$this->session->set_flashdata("notice", array("warning", "User does not exist."));
			} else {
				$data = array(
					"user_id" => $user_id,
					"date" => $date,
					"time" => $time,
					"zip_code" => $zip_code,
					"country" => $country,
					"province" => $province,
					"city" => $city,
					"street" => $street,
					"address" => $address,
					"state" => "0",
					"status" => "1"
				);
				if ($this->model_create->create_order($data)) {
					$order_id = $this->db->insert_id();

					$img = NULL;

					$product_folder = "custom_". $this->db->count_all("products_custom") + 1;

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
						if (isset($_FILES["inp_img_". $i])) {
							if (!$this->upload->do_upload("inp_img_". $i)) {
								$this->session->set_flashdata("notice", array("warning", $this->upload->display_errors()));
							} else {
								$img .= $this->upload->data("file_name");
								$img .= ($i < $img_count ? "/" : "");
							}
						}
					}

					$data_product = array(
						"description" => $description,
						"type_id" => $type_id,
						"size" => $size,
						"img" => $img,
						"status" => "1"
					);
					if ($this->model_create->create_product_custom($data_product)) {
						$product_id = $this->db->insert_id();
						$data_item = array(
							"order_id" => $order_id,
							"product_id" => $product_id,
							"type" => "CUSTOM"
						);
						$this->model_create->create_order_item($data_item);

						$this->session->set_flashdata("notice", array("success", "Order is successfully added."));
					} else {
						$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
					}
				} else {
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("home");
	}
	public function new_order() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);
		$date = date('Y-m-d');
		$time = date('H:i');

		$zip_code = $this->input->post("inp_zip_code");
		$country = $this->input->post("inp_country");
		$province = $this->input->post("inp_province");
		$city = $this->input->post("inp_city");
		$street = $this->input->post("inp_street");
		$address = $this->input->post("inp_address");

		$items_no = $this->input->post("items_no");
		$items = ($this->session->has_userdata("cart") ? $this->session->userdata("cart") : array());


		if ($user_id == NULL || $date == NULL || $time == NULL || count($items) < 1 || $zip_code == NULL || $country == NULL || $province == NULL || $city == NULL || $street == NULL) {
			$this->session->set_flashdata("notice", array("warning", "One or more inputs are empty."));
		} else {
			$user_info = $this->model_read->get_user_acc_wid($user_id);
			if ($user_info->num_rows() < 1) {
				$this->session->set_flashdata("notice", array("warning", "User does not exist."));
			} else {
				$data_products = array();
				$data_items = array();
				foreach ($items as $id => $qty) {
					if ($id != NULL && $qty != NULL) {
						$p_details = $this->model_read->get_product_wid_user($id)->row_array();
						$total_qty = $p_details["qty"] - $qty;
						if ($total_qty < 0) {
							break;
						} else {
							$data_products[$id] = $total_qty;

							$data_items[] = array(
								"product_id" => $id,
								"qty" => $qty,
								"price" => $p_details["price"],
								"type" => "NORMAL"
							);
						}
					}
				}

				if ($total_qty >= 0) {
					$data = array(
						"user_id" => $user_id,
						"date" => $date,
						"time" => $time,
						"zip_code" => $zip_code,
						"country" => $country,
						"province" => $province,
						"city" => $city,
						"street" => $street,
						"address" => $address,
						"state" => "0",
						"status" => "1"
					);
					if ($this->model_create->create_order($data)) {
						$order_id = $this->db->insert_id();

						foreach ($data_products as $id => $qty) {
							$data_product["qty"] = $qty;
							$this->model_update->update_product($id, $data_product);
						}

						foreach ($data_items as $row) {
							$row["order_id"] = $order_id;
							$this->model_create->create_order_item($row);
						}

						$this->session->unset_userdata("cart");

						$this->session->set_flashdata("notice", array("success", "Order is successfully added."));
					} else {
						$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
					}
				} else {
					$this->session->unset_userdata("cart");
					$this->session->set_flashdata("notice", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("home");
	}
}