<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class u_controller_session extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 		$this->load->model("model_create");
 	}

	public function to_cart() {
		$id = $this->input->get("id");
		$amount = $this->input->get("amount");
		$submit = $this->input->get("submit");

		if (!$this->session->has_userdata("cart")) {
			$data["cart"] = array(array($id, $amount));
		} else {
			$cart = $this->session->userdata("cart");

			$item_key = array_search($id, array_column($cart, 0));
			if ($item_key !== FALSE) {
				$cart[$item_key][1] += $amount;

				$data["cart"] = $cart;
			} else {
				$data["cart"] = array_merge($cart, array(array($id, $amount)));
			}
		}
		
		$this->session->set_userdata($data);

		if ($submit == "Buy Now") {
			redirect("cart");
		} else {
			redirect("products");
		}
	}
	public function remove_from_cart() {
		$id = $this->input->get("id");

		if ($this->session->has_userdata("cart")) {
			$cart = $this->session->userdata("cart");

			$item_key = array_search($id, array_column($cart, 0));
			if ($item_key !== FALSE) {
				unset($cart[$item_key]);
				$data["cart"] = $cart;
				$this->session->set_userdata($data);
			}
		}

		redirect("cart");
	}
}