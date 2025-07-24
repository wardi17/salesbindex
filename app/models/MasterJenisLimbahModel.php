<?php

class MasterJenisLimbahModel extends Controller{


    private $table = 'Jenislimbah';

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
     
        $jenislimbah = $this->test_input($post["jenislimbah"]);
       

        
     
        $sql="INSERT INTO $this->table (jenis_limbah) 
        Values ('". $jenislimbah ."')"; 
        
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
        $query = "SELECT id_limbah,jenis_limbah FROM $this->table ORDER BY id_limbah  ASC ";
		//$result_set =odbc_exec($connection,$query);
		$result2 = $this->db->baca_sql($query);
	  $datas = [];
	  while(odbc_fetch_row($result2)){
	  
		  $datas[] = array(
			"id_limbah"=>rtrim(odbc_result($result2,'id_limbah')),
			 "jenis_limbah"=>rtrim(odbc_result($result2,'jenis_limbah')),
     
		  );
		  
		  }
		

      
   
		  return $datas;
    }


 
    public function UpdateData($post){
      
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

      $sql="DELETE FROM  $this->table WHERE id_limbah = '".$id."'"; 
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