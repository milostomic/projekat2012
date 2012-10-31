<?php
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);
		
$predmetID=$_GET['q'];

$upit=("SELECT * FROM lab_vezbe WHERE predmetID='$predmetID' AND  zakljucano='1'");
$result=mysql_query($upit);

	echo "</br><table border='1' style='border:solid;'>";
	echo "<tr><th>Predmet</th><th>Lab vezba</th><th>Datum</th><th>Od</th><th>Do</th>
	<th>Lab</th><th>Max</br>dez.</th><th>Aktivnost</th><th>Demonstratori</th></tr>";	
					
	while ($row = mysql_fetch_assoc($result)){ 						
		$result_a=mysql_query("SELECT naziv,sifra_predmeta FROM predmet WHERE predmetID='$predmetID'");
		$row_a=mysql_fetch_assoc($result_a);//ovo mogu preko aliasa
								
								
		echo "<tr><td>".$row_a['naziv']."</td>";
		echo "<td>".$row['naziv']."</td>";
							
	/* $upit_za_predmet=mysql_query("SELECT * FROM lab_vezbe WHERE  predmetID='$predmetID'");
		$num_rows = mysql_num_rows($upit_za_predmet);
		for ($i=0;i<$num_rows;$i++){ */
							
		//echo "<td>".$row['naziv']."</td>";
		$od=date("H:i", strtotime($row['od']));	
		$do=date("H:i", strtotime($row['do']));	
		echo "<td>".$row['datum']."</td>";
		echo "<td>".$od."</td>";
		echo "<td>".$do."</td>";
		echo "<td>".$row['laboratorija']."</td>";
		echo "<td>".$row['max_dezurnih']."</td>";
					
		$sifarnikID=$row['sifarnikID'];
		
		$b=("SELECT aktivnost FROM sifarnik WHERE sifarnikID='$sifarnikID'");
		$result_b=mysql_query($b);
		$num_rows2 = mysql_num_rows($result_b);
			
			echo "<td>";		
			for ($i=0; $i<$num_rows2; $i++) { 
				$row_b=mysql_fetch_assoc($result_b); 
				echo $row_b['aktivnost'];
				}
			echo "</td>";				
				
				//echo "<br/><tr><td>Demonstratori: </td></tr>"; 
							
							
	/* 			$c=("SELECT dl.prihvatio, dl.komentar, k.ime, k.prezime 
					FROM demo_lab  dl JOIN demonstrator d ON dl.demonstratorID=d.demonstratorID
					JOIN korisnik k  ON  d.korisnikID=k.korisnikID
					WHERE dl.lab_vezbeID='$lab_vezbeID' 
					AND dl.ponuda='1' "); */
				
				$lab_vezbeID=$row['lab_vezbeID'];		
				
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
					
					echo "<td>";
					while ($rows3 = mysql_fetch_assoc($result_c)) { 
							
						if($rows3['prihvatio'] =='1')
							echo $rows3['ime']." ".$rows3['prezime']."</br>"; 
					}				
					echo "</td></tr>";		
						
					//echo "<tr><td>".$row_a['naziv']." ".$row['naziv']."</td><td>".$row['datum']."</td><td>".$row['od']."</td>
					//<td>".$row['do']."</td><td>".$row['laboratorija']."</td><td>".$row['max_dezurnih']."</td></tr>"; 
				
	}
echo "</table>";	
?>