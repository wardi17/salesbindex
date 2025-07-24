<?php
 require_once 'config.php';
 require_once 'Controller.php';
 require_once 'Models.php';
 require_once '../database/Database.php';
class API{

	protected $controller ='login';
	protected $method = 'index';
	protected $params = [];

	public function __construct(){
		
		
		$url = $this->parseURL();
	
			
			header('Access-Control-Allow-Origin: *');
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			header('Content-Type: application/json; charset=UTF-8');
			header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		
		if(file_exists('../app/controllers/' . $url[0] . '.php')){
			$this->controller = $url[0] ;

		
			unset($url[0]);
		}
	
	
		require_once '../app/controllers/' . $this->controller . '.php';

		$this->controller = new $this->controller;
	
		if(isset($url[1])){
		
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);
			}
		}


				
		if(!empty($url)){
			$this->params = array_values($url);
		}

		//jalankan controller
		call_user_func_array([$this->controller, $this->method], $this->params);
	 
	}

	public function parseURL(){
		
	

		$seturl = $this->parselcontrol($_SERVER['REQUEST_URI']);

		
		
		
			$url = filter_var($seturl, FILTER_SANITIZE_URL);
			
			$url = explode('/',$url);

			//die(var_dump($url));
			return $url;
		
	}



	private function parselcontrol($url){
		$specialChar = 'public';

		// Mencari posisi karakter khusus dalam URL
		$pos = strpos($url, $specialChar);
		if ($pos !== false) {
			// Mengambil substring setelah karakter khusus
			$result = substr($url, $pos);
			$st_rep = str_replace("public/","",$result);
		   return $st_rep;
		}
	}

}