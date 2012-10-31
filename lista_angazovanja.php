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
				<h2>Lista angazovanja</h2><br/>
			</div>
			<div class="forma_desno" >
				<br/>
				<?php $upit1 =mysql_query("SELECT demonstratorID from demonstrator where korisnikID='$korisnikID'");
					  $row1=mysql_fetch_array($upit1);
					  $demonstratorID= $row1['demonstratorID']; ?>
				<table border="1" style="border:solid;">
				<?php 
					  $upit2 =mysql_query("SELECT dl.isplata as isplata,
												lv.naziv as naziv_l,
												lv.datum as datum,
												p.naziv as naziv_p,
												lv.lab_vezbeID as lab_vezbeID
											FROM demo_lab dl,
												lab_vezbe lv,
												predmet p
											WHERE dl.prisustvo='1'
												AND dl.demonstratorID='$demonstratorID'
												AND dl.lab_vezbeID=lv.lab_vezbeID
												AND p.predmetID=lv.predmetID");
						echo "<tr><th>Predmet</th><th>Lab vezba</th><th>Datum</th><th>Izvrsena uplata</th><th>Datum uplate</th></tr>";
						while($row2=mysql_fetch_array($upit2)){
								$lab_vezbeID=$row2['lab_vezbeID'];
									if($row2['isplata']=='0'){
										$i='NE';
										$datum_isplate='';
										}
									else{ 	
										$i='DA' ;
										$upit3 ="SELECT * FROM honorar WHERE demonstratorID='$demonstratorID' AND lab_vezbeID='$lab_vezbeID' ";
										$result3=mysql_query($upit3);
										$row3=mysql_fetch_assoc($result3);

										$datum_isplate=$row3['datum'];
										//echo $datum_isplate;
										}
						echo "<tr><td>".$row2['naziv_p']."</td><td>".$row2['naziv_l']."</td><td>".$row2['datum']."</td><td>".$i."</td><td>".$datum_isplate."</td></tr>";
			
					  }
			
				?>	
				</table>
			
			
			</div>
		</div>
</div>
<?php