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
				<h2>Pristigli zahtevi od demonstratora</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
					<?php
					$upit=mysql_query("SELECT * from predmet_korisnik WHERE korisnikID='$korisnikID' ");
					
					while($row=mysql_fetch_array($upit)) {
					$predmetID=$row['predmetID'];
				
					$upit1=mysql_query("SELECT * FROM demo_predmet_prijava WHERE predmetID='$predmetID' AND prihvatio='0' AND aktivan='0' AND odbio='0'");
						while($row1=mysql_fetch_array($upit1)) {
						$demonstratorID=$row1['demonstratorID'];
						$demo_predmetID=$row1['demo_predmetID'];
						
							$upit2=mysql_query("SELECT * from predmet WHERE predmetID='$predmetID' ");
							$row2=mysql_fetch_array($upit2);
							
							$upit3=mysql_query("SELECT korisnikID from demonstrator WHERE demonstratorID='$demonstratorID' ");
							$row3=mysql_fetch_array($upit3);
							
							$korisnikID=$row3['korisnikID'];
						
							$upit4=mysql_query("SELECT ime,prezime from korisnik WHERE korisnikID='$korisnikID' ");
							$row4=mysql_fetch_array($upit4);
						
						//$num_rows2 = mysql_num_rows($upit2);

						/* for ($i=0; $i<$num_rows2; $i++) { 
								$result=mysql_fetch_assoc($upit2);  */?>
								
								<a href="prikaz_novih_zahteva_prof.php?id=<?php echo $row['predmetID'];?>&par=<?php echo $row1['demonstratorID'];?>&dp=<?php echo $row1['demo_predmetID'];?>">
								<?php
								echo $row2['naziv']." - ".$row4['ime']." ".$row4['prezime']."</br>";
								?> 
								</a>
								
						<?php
						}
					}
						
					?>
				</table>
				</form>
			</div>
		</div>
	</div>