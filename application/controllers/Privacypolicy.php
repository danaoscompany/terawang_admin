<?php

class Privacypolicy extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('privacy_policy', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}
}