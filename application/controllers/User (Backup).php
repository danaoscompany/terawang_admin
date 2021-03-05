<?php

include "Util.php";
include "FCM.php";

class User extends CI_Controller {
	
	public function signup() {
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$birthPlace = $this->input->post('birth_place');
		$birthday = $this->input->post('birthday');
		$phone = $this->input->post('phone');
		if ($this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->num_rows() > 0) {
			echo json_encode(array(
				'response_code' => -1
			));
			return;
		}
		if ($this->db->query("SELECT * FROM `users` WHERE `phone`='" . $phone . "'")->num_rows() > 0) {
			echo json_encode(array(
				'response_code' => -2
			));
			return;
		}
		$this->db->insert('users', array(
			'name' => $name,
			'email' => $email,
			'password' => $password,
			'birth_place' => $birthPlace,
			'birthday' => $birthday,
			'phone' => $phone
		));
		$userID = intval($this->db->insert_id());
		$user = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $userID)->row_array();
		$user['response_code'] = 1;
		echo json_encode($user);
	}
	
	public function signup_with_google() {
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$users = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->result_array();
		if (sizeof($users) > 0) {
			$user = $users[0];
			$user['response_code'] = -1;
			echo json_encode($user);
		} else {
			$this->db->insert('users', array(
				'name' => $name,
				'email' => $email,
				'email_verified' => 1
			));
			$userID = intval($this->db->insert_id());
			$user = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $userID)->row_array();
			$user['response_code'] = 1;
			echo json_encode($user);
		}
	}
	
	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$users = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "' AND `password`='" . $password . "'")->result_array();
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
	
	public function set_phone() {
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$this->db->query("UPDATE `users` SET `phone`='" . $phone . "' WHERE `email`='" . $email . "'");
	}
	
	public function login_with_google() {
		$email = $this->input->post('email');
		$users = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->result_array();
		if (sizeof($users) > 0) {
			$user = $users[0];
			$this->db->query("UPDATE `users` SET `email_verified`=1 WHERE `id`=" . $user['id']);
			$user['response_code'] = 1;
			echo json_encode($user);
		} else {
			echo json_encode(array(
				'response_code' => -1
			));
		}
	}
	
	public function send_verification_email() {
		$email = $this->input->post('email');
		$lang = $this->input->post('lang');
		$code = Util::generateRandomNumber(4);
		if ($lang == "in") {
			Util::send_email($email, "Kode verifikasi Fortune Teller Anda: " . $code, "Mohon masukkan 4-digit kode berikut di kolom yang disediakan di aplikasi Anda: <b>" . $code . "</b>");
		} else if ($lang == "en") {
			Util::send_email($email, "Your Fortune Teller verification code: " . $code, "Please enter this 4-digit numeric codes in the field that is shown within your app: <b>" . $code . "</b>");
		} else if ($lang == "zh") {
			Util::send_email($email, "您的算命先生验证码： " . $code, "请在您的应用程序提供的字段中输入以下4位代码： <b>" . $code . "</b>");
		}
		echo json_encode(array(
			'code' => $code
		));
	}
	
	public function verify_email() {
		$email = $this->input->post('email');
		$this->db->query("UPDATE `users` SET `email_verified`=1 WHERE `email`='" . $email . "'");
		echo json_encode($this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->row_array());
	}
	
	public function verify_phone() {
		$phone = $this->input->post('phone');
		$this->db->query("UPDATE `users` SET `phone_verified`=1 WHERE `phone`='" . $phone . "'");
		echo json_encode($this->db->query("SELECT * FROM `users` WHERE `phone`='" . $phone . "'")->row_array());
	}
	
	public function reset_password() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->db->query("UPDATE `users` SET `password`='" . $password . "' WHERE `email`='" . $email . "'");
	}
	
	public function search_city() {
		$city = $this->input->post('city');
		echo json_encode($this->db->query("SELECT * FROM `cities` WHERE `name` LIKE '%" . $city . "%'")->result_array());
	}
	
	public function get_user_by_id() {
		$id = $this->input->post('id');
		echo json_encode($this->db->query("SELECT * FROM `users` WHERE `id`=" . $id)->row_array());
	}
	
	public function send_question() {
		$userID = intval($this->input->post('user_id'));
		$question = $this->input->post('question');
		$date = $this->input->post('date');
		$month = intval($this->input->post('month'));
		$year = intval($this->input->post('year'));
		$user = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $userID)->row_array();
		//$this->send_question_to_admin($userID, $question, $date, 1);
		// Check if user is premium
		$premium = intval($user['premium']);
		if ($premium == 0) {
			$this->check_free_chance($userID, $question, $date, $month, $year, 0);
		} else {
			$lastPremiumPurchase = $user['last_premium_purchase'];
			$premiumMonths = intval($user['premium_months']);
			$d1 = new DateTime(substr($lastPremiumPurchase, 0, strpos($lastPremiumPurchase, ' ')));
			$d2 = new DateTime(substr($date, 0, strpos($date, ' ')));
			$interval = $d2->diff($d1);
			$months = intval($interval->format('%m'));
			$days = intval($interval->format('%d'));
			if ($months < $premiumMonths) {
				$this->send_question_to_admin($userID, $question, $date, 1);
			} else if ($months == $premiumMonths) {
				if ($days > 0) {
					$this->check_free_chance($userID, $question, $date, $month, $year, 1);
				} else {
					$this->send_question_to_admin($userID, $question, $date, 1);
				}
			} else if ($months > $premiumMonths) {
				$this->check_free_chance($userID, $question, $date, $month, $year, 1);
			}
		}
	}
	
	private function check_free_chance($userID, $question, $date, $month, $year, $premium) {
		// $premium:
		//	  0 => user is not premium
		//	  1 => user is premium but premium date is already expired
		$freeHistories = $this->db->query("SELECT * FROM `questions` WHERE `user_id`=" . $userID . " AND `premium`=0 AND YEAR(`date`)=" . $year . " AND MONTH(`date`)=" . $month)->num_rows();
		$maxFreePerMonth = intval($this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array()['free_questions_per_month']);
		if ($freeHistories >= $maxFreePerMonth) {
			if ($premium == 0) {
				echo json_encode(array(
					'response_code' => -1 // user is not premium
				));
			} else {
				echo json_encode(array(
					'response_code' => -2 // user is premium but premium date is already expired
				));
			}
		} else {
			$this->send_question_to_admin($userID, $question, $date, 0);
		}
	}
	
	private function send_question_to_admin($userID, $question, $date, $premium) {
		$this->db->insert('questions', array(
			'user_id' => $userID,
			'premium' => $premium,
			'question' => $question,
			'date' => $date
		));
		$questionID = $this->db->insert_id();
		FCM::send_message_to_topic("New question being asked by user", strlen($question)>30?substr($question, 0, 30):$question, array(
			'question_id' => "" . $questionID
		), 'questions');
		echo json_encode(array(
			'response_code' => 1 // success
		));
	}
	
	public function get_prices() {
		echo json_encode($this->db->query("SELECT * FROM `prices` ORDER BY `month`")->result_array());
	}
	
	public function purchase() {
		$userID = intval($this->input->post('user_id'));
		$month = intval($this->input->post('month'));
		$date = $this->input->post('date');
		$this->db->query("UPDATE `users` SET `premium`=1, `premium_months`=" . $month . ", `last_premium_purchase`='" . $date . "' WHERE `id`=" . $userID);
	}
	
	public function get_answers() {
		$userID = intval($this->input->post('user_id'));
		echo json_encode($this->db->query("SELECT * FROM `questions` WHERE `user_id`=" . $userID . " ORDER BY `date` DESC")->result_array());
	}
	
	public function get_notifications() {
		echo json_encode($this->db->query("SELECT * FROM `notifications` ORDER BY `date` DESC")->result_array());
	}
	
	public function review_fortune() {
		$questionID = intval($this->input->post('question_id'));
		$rating = intval($this->input->post('rating'));
		$comment = $this->input->post('comment');
		$this->db->query("UPDATE `questions` SET `rating`=" . $rating . ", comment='" . $comment . "' WHERE `id`=" . $questionID);
	}
	
	public function get_question_by_id() {
		$id = intval($this->input->post('id'));
		echo json_encode($this->db->query("SELECT * FROM `questions` WHERE `id`=" . $id)->row_array());
	}
	
	public function set_premium() {
		$id = intval($this->input->post('id'));
		$premium = intval($this->input->post('premium'));
		$month = intval($this->input->post('month'));
		$this->db->query("UPDATE `users` SET `premium`=" . $premium . ", `premium_months`=" . $month . " WHERE `id`=" . $id);
		echo json_encode($this->db->query("SELECT * FROM `users` WHERE `id`=" . $id)->row_array());
	}
	
	public function is_premium() {
		$userID = intval($this->input->post('user_id'));
		$month = intval($this->input->post('month'));
		$year = intval($this->input->post('year'));
		$date = $this->input->post('date');
		$user = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $userID)->row_array();
		// Check if user is premium
		$premium = intval($user['premium']);
		if ($premium == 0) {
			$this->check_free_chance_2($userID, $month, $year, 0);
		} else {
			$lastPremiumPurchase = $user['last_premium_purchase'];
			$premiumMonths = intval($user['premium_months']);
			$d1 = new DateTime(substr($lastPremiumPurchase, 0, strpos($lastPremiumPurchase, ' ')));
			$d2 = new DateTime(substr($date, 0, strpos($date, ' ')));
			$interval = $d2->diff($d1);
			$months = intval($interval->format('%m'));
			$days = intval($interval->format('%d'));
			if ($months < $premiumMonths) {
				$this->respond_premium_to_user($userID, 1);
			} else if ($months == $premiumMonths) {
				if ($days > 0) {
					$this->check_free_chance_2($userID, $month, $year, 1);
				} else {
					$this->respond_premium_to_user($userID, 1);
				}
			} else if ($months > $premiumMonths) {
				$this->check_free_chance_2($userID, $month, $year, 1);
			}
		}
	}
	
	private function check_free_chance_2($userID, $month, $year, $premium) {
		// $premium:
		//	  0 => user is not premium
		//	  1 => user is premium but premium date is already expired
		$freeHistories = $this->db->query("SELECT * FROM `questions` WHERE `user_id`=" . $userID . " AND `premium`=0 AND YEAR(`date`)=" . $year . " AND MONTH(`date`)=" . $month)->num_rows();
		$maxFreePerMonth = intval($this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array()['free_questions_per_month']);
		if ($freeHistories >= $maxFreePerMonth) {
			if ($premium == 0) {
				echo json_encode(array(
					'response_code' => -1 // user is not premium
				));
			} else {
				echo json_encode(array(
					'response_code' => -2 // user is premium but premium date is already expired
				));
			}
		} else {
			$this->respond_premium_to_user($userID, 0);
		}
	}
	
	public function respond_premium_to_user($userID, $premium) {
		echo json_encode(array(
			'response_code' => 1 // user is premium
		));
	}
}
