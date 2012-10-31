<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];
$lab_vezbeID=$_GET['id'];
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$cena_po_bodu=file_get_contents("$DOCUMENT_ROOT/../cena_po_bodu.txt");
$today = date("Y-m-d");    
?>

<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Obracun lab vezbe</h2><br/>
		
</div>
			<div class="forma_desno" >
				
				<table>
				
					<?php
					$upit0 =mysql_query("SELECT lv.od as od, 
												lv.do as do,
												lv.naziv as naziv,
												lv.datum as datum,
												s.aktivnost as aktivnost,
												s.koeficijent as koeficijent
										FROM lab_vezbe lv,
										sifarnik s
										WHERE lv.sifarnikID=s.sifarnikID
										AND lv.lab_vezbeID='$lab_vezbeID'");
					
					$row0=mysql_fetch_array($upit0);
					$do = strtotime($row0['do']);
					$od = strtotime($row0['od']);
					$koeficijent=$row0['koeficijent'];
					$trajanje_dezurstva=round(abs($do - $od) / 60,2);
							echo "<tr><td>Lab vezba: </td><td>".$row0['naziv']."</td></tr>";
							echo "<tr><td>Datum: </td><td>".$row0['datum']."</td></tr>";
							echo "<tr><td>Od: </td><td>".$row0['od']."</td></tr>";
							echo "<tr><td>Do: </td><td>".$row0['do']."</td></tr>";
							echo "<tr><td>Aktivnost: </td><td>".$row0['aktivnost']."</td></tr>";
							echo "<tr><td><br/></td></tr>";
							
							echo "<tr><td>Koeficijent: </td><td>".$koeficijent."</td></tr>";
							echo "<tr><td>Trajanje dezurstva: </td><td>".$trajanje_dezurstva." minuta"."</td></tr>";
							echo "<tr><td>Cena po bodu: </td><td>".$cena_po_bodu." din.</td></tr>";
							echo "<tr><td>Datum obracuna: </td><td>".$today."</td></tr>";
							echo "<tr><td><br/></td></tr>";
							
							echo "<tr><td>Formula: </td><td>"."(Trajanje dezurstva/45) * Koeficijent * Cena po bodu"."</td></tr>";
							echo "<tr><td>Formula: </td><td>(".$trajanje_dezurstva." min /45 min) * ".$koeficijent." * ".$cena_po_bodu." din.</td></tr>";
							$iznos=round((($trajanje_dezurstva/45)* $koeficijent* $cena_po_bodu),2);
							echo "<tr><td>Ukupno: </td><td>".$iznos." din.</td></tr>"; 
					//$upit0 =mysql_query("INSERT INTO honorar SET ");
							$upit1 =mysql_query("SELECT * FROM demo_lab WHERE lab_vezbeID='$lab_vezbeID' AND prisustvo='1' ");
							while ($row1=mysql_fetch_assoc($upit1)) { 
								$demonstratorID=$row1['demonstratorID'];
								//echo $demonstratorID;
								$upit2 =mysql_query("UPDATE demo_lab SET isplata='1' where demonstratorID='$demonstratorID'");
								$upit3 =mysql_query("INSERT INTO honorar (demonstratorID,lab_vezbeID, datum,iznos) VALUES ('$demonstratorID','$lab_vezbeID','$today','$iznos')");
							
							}
							

		

?>
	
				</table>
			
			</div>
		</div>
</div>
<?php


