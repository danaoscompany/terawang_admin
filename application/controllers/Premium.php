<?php

class Premium extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('premium', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function add() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('premium/add', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function edit() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$premiumID = intval($this->input->post('id'));
			$this->load->view('premium/edit', array(
				'adminID' => $adminID,
				'premiumID' => $premiumID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}
}
