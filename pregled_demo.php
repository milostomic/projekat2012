<?php 
require 'header.php';
require 'konekcija.php';
require 'korisnik.php';
require 'config.php';
$konekcija = new Konekcija(DB_HOST,DB_NAME,DB_USER,DB_PASS);
$korisnik = new Korisnik($konekcija);	
?>
<div class="sredina">	
		<div class="levo ">
			<?php require 'levi_meni.php'; ?>
		</div>

		<div class="desno">
	
			<div class="naziv">
				<h2>Izbor demonstratora</h2><br/>
			</div>
			<div class="forma_desno">
			<table>
				<form name="forma" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				Pretrazite demonstratora: 
				<select name="izbor">
					<option>svi</option>
					<option>ime</option>
					<option>prezime</option>
				</select>
				Unesite: <input type="text" name="search"/><br>
		<!--	<tr><td>Predmeti: </td>
						<td>
						<?php
								//$upit0= mysql_query("SELECT * FROM predmet");
								//while($row0=mysql_fetch_array($upit0)) { 	
							?>
							<input type="checkbox" name="predmet[]" value="<?php //echo $row0['predmetID'];?>" />
												<?php //echo $row0['naziv']; ?></br>
							
						   <?php //}?>
						</td>
				</tr>	-->
				
			
			<input type="submit" name="pretrazi" value="Pretrazi"/><br><br>
			</form>
			</table></br>
<?php
if(isset($_POST['izbor']) && isset($_POST['pretrazi'])){
    echo "________________________________________________________<br>";
    $izbor=$_POST['izbor'];
    $search=$_POST['search'];
		if($izbor=='svi')
			$upit="SELECT * FROM korisnik WHERE pravoID=3";
		elseif (($izbor=='ime')||($izbor=='prezime'))
			$upit="SELECT * FROM korisnik WHERE pravoID=3 AND ".$izbor." LIKE '%$search%'";
		
    //echo $upit;
    $result = $konekcija->getRecordSet($upit);
    //echo "Broj elemenata: ".count($result);
	echo "Rezultat pretrage: ";
?>
<head>
<script type="text/javascript">
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","prikaz_demo_ajax.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>


    <select name="demonstratori" onchange="showUser(this.value)">
		<option value="">Izaberite...</option>
    <?php
    foreach($result as $nesto)
    {
    ?>
        <option value="<?php echo $nesto['korisnikID'];?>"><?php echo $nesto['ime']." ".$nesto['prezime'];?></option>
	<?php
	}
	?>
	</select>
	<div id="txtHint"><i></br>Informacija o demonstratoru ce biti prikazana ovde.</div></br>
<?php
}
?>
			</div>

		</div>
	
</div> 	

 
