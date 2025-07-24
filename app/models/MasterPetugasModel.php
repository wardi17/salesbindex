<?php

class MasterPetugasModel extends Controller{

    private $table = 'Petugas';

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

    public function saveData($post){

        $nama = $this->test_input($post["nama"]);
        $email = $this->test_input($post["email"]);
        $jabatan = $this->test_input($post["jabatan"]);
        $divisi = $this->test_input($post["divisi"]);
     
        $sql="INSERT INTO $this->table (nama,email,jabatan,divisi) 
        Values ('". $nama ."','".$email."','".$jabatan."','".$divisi."')"; 
        
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
        $query = "SELECT * FROM $this->table ORDER BY id_petugas  ASC ";
		//$result_set =odbc_exec($connection,$query);
		$result2 = $this->db->baca_sql($query);
	  $datas = [];
	  while(odbc_fetch_row($result2)){
	  
		  $datas[] = array(
			"id_petugas"=>rtrim(odbc_result($result2,'id_petugas')),
			  "nama"=>rtrim(odbc_result($result2,'nama')),
			  "email"=>rtrim(odbc_result($result2,'email')),
              "jabatan"=>rtrim(odbc_result($result2,'jabatan')),
              "divisi"=>rtrim(odbc_result($result2,'divisi')),
		  
		  
		  );
		  
		  }
		
		  return $datas;
    }


    public function UpdateData($post){
      $nama = $this->test_input($post["nama"]);
      $email = $this->test_input($post["email"]);
      $jabatan = $this->test_input($post["jabatan"]);
      $divisi = $this->test_input($post["divisi"]);
      $id_petugas = $this->test_input($post["id_petugas"]);

      $sql="UPDATE $this->table SET nama = '". $nama ."', email = '". $email ."',jabatan ='".$jabatan."',divisi='".$divisi."'
      WHERE id_petugas = '". $id_petugas ."' "; 
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
      $id_petugas = $this->test_input($post["id_petugas"]);

      $sql="DELETE FROM  $this->table WHERE id_petugas = '".$id_petugas."'"; 
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