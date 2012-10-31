<?php 
require_once 'header.php'; 
require_once 'konekcija.php';
require_once 'korisnik.php';
require_once 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];

$upit=mysql_query("SELECT username,password FROM korisnik WHERE korisnikID='$korisnikID'");
$row=mysql_fetch_array($upit);
?>
<div class="sredina">	
	<div class="levo ">
		<?php require ('levi_meni.php'); ?>
	</div>
	<div class="desno">
		
		<div class="naziv">
			<h2> Promena šifre</h2>
		</div>
		<div class="forma_centar">
			<form name="forma"  method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<table class="osnovna_tabela">
				<tr>
					<td>Korisničko ime: </td><td><input class="polja_forme" type="text" name="username" value="<?php echo $row['username'];?>"><br/></td>
				</tr>
				<tr>
					<td>Stara šifra: </td><td><input type="password" name="stari_password" value="<?php echo $row['password'];?>"><br/>
				</tr>
				<tr>
					<td>Nova šifra: </td><td><input type="password" name="novi_password"><br/> 
				</tr>
				<tr>
					<td>Ponovljena nova šifra: </td><td><input type="password" name="re_novi_password"><br/>
				</tr>			
				<tr>
					<td><input class="posalji" type="submit" name="posalji" value="Pošalji"></td>
				</tr>
				<tr>
					<td><a href="login.php">Login</a></td>
				</tr>
			</table>
			</form>
		</div>
<?php
$ind = false;
if(isset($_POST['posalji'])){ 
		$username=($_POST['username']); 
		$stari_password=($_POST['stari_password']); 
		$novi_password=($_POST['novi_password']); 
		$re_novi_password=($_POST['re_novi_password']); 
		$ind = $korisnik->change_password($username, $stari_password, $novi_password, $re_novi_password); 
		if($ind != NULL) echo "Uspešno ste promenili šifru";
		//header("Location: login.php"); 
	}
	

?>
	</div>
	
</div> 	
<br/>	

</div>
</center> 
</body>
