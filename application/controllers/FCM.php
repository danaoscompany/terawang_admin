<?php

class FCM {

	public static function send_notification($title, $body, $token, $data) {
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $fields = array(
            'registration_ids' => array($token),
            'notification' => array(
            	'title' => $title,
            	'body' => $body
            )
    	);
    	if (sizeof($data) > 0) {
    		$fields['data'] = $data;
    	}
    	$fields = json_encode($fields);
    	$headers = array (
            'Authorization: key=' . "AAAAY-_XOCc:APA91bE80s0IcAAEXiyENjmT6zNm_SqzAvicdKPFe-TionmL4TLS6nB1t9y4bQM337d6ExqfgbmZWpDSAJvYlzBcLw8WsP0OIjwtz0O6HJQcJJClwZgGFqjgYKLdxQZVnFd8ljlv5jIM",
            'Content-Type: application/json'
    	);
    	$ch = curl_init ();
    	curl_setopt ( $ch, CURLOPT_URL, $url );
    	curl_setopt ( $ch, CURLOPT_POST, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	    echo $result;
	}
}
