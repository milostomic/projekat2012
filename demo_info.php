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
				<h2>Info</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
			
				<?php
				
				$upit = ("SELECT * FROM demonstrator WHERE korisnikID='$korisnikID'");
					$result=mysql_query($upit);
					$row=mysql_fetch_assoc($result); 
							
							
						$a=("SELECT ime,prezime FROM korisnik WHERE korisnikID='$korisnikID'");
						$result_a=mysql_query($a);
						$row_a=mysql_fetch_assoc($result_a);	
							
							echo "<tr><td>Ime: </td><td>".$row_a['ime']."</td></tr>";
							echo "<tr><td>Prezime: </td><td>".$row_a['prezime']."</td></tr>";
							echo "<tr><td>Odsek: </td><td>".$row['odsek']."</td></tr>";
							echo "<tr><td>Godina studija: </td><td>".$row['godina_studija']."</td></tr>";
							echo "<tr><td>Prosek: </td><td>".$row['prosek']."</td></tr>";
				
				echo "</table></br><strong>Angazovan na: </strong></br>";
				
				echo "<table border='1' style='border:solid;'>";
	echo "<tr><th>Predmet</th><th>Sifra predmeta</th><th>Semestar</th><th>Skolska godina</th></tr>";	
				
				$demonstratorID=$row['demonstratorID'];	
				
				$b=("SELECT predmetID FROM demo_istorija WHERE demonstratorID='$demonstratorID'");
				$result_b=mysql_query($b);
					
					while($row_b=mysql_fetch_assoc($result_b)){
					
					$predmetID=$row_b['predmetID'];
				
					$c=("SELECT * FROM predmet WHERE predmetID='$predmetID'");
						$result_c=mysql_query($c);
						$row_c=mysql_fetch_assoc($result_c); 
							
						echo "<tr><td>".$row_c['naziv']."</td><td>".$row_c['sifra_predmeta']."</td>
						<td>".$row_c['semestar']."</td><td>".$row_c['godina_studija']."</td></tr>";
							
							//echo "<tr><td>Predmet: </td><td>".$row_c['naziv']."</td></tr>";
							//echo "<tr><td>Sifra predmeta: </td><td>".$row_c['sifra_predmeta']."</td></tr>";
							//echo "<tr><td>Semestar: </td><td>".$row_c['semestar']."</td></tr>";
							//echo "<tr><td>Skolska godina: </td><td>".$row_c['godina_studija']."</td></tr>";
							echo "</br>";
					}						 
									//echo "<tr><td>Predmet: </td><td><strong>".$row_a['naziv'].", ".$row_a['sifra_predmeta']."</strong></td></tr>";
?>			
						</table></br>
					</form>
			</div>
		</div>
</div>