<?php
/*
*	-------------------------------------------
*	FUNCITON NOT USED YET - PREPARED FOR FUTURE
*	-------------------------------------------
*/

/*
*	Name: 		email.php
*	Author: 	Krystofee
*	Created: 	20.1.2017
*	Desc: 		Header od every HTML document
*/

/*
*	To do list:
*				- implement string validator
*/

class Email() {

	public function __construct($address) {
		$this->address = $address;

		$this->address = $this->address.trim();
	}

	/**
	*	Implement validator to validate email address
	*/
	public function check() {

		return true;
	}

	/**
	*
	*/
	public function toString() {
		return $this->address;
	}

}