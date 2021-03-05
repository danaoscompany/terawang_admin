<?php

class Notification extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('notification', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function add() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('notification/add', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function edit() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$id = intval($this->input->post('id'));
			$this->load->view('notification/edit', array(
				'adminID' => $adminID,
				'notificationID' => $id
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function get() {
		if ($this->session->logged_in == 1) {
			$notifications = $this->db->query("SELECT * FROM `notifications` ORDER BY `date`")
				->result_array();
			for ($i=0; $i<sizeof($notifications); $i++) {
				$notifications[$i]['admin'] = $this->db->query("SELECT * FROM `admins` WHERE `id`=" . $notifications[$i]['admin_id'])->row_array();
			}
			echo json_encode($notifications);
		} else {
			echo json_encode(array(
				'error' => 'not_authenticated'
			));
		}
	}
}
