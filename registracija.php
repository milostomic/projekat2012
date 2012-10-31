<?php
	include("header.php");
?>

<div class="sredina">
<script type="text/javascript" src="js/validate_form.js"></script>
		<div class="centar">
	
			<div class="naziv">
			 <h2> Registracija korisnika</h2>
			</div>
			<div class="forma_centar">
				<form name="forma"  method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()">
					<table class="osnovna_tabela">
						<tr>
							<td>Korisničko ime: </td><td><input class="polja_forme" type="text" name="username"><br/></td>
						</tr>
						<tr>
							<td>Šifra: </td><td><input type="password" name="password"><br/></td>
						</tr>
						<tr>
							<td>Ponovljena šifra: </td><td><input type="password" name="re_password"><br/></td>
						</tr>
						<tr>
							<td>Ime: </td><td><input type="text" name="ime"><br/></td>
						</tr>
						<tr>
							<td>Prezime: </td><td><input type="text" name="prezime"><br/></td>
						</tr>
						<tr>
							<td>Telefon: </td><td><input type="text" name="telefon"><br/></td>
						</tr>
						<tr>
							<td>email: </td><td><input type="text" name="email"><br/></td>
						</tr>
						<br/>

						<tr>
							<td>Ja sam: </td><td><select name="pravoID" onchange="showUser(this.value)">
										
													<option value="">Odaberite</option>
													<option value="2">Nastavnik</option>
													<option value="3">Demonstrator</option>
												</select></td>
						</tr>						
						
						<table id="txtHint" width="342"> </table>
												
						<tr>
							<td><input class="posalji" type="submit" name="posalji" value="Pošalji"></td></br>
						</tr>
						</br>
						<tr>
							<td><a href="login.php">Login</a></td>
						</tr>
					</table>
					
				</form>
			</div>
		
		</div>
	
</div> 	
<br/>	

</div>

<?php	
	require_once 'konekcija.php';
	require_once 'korisnik.php';
	require_once 'config.php';
	if(isset($_POST['posalji'])){
	
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
			$email=$_POST['email'];
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
	
		$konekcija = new Konekcija (DB_HOST, DB_NAME, DB_USER, DB_PASS);
		$korisnik = new Korisnik($konekcija);
		$korisnik->dodaj($username,$password,$ime,$prezime,$telefon,$email,$pravoID);
		
	$korisnikID = mysql_insert_id();
	
	//echo "ovo je idkorisnik $korisnikID"; 

	 switch ($pravoID) {
    case 2:
		$korisnik = new Korisnik($konekcija);
		echo $korisnik->dodaj_nastavnika($korisnikID, $zvanje);
	break;

	case 3:
		$korisnik = new Korisnik($konekcija);
		echo $korisnik->dodaj_demonstratora($korisnikID, $odsek, $godina_studija, $prosek);
	break;
	}
header ("Location: registracija.php");
}
?>
</center> 
</body>