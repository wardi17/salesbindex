<?php

class LoginModel extends Models {

	private $table = '[um_db].[dbo].a_user';
    private $t_token ='[um_db].[dbo].aksetoken';
	public function __construct()
	{
		
		$this->db = new Database;
	
		

	}

    
    public function proselogin($post){
	 $data = json_decode($post, TRUE);
		
        $username =  addslashes($data["username"]);
		$pass = addslashes($data["password"]);

       $query = "SELECT pass,email,nama,divisi,id_departemen,id_user FROM $this->table WHERE email ='".$username."' AND pass ='".$pass."'";
	   
      //die(var_dump($query));
		$sql =$this->db->baca_sql($query);

        $pass2=odbc_result($sql,"pass");
		$email=odbc_result($sql,"email");
        $pass2=odbc_result($sql,"pass");
		$divisi=odbc_result($sql,"divisi");
        $id_depatemen=odbc_result($sql,"id_departemen");
        $nama=odbc_result($sql,"nama");
        $id_user=odbc_result($sql,"id_user");
        $tanggal_sekarang =date("d-m-Y H:i:s");
        $kode_otp = $this->generateOTP();
        $datas=[];
		 
		 
        if($pass2 == $pass && $email == $username){
            $this->token =$this->settoken($email,$pass2,$nama,$tanggal_sekarang,$kode_otp);
           // $this->savetoken($id_user);
            $datas[]=[
                "nama"=>$nama,
                "divisi"=>$divisi,
                "id_depatemen"=>$id_depatemen,
                "tanggal_login"=> $tanggal_sekarang,
                "token"=>$this->token,
                "id_user"=>$id_user
            ];
        }

   
	 
        	
		if (empty($datas))
		{
			$userdata = null;
		}
		else
		{
			$userdata = $datas[0];
		} 
	
		return $userdata;
    }

    private function savetoken($id_user){
        $query ="INSERT INTO $this->t_token(id_user,token)VALUES('".$id_user."','".$this->token."')";
        $this->db->baca_sql($query);
    }

    private function generateOTP($length = 6) {
		$otp = '';
		for ($i = 0; $i < $length; $i++) {
			$otp .= rand(0, 9);
		}

	
		return $otp;
	}
    private function settoken($email,$pass2,$nama,$tanggal_sekarang,$kode_otp)
    {
        $kodeuse =$email.$pass2.$nama.$tanggal_sekarang;
        $md5 = md5($kodeuse.$kode_otp);
        $hast256 = hash('sha256', $md5);

      
        return $hast256;
    }
}