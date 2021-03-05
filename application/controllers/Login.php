<?php

class Login extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			header('Location: http://terawang.co/admin/main');
		} else {
			$this->load->view('login');
		}
	}
}
