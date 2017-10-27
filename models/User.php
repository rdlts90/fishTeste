<?php

class User {
	
	private $dbh;
	
	public function __construct($host,$user,$pass,$db)	{		
		$this->dbh = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
			
	}

	public function getUsers(){				
		$sth = $this->dbh->prepare("SELECT * FROM users");
		$sth->execute();
		return json_encode($sth->fetchAll());
	}

	public function getColors($user){
		$userColor = json_decode($user);
			
		$sth = $this->dbh->prepare("SELECT * FROM cor
									WHERE user_id=".$userColor->id);
							
		$sth->execute();
		return json_encode($sth->fetchAll());
	}
	
	public function add($user){

		$sth = $this->dbh->prepare("INSERT INTO users(name, email, password) VALUES (?, ?, ?)");
		$sth->execute(array($user->name, $user->email, $user->password));	
	
		return json_encode($this->dbh->lastInsertId());
	}

	public function addColor($user){
		
		$sth2 = $this->dbh->prepare("INSERT INTO cor(nome,user_id) VALUES (?,?)");
		$sth2->execute(array($user->name,$user->idUser));	

		return json_encode($this->dbh->lastInsertId());
	}

	public function delete($user){				
	
		$sth = $this->dbh->prepare("DELETE FROM users WHERE id=?");
		$sth->execute(array($user->id));

		$sth = $this->dbh->prepare("DELETE FROM cor WHERE user_id=?");
		$sth->execute(array($user->id));
		return json_encode(1);
	}

	public function deleteColor($user){				
		print_r($user);
		$sth = $this->dbh->prepare("DELETE FROM cor WHERE user_id=? AND nome=?");
		$sth->execute(array($user->id,$user->name));
		return json_encode(1);
	}
	
	public function updateValue($user){		
	
		$sth = $this->dbh->prepare("UPDATE users SET ". $user->field ."=? WHERE id=?");
		$sth->execute(array($user->newvalue, $user->id));				
		return json_encode(1);	
	}
}
?>