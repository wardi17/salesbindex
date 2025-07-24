<?php

class JadwalPetugasModel extends Models {

    private $tb_jenis ="[um_db].[dbo].Jenislimbah";
	public function __construct()
	{
		$this->db = new Database;
		
	}
    public function getjadwal($post){
        
        $tokenakes = $this->test_input($post["token"]);
        $tanggal = $this->test_input($post["tanggal"]);
      
        if(!empty($tokenakes)){
           return $this->setdatajadwal($tanggal);
        }else{
            return "silakan login ulan";
        }
       

    }



    private function setdatajadwal($tanggal){
        $strom =strtotime($tanggal);

        $settanggal = date('Y/m/d',$strom);
       
        $query="SP_GetPetugas '".$settanggal."'";
        $result = $this->db->baca_sql($query);
		$data =[];
		while(odbc_fetch_row($result)){
			$data=[
                "tanggal"=>date('d-m-Y',strtotime(rtrim(odbc_result($result,'tanggal')))),
                "jam"=>rtrim(odbc_result($result,'jam')),
                "nama"=>rtrim(odbc_result($result,'nama')),
                "jabatan"=>rtrim(odbc_result($result,'jabatan')),
                "divisi"=>rtrim(odbc_result($result,'divisi')),
            ];
      
      
			
			}

        $fulldata=[
            "petugas" =>$data,
            "jenis_limbah"=>$this->getJenislimbah(),
        ];

       
        return $fulldata;
		
    }



    private function getJenislimbah(){
        $query = "SELECT id_limbah,jenis_limbah FROM $this->tb_jenis ORDER BY id_limbah  ASC ";
		//$result_set =odbc_exec($connection,$query);
		$result2 = $this->db->baca_sql($query);
	  $datas = [];
	  while(odbc_fetch_row($result2)){
	  
		  $datas[] =[
            "id_limbah"=>rtrim(odbc_result($result2,'id_limbah')),
            "jenis_limbah"=>rtrim(odbc_result($result2,'jenis_limbah')),
    
          ];

      }
				
         return $datas;
    }
}