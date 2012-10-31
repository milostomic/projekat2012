<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
		<meta name="description" content="Visoka skola strukovnih studija projetat 2012">
		<title>Projekat 2012</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
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
			xmlhttp.open("GET","nastavnik_ili_demo.php?q="+str,true);
			xmlhttp.send();
			}
		</script>		
	</head>
	<body>
		<center>
		<div class="content" >
			<div class="header  ">
				<div class= "ulogovani ">
				<?php
					session_start();
					if(!isset($_SESSION['korisnikID'])){
						//ako korisnik nije ulogovan tj ako nema sesije za korisnikID
						session_unset();
						}
					else{
						echo "Dobro došli ".$_SESSION['username']."<br/>";
						echo "<a href='logout.php'> logout </a>";						
					}
				?>
				</div>
				<div class= "logo ">
					<img src="logo_viser/logoskole.jpg">
				</div>
				<div class="naziv_projekta">
					<center>Projekat 2012</center>
				</div>
			</div>