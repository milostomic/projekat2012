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
				<h2>Ponude za angazovanje</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
					<?php
					$upit=mysql_query("SELECT demonstratorID from demonstrator WHERE korisnikID='$korisnikID' ");
					$row=mysql_fetch_array($upit);

					$demonstratorID=$row['demonstratorID'];
					//echo $demonstratorID;
					$upit1=mysql_query("SELECT lab_vezbeID FROM demo_lab WHERE demonstratorID='$demonstratorID' AND ponuda='1' AND prihvatio='0' AND komentar='' AND isplata='0'");
					while ($row1=mysql_fetch_array($upit1)){
						$lab_vezbeID=$row1['lab_vezbeID'];
					//echo $lab_vezbeID;
						$upit2=mysql_query("SELECT predmetID FROM lab_vezbe WHERE lab_vezbeID='$lab_vezbeID'");
						$row2=mysql_fetch_array($upit2);
					
						$predmetID=$row2['predmetID'];
				//	echo $predmetID;
						$upit3=mysql_query("SELECT * FROM predmet WHERE predmetID='$predmetID'");
					$row3=mysql_fetch_array($upit3);			
		?>
							<a href="ponude_za_angazovanje.php?id=<?php echo $row3['predmetID'];?>&lab_id=<?php echo $lab_vezbeID;?>">
							<?php
							echo $row3['naziv'].", ".$row3['semestar'].", ".$row3['godina_studija']."</br>";
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