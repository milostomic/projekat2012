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
				<h2>Prijava za predmet</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
					<tr>
						<td>Predmet: </td>
						<td>
							<?php
								$upit = mysql_query("SELECT * FROM predmet");
								while($row=mysql_fetch_array($upit)) { 	
							?>
							<input type="checkbox" name="predmet[]" value="<?php echo $row['predmetID'];?>" />
												<?php echo $row['naziv'].", ".$row['semestar'].", ".$row['godina_studija']; ?><br/>
							
							<?php }?>
						</td>
					</tr>
					<tr>
						<td><input  type="submit" name="prijavi_se" value="Prijavi se!"></td>
					</tr>
				</table >
			</div>
		</div>
</div>
		
<?php					
if (isset($_POST['prijavi_se'])){		

	//$predmetID=$_POST['predmet'];

	for($i=0;$i<count($_POST['predmet']);$i++){
				$predmetID=$_POST['predmet'][$i];
				$upit1=mysql_query("SELECT demonstratorID FROM demonstrator WHERE korisnikID='$korisnikID'");
				$row1=mysql_fetch_array($upit1);
				$a=$row1['demonstratorID'];
				mysql_query("INSERT INTO demo_predmet_prijava (demonstratorID,predmetID,prihvatio,aktivan) 
							VALUES ('$a','$predmetID','0','0')");
				}								
											
	echo "Uspesno uspesno ste se prijavili za predmet.";
	header("Location: prijava_za_predmet.php"); 
	
	
	
}
?>			