<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];		
$predmetID=$_GET['par'];
$lab_vezbeID=$_GET['id'];
/*	 
$upit = ("SELECT * FROM lab_vezbe WHERE lab_vezbeID='$lab_vezbeID'");
$result=mysql_query($upit);
$row=mysql_fetch_assoc($result);  */
?>



<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Lab vezbe</h2><br/>
			</div>
			<div class="forma_desno">
				<form   action="lab_vezbe_zakljucavanje.php?id=<?php echo $lab_vezbeID;?>&par=<?php echo $predmetID;?>" method="POST">
				<table >	
					<tr>
						<td>Demonstratori koji su prihvatili poziv: </br></td><td>
						<?php
								$upit = mysql_query("SELECT k.korisnikID as korisnikID,
															k.ime as ime,
															k.prezime as prezime
													FROM demo_lab dl,
														demonstrator d,
														korisnik k
													WHERE dl.demonstratorID=d.demonstratorID
														AND d.korisnikID=k.korisnikID
														AND dl.prihvatio='1'
														AND dl.ponuda='1'
														AND dl.lab_vezbeID=$lab_vezbeID
													");
								while($row=mysql_fetch_array($upit)) { 	
							?>
							<input type="checkbox" name="demo[]" value="<?php echo $row['korisnikID'];?>" />
												<?php echo $row['ime']." ".$row['prezime']; ?><br/>
							
						   <?php }?>
						</td>
					</tr>
					<tr><td>_______________________________</td><td>_________________</td></tr>
					<tr>
						<td>Ostali demonstratori: </br></td><td>
						<?php
						
						 $upit1=mysql_query("SELECT demonstratorID,korisnikID FROM demonstrator WHERE demonstratorID 
											NOT IN (SELECT demonstratorID FROM demo_lab WHERE lab_vezbeID='$lab_vezbeID')"); 
							
							
								
								while($row1=mysql_fetch_array($upit1)) { 
									$korisnikID=$row1['korisnikID'];
								$upit_kor=mysql_query("SELECT ime,prezime FROM korisnik WHERE korisnikID='$korisnikID'");
								$row_kor=mysql_fetch_array($upit_kor);
							?>
							<input type="checkbox" name="demo1[]" value="<?php echo $row1['korisnikID'];?>" />
												<?php echo $row_kor['ime']." ".$row_kor['prezime']; ?><br/>
							
						   <?php }?>
						</td>
					</tr>	
						
					<tr>
						<td>
							
							<input type="submit" name="zakljucaj" value="Zakljucaj"/>
						</td></br>
					</tr>
						
				</table>
				
				</form>
			</div>
		</div>
</div>						
<?php
/* $lab_vezbeID=$_GET['id'];
$upit = ("SELECT * FROM lab_vezbe WHERE lab_vezbeID='$lab_vezbeID'");
$result=mysql_query($upit);
$row=mysql_fetch_assoc($result);  */


if (isset($_POST['zakljucaj'])){
$id=$_GET['id'];
$par=$_GET['par'];
			for($i=0;$i<count($_POST['demo']);$i++){
				$korisnikID=$_POST['demo'][$i];
				$upit2=mysql_query("SELECT demonstratorID FROM demonstrator WHERE korisnikID='$korisnikID'");
				$row2=mysql_fetch_array($upit2);
				//$a=$row2['demonstratorID'];
				mysql_query("UPDATE demo_lab SET prisustvo='1' WHERE lab_vezbeID='$lab_vezbeID' and prihvatio='1'");
				mysql_query("UPDATE lab_vezbe SET zakljucano='1' WHERE lab_vezbeID='$lab_vezbeID'");
				} 	

			for($i=0;$i<count($_POST['demo1']);$i++){
				$korisnikID=$_POST['demo1'][$i];
				$upit3=mysql_query("SELECT demonstratorID FROM demonstrator WHERE korisnikID='$korisnikID'");
				$row3=mysql_fetch_array($upit3);
				$b=$row3['demonstratorID'];
				mysql_query("INSERT INTO demo_lab (demonstratorID,lab_vezbeID,ponuda,prisustvo,prihvatio) 
							VALUES ('$b','$lab_vezbeID','1','1','1')");
				mysql_query("UPDATE lab_vezbe SET zakljucano='1' WHERE lab_vezbeID='$lab_vezbeID'");
				} 	
header("Location: pregled_zakljucanih_lab.php");				
				
}
?>



				