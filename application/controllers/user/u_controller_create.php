<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class u_controller_create extends CI_Controller {

 	public function __construct() {
 		parent::__construct();
 		$this->load->model("model_read");
 		$this->load->model("model_create");
 	}
}