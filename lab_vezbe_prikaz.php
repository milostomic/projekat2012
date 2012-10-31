<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];		
$lab_vezbeID=$_GET['id'];
$predmetID=$_GET['par'];
?>




<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Lab vezba</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="lab_vezbe_prikaz.php?id=<?php echo $lab_vezbeID;?>&par=<?php echo $predmetID;?>" method="POST">
				<table>
				<?php
					$upit = ("SELECT * FROM lab_vezbe WHERE lab_vezbeID='$lab_vezbeID'");
					$result=mysql_query($upit);

				
							$row=mysql_fetch_assoc($result); 
							
							//$predmetID=$row['predmetID'];
							$a=("SELECT naziv,sifra_predmeta FROM predmet WHERE predmetID='$predmetID'");
							$result_a=mysql_query($a);
				
								
									$row_a=mysql_fetch_assoc($result_a); 
									echo "<tr><td>Predmet: </td><td><strong>".$row_a['naziv'].", ".$row_a['sifra_predmeta']."</strong></td></tr>";
								
							
							echo "<tr><td>Lab vezba: </td><td>".$row['naziv']."</td></tr>";
							echo "<tr><td>Datum: </td><td>".$row['datum']."</td></tr>";
							echo "<tr><td>Od: </td><td>".$row['od']."</td></tr>";
							echo "<tr><td>Do: </td><td>".$row['do']."</td></tr>";
							echo "<tr><td>Laboratorija: </td><td>".$row['laboratorija']."</td></tr>";
							echo "<tr><td>Max dezurnih: </td><td>".$row['max_dezurnih']."</td></tr>";
						
							$sifarnikID=$row['sifarnikID'];
							$b=("SELECT aktivnost FROM sifarnik WHERE sifarnikID='$sifarnikID'");
							$result_b=mysql_query($b);
							$num_rows2 = mysql_num_rows($result_b);
								
								for ($i=0; $i<$num_rows2; $i++) { 
									$row_b=mysql_fetch_assoc($result_b); 
									echo "<tr><td>Aktivnost: </td><td>".$row_b['aktivnost']."</td></tr>";
									}
							
							echo "<br/><tr><td>Demonstratori: </td></tr>"; 
	
							
	/* 						$c=("SELECT dl.prihvatio, dl.komentar, k.ime, k.prezime 
								FROM demo_lab  dl JOIN demonstrator d ON dl.demonstratorID=d.demonstratorID
													JOIN korisnik k  ON  d.korisnikID=k.korisnikID
								WHERE dl.lab_vezbeID='$lab_vezbeID' 
									AND dl.ponuda='1' "); */
									
							$c=("SELECT dl.prihvatio as prihvatio, 
										dl.komentar as komentar, 
										k.ime as ime, 
										k.prezime as prezime 
								FROM demo_lab  dl,
									 demonstrator d ,
									 korisnik k  
								WHERE dl.demonstratorID=d.demonstratorID
								AND d.korisnikID=k.korisnikID
								AND dl.lab_vezbeID='$lab_vezbeID' 
								AND dl.ponuda='1'");		
									
							$result_c=mysql_query($c);
							$num_rows3 = mysql_num_rows($result_c);
							while ($rows3 = mysql_fetch_assoc($result_c)) { 
							 
								if($rows3['prihvatio'] =='0')
									echo "<tr><td><u>Nisu prihvatili: </td><td>".$rows3['ime']." ".$rows3['prezime']."</u></td></tr>"; 
								if($rows3['prihvatio'] =='1')
									echo "<tr><td>Prihvatili su: </td><td>".$rows3['ime']." ".$rows3['prezime']."</td></tr>"; 
							}
		
?>
					
						<td>
							<a href="lab_vezbe_izmena.php?id=<?php echo $lab_vezbeID;?>&par=<?php echo $predmetID;?>">Izmeni</a>
						</td>
						<td>
							<a href="lab_vezbe_zakljucavanje.php?id=<?php echo $lab_vezbeID;?>&par=<?php echo $predmetID;?>">Zakljucaj</a>
						</td>
				</table>
				</form>
			</div>
		</div>
</div>