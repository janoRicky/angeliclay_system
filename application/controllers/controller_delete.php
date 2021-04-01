<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class controller_delete extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 		$this->load->model("model_delete");
 	}

	public function delete_admin_account() {
		$id = $this->input->post("inp_id");

		if ($id == NULL) {
			$this->session->set_flashdata("alert", array("warning", "Something went wrong, please try again."));
			redirect("admin/accounts");
		} else {
			if ($this->model_read->get_adm_acc_w_id($id)->num_rows() < 1) {
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