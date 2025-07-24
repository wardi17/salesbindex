<?php

class Database{
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbnm = DB_NAME;
	private $dbnm2 = DB_NAME2;
	private $dbh;
	private $dbh2;
	private $dbh3;
	private $stmt;

	public function __construct()
	{
		//$server ="(LOCAL)";
		$server="DESKTOP-1CEB0AJ\SQLEXPRESS";
		// $connection = odbc_connect("Driver={SQL Server};Server=DESKTOP-PUJ0GAQ\MSSQLSERVER2;Database=bambi-bmi;","sa","123456");
		// $this->dbh =$connection;
		$dsn = 'Driver={SQL Server};Driver={SQL Server};Server='.$server.';Database='. $this->dbnm;

		$dsn2 = 'Driver={SQL Server};Driver={SQL Server};Server='.$server.';Database='. $this->dbnm2;
	
	
		try{
			$this->dbh = odbc_connect($dsn,$this->user,$this->pass);
			$this->dbh2 = odbc_connect($dsn2,$this->user,$this->pass);
			//$this->dbh3 = odbc_connect($dsn3,$this->user,$this->pass);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}





	public function baca_sql($sql){

		$db =$this->dbh;
		$result = odbc_exec($db,$sql);
		return $result;
	
	}

	public function baca_sql2($sql){
	
		$db =$this->dbh;
		$result = odbc_exec($db,$sql);
		return $result;
	
	}


	
	public function baca_sql3($sql){
	
		$db3 =$this->dbh3;
		$result = odbc_exec($db3,$sql);
		return $result;
	
	}



}

