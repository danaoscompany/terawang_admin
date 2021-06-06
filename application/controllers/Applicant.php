<?php

class Applicant extends CI_Controller {

	public function index()
	{
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('applicant', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://192.168.43.254/idjobfinder/login');
		}
	}
}
