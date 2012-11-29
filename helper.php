<?php
	function IsNullOrEmpty($string){
		return (!isset($string) || trim($string)==='');
	}

	function checkEmail( $email ){
	    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
	}
?>