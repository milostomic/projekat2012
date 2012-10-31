<?php require_once 'header.php';?>
<body>
<div id="fb-root"></div>
<script>
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '458907600814256', // App ID
      channelUrl : 'https://github.com/milostomic/app/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here

  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>
	<div class="sredina">	

		<div class="centar">
	
			<div class="naziv">
			 <h2> Login</h2>
			</div>
			<div class="forma_centar">
				<form name="forma"  method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<table class="osnovna_tabela">
						<tr>
							<td>Korisničko ime: </td><td><input class="polja_forme" type="text" name="username"><br/></td>
						</tr>
						<tr>
							<td>Šifra: </td><td><input type="password" name="password"><br/> 
						</tr>
										
						<tr>
							<td><input class="posalji" type="submit" name="posalji" value="Pošalji"></td>
						</tr>
						<tr>
							<td><a href="registracija.php">Registruj se</a></td>
						</tr>
					</table>
				</form>
			</div>
<?php
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija=new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik=new Korisnik($konekcija);
$ind=false;
if(isset($_POST['username']) && isset($_POST['password'])){
		$username=mysql_real_escape_string($_POST['username']); 
		$password=mysql_real_escape_string($_POST['password']); 
		$ind=$korisnik->login($username, $password); 
			if($ind==NULL){
				echo "Korisnik sa tim imenom ili sifrom ne postoji.</br>";
				echo "(Postoji mogucnost da Vas zahtev nije odobren. Molimo Vas pokusajte kasnije.)";
				}
			else{
				$korisnikID=$korisnik->korisnikID($username, $password); 
				//echo $korisnikID;
				$_SESSION['username']=$username; 
				$_SESSION['korisnikID']=$korisnikID; 
				header("Location: user_strana.php"); 
				} 
}

?>
		</div>
	
</div> 	
<br/>	

</div>
</center> 
</body>


