<?php

/**
 * 
 */
class chatAppObject
{
	var $receiverId;

	var $name;

	var $mobileNo;

	var $avatar;

	var $data;

	
	function __construct()
	{
		$this->receiverId="";

		$this->name="";

		$this->mobileNo="";

		$this->avatar = "./img/default.png";

		$this->data = [];
		
	}
}


?>