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
				<h2>Obracun zakljucanih lab vezbi</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
				
					<?php
					$upit0 =mysql_query("SELECT DISTINCT lv.predmetID as predmetID,
												lv.naziv as naziv,
												lv.lab_vezbeID as lab_vezbeID
										FROM lab_vezbe lv,
										demo_lab dl
										WHERE lv.lab_vezbeID=dl.lab_vezbeID
										AND lv.zakljucano='1' 
										AND dl.isplata='0'
										AND dl.prisustvo='1'");
					
					
					
					while($row0=mysql_fetch_array($upit0)) {
						$predmetID=$row0['predmetID'];
						$lab_vezbeID=$row0['lab_vezbeID'];
						//echo $lab_vezbeID;
							
							$upit1 =mysql_query("SELECT naziv, semestar FROM predmet WHERE predmetID='$predmetID'");
							$row1=mysql_fetch_array($upit1);
							echo "<tr>";
							echo "<td>";
							//echo $lab_vezbeID;
							echo $row0['naziv']." - ".$row1['naziv'].", ".$row1['semestar']."</br>";
					
					?>
					</td>
					<td>
					
					<a href="obracun_izvestaja_lab_vezbe.php?id=<?php echo $lab_vezbeID;?>">Obracunaj</a>
					</td>
					</tr>
				<?php				
				}
				?>
				</table>
				</form>
			</div>
		</div>
</div>