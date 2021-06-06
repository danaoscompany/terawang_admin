<?php

include "Util.php";
include "FCM.php";

class Test extends CI_Controller {
	
	public function email() {
		Util::send_email("danaoscompany@gmail.com", "This is subject", "This is body");
	}
	
	public function fcm() {
		FCM::send_notification("This is title", "This is body", "duJwIW85RbWqHrBsJ_Ixl1:APA91bGRP8LGmkE45YZbpuZcuedLlEjJH2bKeKehu9BuOzv8ifn1YJ0MmzDxE02db7dirxYacDCb-WcNYTPRL6A3dwTPo_Hpr6mA8w1ePiPn9QEii4IQmvW7xuU78J5lLuU8nUlvUk_E", array());
	}
}
