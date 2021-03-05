<?php

include "Util.php";
include "FCM.php";

class User extends CI_Controller {

	public function index() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('user', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function add() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$this->load->view('user/add', array(
				'adminID' => $adminID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}

	public function edit() {
		if ($this->session->logged_in == 1) {
			$adminID = $this->session->user_id;
			$userID = intval($this->input->post('id'));
			$this->load->view('user/edit', array(
				'adminID' => $adminID,
				'userID' => $userID
			));
		} else {
			header('Location: http://terawang.co/admin/login');
		}
	}
	
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
			Util::send_email($email, "Kode verifikasi Terawang Anda: " . $code, "Mohon masukkan 4-digit kode berikut di kolom yang disediakan di aplikasi Anda: <b>" . $code . "</b>");
		} else if ($lang == "en") {
			Util::send_email($email, "Your Terawang verification code: " . $code, "Please enter this 4-digit numeric codes in the field that is shown within your app: <b>" . $code . "</b>");
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
		$questionsAsked = intval($this->input->post('questions_asked'));
		// User details
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$birthday = $this->input->post('birthday');
		$job = $this->input->post('job');
		$relationship = $this->input->post('relationship');
		$birthTime = $this->input->post('birth_time');
		$birthPlace = $this->input->post('birth_place');
		$user = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $userID)->row_array();
		if (intval($user['questions_asked']) <= 0) {
			$this->db->query("UPDATE `users` SET `name`='" . $name . "', `gender`='" . $gender . "', `birthday`='" . $birthday . "', `job`='" . $job . "', `relationship_status`='" . $relationship . "', `birth_time`='" . $birthTime . "', `birth_place`='" . $birthPlace . "', `question_profile_completed`=1 WHERE `id`=" . $userID);
		}
		$lastQuestionDate = $user['last_question_date'];
		//$this->send_question_to_admin($userID, $question, $date, 1);
		$freeQuestionsAsked = intval($user['free_questions_asked']);
		$settings = $this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array();
		$freeQuestionsPerMonth = intval($settings['free_questions_per_month']);
		// Check if user is premium
		$premium = intval($user['premium']);
		$credits = intval($user['credits']);
		if ($premium == 0) {
			if ($credits <= 0) {
				if ($lastQuestionDate == null) {
					if ($freeQuestionsAsked < $freeQuestionsPerMonth) {
						$this->db->query("UPDATE `users` SET `free_questions_asked`=1, `last_question_date`='" . $date . "' WHERE `id`=" . $userID);
						$this->send_question_to_admin($userID, $question, $date, 1);
					} else {
						echo json_encode(array('response_code' => -1));
					}
				} else {
					$d1 = new DateTime(substr($date, 0, strpos($date, " ")));
					$d2 = new DateTime(substr($lastQuestionDate, 0, strpos($lastQuestionDate, " ")));
					$interval = $d2->diff($d1);
					$diffMonths = intval($interval->format('%y')) * 12 + intval($interval->format('%m'));
					if ($diffMonths > 0) {
						$this->db->query("UPDATE `users` SET `free_questions_asked`=1, `last_question_date`='" . $date . "' WHERE `id`=" . $userID);
						$this->send_question_to_admin($userID, $question, $date, 1);
					} else {
						if ($freeQuestionsAsked < $freeQuestionsPerMonth) {
							$this->db->query("UPDATE `users` SET `free_questions_asked`=`free_questions_asked`+1, `last_question_date`='" . $date . "' WHERE `id`=" . $userID);
							$this->send_question_to_admin($userID, $question, $date, 1);
						} else {
							echo json_encode(array('response_code' => -1));
						}
					}
				}
			} else {
				$this->db->query("UPDATE `users` SET `last_question_date`='" . $date . "' WHERE `id`=" . $userID);
				$this->send_question_to_admin($userID, $question, $date, 1);
			}
		} else {
			$this->db->query("UPDATE `users` SET `last_question_date`='" . $date . "' WHERE `id`=" . $userID);
			$this->send_question_to_admin($userID, $question, $date, 1);
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
	
	private function send_question_to_admin($userID, $question, $date, $responseCode) {
		$user = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $userID)->row_array();
		$premium = intval($user['premium']);
		$credits = intval($user['credits']);
		$this->db->insert('questions', array(
			'user_id' => $userID,
			'premium' => $premium,
			'question' => $question,
			'date' => $date
		));
		$questionID = $this->db->insert_id();
		$this->db->query("UPDATE `users` SET `questions_asked`=`questions_asked`+1 WHERE `id`=" . $userID);
		if ($premium == 0) {
			if ($credits > 0) {
				$this->db->query("UPDATE `users` SET `credits`=`credits`-1 WHERE `id`=" . $userID);
			}
		}
		$this->db->insert('admin_notifications', array(
			'type' => 'question',
			'content' => 'Ada pertanyaan baru dibuat oleh user',
			'date' => $date,
			'question_id' => $questionID
		));
		FCM::send_message_to_topic("Ada pertanyaan baru dibuat oleh user",
			strlen($question)>30?substr($question, 0, 30):$question, array(
				'question_id' => "" . $questionID
			), 'questions');
		echo json_encode(array(
			'response_code' => $responseCode
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
	
	public function purchase_credits() {
		$userID = intval($this->input->post('user_id'));
		$credits = intval($this->input->post('credits'));
		$this->db->query("UPDATE `users` SET `credits`=`credits`+" . $credits . " WHERE `id`=" . $userID);
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
		$lastQuestionDate = $user['last_question_date'];
		$settings = $this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array();
		$freeQuestionsPerMonth = intval($settings['free_questions_per_month']);
		$credits = intval($user['credits']);
		// Check if user is premium
		$premium = intval($user['premium']);
		if ($premium == 0) {
			if ($credits <= 0) {
				if ($lastQuestionDate == null) {
					$this->db->query("UPDATE `users` SET `free_questions_asked`=0 WHERE `id`=" . $userID);
					$this->respond_premium_to_user($userID, 1);
				} else {
					$d1 = new DateTime(substr($date, 0, strpos($date, " ")));
					$d2 = new DateTime(substr($lastQuestionDate, 0, strpos($lastQuestionDate, " ")));
					$interval = $d2->diff($d1);
					$diffMonths = intval($interval->format('%y')) * 12 + intval($interval->format('%m'));
					if ($diffMonths > 0) {
						$this->db->query("UPDATE `users` SET `free_questions_asked`=0 WHERE `id`=" . $userID);
						$this->respond_premium_to_user($userID, 1);
					} else {
						$freeQuestionsAsked = intval($user['free_questions_asked']);
						if ($freeQuestionsAsked < $freeQuestionsPerMonth) {
							$this->respond_premium_to_user($userID, 1);
						} else {
							$this->respond_premium_to_user($userID, -1);
						}
					}
				}
			} else {
				echo json_encode(array(
					'response_code' => 2 // user is not premium but have sufficient credits
				));
			}
		} else {
			$this->respond_premium_to_user($userID, 1);
		}
	}
	
	public function is_premium2() {
		$userID = intval($this->input->post('user_id'));
		$month = intval($this->input->post('month'));
		$year = intval($this->input->post('year'));
		$date = $this->input->post('date');
		$user = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $userID)->row_array();
		$credits = intval($user['credits']);
		// Check if user is premium
		$premium = intval($user['premium']);
		if ($premium == 0) {
			if ($credits <= 0) {
				$this->check_free_chance_2($userID, $month, $year, 0);
			} else {
				echo json_encode(array(
					'response_code' => 2 // user is not premium but have sufficient credits
				));
			}
		} else {
			$this->respond_premium_to_user($userID, 1);
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
			$this->respond_premium_to_user($userID, -1);
		}
	}
	
	public function respond_premium_to_user($userID, $premium) {
		echo json_encode(array(
			'response_code' => $premium // user is premium
		));
	}
	
	public function get_credit_prices() {
		echo json_encode($this->db->query("SELECT * FROM `credit_prices` ORDER BY `credits`")->result_array());
	}
	
	public function update_profile() {
		$userID = intval($this->input->post('user_id'));
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$gender = $this->input->post('gender');
		$birthday = $this->input->post('birthday');
		$job = $this->input->post('job');
		$relationshipStatus = $this->input->post('relationship_status');
		$profilePictureChanged = intval($this->input->post('profile_picture_changed'));
		if ($profilePictureChanged == 1) {
			$config['upload_path']          = './userdata/';
	        $config['allowed_types']        = '*';
	        $config['max_size']             = 2147483647;
	        $config['file_name']            = Util::generateUUIDv4();
	        $this->load->library('upload', $config);
	        if ($this->upload->do_upload('profile_picture')) {
	        	$this->db->where('id', $userID);
				$this->db->update('users', array(
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'gender' => $gender,
					'birthday' => $birthday,
					'job' => $job,
					'relationship_status' => $relationshipStatus,
					'profile_picture' => $this->upload->data()['file_name']
				));
	        } else {
	        	echo json_encode($this->upload->display_errors());
	        }
		} else {
			$this->db->where('id', $userID);
			$this->db->update('users', array(
				'name' => $name,
				'email' => $email,
				'password' => $password,
				'gender' => $gender,
				'birthday' => $birthday,
				'job' => $job,
				'relationship_status' => $relationshipStatus
			));
		}
	}
	
	public function get_quotes() {
		echo json_encode($this->db->query("SELECT * FROM `quotes` ORDER BY `date`")->result_array());
	}
	
	public function get_testimony() {
		$testimonies = $this->db->query("SELECT * FROM `questions` WHERE `answered`=1 AND `comment` IS NOT NULL AND TRIM(`comment`)!='' ORDER BY `date`")->result_array();
		for ($i=0; $i<sizeof($testimonies); $i++) {
			$testimonies[$i]['user'] = $this->db->query("SELECT * FROM `users` WHERE `id`=" . $testimonies[$i]['user_id'])->row_array();
		}
		echo json_encode($testimonies);
	}
	
	public function get_howto() {
		$lang = $this->input->post('lang');
		echo $this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array()['howto_' . $lang];
	}
	
	public function get_terms() {
		$lang = $this->input->post('lang');
		echo $this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array()['terms_' . $lang];
	}
	
	public function get_privacy_policy() {
		$lang = $this->input->post('lang');
		echo $this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array()['privacy_policy_' . $lang];
	}
	
	public function update_fcm_id() {
		$userID = intval($this->input->post('id'));
		$fcmID = $this->input->post('fcm_id');
		$this->db->query("UPDATE `users` SET `fcm_id`='" . $fcmID . "' WHERE `id`=" . $userID);
	}
	
	public function get_howtos() {
		$lang = $this->input->post('lang');
		echo json_encode($this->db->query("SELECT * FROM `howtos` WHERE `lang`='" . $lang . "'")->result_array());
	}
	
	public function get_wa_number() {
		echo $this->db->query("SELECT * FROM `settings` LIMIT 1")->row_array()['wa_number'];
	}
	
	public function update_ask_profile() {
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$birthday = $this->input->post('birthday');
		$job = $this->input->post('job');
		$relationship = $this->input->post('relationship');
		$birthTime = $this->input->post('birth_time');
		$birthPlace = $this->input->post('birth_place');
		
	}
}
