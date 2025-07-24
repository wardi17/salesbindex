<?php

class AttenFiledModel {
	
	private $table = 'orderHeader';

	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}



  
	public function SaveDataAtten($data)
	{

		$sotranid =$this->test_input($data["sotranid"]);
		$cabang =$this->test_input($data["cabang"]);
		$cek = 0;
		$valid = 0;
		$nama_atter ="";
			if(!empty($_FILES)){
				$files = $_FILES['files'];
			
				$total = count($files['name']);
				for ($i = 0; $i < $total; $i++) {
					$file_name = $files['name'][$i];
					$file_tmp = $files['tmp_name'][$i];
					$file_size = $files['size'][$i];
					$file_error = $files['error'][$i];
					$fileType = $files['type'][$i];
					//$nama_panjang = $this->CekpanjangName($file_name);
					
					$new_filename = $this->Rubahnama($file_name,$sotranid,$cabang);
						
						if ($file_error !== UPLOAD_ERR_OK) {
							echo "Error uploading $new_filename. Error code: $file_error<br>";
							continue;
						}
						if(($fileType == "image/gif") || ($fileType == "image/jpeg") || ($fileType == "image/png") || ($fileType == "image/pjpeg") || ($fileType == "application/pdf") ){
                            $upload_dir = '../public/uploads_attachfile/';
                            $new_nama = $new_filename;
                            $destination = $upload_dir . $new_nama;
                            if (move_uploaded_file($file_tmp, $destination)) {
                            $nama_atter = $new_nama;
                            }
					    } 
                    //     $new_nama = $file_name;
                    //     $upload_dir = '../public/uploads_attachfile/';
                    //     $destination = $upload_dir . $new_nama;
                    //     if (move_uploaded_file($file_tmp, $destination)) {
                    //       $nama_atter = $new_nama;
                    //   }
				}
			}
			if($nama_atter !==""){
				$st_doc ="Y";
				$sql = "UPDATE $this->table SET nama_document ='".$nama_atter."',status_document='".$st_doc."' WHERE SOTransacID ='".$sotranid."'";

				
				  $result = $this->db->baca_sql($sql);
				  if(!$result){
					$cek =$cek+1;
				  }
				  
				  if ($cek==0){
					$pesan['nilai']=1; //bernilai benar
					$pesan['nama_file'] = $new_nama;
					$pesan['st_document'] = $st_doc;
					$pesan['SOTransacID'] = $sotranid;
					$pesan['error']="Upload Berhasil";
				  }else{
					$pesan['nilai']=0; //bernilai benar
					$pesan['error']="Upload Gagal";
				  }
			}else{
				$pesan['nilai']=0; //bernilai benar
				$pesan['nama_file'] ="gagal";
				$pesan['error'] ="Nama file harus berbeda";
			}
		

			return $pesan;
			  
	}
	

	public function DeleteDataUpload($data){
		$namafile = $this->test_input($data["nama_file"]);
		$sotranid = $this->test_input($data["id"]);
		
		$nama_atter ="NULL";
		$st_doc ="NULL";
		$cek = 0;
		$sql = "UPDATE $this->table SET nama_document =".$nama_atter.",status_document=".$st_doc." WHERE SOTransacID ='".$sotranid."'";
	
		
		  $result = $this->db->baca_sql($sql);
		  if(!$result){
			$cek =$cek+1;
		  }
		  
		  if ($cek==0){
			unlink( "../public/uploads_attachfile/".$namafile);
			$pesan['nilai']=1; //bernilai benar
			$pesan['SOTransacID'] = $sotranid;
			$pesan['error']="Hapus Berhasil";
		  }else{
			$pesan['nilai']=0; //bernilai benar
			$pesan['error']="Hapus Gagal";
		  }

		  return $pesan;
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}


		



	public function TampilAtten($data){
		
		$kode_budget = $this->test_input($data["kode_budget"]);
		$kode_atter = $this->test_input($data["atter"]);
		$sql = "SELECT  nama_document FROM $this->table WHERE kode_budget ='".$kode_budget."' AND kode_atter ='".$kode_atter."' ";
		$result = $this->db->baca_sql($sql);
		
		$data =[];
		while (odbc_fetch_row($result)){
			$data[] = [
			 "nama_document" =>rtrim(odbc_result($result,'nama_document')),
			]; 
		}
		return $data;

	}


	public function dataAttenByID($kodeKeluhan){
		$sql = "SELECT  nama_document FROM $this->table WHERE kode_keluhan ='".$kodeKeluhan."'";
		$rows = $this->db->baca_sql($sql);
		
		// $data =[];
		// while (odbc_fetch_row($result)){
		// 	$data[] = [
		// 	 "nama_document" =>rtrim(odbc_result($result,'nama_document')),
		// 	]; 
		// }
		while(odbc_fetch_row($rows)){
			
			$data[] =
			 odbc_result($rows,'nama_document');
			}
		 $json = json_encode($data);
		   
				$str_replace = str_replace("["," ",$json);
				$str_replace2 = str_replace("]"," ",$str_replace);
				$str_replace3 = str_replace('"','',$str_replace2);
				$str_replace4 = str_replace(',',', ',$str_replace3);
	  
		
		   return $str_replace4;
		
	}
	
	public function DeleteAtten($data){
		$cek = 0;
		$kode_budget = $this->test_input($data["kode_budget"]);
		$nama_file = $this->test_input($data["nama_file"]);
		$kode_atter = $this->test_input($data["atter"]);

		$sql = "DELETE FROM $this->table WHERE kode_budget = '".$kode_budget."' AND  nama_document = '".$nama_file."' AND  kode_atter = '".$kode_atter."'";
		$result = $this->db->baca_sql($sql);

		if(!$result){
		  $cek =$cek+1;
		}
		
		if ($cek==0){
		  $pesan['nilai']=1; //bernilai benar
		  $pesan['error']="Data Berhasil Dihapus";
		}else{
		  $pesan['nilai']=0; //bernilai benar
		  $pesan['error']="Data Gagal Dihapus";
		}
  
	  return $pesan;

	}


	private function Rubahnama($file_name,$sotranid,$cabang){
		$tahun =date("y");
		$sub_name = substr($sotranid,0,3);

		$gabung = $tahun."-".$cabang.$sub_name.$file_name;

		return $gabung;

	}


	// private function CekpanjangName($file_name){
	// 	$jumlah_karakter    =strlen($file_name);
	// 	die(var_dump($jumlah_karakter));
	// }

private function compress_image($source_url, $destination_url, $quality)
	{
	
		$info = getimagesize($source_url);
		if ($info['mime'] == 'image/jpeg') 
		$image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
		imagejpeg($image, $destination_url, $quality);
		//echo "Image uploaded successfully.";
	}


	
}