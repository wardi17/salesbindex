<?php

class Controller{
	protected $cekrquest;
	public function view($view, $data = [])
	{
		require_once '../app/views/' . $view . '.php';
	}

	public function model($model)
	{
		require_once '../app/models/' . $model . '.php';
		return new $model;
	}


	
	public function request(){
		$this->cekrquest =$_SERVER['REQUEST_METHOD'];
	
	}
}