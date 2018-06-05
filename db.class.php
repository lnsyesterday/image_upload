<?php
class Database {
	private $host;
	private $user;
	private $password;
	private $rows;
	private $results = array ();	
	private $dbName;
	private $isReady;
	public $stmt;
	public $mysqli;
	
	public function __construct() { 		
		$this->result = null;
		$this->isReady = false;
		
		//Initiate Database
		$this->initiate('localhost', 'root', 'NeverNoticeNothing', 'image_upload');
			 
		//Connect to Database
		$this->connect();	
	}
	
	/* Setters */
	public function setHost($host){ $this->host = $host; }
	public function setUser($user){ $this->user = $user; }
	public function setPassword($password){ $this->password = $password; }
	public function setDbName($dbName){ $this->dbName = $dbName; }

	/* Interface functions */
	public function initiate($host=null,$user=null,$password=null,$dbName=null) {
		if(isset($host,$user,$password,$dbName)==false) {
			die("Please provide require settings to log to database.");
		}
		$this->setHost($host);
		$this->setUser($user);
		$this->setPassword($password);
		$this->setDbName($dbName);
		$this->isReady = true;
	}
	
	public function connect() {
		if($this->isReady==false) {
			die("Not ready to connect, please initiate connection");
		}
		$this->mysqli = new mysqli($this->host,$this->user,  $this->password,$this->dbName) or die('There was a problem connecting to the database');
		if(mysqli_connect_errno()) {
		  echo "Connection Failed: " . mysqli_connect_errno();
		  exit();
	   }
	}	


	public function bind_parameters($values){
		call_user_func_array(array($this->stmt, 'bind_param'), $values);	
	}
		
	public function execute(){
		return $this->stmt->execute();
	}	
	public function inserted_id(){
		return  $this->stmt->insert_id;
	}
	public function query($sql){
		$this->results=NULL;
		$this->stmt=$this->mysqli->prepare($sql) or die('Problem preparing query'); 
	}
	public function loadRows(){
		$parameters=array();
		$meta=$this->stmt->result_metadata();
		while($field=$meta->fetch_field()){
			$parameters[] = &$row[$field->name];
		}
		
		call_user_func_array(array($this->stmt, 'bind_result'), $parameters);	
		while($this->stmt->fetch()){
			$x = array();
			foreach($row as $key => $val){
				$x[$key]=$val;
					
			}
			$this->results[]=$x;
		}
		
		if(count($this->results)==0){
		$this->results=FALSE;
		}
		else{		
		return $this->results;
		}
	}
	public function countRows() {
		return count($this->results);
	}

} // End of Database class
?>