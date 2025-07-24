<?php

class TransaksiLimbahModel extends Models {

        private $tablehead ="[um_db].[dbo].HeaderTransaksiLimbah";
        private $tabledetail ="[um_db].[dbo].DetailTransaksiLimbah";
        
        
        public function __construct()
        {
            $this->db = new Database;
			
            
        }



    public function SaveTransaksi($post){
             $data = json_decode($post, TRUE);
			
			
			$id_transo = $data["id_trans"];
			$jenis_limbah = $data["jenis_limbah"];
			$user_log = $data["user_log"];
			$date_entry =date("Y/m/d H:i:s");
			$qty =$data["qty"];
			$harga = $data["harga"];
			$ket = $data["ket"];
			$total = $data["total"];
			$gambar = $data["gambar"];
		
			//$new_gambar = $this->setgambar($gambar);
			$item_no = $this->setItemno($id_transo);
		
			$query= "INSERT INTO $this->tabledetail(item_no,id_transo,jenis_limbah,qty,total_kg,harga,ket,images,user_log,date_entry)VALUES(
			'".$item_no."','".$id_transo."','".$jenis_limbah."','".$qty."','".$total."','".$harga."','".$ket."','".$gambar."','".$user_log."','".$date_entry."')";
			

			 $result = $this->db->baca_sql($query);
				$cek =0;
				if(!$result){
				$cek = $cek+1;
				}
				if ($cek==0){
				$status['nilai']=1; //bernilai benar
				$status['error']="Data Berhasil di Simpan";
				}else{
				$status['nilai']=0; //bernilai benar
				$status['error']="Data Gagal di Simpan";
				}
				return $status;
		
            //datadetail = $data["detail"];

      

           // $id_transo = $dataheader["id_transo"];

            
            
           // $this->SaveDetail($datadetail);
           // return $this->SaveDataHeader($dataheader);
			
			

    }
		private function setgambar($gambar){
			
			die(var_dump($gambar));
			 $decodedImage = base64_decode($gambar);
			 die(var_dump($decodedImage));
			
		}
	
	
		private function setItemno($id_transo){
			
			$query ="SELECT  TOP 1 item_no  FROM $this->tabledetail  WHERE  id_transo ='".$id_transo."' ORDER BY item_no DESC";
		
			$sql =$this->db->baca_sql($query);
			
			$item_no=odbc_result($sql,"item_no");

			if($item_no == NULL){
			 return 1;
			}else{
			return (int)$item_no +1;
			}
		}

      private function SaveDetail($datadetail){
         
      
        foreach($datadetail as $items){
            $item_no =$items["item_no"];
            $id_transo =$items["id_transo"];
            $jenis_limbah =$items["jenis_limbah"];
            $berat =$items["berat"];
            $pcs =$items["pcs"];
            $total_kg =$items["total_kg"];
            $harga =$items["harga"];
            $subtotal =$items["subtotal"];
            $images =$items["images"];

            $query ="INSERT INTO DetailTransaksiLimbah(item_no,id_transo,jenis_limbah,berat,pcs,
            total_kg,harga,subtotal,images)
             VALUES('".$item_no."','".$id_transo."','".$jenis_limbah."','".$berat."','".$pcs."',
             '".$total_kg."','".$harga."','".$subtotal."','".$images."'      
             )";

           

         $this->db->baca_sql($query);
        }
      
      }
     private function SaveDataHeader($dataheader){

        $id_transo = $dataheader["id_transo"];
        $nama_petugas = $dataheader["nama_petugas"];
        $jabatan = $dataheader["jabatan"];
        $divisi = $dataheader["divisi"];
        $tanggal = date('Y/m/d H:i:s',strtotime($dataheader["tanggal"]));
        $userlog = $dataheader["userlog"];
        $las_akses = date('Y/m/d H:i:s',strtotime($dataheader["las_akses"]));
        $typehp = $dataheader["typehp"];
        $lat = $dataheader["lat"];
        $lng = $dataheader["lng"];
       
        $query ="INSERT INTO  $this->tablehead(id_transo,nama_petugas,jabatan,divisi,Tanggal,userlog,las_akses,typehp,lat,lng)
        VALUES('".$id_transo."','".$nama_petugas."','".$jabatan."','".$divisi."','".$tanggal."'
        ,'".$userlog."','".$las_akses."','".$typehp."','".$lat."','".$lng."')";

        $result = $this->db->baca_sql($query);
        $cek =0;
        if(!$result){
        $cek = $cek+1;
        }
        if ($cek==0){
        $status['nilai']=1; //bernilai benar
        $status['error']="Data Berhasil di Simpan";
        }else{
        $status['nilai']=0; //bernilai benar
        $status['error']="Data Gagal di Simpan";
        }
        return $status;
     }
	 
	 
	 //untuk laporantransaksi
		public function LaporanTransaksi(){
		
			$query ="SP_getLaporanJadwalLimbah";
			
			
	  $result = $this->db->baca_sql($query);
	  $datas = [];
	   while(odbc_fetch_row($result)){
	  
		  $datas[] = array(
			"tanggal"=>date('d-m-Y',strtotime(rtrim(odbc_result($result,'tanggal')))),
			 "total"=>number_format(odbc_result($result,'total'),( "total" == "total" ? 2 : 2), '.', ',')

		  
		  
		  );
		  
		  }

		  return $datas;
		}
	 //and
	 
	 //membuat tampil produk berdasarkan jenis 
		public function TampilTransaksiJenis($post){
	
			$data = json_decode($post, TRUE);
			
			$tanggal = date('Y/m/d',strtotime($data["tanggal"]));
			
			$query ="SP_TampilTransaksiJenisLmh '".$tanggal."' ";
			
			 $result = $this->db->baca_sql($query);
		  $datas = [];
		   while(odbc_fetch_row($result)){
		  
			  $datas[] =[
				"tanggal"=>date('d-m-Y',strtotime(rtrim(odbc_result($result,'tanggal')))),
				 "jenis_limbah"=>rtrim(odbc_result($result,'jenis_limbah')),
				 "qty"=>(int)odbc_result($result,'qty'),
				 "harga"=>number_format(odbc_result($result,'harga'),( "harga" == "harga" ? 2 : 2), '.', ','),
				 "total"=>number_format(odbc_result($result,'total'),( "total" == "total" ? 2 : 2), '.', ','),
			  
			  ];
			  
		  }

		  return $datas;
			
		}
	 
	 //and tampil


	 public function TampilDetailTrBy($post){
		$data = json_decode($post, TRUE);


		$tanggal = date('Y/m/d',strtotime($data["tanggal"]));
		$jenis = $data["jenis"];	
		
			$query ="SELECT * FROM";
			//$query ="SP_TampilTransaksiJenisLmh '".$tanggal."','".$jenis."' ";

			die(var_dump($query));
	 }
}