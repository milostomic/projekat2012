<?php
$q=$_GET['q'];
switch ($q) {
case 2: 
?>
	<tr>
		<td>Zvanje: </td>
				<td style="padding-right: 14px;"><select name="zvanje">
					<option value="">Odaberite</option>
					<option value="prof">Profesor</option>
					<option value="asistent">Asistent</option>
					<option value="saradnik">Saradnik</option>
				</select></td>
	</tr>
		<?php
		break;
    case 3: ?>	
	<tr><td>Odsek:</td><td style="padding-left: 19px;"><input  style="width: 233px;" type="text" name="odsek"></td></tr>
	<tr><td>Godina studija:</td>
		<td style="padding-left: 19px;">
						<input type="radio" name="godina_studija" value="1">Prva<br/>
						<input type="radio" name="godina_studija" value="2">Druga<br/>
						<input type="radio" name="godina_studija" value="3">Treća<br/>
						<input type="radio" name="godina_studija" value="4">Četvrta<br/>
						<input type="radio" name="godina_studija" value="5">Peta<br/>
		</td>
	</tr>
	<tr><td>Prosek:</td><td style="padding-left: 19px;"> <input  style="width: 233px;" type="text" name="prosek"></td></tr>
<?php
break;
}		
?>