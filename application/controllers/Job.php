<?php

class Job extends CI_Controller
{

	public function index()
	{
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('job', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://192.168.43.254/idjobfinder/login');
		}
	}

	public function add()
	{
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('job/add', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://192.168.43.254/idjobfinder/login');
		}
	}

	public function edit() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$id = intval($this->input->post('id'));
			$this->load->view('job/edit', array(
				'adminID' => $adminID,
				'editedJobID' => $id
			));
		} else {
			header('Location: http://192.168.43.254/idjobfinder/login');
		}
	}
}
