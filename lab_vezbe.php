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
				<h2>Lab vezbe</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
					<?php
					$upit0 =mysql_query("SELECT predmetID FROM predmet_korisnik WHERE korisnikID='$korisnikID'");
					
					
					while($result0=mysql_fetch_array($upit0)) {
					$predmetID=$result0['predmetID'];
					
					$upit = mysql_query("SELECT lab_vezbeID,naziv FROM lab_vezbe WHERE zakljucano='0' AND predmetID='$predmetID'");
					
					$num_rows = mysql_num_rows($upit);
					
					
					
						for ($i=0; $i<$num_rows; $i++) { 
								$row=mysql_fetch_assoc($upit); ?>
								
								<a href="lab_vezbe_prikaz.php?id=<?php echo $row['lab_vezbeID'];?>&par=<?php echo $result0['predmetID'];?>">
								<?php
								echo $row['naziv']."</br>";
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