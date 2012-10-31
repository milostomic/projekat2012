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
				<h2>Novi korisnici</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
				<?php
					$upit=mysql_query("SELECT korisnikID,ime,prezime from korisnik WHERE zahtev='0'");
					
					
					while ($row=mysql_fetch_array($upit)){
					$k=$row['korisnikID'];
				?>
							<a href="registracija_admin.php?id=<?php echo $k;?>">
							<?php
							echo $row['ime']." ".$row['prezime']."</br>";
							?> 
							</a>
					<?php
						}
					?>
				</table>
				</form>
			</div>
		</div>
</div>