<?php

class MasterPetugas extends Controller{


    
	public function index()
		{
		
			$data['page'] = "ms_petugas";
			
			$this->view('templates/header', $data);
			$this->view('templates/sidebar', $data);
			$this->view('masterpetugas/index', $data);
			$this->view('masterpetugas/tambah');
			$this->view('masterpetugas/edit');
			$this->view('templates/footer');
		}






   public function createdate(){
	$data= $this->model('MasterPetugasModel')->saveData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function tampildata(){
		$data= $this->model('MasterPetugasModel')->GetTampil();
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
   }



   public function Updatedate(){
	$data= $this->model('MasterPetugasModel')->UpdateData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function deletedate(){
	$data= $this->model('MasterPetugasModel')->DeleteData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }
}