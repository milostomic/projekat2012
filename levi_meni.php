<ul class='css_vertical_menu'>
	<?php if(isset($_SESSION['korisnikID'])){ 
		$korisnikID =$_SESSION['korisnikID'];
		$pravo = $korisnik->pravo($korisnikID); ?>
			<li><a href="user_strana.php">Početna</a></li>
			<li><a href="promena_sifre.php">Promeni šifru</a></li> 
			<?php 
				if($pravo==1){ //ako je ulogovani korisnik administrator imace sledece opcije
					echo '<li><a href="unos_n_d.php?pravo=1">Unos nastavnika/demonstratora</a></li>
						<li><a href="unos_predmeta.php">Unos predmeta</a></li>
						<li><a href="obracun_izvestaja.php">Obračun izveštaja</a></li>
						<li><a href="lista_isplata_admin.php">Lista isplata honorara</a></li>
						<li><a href="zahtevi_za_registraciju.php">Zahtevi za registraciju</a></li>';
						}
				if($pravo==2){ //ako je ulogovani korisnik nastavnik imace sledece opcije
					echo '<li><a href="pregled_demo.php">Pregled demonstratora</a></li>
						<li><a href="lab_vezbe_unos.php">Lab vežbe</a></li>
						<li><a href="lab_vezbe.php">Izmena i zaključavanje lab vežbi</a></li>
						<li><a href="pregled_zakljucanih_lab.php">Pregled zaključanih lab vežbi</a></li>
						<li><a href="novi_zahtevi_prof.php">Novi zahtevi od demonstratora</a></li>';
						}
				if($pravo==3){ //ako je ulogovani korisnik demonstrator imace sledece opcije
					echo '<li><a href="demo_info.php">Info</a></li>
						<li><a href="ponude_lab_demo.php">Ponude za angažovanje</a></li>
						<li><a href="lista_isplata.php">Lista isplata honorara</a></li>
						<li><a href="lista_angazovanja.php">Lista angažovanja</a></li>
						<li><a href="prijava_za_predmet.php">Prijava za predmete</a></li>';
						}
	}	
?>	
</ul>