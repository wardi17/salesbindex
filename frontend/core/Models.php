<?php

class Models{

    protected $db;
	protected $db2;
    protected $token;


    protected function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}