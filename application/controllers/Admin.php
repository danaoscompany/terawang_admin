<?php

include "Util.php";
include "FCM.php";

class Admin extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('admin', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://192.168.43.254/idjobfinder/login');
		}
	}

	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->db->where('email', $email);
		$users = $this->db->get('employers')->result_array();
		if (sizeof($users) > 0) {
			$user = $users[0];
			if ($user['password'] == $password) {
				$this->session->set_userdata(array(
					'logged_in' => 1,
					'user_id' => intval($user['id']),
					'name' => $user['name']
				));
				echo json_encode(array('response_code' => 1,
					'user_id' => intval($user['id'])));
			} else {
				echo json_encode(array('response_code' => -1));
			}
		} else {
			echo json_encode(array('response_code' => -2));
		}
	}

	public function get_admins() {
		echo json_encode($this->db->query("SELECT * FROM `employers` ORDER BY `name` ASC")->result_array());
	}

	public function get_users() {
		echo json_encode($this->db->query("SELECT * FROM `users` ORDER BY `name`")->result_array());
	}

	public function add() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('admin/add', array(
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
			$this->load->view('admin/edit', array(
				'adminID' => $adminID,
				'editedAdminID' => $id
			));
		} else {
			header('Location: http://192.168.43.254/idjobfinder/login');
		}
	}

	public function add_admin() {
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$profilePictureChanged = intval($this->input->post('profile_picture_changed'));
		$adminCount = $this->db->query("SELECT * FROM `employers` WHERE `email`='" . $email . "'")->num_rows();
		if ($adminCount > 0) {
			echo json_encode(
				array(
					'response_code' => -1
				)
			);
		} else {
			if ($profilePictureChanged == 1) {
				$config['upload_path']          = './userdata/';
				$config['allowed_types']        = '*';
				$config['max_size']             = 2147483647;
				$config['file_name']            = Util::generateUUIDv4();
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('file')) {
					$this->db->insert('employers', array(
						'name' => $name,
						'email' => $email,
						'password' => $password,
						'logo' => $this->upload->data()['file_name']
					));
					echo json_encode(
						array(
							'response_code' => 1
						)
					);
				} else {
					echo json_encode($this->upload->display_errors());
				}
			} else {
				$this->db->insert('employers', array(
					'name' => $name,
					'email' => $email,
					'password' => $password
				));
				echo json_encode(
					array(
						'response_code' => 1
					)
				);
			}
		}
	}

	public function edit_admin() {
		$id = intval($this->input->post('id'));
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$emailChanged = intval($this->input->post('email_changed'));
		$profilePictureChanged = intval($this->input->post('profile_picture_changed'));
		if ($emailChanged == 1) {
			$adminCount = $this->db->query("SELECT * FROM `admins` WHERE `email`='" . $email . "'")->num_rows();
			if ($adminCount > 0) {
				echo json_encode(
					array(
						'response_code' => -1
					)
				);
				return;
			}
		}
		if ($profilePictureChanged == 1) {
			$config['upload_path']          = './userdata/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 2147483647;
			$config['file_name']            = Util::generateUUIDv4();
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file')) {
				$this->db->where('id', $id);
				$this->db->update('employers', array(
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'logo' => $this->upload->data()['file_name']
				));
				echo json_encode(
					array(
						'response_code' => 1
					)
				);
			} else {
				echo json_encode($this->upload->display_errors());
			}
		} else {
			$this->db->where('id', $id);
			$this->db->update('employers', array(
				'name' => $name,
				'email' => $email,
				'password' => $password
			));
			echo json_encode(
				array(
					'response_code' => 1
				)
			);
		}
	}

	public function delete_admin() {
		$id = intval($this->input->post('id'));
		$this->db->query("DELETE FROM `employers` WHERE `id`=" . $id);
	}

	public function get_admin_by_id() {
		$id = intval($this->input->post('id'));
		$admin = $this->db->query("SELECT * FROM `employers` WHERE `id`=" . $id)->row_array();
		echo json_encode($admin);
	}

	public function get_jobs() {
		$employerID = $this->input->post('employer_id');
		$jobs = $this->db->query("SELECT * FROM `jobs` WHERE `employer_id`=" . $employerID)->result_array();
		echo json_encode($jobs);
	}

	public function add_job() {
		$employerID = $this->input->post('employer_id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$salary = $this->input->post('salary');
		$processingTime = $this->input->post('processing_time');
		$processingTimeUnit = $this->input->post('processing_time_unit');
		$address = $this->input->post('address');
		$this->db->insert('jobs', array(
			'employer_id' => intval($employerID),
			'title' => $title,
			'description' => $description,
			'salary' => intval($salary),
			'processing_time' => intval($processingTime),
			'processing_time_unit' => $processingTimeUnit,
			'address' => $address
		));
	}

	public function update_job() {
		$id = $this->input->post('id');
		$employerID = $this->input->post('employer_id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$salary = $this->input->post('salary');
		$processingTime = $this->input->post('processing_time');
		$processingTimeUnit = $this->input->post('processing_time_unit');
		$address = $this->input->post('address');
		$this->db->where('id', $id);
		$this->db->update('jobs', array(
			'employer_id' => intval($employerID),
			'title' => $title,
			'description' => $description,
			'salary' => intval($salary),
			'processing_time' => intval($processingTime),
			'processing_time_unit' => $processingTimeUnit,
			'address' => $address
		));
	}

	public function delete_job() {
		$id = $this->input->post('id');
		$this->db->query("DELETE FROM `jobs` WHERE `id`=" . $id);
	}

	public function get_job_by_id() {
		$id = $this->input->post('id');
		echo json_encode($this->db->query("SELECT * FROM `jobs` WHERE `id`=" . $id)->row_array());
	}

	public function get_applications() {
		$employerID = $this->input->post('employer_id');
		$applications = $this->db->query("SELECT * FROM `applications` WHERE `employer_id`=" . $employerID)->result_array();
		for ($i=0; $i<sizeof($applications); $i++) {
			$applications[$i]['user'] = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $applications[$i]['user_id'])->row_array();
			$applications[$i]['job'] = $this->db->query("SELECT * FROM `jobs` WHERE `id`=" . $applications[$i]['job_id'])->row_array();
		}
		echo json_encode($applications);
	}

	public function update_application_status() {
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$this->db->query("UPDATE `applications` SET `status`='" . $status . "' WHERE `id`=" . $id);
		$application = $this->db->query("SELECT * FROM `applications` WHERE `id`=" . $id)->row_array();
		$user = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $application['user_id'])->row_array();
		$job = $this->db->query("SELECT * FROM `jobs` WHERE `id`=" . $application['job_id'])->row_array();
		$title = "";
		if ($status == 'approved') {
			$title = "Selamat, lamaran Anda sebagai " . $job['title'] . " disetujui";
		} else if ($status == 'rejected') {
			$title = "Lamaran Anda sebagai " . $job['title'] . " ditolak";
		}
		FCM::send_notification($title, "Klik untuk mengecek status terbaru lamaran Anda", $user['fcm_id'], array());
	}
}
