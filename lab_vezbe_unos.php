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
				<h2>Lab vezbe</h2><br/>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table >
					<tr>
						<td>Predmet: </td>
						<td><select name="izbor_predmeta">
						<?php
							$upit = mysql_query("SELECT predmetID FROM predmet_korisnik WHERE korisnikID='$korisnikID'");
							
							while($result=mysql_fetch_array($upit)) { 
							$data = mysql_query("SELECT * FROM predmet where predmetID='$result[predmetID]'");
							$row=mysql_fetch_array($data)
							
						?>
						<option value="<?php echo $row['predmetID'];?>">
								<?php echo $row['naziv'].", ".$row['sifra_predmeta']; ?></option>
					   <?php }?>
						</select><br/></td>
					</tr>
					<tr>
						<td>Lab vezba: </td><td><input type="text" name="lab_vezba"></td><td></td>
					</tr>
					<tr>
						<td>Datum: </td><td><select  name="dan">
												<option value="">Dan</option>
												<?php
													for ($i=1; $i<=31; $i++){
														echo "<option value='$i'>$i</option>";
													}
												?>
											</select>
											<select  name="mesec">
												<option value="">Mesec</option>
												<?php
													for ($i=1; $i<=12; $i++){
														echo "<option value='$i'>$i</option>";
													}
												?>   
											</select>
											<select name="godina">
												<option value="">Godina</option>
												<?php
													for ($i=2020; $i>=2010; $i--){
														echo "<option value='$i'>$i</option>";
													}
												?>
											</select></td>
					</tr>
					<tr>
						<td>Od: </td><td><select  name="sati_od">
											<option value="">Sat</option>
											<?php
												for ($i=00; $i<=23; $i++){
													echo "<option value='$i'>$i</option>";
												}
											?>
										</select>
										<select  name="min_od">
											<option value="">Min</option>
											<?php
												for ($i=00; $i<=55; $i=$i+5){
													echo "<option value='$i'>$i</option>";
												}
											?>   
										</select> h </td> 	
					</tr>
					<tr>
						<td>Do: </td><td><select  name="sati_do">
											<option value="">Sat</option>
											<?php
												for ($i=00; $i<=23; $i++){
													echo "<option value='$i'>$i</option>";
												}
											?>
										</select>
										<select  name="min_do">
											<option value="">Min</option>
											<?php
												for ($i=00; $i<=55; $i=$i+5){
													echo "<option value='$i'>$i</option>";
												}
											?>   
										</select> h </td> 
					</tr>
					<tr>
						<td>Laboratorija: </td><td><input type="text" name="laboratorija"></td>
					</tr>
					<tr>
						<td>Tip aktivnosti: </td>
						<td><select name="sifarnik">
						<?php
							$upit1 = ("SELECT * FROM sifarnik");
							$result1=mysql_query($upit1);
							$num_rows = mysql_num_rows($result1);
							for ($i=0; $i<$num_rows; $i++) {  
							$row=mysql_fetch_assoc($result1);
						?>
						<option value="<?php echo $row['sifarnikID'];?>">
								<?php echo $row['aktivnost']; ?></option>
					   <?php }?>
						</select><br/></td>
					</tr>

					<tr>
						<td>Max dezurnih: </td><td><input type="text" name="max_dezurnih"></td>
					</tr>
					<tr>
					<td>Demonstratori: </br></td>
						<td>
						<?php
								$upit = mysql_query("SELECT * FROM korisnik WHERE pravoID='3'");
								while($row=mysql_fetch_array($upit)) { 	
							?>
							<input type="checkbox" name="demo[]" value="<?php echo $row['korisnikID'];?>" />
												<?php echo $row['ime']." ".$row['prezime']; ?><br/>
							
						   <?php }?>
						</td>
					</tr>
					<tr>
						<td><input  type="submit" name="posalji" value="Posalji"></td>
					</tr>
						
				</table>
				</form>
			</div>
		</div>
	</div>
<?php

if (isset($_POST['posalji'])){
			
		$predmetID=$_POST['izbor_predmeta']; 
		$lab_vezba=$_POST['lab_vezba']; 
		$laboratorija=$_POST['laboratorija'];
		$godina=$_POST['godina'];
		$mesec=$_POST['mesec'];
		$dan=$_POST['dan'];
		$sati_od=$_POST['sati_od'];
		$min_od=$_POST['min_od'];
		$sati_do=$_POST['sati_do'];
		$min_do=$_POST['min_do'];
		$max_dezurnih=$_POST['max_dezurnih'];
		$sifarnikID=$_POST['sifarnik'];
		
		$upit=mysql_query("SELECT nastavnikID FROM nastavnik WHERE korisnikID='$korisnikID'");
		$result=mysql_fetch_array($upit);
		$nastavnikID=$result['nastavnikID'];
		
	

		if (($lab_vezba == '') || ($laboratorija == '') || ($godina == '') || ($mesec == '') || ($dan == '')
		|| ($sati_od == '') || ($min_od == '') || ($sati_do == '') || ($min_do == '') || ($max_dezurnih == '')) 
			echo "Niste uneli sve detalje!";
		
		else {
			$par=false;
			$par=$korisnik->unos_lab_vezbe($lab_vezba,$nastavnikID,$predmetID,$godina,$mesec,$dan,$sati_od,$min_od,$sati_do,$min_do,
											$sifarnikID,$laboratorija,$max_dezurnih);
			
			$lab_vezbeID = mysql_insert_id();	
				
				for($i=0;$i<count($_POST['demo']);$i++){
				$korisnikID=$_POST['demo'][$i];
				$upit1=mysql_query("SELECT demonstratorID FROM demonstrator WHERE korisnikID='$korisnikID'");
				$row1=mysql_fetch_array($upit1);
				$a=$row1['demonstratorID'];
				mysql_query("INSERT INTO demo_lab (demonstratorID,lab_vezbeID,ponuda) VALUES ('$a','$lab_vezbeID','1')");
				}								
											
			echo "Uspesno dodata lab vezba.";
			header("Location: lab_vezbe_unos.php"); 
		}
		

}



?>