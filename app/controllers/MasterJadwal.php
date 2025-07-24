<?php

class MasterJadwal extends Controller{


    
	public function index()
		{
		
			$data['page'] = "ms_jadwal";
			
			$this->view('templates/header', $data);
			$this->view('templates/sidebar', $data);
			$this->view('masterjadwal/index', $data);
			$this->view('masterjadwal/tambah');
			$this->view('masterjadwal/edit');
			$this->view('templates/footer');
		}





   public function getnamepetugas(){
	$data= $this->model('MasterJadwalModel')->GetNamaPetugas();
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function createdate(){
	$data= $this->model('MasterJadwalModel')->saveData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function tampildata(){
		$data= $this->model('MasterJadwalModel')->GetTampil();
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
   }



   public function Updatedate(){
	$data= $this->model('MasterJadwalModel')->UpdateData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function deletedate(){
	$data= $this->model('MasterJadwalModel')->DeleteData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }
}