<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];
$predmetID=$_GET['id'];
$lab_vezbeID=$_GET['lab_id'];

?>
<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Ponuda za angazovanje</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="ponude_za_angazovanje.php?lab_id=<?php echo $lab_vezbeID;?>" method="POST">
				<table>
					<?php
					$upit0=mysql_query("SELECT * FROM predmet WHERE predmetID='$predmetID'");
					$row0=mysql_fetch_array($upit0);
					
					echo "<tr><td>Predmet: </td><td>".$row0['naziv']."</td></tr>";
					
					
					$upit=mysql_query("SELECT demonstratorID from demonstrator WHERE korisnikID='$korisnikID' ");
					$row=mysql_fetch_array($upit);

					$demonstratorID=$row['demonstratorID'];

					/* $upit2=mysql_query("SELECT * from demo_lab WHERE demonstratorID='$demonstratorID' AND ponuda='1' AND prihvatio='0' AND komentar=''");
					$row2=mysql_fetch_array($upit2);

					$lab_vezbeID=$row2['lab_vezbeID']; */

					$upit3=mysql_query("SELECT * from lab_vezbe WHERE lab_vezbeID='$lab_vezbeID'");
					$row3=mysql_fetch_array($upit3);

					//echo "<tr><td>Predmet: </td><td><strong>".$row3['naziv'].", ".$row3['sifra_predmeta']."</strong></td></tr>";
					echo "<tr><td>Lab vezba: </td><td>".$row3['naziv']."</td></tr>";
					echo "<tr><td>Datum: </td><td>".$row3['datum']."</td></tr>";
					echo "<tr><td>Od: </td><td>".$row3['od']."</td></tr>";
					echo "<tr><td>Do: </td><td>".$row3['do']."</td></tr>";
					echo "<tr><td>Laboratorija: </td><td>".$row3['laboratorija']."</td></tr>";

					$sifarnikID=$row3['sifarnikID'];

					$upit4=mysql_query("SELECT aktivnost from sifarnik WHERE sifarnikID='$sifarnikID'");
					$row4=mysql_fetch_array($upit4);
												
					echo "<tr><td>Aktivnost: </td><td>".$row4['aktivnost']."</td></tr>";
					?>
					<tr>
						<td><input  type="submit" name="prihvatam" value="Prihvatam"></td>
					</tr>
					
					<tr>
						<td colspan="2">Razlog zbog koga ne prihvatate? </td></tr>
					<tr><td colspan="2"><textarea type="text" name="komentar" maxlength="160" rows="5" cols="40" ></textarea></td><br/>
					</tr>
					<tr>
						<td><input  type="submit" name="ne_prihvatam" value="Ne prihvatam"></td>
					</tr>
				</table>
				</form>
			</div>
		</div>
</div>		
<?php
//if (isset($_POST['posalji'])){
if(isset($_POST['prihvatam'])){
$lab_vezbeID=$_GET['lab_id'];
//echo $lab_vezbeID;
	$ind=mysql_query("UPDATE demo_lab SET prihvatio='1', komentar='' WHERE lab_vezbeID='$lab_vezbeID' AND demonstratorID='$demonstratorID'");
	header("Location: ponude_lab_demo.php");
	}
else if(isset($_POST['ne_prihvatam'])){
	$lab_vezbeID=$_GET['lab_id'];
	$komentar=$_POST['komentar'];
	$par=mysql_query("UPDATE demo_lab SET prihvatio='0', komentar='$komentar' WHERE lab_vezbeID='$lab_vezbeID' AND demonstratorID='$demonstratorID'");
	header("Location: ponude_lab_demo.php");
	}


?>