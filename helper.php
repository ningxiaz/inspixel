<?php
	function IsNullOrEmpty($string){
		return (!isset($string) || trim($string)==='');
	}
?>