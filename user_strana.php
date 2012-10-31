<?php 
require 'header.php';
require ('konekcija.php');
require ('korisnik.php');
require ('config.php');
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);	
?>
<div class="sredina">	
		<div class="levo ">
			<?php require ('levi_meni.php'); ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
			 <h2> Dobro došli!</h2>
			 <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			</div>
			<div class="forma_desno">

			</div>

		</div>
	
</div> 	
<br/>	

</div>
</center> 
</body>
