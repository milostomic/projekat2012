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
				<h2>Zakljucane lab vezbe</h2><br/>
			</div>
			<div class="forma_desno">

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
xmlhttp.open("GET","pregled_zakljucanih_lab_ajax.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
			
<tr>
	<td>Predmet: </td>
		<td><select name="izbor_predmeta" onchange="showUser(this.value)">
		<option value="">Izaberite...</option>
			<?php
			$upit=mysql_query("SELECT predmetID FROM predmet_korisnik WHERE korisnikID='$korisnikID'");
			
				while($result=mysql_fetch_array($upit)){ 
				$data=mysql_query("SELECT * FROM predmet where predmetID='$result[predmetID]'");
				$row=mysql_fetch_array($data);			
			?>
		<option value="<?php echo $row['predmetID'];?>"><?php echo $row['naziv']; ?></option>
		<?php }?>
		</select>
		</td>
</tr>
<br/>
	<div id="txtHint"><i></br>Prikaz zakljucanih lab vezbi...</div>
				
			</div>
		</div>
</div>