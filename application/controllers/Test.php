<?php

include "Util.php";
include "FCM.php";

class Test extends CI_Controller {
	
	public function email() {
		Util::send_email("danaoscompany@gmail.com", "This is subject", "This is <b>content</b>.");
	}
	
	public function bulk_insert_cities() {
		$this->db->query('DELETE FROM `cities`');
		$citiesJSONString = file_get_contents("cities.json");
		$cities = json_decode($citiesJSONString, true);
		for ($i=0; $i<sizeof($cities); $i++) {
			$city = $cities[$i];
			$this->db->insert('cities', array(
				'country_code' => $city['country'],
				'name' => $city['name'],
				'lat' => $city['lat'],
				'lng' => $city['lng']
			));
		}
	}
	
	public function a() {
		$d1 = new DateTime('2020-11-01');
		$d2 = new DateTime('2021-02-07');
		$interval = $d2->diff($d1);
		echo $interval->format('%d');
	}
	
	public function b() {
		FCM::send_message_to_admin("[TEST] Ada pertanyaan baru dibuat oleh user", 'Content', 'questions',
			array(
				'type' => 4
			));
	}
	
	public function c() {
		$d1 = new DateTime('2011-09-01');
		$d2 = new DateTime('2011-10-10');
		$interval = $d2->diff($d1);
		echo intval($interval->format('%m'));
	}
	
	public function d() {
		$users = $this->db->get('users')->result_array();
		for ($i=0; $i<sizeof($users); $i++) {
			$user = $users[$i];
			if (intval($user['premium']) == 1) {
				$lastPremiumPurchase = $user['last_premium_purchase'];
				$premiumMonths = intval($user['premium_months']);
				$d1 = new DateTime(substr($lastPremiumPurchase, 0, strpos($lastPremiumPurchase, " ")));
				$d2 = new DateTime();
				$interval = $d2->diff($d1);
				$diffMonths = intval($interval->format('%y')) * 12 + intval($interval->format('%m'));
				if ($diffMonths >= $premiumMonths) {
					$this->db->query("UPDATE `users` SET `premium`=0, `premium_months`=0 WHERE `id`=" . $user['id']);
				}
			}
		}
	}
}
