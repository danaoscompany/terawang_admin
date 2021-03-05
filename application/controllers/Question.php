<?php

class Question extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('question', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function answer() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$id = intval($this->input->post('id'));
			$this->load->view('question/answer', array(
				'adminID' => $adminID,
				'questionID' => $id
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}
}
