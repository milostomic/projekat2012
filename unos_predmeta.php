<?php
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
		
?>
<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Unos predmeta</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
					<tr>
						<td>Naziv: </td><td><input type="text" name="naziv_predmeta"></td>
					</tr>
					<tr>
						<td>Sifra: </td><td><input type="text" name="sifra_predmeta"></td>
					</tr>
					<tr>
						<td>Semestar: </td><td><select name="semestar">
												<option value="zimski">zimski</option>
												<option value="letnji">letnji</option>
											   </select>
											</td>
					</tr>
					<tr>
						<td>Skolska godina: </td><td><input type="text" name="godina_studija"></td>
					</tr>
					<tr>
					<td>Nastavnici: </br></td>
						<td>
						<?php
								$upit = mysql_query("SELECT * FROM korisnik WHERE pravoID='2'");
								while($row=mysql_fetch_array($upit)) { 	
							?>
							<input type="checkbox" name="nastavnik[]" value="<?php echo $row['korisnikID'];?>" />
												<?php echo $row['ime']." ".$row['prezime']; ?><br/>
						   <?php }?>
						</td>
					</tr>
					
					<tr>
						<td><input  type="submit" name="unesi" value="Unesi"></td>
					</tr>
						
				</table>
				</form>
			
	
<?php

if (isset($_POST['unesi'])){

	$naziv_predmeta=$_POST['naziv_predmeta']; 
	$sifra_predmeta=$_POST['sifra_predmeta']; 
	$semestar=$_POST['semestar'];
	$godina_studija=$_POST['godina_studija'];
	if (($naziv_predmeta == '') || ($sifra_predmeta == '') || ($godina_studija == '')) 
	echo "Niste uneli sve detalje!";
	
else{	
	$ind=$korisnik->unos_predmeta($naziv_predmeta,$sifra_predmeta,$semestar,$godina_studija);	
	
	$predmetID=mysql_insert_id();	
				
				for($i=0;$i<count($_POST['nastavnik']);$i++){
				$korisnikID=$_POST['nastavnik'][$i];
				$a=mysql_query("INSERT INTO predmet_korisnik (predmetID,korisnikID) VALUES ('$predmetID','$korisnikID')");
				}
	
	echo "Uspesno dodat predmet.";
	header("Location: unos_predmeta.php"); 
	}
}
?>		
			</div>
		</div>
</div>	