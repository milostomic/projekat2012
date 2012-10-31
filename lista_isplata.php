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
				<h2>Lista uplacenih honorara</h2><br/>
			</div>
			<div class="forma_desno" >
				<br/>
				<form   action="" method="POST">
				<input type="submit" name="prikazi_sve" value="Prikazi sve uplate"/>
				</form>
				<?php $upit1 =mysql_query("SELECT demonstratorID from demonstrator where korisnikID='$korisnikID'");
					  $row1=mysql_fetch_array($upit1);
					  $demonstratorID= $row1['demonstratorID']; ?>
				<?php if (isset($_REQUEST['prikazi_sve'])){?>
								<table border="1" style="border:solid;">
				<?php  $ukupno=0.00;
					  $upit2 =mysql_query("SELECT h.datum AS datum,
												  h.iznos AS iznos,
												  lv.naziv  AS naziv
											FROM honorar h,
											lab_vezbe lv
											WHERE h.demonstratorID='$demonstratorID'
											AND h.lab_vezbeID=lv.lab_vezbeID
											");
						echo "<tr><th>Lab vezba</th><th>Datum isplate</th><th>Iznos</th></tr>";
					  while ( $row2=mysql_fetch_array($upit2)){
						echo "<tr><td>".$row2['naziv']."</td><td>".$row2['datum']."</td><td>".$row2['iznos']." din.</td></tr>";
						$ukupno=($ukupno+$row2['iznos']);
						$formated = number_format($ukupno,2);
					  }
						echo "<tr><th colspan='2'>Ukupno</th><th>".number_format($ukupno,2)." din.</th></tr>";
				?>	
				</table>
			<?php	}?>
				___________________________________
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
					$ukupno_od_do=0;
					$upit3 =mysql_query("SELECT h.datum AS datum,
												  h.iznos AS iznos,
												  lv.naziv  AS naziv
											FROM honorar h,
											lab_vezbe lv
											WHERE h.demonstratorID='$demonstratorID'
											AND h.lab_vezbeID=lv.lab_vezbeID
											AND h.datum>='$od'
											AND h.datum<'$do'
											");?>
					<table border="1" style="border:solid;">
				<?php echo "<tr><th>Lab vezba</th><th>Datum isplate</th><th>Iznos</th></tr>";
					  while ( $row3=mysql_fetch_array($upit3)){
						echo "<tr><td>".$row3['naziv']."</td><td>".$row3['datum']."</td><td>".$row3['iznos']." din.</td></tr>";
						$ukupno_od_do=($ukupno_od_do+$row3['iznos']);
						$formated1 = number_format($ukupno_od_do,2);
					  }
						echo "<tr><td>Ukupno</th><td>   </td><th>".number_format($ukupno_od_do,2)." din.</th></tr>";
				?>	
				</table>
											
					<?php
					}
					
				?>
			
			</div>
		</div>
</div>