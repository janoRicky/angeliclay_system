<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class a_controller_create extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_create");
 		$this->load->model("model_read");
 		$this->load->model("model_update");
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

			$product_folder = "product_". $this->db->count_all("products") + 1;

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
				"status" => "ACTIVE"
			);
			if ($this->model_create->create_product($data)) {
				$this->session->set_flashdata("alert", array("success", "Product is successfully added."));
			} else {
				$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
			}
		}
		redirect("admin/products");
	}
	// = = = TYPES
	public function new_type() {
		$type = $this->input->post("inp_type");

		if ($type == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			$data = array(
				"type" => $type,
				"status" => "ACTIVE"
			);
			if ($this->model_create->create_type($data)) {
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
					"time" => $time,
					"state" => "PENDING",
					"status" => "ACTIVE"
				);
				if ($this->model_create->create_order($data)) {
					$order_id = $this->db->insert_id();

					foreach ($items as $row) {
						$product_info = $this->model_read->get_product_wid($row["product_id"])->row_array();
						$data_product["qty"] = $product_info["qty"] - $row["qty"];
						$this->model_update->update_product($row["product_id"], $data_product);

						$row["order_id"] = $order_id;
						$this->model_create->create_order_item($row);
					}

					$this->session->set_flashdata("alert", array("success", "Order is successfully added."));
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
				}
			}
		}
		redirect("admin/orders");
	}
	// = = = USERS
	public function new_user_account() {
		$name = $this->input->post("inp_name");
		$gender = $this->input->post("inp_gender");
		$email = $this->input->post("inp_email");
		$contact_num = $this->input->post("inp_contact_num");
		$address = $this->input->post("inp_address");
		$password = $this->input->post("inp_password");

		if ($name == NULL || $gender == NULL || $email == NULL || $contact_num == NULL || $address == NULL || $password == NULL) {
			$this->session->set_flashdata("alert", array("warning", "One or more inputs are empty."));
		} else {
			if ($this->model_read->get_user_acc_wemail($email)->num_rows() > 0) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been used."));
			} else {
				$data = array(
					"name" => $name,
					"gender" => $gender,
					"email" => $email,
					"contact_num" => $contact_num,
					"address" => $address,
					"password" => password_hash($password, PASSWORD_BCRYPT),
					"status" => "ACTIVE"
				);
				if ($this->model_create->create_user_account($data)) {
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
			if ($this->model_read->get_adm_acc_wemail($email)->num_rows() > 0) {
				$this->session->set_flashdata("alert", array("warning", "Email has already been registered."));
			} else {
				$data = array(
					"name" => $name,
					"email" => $email,
					"password" => password_hash($password, PASSWORD_BCRYPT),
					"status" => "ACTIVE"
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