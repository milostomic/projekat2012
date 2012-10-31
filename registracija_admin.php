<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];		
$k=$_GET['id'];
?>

<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Novi korisnici</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="registracija_admin.php?id=<?php echo $k;?>" method="POST">
				<table>
				<?php
				$upit=mysql_query("SELECT * FROM korisnik WHERE korisnikID='$k'");
				$row=mysql_fetch_array($upit);
				
				echo "<tr><td>Ime: </td><td>".$row['ime']."</td></tr>";
				echo "<tr><td>Prezime: </td><td>".$row['prezime']."</td></tr>";
				echo "<tr><td>Telefon: </td><td>".$row['telefon']."</td></tr>";
				echo "<tr><td>e-mail: </td><td>".$row['email']."</td></tr>";
				
				$pravoID=$row['pravoID'];
						
				if ($pravoID==2){
					$upit1=mysql_query("SELECT zvanje FROM nastavnik WHERE korisnikID='$k'");
					$row1=mysql_fetch_array($upit1);
					echo "<tr><td>Zvanje: </td><td>".$row1['zvanje']."</td></tr>";
					}
				else if($pravoID==3){
					$upit1=mysql_query("SELECT * FROM demonstrator WHERE korisnikID='$k'");
					$row1=mysql_fetch_array($upit1);
					echo "<tr><td>Odsek: </td><td>".$row1['odsek']."</td></tr>";
					echo "<tr><td>Godina studija: </td><td>".$row1['godina_studija']."</td></tr>";
					echo "<tr><td>Prosek: </td><td>".$row1['prosek']."</td></tr>";
					}
				?>
				<tr>
					<td><input  type="submit" name="prihvati" value="Prihvati"></td>
					<td><input  type="submit" name="odbaci" value="Odbaci"></td>
				</tr>
				</table>
				</form>
			</div>
		</div>
</div>
<?php

if(isset($_POST['prihvati'])){
	$k=$_GET['id'];
	$ind=mysql_query("UPDATE korisnik SET zahtev='1' WHERE korisnikID='$k'");
	header("Location: zahtevi_za_registraciju.php");
	}
else if(isset($_POST['odbaci'])){
	$k=$_GET['id'];
	$ind=mysql_query("DELETE FROM korisnik WHERE korisnikID='$k'");
	header("Location: zahtevi_za_registraciju.php");
	}
?>
			