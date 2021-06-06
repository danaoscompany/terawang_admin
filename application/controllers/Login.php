<?php

class Login extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			header('Location: http://192.168.43.254/idjobfinder/main');
		} else {
			$this->load->view('login');
		}
	}
}
