<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
$korisnikID=$_SESSION['korisnikID'];		
$lab_vezbeID=$_GET['id'];
	 
$upit = ("SELECT * FROM lab_vezbe WHERE lab_vezbeID='$lab_vezbeID'");
$result=mysql_query($upit);
$row=mysql_fetch_assoc($result); 
?>
<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
			<div class="naziv">
				<h2>Izmenite lab vezbu</h2>
			</div>
			<div class="forma_desno">
				<form name="forma"  action="lab_vezbe_izmena.php?id=<?php echo $row['lab_vezbeID'];?>" method="POST">
				<table>
					<?php
						$predmetID=$row['predmetID'];
						$a=("SELECT naziv,sifra_predmeta FROM predmet WHERE predmetID='$predmetID'");
						$result_a=mysql_query($a);
				
						$row_a=mysql_fetch_assoc($result_a); 
						echo "<tr><td>Predmet: </td><td><strong>".$row_a['naziv'].", ".$row_a['sifra_predmeta']."</strong></td></tr>";
					?>
					<tr>
						<td>Lab vezba: </td><td><input type="text" name="lab_vezba" value="<?php echo $row['naziv'];?>"></td>
					</tr>
					
					
					<tr>
						<td>Datum: </td><td><select  name="dan">
												<?php list($godina, $mesec, $dan)= explode("-",$row['datum']); echo $dan;  ?>
												<option value="<?php echo $dan;?>" selected><?php echo $dan;?></option>
												
												<?php
													for ($i=1; $i<=31; $i++){
														echo "<option value='$i'>$i</option>";
													}
												?>
											</select>
											<select  name="mesec">
												<?php list($godina, $mesec, $dan)= explode("-",$row['datum']); echo $mesec;  ?>
												<option value="<?php echo $mesec;?>" selected><?php echo $mesec;?></option>
												<?php
													for ($i=1; $i<=12; $i++){
														echo "<option value='$i'>$i</option>";
													}
												?>   
											</select>
											<select name="godina">
												<?php list($godina, $mesec, $dan)= explode("-",$row['datum']); echo $godina;  ?>
												<option value="<?php echo $godina;?>" selected><?php echo $godina;?></option>
												<?php
													for ($i=2020; $i>=2010; $i--){
														echo "<option value='$i'>$i</option>";
													}
												?>
											</select></td>
					</tr>
					<tr>
						<td>Od: </td><td><select  name="sati_od">
											<?php list($sati_od, $min_od)= explode(":",$row['od']); echo $sati_od;  ?>
												<option value="<?php echo $sati_od;?>" selected><?php echo $sati_od;?></option>
											<?php
												for ($i=00; $i<=23; $i++){
													echo "<option value='$i'>$i</option>";
												}
											?>
										</select>
										<select  name="min_od">
											<?php list($sati_od, $min_od)= explode(":",$row['od']); echo $min_od;  ?>
												<option value="<?php echo $min_od;?>" selected><?php echo $min_od;?></option>
											<?php
												for ($i=00; $i<=55; $i=$i+5){
													echo "<option value='$i'>$i</option>";
												}
											?>   
										</select> h </td> 	
					</tr>
					<tr>
						<td>Do: </td><td><select  name="sati_do">
											<?php list($sati_do, $min_do)= explode(":",$row['do']); echo $sati_do;  ?>
												<option value="<?php echo $sati_do;?>" selected><?php echo $sati_do;?></option>
											<?php
												for ($i=00; $i<=23; $i++){
													echo "<option value='$i'>$i</option>";
												}
											?>
										</select>
										<select  name="min_do">
											<?php list($sati_do, $min_do)= explode(":",$row['do']); echo $min_do;  ?>
												<option value="<?php echo $min_do;?>" selected><?php echo $min_do;?></option>
											<?php
												for ($i=00; $i<=55; $i=$i+5){
													echo "<option value='$i'>$i</option>";
												}
											?>   
										</select> h </td> 
					</tr>
					<tr>
						<td>Laboratorija: </td><td><input type="text" name="laboratorija" value="<?php echo $row['laboratorija'];?>"></td>
					</tr>
					<tr>
						<td>Tip aktivnosti: </td>
						<td><select name="sifarnikID">
						<?php 
							$upit1 = ("SELECT s.*
									FROM sifarnik s,
										lab_vezbe lv
									WHERE 
									s.sifarnikID=lv.sifarnikID
									and lv.lab_vezbeID='$lab_vezbeID' ");
							$result1=mysql_query($upit1);
							$row1=mysql_fetch_assoc($result1);
							$selected_aktivnost=$row1['sifarnikID'];
							$upit2 = ("SELECT * FROM sifarnik where sifarnikID<>'$selected_aktivnost'");
							$result2=mysql_query($upit2);
						?>	
						<option value="<?php echo $row1['sifarnikID'];?>"><?php echo $row1['aktivnost'] ?></option>
						
						<?php	while ($row2=mysql_fetch_assoc($result2)) {  	
						?>
						
						<option value="<?php echo $row2['sifarnikID'];?>"><?php echo $row2['aktivnost']; ?></option>
					   <?php }?>
						</select><br/></td>
					</tr>

					<tr>
						<td>Max dezurnih: </td><td><input type="text" name="max_dezurnih" value="<?php echo $row['max_dezurnih'];?>"></td>
					</tr>
							<a href="lab_vezbe_prikaz.php?id=<?php echo $row['lab_vezbeID'];?>">
					<tr>
						<td>
							<input type="hidden" name="id" value="<?php echo $row['lab_vezbeID'];?>"/>
							<input type="submit" name="izmeni" value="Izmeni"/>
						</td></br>
					</tr>
						
				</table>
				
				</form>
			</div>
		</div>
</div>						

<?php

if (isset($_REQUEST['izmeni'])){
		$lab_vezbeID=$_GET['id'];
		//$lab_vezbeID=$_POST['id'];
		//$predmetID=$_POST['izbor_predmeta']; 
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
		$sifarnikID=$_POST['sifarnikID'];
		// echo $sifarnikID; 
		
		/* $upit2=mysql_query("SELECT sifarnikID FROM sifarnik WHERE sifarnikID='$sifarnikID'");
		$result2=mysql_fetch_array($upit2);
		$sifarnik=$result2['aktivnost']; */
		

		/* if (($lab_vezba == '') || ($laboratorija == '') || ($godina == '') || ($mesec == '') || ($dan == '')
		|| ($sati_od == '') || ($min_od == '') || ($sati_do == '') || ($min_do == '') || ($max_dezurnih == '')) 
			echo "Niste uneli sve detalje!";
		
		else { */
			$par=false;
			$par=$korisnik->izmena_lab_vezbe($lab_vezbeID,$lab_vezba,$godina,$mesec,$dan,$sati_od,$min_od,$sati_do,$min_do,
											$sifarnikID,$laboratorija,$max_dezurnih);
			echo $par;
			//$lab_vezbeID = mysql_insert_id();	
				
			/* 	for($i=0;$i<count($_POST['demo']);$i++){
				$korisnikID=$_POST['demo'][$i];
				$upit1=mysql_query("SELECT demonstratorID FROM demonstrator WHERE korisnikID='$korisnikID'");
				$row1=mysql_fetch_array($upit1);
				$a=$row1['demonstratorID'];
				mysql_query("update demo_lab (demonstratorID,lab_vezbeID,ponuda,prihvatio) values ('$a','$lab_vezbeID','0','0')");
				/* } */				
											
			// echo "Uspesno dodata lab vezba."; 
			//header("Location: lab_vezbe.php"); 
		
		

}

?> 
