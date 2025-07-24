<?php


class login  extends Controller
{
   
    
	public function __construct(){
            $this->request();
    }
    public function index(){
     
  
		//header("Content-Type: application/json");

		// Collect what you need in the $data variable.


        if($this->cekrquest =="POST"){
			 $post = file_get_contents('php://input');
            $data= $this->model('LoginModel')->proselogin($post);
					
            if(empty($data)){
                $data = null;
				header("HTTP/1.1 404 ERROR");
                echo json_encode($data);
            }else{
				header("HTTP/1.1 200 OK");
                echo json_encode($data);
            }
        }else{
		header("HTTP/1.1 404 ERROR");
            $data =[
                406 => 'Not Acceptable',
            ];

            echo json_encode($data);
        }
     
    }
}
