<?php

class MasterJadwalModel extends Controller{

    private $table_pgs = 'Petugas';
    private $table = 'JadwalPetugas';

	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}
    
    protected 	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}



    public function GetNamaPetugas(){
        $query ="SELECT id_petugas,nama FROM $this->table_pgs ORDER BY nama ASC";

        $result2 = $this->db->baca_sql($query);
        $datas = [];
        while(odbc_fetch_row($result2)){
        
          $datas[] = array(
          "id_petugas"=>rtrim(odbc_result($result2,'id_petugas')),
          "nama"=>rtrim(odbc_result($result2,'nama')),
     
          );
          
          }
        
          return $datas;
    }



    public function saveData($post){
      
        $nama = $this->test_input($post["nama"]);
        $tanggal = $this->test_input($post["tanggal"]);
        $jam = $this->test_input($post["jam"]);

        
     
        $sql="INSERT INTO $this->table (nama,tanggal,jam) 
        Values ('". $nama ."','".$tanggal."','".$jam."')"; 
        
        $cek =0;
        $result = $this->db->baca_sql2($sql);
        if(!$result){
        $cek =$cek+1;
        }
    
        if ($cek==0){
        $status['nilai']=1; //bernilai benar
        $status['error']="Data Berhasil Ditambahkan";
        }else{
        $status['nilai']=0; //bernilai benar
        $status['error']="Data Gagal Ditambahkan";
        }


        return $status;
    }



    public function GetTampil(){
        $query = "SELECT * FROM $this->table ORDER BY id_jadwal  ASC ";
		//$result_set =odbc_exec($connection,$query);
		$result2 = $this->db->baca_sql($query);
	  $datas = [];
	  while(odbc_fetch_row($result2)){
	  
		  $datas[] = array(
			"id_jadwal"=>rtrim(odbc_result($result2,'id_jadwal')),
			  "nama"=>rtrim(odbc_result($result2,'nama')),
        "tanggal"=>rtrim(odbc_result($result2,'tanggal')),
        "jam"=>rtrim(odbc_result($result2,'jam')),
		  
		  
		  );
		  
		  }
		
		  return $datas;
    }


    public function UpdateData($post){
      die(var_dump($post));
      $id = $this->test_input($post["id"]);
      $jenislimbah = $this->test_input($post["jenislimbah"]);
    

      $sql="UPDATE $this->table SET jenis_limbah = '". $jenislimbah ."'WHERE id_limbah = '". $id ."' "; 
      $result = $this->db->baca_sql2($sql);
      $cek =0;
      if(!$result){
      $cek = $cek+1;
      }
      if ($cek==0){
      $status['nilai']=1; //bernilai benar
      $status['error']="Data Berhasil di edit";
      }else{
      $status['nilai']=0; //bernilai benar
      $status['error']="Data Gagal di edit";
      }
      return $status;

    }



    public function DeleteData($post){
      $id = $this->test_input($post["id"]);

      $sql="DELETE FROM  $this->table WHERE id = '".$id."'"; 
      $result = $this->db->baca_sql2($sql);
    
    
      $cek = 0;
      if(!$result){
        $cek = $cek+1;
      }
      if ($cek==0){
        $status['nilai']=1; //bernilai benar
        $status['error']="Data Berhasil Dihapus";
      }else{
        $status['nilai']=0; //bernilai benar
        $status['error']="Data Gagal Dihapus";
        }
      return $status;
    }



}