<?php


class Android  extends Controller
{
   
    
	public function __construct(){
            $this->request();
    }
    public function jadwal(){
     
    
        if($this->cekrquest =="POST"){
            $data= $this->model('JadwalPetugasModel')->getjadwal($_POST);
					
            if(empty($data)){
                $data = null;
                echo json_encode($data);
            }else{
                echo json_encode($data);
            }
        }else{
            $data =[
                406 => 'Not Acceptable',
            ];

            echo json_encode($data);
        }
     
    }


    public function Transaksi(){
		
        $post = file_get_contents('php://input');

        $data= $this->model('TransaksiLimbahModel')->SaveTransaksi($post);
					
        if(empty($data)){
            $data = null;
			header("HTTP/1.1 404 ERROR");
            echo json_encode($data);
        }else{
			header("HTTP/1.1 200 OK");
            echo json_encode($data);
        }
    }
	
	
	public function LaporanJadwal(){

	
		
		if($this->cekrquest =="POST"){
			$data= $this->model('TransaksiLimbahModel')->LaporanTransaksi();
					
			if(empty($data)){
				$data = null;
				header("HTTP/1.1 404 ERROR");
				echo json_encode($data);
			}else{
			  header("HTTP/1.1 200 OK");
             echo json_encode($data);
			}
		}else{
			header("HTTP/1.1 405 METHED NOT GET");
            echo json_encode('methed salah');
		}

	}
	
	
	    public function TampilDataProduk(){
			if($this->cekrquest =="POST"){
				$post = file_get_contents('php://input');
				$data= $this->model('TransaksiLimbahModel')->TampilTransaksiJenis($post);
							
				if(empty($data)){
					$data = null;
					header("HTTP/1.1 404 ERROR");
					echo json_encode($data);
				}else{
					header("HTTP/1.1 200 OK");
					echo json_encode($data);
				}
			}else{
				header("HTTP/1.1 405 METHED NOT GET");
				echo json_encode('methed salah');
			}

     
    }
	
	
	public function TampilDetailTransaksiProduk(){
		if($this->cekrquest =="POST"){
				$post = file_get_contents('php://input');
				$data= $this->model('TransaksiLimbahModel')->TampilDetailTransaksi($post);
							
				if(empty($data)){
					$data = null;
					header("HTTP/1.1 404 ERROR");
					echo json_encode($data);
				}else{
					header("HTTP/1.1 200 OK");
					echo json_encode($data);
				}
			}else{
				header("HTTP/1.1 405 METHED NOT GET");
				echo json_encode('methed salah');
			}
	}



	//untuk tampil detail berdasarkan  jenis
	 public function TampilDetailtransaksibyJenis(){
		if($this->cekrquest =="POST"){
			$post = file_get_contents('php://input');
			$data= $this->model('TransaksiLimbahModel')->TampilDetailTrBy($post);
						
			if(empty($data)){
				$data = null;
				header("HTTP/1.1 404 ERROR");
				echo json_encode($data);
			}else{
				header("HTTP/1.1 200 OK");
				echo json_encode($data);
			}
		}else{
			header("HTTP/1.1 405 METHED NOT GET");
			echo json_encode('methed salah');
		}

	 }

	//and berdsarsarkan jenis

}
