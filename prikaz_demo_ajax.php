<?php
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
		
$q=$_GET['q'];

$upit=mysql_query("SELECT k.ime as ime,
						k.prezime as prezime,
						k.telefon as telefon,
						k.email as email,
						d.demonstratorID as demonstratorID,
						d.odsek as odsek,
						d.godina_studija as godina_studija,
						d.prosek as prosek
					FROM korisnik k,
					demonstrator d
					WHERE k.korisnikID=d.korisnikID
					AND k.korisnikID='$q'");

		
								
while($row=mysql_fetch_array($upit)){
	
echo "</br><table>";
	echo "<tr><td>Ime: </td><td>".$row['ime']."</td></tr>";
	echo "<tr><td>Prezime: </td><td>".$row['prezime']."</td></tr>";
	echo "<tr><td>Telefon: </td><td>".$row['telefon']."</td></tr>";
	echo "<tr><td>e-mail: </td><td>".$row['email']."</td></tr>";
	echo "<tr><td>Odsek: </td><td>".$row['odsek']."</td></tr>";
	echo "<tr><td>Godina studija: </td><td>".$row['godina_studija']."</td></tr>";
	echo "<tr><td>Prosek: </td><td>".$row['prosek']."</td></tr>";
echo "</table>"; 

$demonstratorID=$row['demonstratorID'];
	$upit1=mysql_query("SELECT p.naziv as naziv,
					p.sifra_predmeta as sifra_predmeta,
					p.godina_studija as godina_studija,
					p.semestar as semestar
					FROM demo_istorija di,
					predmet p
					WHERE di.predmetID=p.predmetID
					AND di.demonstratorID='$demonstratorID'");	
	echo "</br><strong>Angazovan na:</strong></br>";
	
	echo "<table border='1' style='border:solid;'>";
	echo "<tr><th>Predmet</th><th>Sifra predmeta</th><th>Semestar</th><th>Skolska godina</th></tr>";
	
	while($row1=mysql_fetch_array($upit1)){	
	
	echo "<tr><td>".$row1['naziv']."</td><td>".$row1['sifra_predmeta']."</td>
		<td>".$row1['semestar']."</td><td>".$row1['godina_studija']."</td></tr>";
	
	/* echo "</br><table>";
		echo "<tr><td>Predmet: </td><td>".$row1['naziv']."</td></tr>";
		echo "<tr><td>Sifra predmeta: </td><td>".$row1['sifra_predmeta']."</td></tr>";
		echo "<tr><td>Semestar: </td><td>".$row1['semestar']."</td></tr>";
		echo "<tr><td>Skolska godina: </td><td>".$row1['godina_studija']."</td></tr>";
	echo "</table></br>";  */
	
	echo "</br>";
	}
}
?>