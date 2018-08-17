<?php
class DB_Config
{
	private $DB_SERVER='localhost';
	private $DB_DATABASE='achivia_live';
	private $DB_SERVER_USERNAME='achivia_inflexi';
	private $DB_SERVER_PASSWORD='Krs=sE[3+S+F';
	public $Connect;
	
	function __construct()
	{
		//$this->conn=mysql_pconnect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD);
		//$this->conn=mysql_select_db(DB_DATABASE,$this->conn);
		try{
			$this->Connect=new PDO('mysql:host='.$this->DB_SERVER.';dbname='.$this->DB_DATABASE.';charset=utf8' ,
									 $this->DB_SERVER_USERNAME , $this->DB_SERVER_PASSWORD ,
									 array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );
									 
		}catch(PDOException $e){
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
}
