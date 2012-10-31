<?php
class Korisnik
{
	private $konekcija;
	public function __construct($konekcija)
	{
		$this->konekcija=$konekcija;
	}
	
		public function dodaj($username,$password,$ime,$prezime,$telefon,$email,$pravoID)
	{
		try {
			$upit = "INSERT INTO korisnik (username,password,ime,prezime,telefon,email,pravoID) 
			values('".mysql_real_escape_string($username)."','".
			mysql_real_escape_string($password)."','".
			mysql_real_escape_string($ime)."','".
			mysql_real_escape_string($prezime)."','".
			mysql_real_escape_string($telefon)."','".
			mysql_real_escape_string($email)."','".
			mysql_real_escape_string($pravoID)."')";
			$this->konekcija->pokreniUpit($upit);
		}
		catch(Exception $e) {return $e->getMessage();}
		//return "Uspesno dodat korisnik.";
		
	}
	
		public function dodaj_nastavnika($korisnikID,$zvanje)
	{
		try {
		$korisnikID = mysql_insert_id();
			$upit = "INSERT INTO nastavnik (korisnikID,zvanje) 
			values('".mysql_real_escape_string($korisnikID)."','".
			mysql_real_escape_string($zvanje)."')";
			$this->konekcija->pokreniUpit($upit);
		}
		catch(Exception $e) {return $e->getMessage();}
		//return "Uspesno dodat nastavnik.";
	}
		
		public function dodaj_demonstratora($korisnikID, $odsek, $godina_studija, $prosek)
	{
		try {
		
			$upit = "INSERT INTO demonstrator (korisnikID,odsek,godina_studija,prosek) 
			values('".mysql_real_escape_string($korisnikID)."','".
			mysql_real_escape_string($odsek)."','".
			mysql_real_escape_string($godina_studija)."','".
			mysql_real_escape_string($prosek)."')";
			$this->konekcija->pokreniUpit($upit);
		}
		catch(Exception $e) {return $e->getMessage();}
		//return "Uspesno dodat demonstrator.";
	} 
	
	public function login($username, $password)
	{
		$upit = "SELECT username, password, korisnikID FROM korisnik WHERE username='$username' AND password='$password' AND zahtev='1'";
		$rezultat = $this->konekcija->getRecord($upit);
		if($rezultat!=NULL) return true;
		return false;
	}
	
	public function logout(){
        session_destroy();
        return;
    }
	
	public function change_password($username, $stari_password, $novi_password, $re_novi_password)
	{	
		$upit = "SELECT username, password, korisnikID FROM korisnik WHERE username='$username' AND password='$stari_password' ";
		$rezultat = $this->konekcija->getRecord($upit);
		if($rezultat!=NULL)
		{ 
			if($novi_password==$re_novi_password) 
			{
				if (($novi_password!=NULL) && ($re_novi_password!=NULL))
					{ 
						$upit = "UPDATE korisnik SET password='$novi_password' WHERE username='$username' AND password='$stari_password' ";
						$rezultat = mysql_query($upit);
						//echo $rezultat;
						if($rezultat != NULL) 
							return true;
						else "Doslo je do greske pri promeni šifre.";
					}
				else 
					echo "Polje za novu sifru ne moze biti prazno";
			}
			else 
				echo "Sifre se ne podudaraju.";
		}
		else 
			echo "Korisnik sa unetim podacima ne postoji.";
	}

	
	public function korisnikID($username, $password)
	{
		$upit = "SELECT korisnikID FROM korisnik WHERE username='$username' AND password='$password'";
		$korisnikID = $this->konekcija->getRecord($upit);
		
		echo $korisnikID; //echo "korisnikID je ".$korisnikID[0].'<br>';
		return $korisnikID[0];
	}
	
		public function pravo($korisnikID)
	{
		$upit = "SELECT pravoID FROM korisnik WHERE korisnikID=$korisnikID";
		$pravo = $this->konekcija->getRecord($upit);
	//	echo "Pravo je ".$pravo[0].'<br>';
		return $pravo[0];
	}
	
		public function unos_lab_vezbe($lab_vezba,$nastavnikID,$predmetID,$godina,$mesec,$dan,$sati_od,$min_od,$sati_do,$min_do,
										$sifarnikID,$laboratorija,$max_dezurnih)
	{
			$upit = "INSERT INTO lab_vezbe (nastavnikID,naziv,predmetID,datum,od,do,laboratorija,sifarnikID,max_dezurnih) 
			VALUES('$nastavnikID',
			'".mysql_real_escape_string($lab_vezba)."',
			'$predmetID',
			'".$godina."-".$mesec."-".$dan."',
			'".$sati_od.":".$min_od."',
			'".$sati_do.":".$min_do."',
			'".mysql_real_escape_string($laboratorija)."',
			'$sifarnikID',
			'".mysql_real_escape_string($max_dezurnih)."')";
			$result=mysql_query($upit);
		
		echo "Uspesno dodata lab vezba.";
		
	} 

	
		public function izmena_lab_vezbe($lab_vezbeID,$lab_vezba,$godina,$mesec,$dan,$sati_od,$min_od,$sati_do,$min_do,
											$sifarnikID,$laboratorija,$max_dezurnih)
	{
			$upit = "UPDATE lab_vezbe SET naziv='$lab_vezba',
			datum='".$godina."-".$mesec."-".$dan."',
			od='".$sati_od.":".$min_od."',
			do='".$sati_do.":".$min_do."',
			laboratorija='".mysql_real_escape_string($laboratorija)."',
			sifarnikID='$sifarnikID',
			max_dezurnih='".mysql_real_escape_string($max_dezurnih)."' 
			WHERE lab_vezbeID='$lab_vezbeID'";
			$result=mysql_query($upit);
	
		/* return "Uspesno izmenjena lab vezba."; */
	} 									
											
	
		public function unos_predmeta($naziv_predmeta,$sifra_predmeta,$semestar,$godina_studija)
	{
			$upit = "INSERT INTO predmet (naziv,sifra_predmeta,semestar,godina_studija) 
			VALUES('".mysql_real_escape_string($naziv_predmeta)."',
			'".mysql_real_escape_string($sifra_predmeta)."',
			'$semestar',
			'".mysql_real_escape_string($godina_studija)."')";
			$result=mysql_query($upit);
		
		//echo "Uspesno dodat predmet.";
	}

		public function unos_n_d($ime,$prezime,$telefon,$email)
	{
			$upit = "INSERT INTO korisnik (pravoID,ime,prezime,telefon,email) 
			VALUES('2',
			'".mysql_real_escape_string($ime)."',
			'".mysql_real_escape_string($prezime)."',
			'".mysql_real_escape_string($telefon)."',
			'".mysql_real_escape_string($email)."')";
			$result=mysql_query($upit);
		
		echo "Uspesno dodat profesor.";
	}

/*	
	public function brisi($id)
	{
		try {
			$upit = "delete from kupac where korisnikID=".$id;
			$this->konekcija->pokreniUpit($upit);
		}
		catch(Exception $e) {return $e->getMessage();}
		return "Uspesno obrisan korisnik.";
	}
	
	
	public function sviKorisnici()
	{
		$upit = "select * from kupac";
		$rezultat = $this->konekcija->getRecordSet($upit);
		if(!rezultat) throw Exception($this->konekcija->getError());
		return $rezultat;
	}
	public function vratiKorisnika($id)
	{
		 $upit = "SELECT * FROM kupac WHERE id=".$id;
		 $rezultat = $this->konekcija->getRecord($upit);
		 return $rezultat;
	}

	public function pravo($ime)
	{
		$upit = "select pravo from kupac where ime='".$ime."'";
		//echo $upit.'<br>';
		$pravo = $this->konekcija->getRecord($upit);
		echo "Pravo je ".$pravo[0].'<br>';
		return $pravo[0];
	}
	public function postaviPravo($pravo,$ime)
	{
		$upit = "update kupac set pravo=".$pravo." where ime='".$ime."'";
		mysql_query($upit);
	}   */
}
?>


