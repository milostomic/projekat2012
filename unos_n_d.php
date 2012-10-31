<?php
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
		
?>
<div class="sredina">	
<script type="text/javascript" src="js/validate_form.js"></script>
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Unos nastavnika/demonstratora</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" onsubmit="return validateForm()">
				<table>
					<tr>
						<td>Korisnicko ime: </td><td><input class="polja_forme" type="text" name="username"><br/></td>
					</tr>
					<tr>
						<td>Sifra: </td><td><input type="password" name="password"><br/> 
					</tr>
					<tr>
						<td>Ponovljena sifra: </td><td><input type="password" name="re_password"><br/></td>
					</tr>
					<tr>
						<td>Ime: </td><td><input type="text" name="ime"></td>
					</tr>
					<tr>
						<td>Prezime: </td><td><input type="text" name="prezime"></td>
					</tr>
					<tr>
						<td>Telefon: </td><td><input type="text" name="telefon"></td>
					</tr>
					<tr>
						<td>e-mail: </td><td><input type="text" name="email"></td>
					</tr>
					<tr>
						<td>Ja sam: </td><td><select name="pravoID" onchange="showUser(this.value)">
										
												<option value="">Odaberite</option>
												<option value="2"> Nastavnik</option>
												<option value="3">Demonstrator</option>
											</select></td>
						</tr>						
						
						<table id="txtHint" width="342"> </table>
												
						<tr>
							<td><input class="posalji" type="submit" name="posalji" value="Posalji"></td></br>
						</tr>
				</table>
				</form>
			</div>
		</div>
	</div>	
	
<?php

if(isset($_POST['posalji']))
	{
		if(isset($_POST['username']))
			$username = $_POST['username'];
		if(isset($_POST['password']))
			$password = $_POST['password'];
		if(isset($_POST['ime']))
			$ime = $_POST['ime'];
		if(isset($_POST['prezime']))
			$prezime = $_POST['prezime'];
		if(isset($_POST['telefon']))
			$telefon = $_POST['telefon'];
		if(isset($_POST['email']))
			$email = $_POST['email'];
		if(isset($_POST['pravoID']))
			$pravoID = $_POST['pravoID'];
		if(isset($_POST['zvanje']))
			$zvanje = $_POST['zvanje'];
		if(isset($_POST['odsek']))
			$odsek = $_POST['odsek'];
		if(isset($_POST['godina_studija']))
			$godina_studija = $_POST['godina_studija'];
		if(isset($_POST['prosek']))
			$prosek = $_POST['prosek'];
			
	$korisnik->dodaj($username,$password,$ime,$prezime,$telefon,$email,$pravoID);
		
	$korisnikID = mysql_insert_id();
	
	 switch ($pravoID) {
    case 2:
		$korisnik = new Korisnik($konekcija);
		$korisnik->dodaj_nastavnika($korisnikID, $zvanje);
	break;

	case 3:
		$korisnik = new Korisnik($konekcija);
		$korisnik->dodaj_demonstratora($korisnikID, $odsek, $godina_studija, $prosek);
	break;
	}

	header("Location: unos_n_d.php");
	}	
?>		
</center> 
</body>
