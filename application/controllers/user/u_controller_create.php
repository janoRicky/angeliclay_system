<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class u_controller_create extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 		$this->load->model("model_create");

 		date_default_timezone_set('Asia/Manila');
 	}

	public function new_order_custom() {
		$user_id = ($this->session->has_userdata("user_id") ? $this->session->userdata("user_id") : NULL);
		$date = date('Y-m-d');
		$time = date('H:i');

		$description = $this->input->post("inp_description");
		$type_id = $this->input->post("inp_type_id");
		$size = $this->input->post("inp_size");
		$img_count = $this->input->post("inp_img_count");


		if ($user_id == NULL || $description == NULL || $type_id == NULL || $size == NULL) {
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
}