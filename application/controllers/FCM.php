<?php

class FCM extends CI_Controller {
	const NOTIFICATION_TYPE_GENERAL = 1;
	const NOTIFICATION_TYPE_UPDATED_GENERAL = 2;
	const NOTIFICATION_TYPE_ANSWER = 3;
	const NOTIFICATION_TYPE_NEW_QUESTION = 4;

	static public function sendPushNotification($title, $body, $data, $token) {
	    $url = "https://fcm.googleapis.com/fcm/send";
	    $serverKey = 'AAAAZkzF8SI:APA91bFrx3OFLIXoLwWA2ovvI3j0UI8x4_yH053j7aWTWeR1O01P8FidSCr_uqE9rAlw0nuod3hWJrPrM7i-kkOMOX4H0_oD03dB9pUb1F13WDppVpiHoNO9_-uFnyIDuRXleAJrZQEl';
	    $notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1');
	    $arrayToSend = array('to' => $token, /*'notification' => $notification,*/ 'priority'=>'high', 'data' => $data);
	    $json = json_encode($arrayToSend);
	    $headers = array();
	    $headers[] = 'Content-Type: application/json';
	    $headers[] = 'Authorization: key='. $serverKey;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	    //Send the request
	    $response = curl_exec($ch);
	    //Close request
	    if ($response === FALSE) {
	    	die('FCM Send Error: ' . curl_error($ch));
	    }
	    curl_close($ch);
	}
	
	static public function send_message($token, $notificationType, $title, $body, $data) {
	  $data['type'] = $notificationType;
      FCM::sendPushNotification($title, $body, $data, $token);
    }

	static public function sendPushNotificationWithColor($title, $body, $color, $data, $token) {
	    $url = "https://fcm.googleapis.com/fcm/send";
	    $serverKey = 'AAAAZkzF8SI:APA91bFrx3OFLIXoLwWA2ovvI3j0UI8x4_yH053j7aWTWeR1O01P8FidSCr_uqE9rAlw0nuod3hWJrPrM7i-kkOMOX4H0_oD03dB9pUb1F13WDppVpiHoNO9_-uFnyIDuRXleAJrZQEl';
	    $notification = array('title' => $title, 'body' => $body, 'color' => $color, 'sound' => 'default', 'badge' => '1');
	    $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority'=>'high', 'data' => $data);
	    $json = json_encode($arrayToSend);
	    $headers = array();
	    $headers[] = 'Content-Type: application/json';
	    $headers[] = 'Authorization: key='. $serverKey;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	    //Send the request
	    $response = curl_exec($ch);
	    //Close request
	    if ($response === FALSE) {
	    	die('FCM Send Error: ' . curl_error($ch));
	    }
	    curl_close($ch);
	}
	
	static public function send_message_with_color($token, $notificationType, $showNotification, $title, $body, $color, $data) {
	  $data['show_notification'] = $showNotification;
	  $data['notification_type'] = $notificationType;
      FCM::sendPushNotificationWithColor($title, $body, $color, $data, $token);
    }

	static public function sendPushNotificationWithoutNotification($data, $token) {
	    $url = "https://fcm.googleapis.com/fcm/send";
	    $serverKey = 'AAAAZkzF8SI:APA91bFrx3OFLIXoLwWA2ovvI3j0UI8x4_yH053j7aWTWeR1O01P8FidSCr_uqE9rAlw0nuod3hWJrPrM7i-kkOMOX4H0_oD03dB9pUb1F13WDppVpiHoNO9_-uFnyIDuRXleAJrZQEl';
	    $arrayToSend = array('to' => $token, 'priority'=>'high', 'data' => $data);
	    $json = json_encode($arrayToSend);
	    $headers = array();
	    $headers[] = 'Content-Type: application/json';
	    $headers[] = 'Authorization: key='. $serverKey;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	    //Send the request
	    $response = curl_exec($ch);
	    //Close request
	    if ($response === FALSE) {
	    	die('FCM Send Error: ' . curl_error($ch));
	    }
	    curl_close($ch);
	}
	
	static public function send_message_without_notification($token, $notificationType, $data) {
	  $data['show_notification'] = 0;
	  $data['notification_type'] = $notificationType;
      FCM::sendPushNotificationWithoutNotification($data, $token);
    }
    
    public static function send_message_to_topic($title, $body, $data, $topic) {
    	$url = "https://fcm.googleapis.com/fcm/send";
	    $serverKey = 'AAAAZkzF8SI:APA91bFrx3OFLIXoLwWA2ovvI3j0UI8x4_yH053j7aWTWeR1O01P8FidSCr_uqE9rAlw0nuod3hWJrPrM7i-kkOMOX4H0_oD03dB9pUb1F13WDppVpiHoNO9_-uFnyIDuRXleAJrZQEl';
	    $notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1');
	    $arrayToSend = array('to' => '/topics/' . $topic, 'notification' => $notification, 'priority'=>'high', 'data' => $data);
	    $json = json_encode($arrayToSend);
	    $headers = array();
	    $headers[] = 'Content-Type: application/json';
	    $headers[] = 'Authorization: key='. $serverKey;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	    curl_exec($ch);
	    curl_close($ch);
    }

    public static function send_message_to_admin($title, $body, $topic, $data) {
		$url = "https://fcm.googleapis.com/fcm/send";
		$serverKey = 'AAAAZkzF8SI:APA91bFrx3OFLIXoLwWA2ovvI3j0UI8x4_yH053j7aWTWeR1O01P8FidSCr_uqE9rAlw0nuod3hWJrPrM7i-kkOMOX4H0_oD03dB9pUb1F13WDppVpiHoNO9_-uFnyIDuRXleAJrZQEl';
		$notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1');
		$arrayToSend = array('to' => '/topics/' . $topic, 'notification' => $notification, 'priority'=>'high', 'data' => $data);
		$json = json_encode($arrayToSend);
		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: key='. $serverKey;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		curl_exec($ch);
		curl_close($ch);
	}

    /*
     *
     * curl -X POST -H "Authorization: key=AAAAZkzF8SI:APA91bFrx3OFLIXoLwWA2ovvI3j0UI8x4_yH053j7aWTWeR1O01P8FidSCr_uqE9rAlw0nuod3hWJrPrM7i-kkOMOX4H0_oD03dB9pUb1F13WDppVpiHoNO9_-uFnyIDuRXleAJrZQEl" -H "Content-Type: application/json" -d '{"notification": {"title": "Portugal vs. Denmark","body": "5 to 1","icon": "firebase-logo.png","click_action": "http://terawang.co:8081"},"to": "cMmyRbRH37jcIO6XS2Tj2f:APA91bGYneiAkNLKGuuTplS2e6_F7RdlQSWd85aIODXTGc6UIa1cPYKLdjoYz8GlOT1Tnq4FTwAcgt6LZWm9pvsftsoumLt95wKC3sy5M2HZry_e2SQzVM8fmUUfGay0m6sIXkbEUi1k"}' "https://fcm.googleapis.com/fcm/send"
     *
     */
}
