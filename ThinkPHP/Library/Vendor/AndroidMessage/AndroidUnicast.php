<?php


require_once('AndroidNotification.php');

class AndroidUnicast extends AndroidNotification {
	function __construct($customer) {
		parent::__construct($customer);
		$this->data["type"] = "unicast";
		$this->data["device_tokens"] = NULL;
	}

}