<?php

class Main extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			header('Location: http://192.168.43.254/idjobfinder/user');
		} else {
			header('Location: http://192.168.43.254/idjobfinder/login');
		}
	}
}
