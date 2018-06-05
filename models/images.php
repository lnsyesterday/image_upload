<?php 

require_once('./db.class.php');


class Images extends Database {

	public function create($title,$filename) {
		$sql = "INSERT INTO images (image, image_text)
			VALUES (?,?)";
		$this->query($sql);
		$par=array('ss',&$filename,&$title);
		$this->bind_parameters($par);		
		$this->execute();
		return $this->inserted_id();
	} 

	public function select($per_page, $skip) {
		 
		//Prepare the SQL Statement
		$sql = "SELECT  * FROM images
		ORDER BY id DESC
		LIMIT ? OFFSET ?
		";
				
		//Run the SQL
		$this->query($sql);
		$par=array('ii',&$per_page, &$skip);
		$this->bind_parameters($par);	
		$this->execute();
		return $this->loadRows();
	} 
	
	public function count() {
		 
		//Prepare the SQL Statement
		$sql = "SELECT Count(id) as count FROM images";
		//Run the SQL
		$this->query($sql);
		$this->execute();
		return $this->loadRows();
	} 

	
	public function select_one($image_id) {
		 
		//Prepare the SQL Statement
		$sql = "SELECT * FROM images
				WHERE id=?
		";
			//Run the SQL
		$this->query($sql);
		$par=array('i',&$image_id);
		$this->bind_parameters($par);
		$this->execute();
		return $this->loadRows();
	}
}
	