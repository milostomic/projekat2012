<?php
	class Konekcija
	{
		private $veza;
		private $error;
		public function __construct($host,$baza,$ime,$lozinka)
		{
			$this->veza=mysql_connect($host,$ime,$lozinka)or die("Ne mozete da se konektujete"); // povezivanje na server
			$sel = mysql_select_db($baza);
		}
		
	
	//f-ja getRecord($upit) koja vraca samo 1 row
	public function getRecord($upit)
	{
		$result = mysql_query($upit);
		$num_rows = mysql_num_rows($result);
		//if(!$result) { $this->error=mysql_error(); return 0;}
		//else $red = mysql_fetch_row($result); // sada se rezultat stavlja u numericki niz
		if($num_rows == 0)
		{
			$this->error=mysql_error(); 
			return NULL;
		}
		else 
		{
			$red = mysql_fetch_row($result);
		//	echo $red;
		}
		foreach($red as $value)  
		{
	//	echo $value.' ';			
		}
                echo '<br />';
		return $red;
	}
	
	public function getRecord1($upit)
	{
		$result = mysql_query($upit);
		if($result) $object = mysql_fetch_object($result);
		//echo $object->ime.' ';
		//echo $object->adresa.' ';
		//echo $object->grad.'<br>';
		return object;
	}
	
	public function close()
	{
		if (!$this->veza) 
		{
    		die('Could not connect: '. mysql_error());
		}
		echo 'Connected successfully';
		mysql_close($veza);
	}
	
	public function getError()
	{
		return $this->error;
	}
	
			public function getRecordSet($upit)
	{
		$niz = array();
		$result = mysql_query($upit); 
	    if(!$result) { $this->error=mysql_error(); return 0;}
		while($row =  mysql_fetch_assoc($result)) // isto radi i mysql_fetch_array($result)
		{
			$niz[] = $row; // svaki clan niza je vrsta iz tabele odnosno asocijativni niz
			//echo $row['korisnikID'].' ';
			//echo $row['ime'].' ';
			//echo $row['adresa'].' ';
			//echo $row['grad'].'<br />';
		}
		/*foreach($niz as $value)  //ispis vrsta tabele preko foreach
		{
			echo $value['korisnikID'].' ';
			echo $value['ime'].' ';
			echo $value['adresa'].' ';
			echo $value['grad'].'<br />';
		}*/
		return $niz;
	}
		public function pokreniUpit($upit)
	{
		//echo "<br /> $upit<br />";
		$rezultat=mysql_query($upit); // or die(mysql_error());
		//echo "<br />Rezultat je: $rezultat<br />"; // ispis upita zbog provere njegove ispravnosti
		if(!$rezultat) throw Exception("Greska!!!"); // primer bacanja izuzetka
	}

}
	
	
?>
