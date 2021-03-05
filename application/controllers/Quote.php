<?php

class Quote extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('quote', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function add() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('quote/add', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function edit() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$quoteID = intval($this->input->post('id'));
			$this->load->view('quote/edit', array(
				'adminID' => $adminID,
				'quoteID' => $quoteID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}
}
