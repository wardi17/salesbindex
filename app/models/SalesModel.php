<?php

class SalesModel {

    private $tablebulan ="[lampeberger].[dbo].MothdayBindex";
    private $tb_cuti ="[cuti_bmi].[dbo].hari_libur";
    private $db;

     public $targetbulan;
     public $targetharian;

     public $totalCorporate =0;
     public $totalDealer =0;
     public $totalStore =0;
     public $totalDepstore =0;
     public $totalUsers =0;
     public $totalOnline =0;
    
     public $TargetCorporate=0;
     public $TargetDealer=0;
     public $TargetDepstore=0;
     public $TargetStore=0;
     public $TargetUsers=0;
     public $TargetOnline=0;
     public $hk_kerja =0;
     public $libur=0;
     public $hk_harian;
     public $Totalw1;
     public $Totalw2;
     public $Totalw3;
     public $Totalw4;

     public $Rowspan1;
     public $Rowspan2;
     public $Rowspan3;
     public $Rowspan4;
     
     public $harini;

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


    public function getHarikerja($post){
        
        $tahun = $this->test_input($post["tahun"]);
        $bulan = $this->test_input($post["bulan"]);
        $bulan_k =$this->setbulanangka($bulan);
 
        $tgl_from = $this->test_input($post["tgl_from"]);
        $tgl_to = $this->test_input($post["tgl_to"]);
        $this-> getDatesForMonth($tahun, $bulan_k,$tgl_from,$tgl_to);

     
        $tanggal =cal_days_in_month(CAL_GREGORIAN, $bulan_k, $tahun);
    
        $headhover =[
            "Detaildata"=>$this->loopdatadetail($tahun,$bulan_k,$tanggal),
            "Target" =>$this->targetbulan,
            "Target2" =>$this->targetharian,
            "Hari"=>$tanggal,
            "totalCorporate"=>number_format($this->totalCorporate, 0, ',', ','),
            "totalDealer"=>number_format($this->totalDealer, 0, ',', ','),
            "totalStore"=>number_format($this->totalStore, 0, ',', ','),
            "totalDepstore"=>number_format($this->totalDepstore, 0, ',', ','),
            "totalUsers"=>number_format($this->totalUsers, 0, ',', ','),
            "totalOnline"=>number_format($this->totalOnline, 0, ',', ','),

            "TargetCorporate"=>number_format($this->TargetCorporate, 0, ',', ','),
            "TargetDealer"=>number_format($this->TargetDealer, 0, ',', ','),
            "TargetStore"=>number_format($this->TargetStore, 0, ',', ','),
            "TargetUsers"=>number_format($this->TargetUsers, 0, ',', ','),
            "TargetOnline"=>number_format($this->TargetOnline, 0, ',', ','),
            "TargetDepstore"=>number_format($this->TargetDepstore, 0, ',', ','),
            "krg_cor"=>number_format(($this->TargetCorporate - $this->totalCorporate), 0, ',', ','),
            "krg_der"=>number_format(($this->TargetDealer - $this->totalDealer), 0, ',', ','),
            "krg_sto"=>number_format(($this->TargetStore - $this->totalStore), 0, ',', ','),
            "krg_use"=>number_format(($this->TargetUsers - $this->totalUsers), 0, ',', ','),
            "krg_onl"=>number_format(($this->TargetOnline - $this->totalOnline), 0, ',', ','),
            "krg_dep"=>number_format(($this->TargetDepstore - $this->totalDepstore), 0, ',', ','),
            "garand_total"=>number_format(($this->totalCorporate + $this->totalDealer + $this->totalStore +
             $this->totalDepstore + $this->totalUsers + $this->totalOnline), 0, ',', ','),
            "total_target"=>number_format($this->TargetCorporate + $this->TargetDealer + $this->TargetStore +
             $this->TargetUsers + $this->TargetOnline + $this->TargetDepstore),
            "w1"=>number_format($this->Totalw1, 0, ',', ','),
            "w2"=>number_format($this->Totalw2, 0, ',', ','),
            "w3"=>number_format($this->Totalw3, 0, ',', ','),
            "w4"=>number_format($this->Totalw4, 0, ',', ','),
            "total_week"=>number_format(($this->Totalw1 + $this->Totalw2 + $this->Totalw3 + $this->Totalw4 ), 0, ',', ','),
            "rowspan1" =>$this->Rowspan1,
            "rowspan2" =>$this->Rowspan2,
            "rowspan3" =>$this->Rowspan3,
            "rowspan4" =>$this->Rowspan4,
            "hk"=>($this->hk_kerja - $this->libur),
            "hk_harian"=>$this->hk_harian,
            "prediksi_Corporate"=>number_format($this->hitungprediksi($this->totalCorporate,$this->TargetCorporate),2, ',', ','),
            "prediksi_Dealer"=>number_format($this->hitungprediksi($this->totalDealer,$this->TargetDealer),2, ',', ','),
            "prediksi_Store"=>number_format($this->hitungprediksi($this->totalStore,$this->TargetStore),2, ',', ','),
            "prediksi_Depstore"=>number_format($this->hitungprediksi($this->totalDepstore,$this->TargetDepstore),2, ',', ','),
            "prediksi_Users"=>number_format($this->hitungprediksi($this->totalUsers,$this->TargetUsers),2, ',', ','),
            "prediksi_Online"=>number_format($this->hitungprediksi($this->totalOnline,$this->TargetOnline),2, ',', ','),
            "hariini"=>(int)$this->harini
        ];
       
   
      


      return $headhover;
      // echo "<pre>";
			// print_r($headhover);
			// echo "</pre>";
			// die();

    }

    private function hitungprediksi($total,$target){
      $hk_bulan =($this->hk_kerja - $this->libur);
      $hk_harian = $this->hk_harian;

      $hasil =(($hk_bulan/$hk_harian) *($total/$target) * 100);
      return $hasil;
    }
    private function  getDatesForMonth($tahun, $bulan_k,$tgl_from,$tgl_to){

      $query ="SP_BinexgetHarilibur '".$tahun."','".$bulan_k."'";
      $result2 = $this->db->baca_sql2($query);
		  $tgl_db =0;
      while(odbc_fetch_row($result2)){
        $tgl_db   += date("l",strtotime(rtrim(odbc_result($result2,'tanggal'))))=="Saturday" || date("l",strtotime(rtrim(odbc_result($result2,'tanggal'))))=="Sunday"? 0 :1;


      }

  
      $start = new DateTime($tgl_from);
      $end = new DateTime($tgl_to);
      
     
      $datas =[];
      while ($start <= $end) {
         
        $datas[] = $start->format("Y-m-d") . "\n";
      
         $start->modify("+1 day");
      }
      
    
      $totalhari =0;
      foreach($datas as $itms){
     
        $totalhari +=date("l",strtotime($itms))=="Saturday" || date("l",strtotime($itms))=="Sunday"? 0 :1;

      }
      $kerja_harian = $tgl_db + $totalhari;
     
      $this->hk_harian = $kerja_harian;
      $this->libur=$tgl_db;

      $this->harini = $end->format("d");
  }
  
    private function loopdatadetail($tahun,$bulan_k,$tanggal){
        

          $query ="DELETE  FROM $this->tablebulan WHERE bulan='".$bulan_k."' AND tahun='".$tahun."' ";

         
          $this->db->baca_sql2($query);
          for ($i=1; $i < $tanggal+1; $i++) { 

            $this->setTanggalbulan($tahun,$bulan_k,$i);
              ///$datafull[] =$this->detaildata($tahun,$bulan_k,$i);
          
            
          }
          $datadetail = $this->getdetaildata($tahun,$bulan_k);
          return $datadetail;
    }


    private function setTanggalbulan($tahun,$bulan_k,$i){
       $query ="SP_CreateSetBulanBindex'".$i."','".$bulan_k."','".$tahun."'"; 
       $this->db->baca_sql2($query);
    }

    private function getdetaildata($tahun,$bukan_k){
  
      

        $query ="SP_BinexTransaskiSales'".$tahun."','".$bukan_k."'";

      	$result2 = $this->db->baca_sql2($query);
        $daftar_hari = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
           );
        $datadetail=[];
        
       
        while(odbc_fetch_row($result2)){
          $this->targetbulan = number_format(odbc_result($result2,'TargetBulana'),("TargetBulana" == "TargetBulana" ? 0 : 2), ',', ',');
          $this->targetharian = number_format(odbc_result($result2,'TargetHarian'),("TargetHarian" == "TargetHarian" ? 0 : 2), ',', ',');
          $this->totalCorporate  += odbc_result($result2,'Corporate');
          $this->totalDealer  += odbc_result($result2,'Dealer');
          $this->totalStore  += odbc_result($result2,'Store');
          $this->totalDepstore  += odbc_result($result2,'Depstore');
          $this->totalUsers   += odbc_result($result2,'Users');
          $this->totalOnline  += odbc_result($result2,'Online');
         
          $this->TargetCorporate  = odbc_result($result2,'TargetCorporate');
          $this->TargetDealer  = odbc_result($result2,'TargetDealer');
          $this->TargetDepstore  = odbc_result($result2,'TargetDepstore');
          $this->TargetStore  = odbc_result($result2,'TargetStore');
          $this->TargetUsers  = odbc_result($result2,'TargetUsers');
          $this->TargetOnline  = odbc_result($result2,'TargetOnline');

          $this->hk_kerja   += date("l",strtotime(rtrim(odbc_result($result2,'Hari'))))=="Saturday" || date("l",strtotime(rtrim(odbc_result($result2,'Hari'))))=="Sunday"? 0 :1;
    
          $this->Totalw1  = odbc_result($result2,'Totalw1');
          $this->Totalw2  = odbc_result($result2,'Totalw2');
          $this->Totalw3  = odbc_result($result2,'Totalw3');
          $this->Totalw4  = odbc_result($result2,'Totalw4');

          $this->Rowspan1  = odbc_result($result2,'Rowspan1');
          $this->Rowspan2  = odbc_result($result2,'Rowspan2');
          $this->Rowspan3  = odbc_result($result2,'Rowspan3');
          $this->Rowspan4  = odbc_result($result2,'Rowspan4');
          $datadetail[] =[
            "Tgl"=>rtrim(odbc_result($result2,'Tgl')),
            "Hari"=>$daftar_hari[date("l",strtotime(rtrim(odbc_result($result2,'Hari'))))],
            "Corporate"=>number_format(odbc_result($result2,'Corporate'),("Corporate" == "Corporate" ? 0 : 2), ',', ','),
            "Dealer"=>number_format(odbc_result($result2,'Dealer'),("Dealer" == "Dealer" ? 0 : 2), ',', ','),  
            "Depstore"=>number_format(odbc_result($result2,'Depstore'),("Depstore" == "Depstore" ? 0 : 2), ',', ','),
            "Store"=>number_format(odbc_result($result2,'Store'),("Store" == "Store" ? 0 : 2), ',', ','),
            "Users"=>number_format(odbc_result($result2,'Users'),("Users" == "Users" ? 0 : 2), ',', ','),
            "Online"=>number_format(odbc_result($result2,'Online'),("Online" == "Online" ? 0 : 2), ',', ','),
            "Total"=>number_format(odbc_result($result2,'Total'),("Total" == "Total" ? 0 : 2), ',', ','),
            "Accumulation"=>number_format(odbc_result($result2,'Accumulation'),("Accumulation" == "Accumulation" ? 0 : 2), ',', ','),
            "Current_day_targets"=>number_format(odbc_result($result2,'Current_day_targets'),("Current_day_targets" == "Current_day_targets" ? 0 : 2), ',', ','),
            "Achivement1"=>number_format(odbc_result($result2,'Achivement1'),2, '.', '.'),
            "Projection"=>number_format(odbc_result($result2,'Projection'),("Projection" == "Projection" ? 0 : 2), ',', ','),
            "Achivement2"=>number_format(odbc_result($result2,'Achivement2'),2, '.', '.'),
     
          ];
          
          }

          
        return $datadetail;

    }

    private function setbulanangka($bulan){

        switch ($bulan) {
                case 'January':
                    $bulan=1;
                    break;
                case "February" : 
                    $bulan=2;
                    break;
                  case "March" : 
                    $bulan= 3;
                    break;
                  case "April" : 
                    $bulan= 4;
                    break;
                  case "May" : 
                    $bulan= 5;
                    break;
                  case "June" : 
                    $bulan= 6 ;
                    break;
                  case "July" : 
                    $bulan= 7;
                    break;
                  case "August" : 
                    $bulan= 8;
                    break;
                  case "September": 
                    $bulan= 9;
                    break;
                  case "October" : 
                    $bulan=10;
                    break;
                  case "November" : 
                    $bulan= 11;
                    break;
                  case "December" : 
                    $bulan= 12;
                    break;
        }

        return $bulan;
    }
}