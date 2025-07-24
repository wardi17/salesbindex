<?php

class MasterJenisLimbah extends Controller{


    
	public function index()
		{
		
			$data['page'] = "ms_jenis";
			
			$this->view('templates/header', $data);
			$this->view('templates/sidebar', $data);
			$this->view('masterjenislimbah/index', $data);
			$this->view('masterjenislimbah/tambah');
			$this->view('masterjenislimbah/edit');
			$this->view('templates/footer');
		}





   public function getnamepetugas(){
	$data= $this->model('MasterJenisLimbahModel')->GetNamaPetugas();
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function createdate(){
	$data= $this->model('MasterJenisLimbahModel')->saveData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function tampildata(){
		$data= $this->model('MasterJenisLimbahModel')->GetTampil();
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
   }



   public function Updatedate(){
	$data= $this->model('MasterJenisLimbahModel')->UpdateData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function deletedate(){
	$data= $this->model('MasterJenisLimbahModel')->DeleteData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }
}