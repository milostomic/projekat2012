<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];
$predmetID=$_GET['id'];
$demonstratorID=$_GET['par'];
$demo_predmetID=$_GET['dp'];
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
				<form name="forma"  action="prikaz_novih_zahteva_prof.php?id=<?php echo $predmetID;?>&par=<?php echo $demonstratorID;?>&dp=<?php echo $demo_predmetID;?>" method="POST">
				<table>
					<?php		
					$upit=mysql_query("SELECT * FROM demonstrator WHERE demonstratorID='$demonstratorID'");
					$row=mysql_fetch_array($upit);
					
					$k=$row['korisnikID'];
						
						$upit1=mysql_query("SELECT ime,prezime,email from korisnik WHERE korisnikID='$k' ");
						$row1=mysql_fetch_array($upit1);
					
							$upit2=mysql_query("SELECT * from predmet WHERE predmetID='$predmetID' ");
							$row2=mysql_fetch_array($upit2);
					
					echo "<tr><td>Predmet: </td><td>".$row2['naziv']."</td></tr>";
					echo "<tr><td>Semestar: </td><td>".$row2['semestar']."</td></tr>";
					echo "<tr><td>Skolska godina: </td><td>".$row2['godina_studija']."</td></tr>";
					
						echo "</table></br><strong>Student: </strong><table>";
						echo "<tr><td>Ime: </td><td>".$row1['ime']."</td></tr>";
						echo "<tr><td>Prezime: </td><td>".$row1['prezime']."</td></tr>";
						echo "<tr><td>e-mail: </td><td>".$row1['email']."</td></tr>";
						echo "<tr><td>Odsek: </td><td>".$row['odsek']."</td></tr>";
						echo "<tr><td>Godina: </td><td>".$row['godina_studija']."</td></tr>";
						echo "<tr><td>Prosek: </td><td>".$row['prosek']."</td></tr>";
					?>
					<tr>
						
						<td>
						 
						<input  type="submit" name="prihvatam" value="Prihvatam"></td>
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
$predmetID=$_GET['id'];
$demonstratorID=$_GET['par'];
$demo_predmetID=$_GET['dp'];
$god_studija=$row2['godina_studija'];
$ind=false;
if(isset($_POST['prihvatam'])){

/* echo $predmetID; */
	$ind=mysql_query("UPDATE demo_predmet_prijava SET prihvatio='1', aktivan='1',odbio='0' WHERE demo_predmetID='$demo_predmetID'");
	$ind1=mysql_query("INSERT INTO demo_istorija (demonstratorID,predmetID,godina_studija) VALUES ('$demonstratorID','$predmetID','$god_studija')");
	header("Location: novi_zahtevi_prof.php");
	}
else if(isset($_POST['ne_prihvatam'])){
	$ind=mysql_query("UPDATE demo_predmet_prijava SET prihvatio='0', aktivan='0',odbio='1' WHERE demo_predmetID='$demo_predmetID'");
	header("Location: novi_zahtevi_prof.php");
	}


?>