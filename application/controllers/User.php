<?php

include "Util.php";

class User extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('user', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://192.168.43.254/idjobfinder/login');
		}
	}
	
	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$users = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "' AND `password`='" . $password . "'")
			->result_array();
		if (sizeof($users) > 0) {
			$user = $users[0];
			$user['response_code'] = 1;
			echo json_encode($user);
		} else {
			echo json_encode(array(
				'response_code' => -1
			));
		}
	}
	
	public function get_latest_jobs() {
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$jobs = $this->db->query("SELECT * FROM `jobs` ORDER BY `date` DESC LIMIT " . $start . "," . $length)->result_array();
		for ($i=0; $i<sizeof($jobs); $i++) {
			$jobs[$i]['employer'] = $this->db->query("SELECT * FROM `employers` WHERE `id`=" . $jobs[$i]['employer_id'])->row_array();
		}
		echo json_encode($jobs);
	}
	
	public function get_applied_jobs() {
		$userID = $this->input->post('user_id');
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$jobs = $this->db->query("SELECT * FROM `applications` WHERE `user_id`=" . $userID . " ORDER BY `date` DESC LIMIT " . $start . "," . $length)->result_array();
		for ($i=0; $i<sizeof($jobs); $i++) {
			$jobs[$i]['job'] = $this->db->query("SELECT * FROM `jobs` WHERE `id`=" . $jobs[$i]['job_id'])->row_array();
			$jobs[$i]['employer'] = $this->db->query("SELECT * FROM `employers` WHERE `id`=" . $jobs[$i]['employer_id'])->row_array();
		}
		echo json_encode($jobs);
	}
	
	public function check_email() {
		$email = $this->input->post('email');
		$userCount = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->num_rows();
		if ($userCount > 0) {
			echo json_encode(array(
				'response_code' => -1
			));
			return;
		}
		echo json_encode(array(
			'response_code' => 1
		));
	}
	
	public function send_verification_email() {
		$email = $this->input->post('email');
		$code = $this->input->post('code');
		Util::send_email($email, "Kode verifikasi Anda: " . $code, "Masukkan 6-digit kode verifikasi berikut ke kotak yang tersedia: <b>" . $code . "</b>");
	}
	
	public function signup() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$name = $this->input->post('name');
		$this->db->insert('users', array(
			'email' => $email,
			'password' => $password,
			'name' => $name
		));
		echo json_encode(array(
			'response_code' => 1
		));
	}
	
	public function apply_job() {
		$userID = $this->input->post('user_id');
		$employerID = $this->input->post('employer_id');
		$description = $this->input->post('description');
		$jobID = $this->input->post('job_id');
		$date = $this->input->post('date');
		$this->db->insert('applications', array(
			'user_id' => $userID,
			'employer_id' => $employerID,
			'job_id' => $jobID,
			'description' => $description,
			'date' => $date
		));
	}
	
	public function is_job_applied() {
		$userID = $this->input->post('user_id');
		$jobID = $this->input->post('job_id');
		$applicationCount = $this->db->query("SELECT * FROM `applications` WHERE `user_id`=" . $userID . " AND `job_id`=" . $jobID)->num_rows();
		echo json_encode(array(
			'applied' => $applicationCount>0?1:0
		));
	}
	
	public function update_fcm_id() {
		$userID = $this->input->post('user_id');
		$fcmID = $this->input->post('fcm_id');
		$this->db->query("UPDATE `users` SET `fcm_id`='" . $fcmID . "' WHERE `id`=" . $userID);
	}
}
