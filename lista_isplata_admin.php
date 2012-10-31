<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];
?>
<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Lista isplata honorara demonstratorima</h2><br/>
			</div>
			<div class="forma_desno" >
				<br/>
				<p><b>Izaberite period za koji zelite prikaz isplata</b></p>
				<form   action="" method="POST">
				Od: <input type="date" name="od">
				Do: <input type="date" name="do">
				<input type="submit" name="prikazi" value="Prikazi"/>
				</form>
				
				<?php 
				if (isset($_REQUEST['prikazi'])){
					$od=$_POST['od'];
					$do=$_POST['do'];
				echo "Isplata za period od ".$od." do ".$do;
				echo "<br/>";
				echo "<br/>";
					$upit1 =mysql_query("SELECT DISTINCT demonstratorID FROM honorar");
				echo "<table border='1' style='border:solid;'>";
				echo "<tr><th>Demonstrator</th><th>Sumirani iznos</th></tr>";
					 while ( $row1=mysql_fetch_array($upit1)){	
							$demonstratorID=$row1['demonstratorID'];
							$ukupno_od_do=0.00;
							$upit2 =mysql_query("SELECT   h.iznos AS iznos,
												  k.ime  AS ime,
												  k.prezime AS prezime
											FROM honorar h,
											demonstrator d,
											korisnik k
											WHERE h.demonstratorID='$demonstratorID'
											AND h.demonstratorID=d.demonstratorID
											AND d.korisnikID=k.korisnikID
											AND h.datum>='$od'
											AND h.datum<'$do'
											");
							$num_rows2 = mysql_num_rows($upit2);
									$row2=mysql_fetch_array($upit2);			
							 	for ($i=0; $i<$num_rows2; $i++) { 
									$ukupno_od_do=($ukupno_od_do+$row2['iznos']);
									}
						 $formated1 = number_format($ukupno_od_do,2);
							echo "<tr><td>".$row2['ime']." ".$row2['prezime']."</td><td>".$formated1."</td></tr>";
					}
					
				?>
			</table>
			
			<?php echo "<br/>"; } ?>
			</div>
		</div>
</div>