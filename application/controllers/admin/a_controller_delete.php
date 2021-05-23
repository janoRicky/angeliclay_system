<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class a_controller_delete extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 		$this->load->model("model_delete");
 		$this->load->model("model_update");
 	}

	// = = = PRODUCTS
	public function delete_product() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
			redirect("admin/products");
		} else {
			if ($this->model_read->get_product_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Product does not exist."));
				redirect("admin/products");
			} else {
				if ($this->model_delete->delete_product($id)) {
					$this->session->set_flashdata("alert", array("success", "Product is successfully deleted."));
					redirect("admin/products");
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
					redirect("admin/products");
				}
			}
		}
	}
	// = = = TYPES
	public function delete_type() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
			redirect("admin/types");
		} else {
			if ($this->model_read->get_type_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Type does not exist."));
				redirect("admin/types");
			} else {
				
				$products = $this->model_read->get_product_wtype($id);
				foreach ($products->result_array() as $row) {
					$data = array(
						"type_id" => NULL,
					);
					$this->model_update->update_product($row["product_id"], $data);
				}

				if ($this->model_delete->delete_type($id)) {
					$this->session->set_flashdata("alert", array("success", "Type is successfully deleted."));
					redirect("admin/types");
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
					redirect("admin/types");
				}
			}
		}
	}
	// = = = ORDERS
	public function delete_order() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
			redirect("admin/orders");
		} else {
			if ($this->model_read->get_order_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Order does not exist."));
				redirect("admin/orders");
			} else {
				$order_items = $this->model_read->get_order_items_wid($id);
				foreach ($order_items->result_array() as $row) { // restore stock before deleting order
					$product_info = $this->model_read->get_product_wid($row["product_id"])->row_array();
					$data_product["qty"] = $product_info["qty"] + $row["qty"];
					$this->model_update->update_product($row["product_id"], $data_product);
				}
				
				if ($this->model_delete->delete_order($id)) {
					$this->session->set_flashdata("alert", array("success", "Order is successfully deleted."));
					redirect("admin/orders");
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
					redirect("admin/orders");
				}
			}
		}
	}
	// = = = USERS
	public function delete_user_account() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
			redirect("admin/users");
		} else {
			if ($this->model_read->get_user_acc_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Account does not exist."));
				redirect("admin/users");
			} else {
				if ($this->model_delete->delete_user_account($id)) {
					$this->session->set_flashdata("alert", array("success", "Account is successfully deleted."));
					redirect("admin/users");
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
					redirect("admin/users");
				}
			}
		}
	}
	// = = = ADMINS
	public function delete_admin_account() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
			redirect("admin/accounts");
		} else {
			if ($this->model_read->get_adm_acc_wid($id)->num_rows() < 1) {
				$this->session->set_flashdata("alert", array("warning", "Account does not exist."));
				redirect("admin/accounts");
			} else {
				if ($this->model_delete->delete_adm_account($id)) {
					$this->session->set_flashdata("alert", array("success", "Account is successfully deleted."));
					redirect("admin/accounts");
				} else {
					$this->session->set_flashdata("alert", array("danger", "Something went wrong, please try again."));
					redirect("admin/accounts");
				}
			}
		}
	}
}