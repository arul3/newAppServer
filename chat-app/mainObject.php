<?php

/**
 * 
 */

include 'leftPanelObject.php';
include 'chatAppObject.php';


class mainObject
{
	var $status;

	var $loggedIn;

	var $dataLoaded;

	var $leftPanel;

	var $chatApp;

	function __construct()
	{
		$this->status = "started";
		$this->loggedIn = false;
		$this->dataLoaded = true;
	}

	public function setLeftPanel($data)
	{

		$this->leftPanel = new leftPanelObject;

		$this->leftPanel->setChatList($data);
	}
	public function setLoggedIn($data)
	{
		if($data){
			$this->loggedIn = true;
		}
	}


	public function setChatApp()
	{

		$this->chatApp = new chatAppObject;


	}
}

?>