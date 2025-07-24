<?php

class Sales extends Controller{


    
	public function index()
		{
		

			
			$this->view('templates/header');
			//$this->view('templates/sidebar', $data);
			$this->view('sales/index');
			$this->view('templates/footer');
		}


		public function index2(){
			$this->view('sales/index2');
		}


 public function getharikerja(){

	$data= $this->model('SalesModel')->getHarikerja($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}

 }







   public function createdate(){
	$data= $this->model('salesModel')->saveData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function tampildata(){
		$data= $this->model('salesModel')->GetTampil();
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
   }



   public function Updatedate(){
	$data= $this->model('salesModel')->UpdateData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function deletedate(){
	$data= $this->model('salesModel')->DeleteData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }
}