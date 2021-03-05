<?php

class Main extends CI_Controller {
	
	public function index() {
		if ($this->session->logged_in == 1) {
			header('Location: http://terawang.co/admin/notification');
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}
}
