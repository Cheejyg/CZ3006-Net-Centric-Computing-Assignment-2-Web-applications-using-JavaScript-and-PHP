<?php if(!isset($_SESSION)) { session_start(); } ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>CZ3006 Net Centric Computing Assignment 2: Web applications using JavaScript and PHP</title>
</head>
<body>
<?php if(isset($_POST) && (isset($_POST['submit']) && $_POST['submit'] == "Submit")) { ?>
<?php
	$total = $_POST['apples'] * 69 + $_POST['oranges'] * 59 + $_POST['bananas'] * 39;
	
	$orderFile = fopen("order.txt", "r") or die("Unable to open file for read!");
	$apples = substr(fgets($orderFile), 24, -1);
	$oranges = substr(fgets($orderFile), 25, -1);
	$bananas = substr(fgets($orderFile), 25, -1);
	fclose($orderFile);
	
	$orderFile = fopen("order.txt", "w") or die("Unable to open file for write!");
	$order = "Total number of apples: ".($apples+$_POST['apples'])."\r\nTotal number of oranges: ".($oranges+$_POST['oranges'])."\r\nTotal number of bananas: ".($bananas+$_POST['bananas'])."\r\n";
	fwrite($orderFile, $order);
	fclose($orderFile);
?>
<fieldset style="width: max-content;">
	<legend>Receipt</legend>
	<table>
		<tr>
			<td colspan="3" style="text-align: center;">CZ3006 Net Centric Computing Assignment 2</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: center;">Web applications using JavaScript and PHP</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: center;">#CHEE JUN YUAN GLENN#</td>
		</tr>
		<tr>
			<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;</td>
		</tr>
		<tr>
			<td><span id="id"><?php echo '#'.' '.rand(); ?></span></td>
			<td colspan="2" style="text-align: right;"><?php echo date("j/n/Y g:i A"); ?></td>
		</tr>
		<tr>
			<td colspan="3" style="border-top: 1px solid black;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3"><label>Name: </label> <span id="name"><?php echo $_POST['name']; ?></span></td>
		</tr>
		<?php if(isset($_POST['apples']) && $_POST['apples'] > 0) { ?>
		<tr>
			<td><span id="apples"><?php echo $_POST['apples']; ?></span> &#215; <label>Apple</label></td>
			<td style="text-align: center;">(69&#162;)</td>
			<td style="text-align: right;"><?php echo ($_POST['apples'] * 69) < 100 ? ($_POST['apples'] * 69) . '¢' : '$' . ($_POST['apples'] * 69)/100; ?></td>
		</tr>
		<?php } ?>
		<?php if(isset($_POST['oranges']) && $_POST['oranges'] > 0) { ?>
		<tr>
			<td><span id="oranges"><?php echo $_POST['oranges']; ?></span> &#215; <label>Orange</label></td>
			<td style="text-align: center;">(59&#162;)</td>
			<td style="text-align: right;"><?php echo ($_POST['oranges'] * 59) < 100 ? ($_POST['oranges'] * 59) . '¢' : '$' . ($_POST['oranges'] * 59)/100; ?></td>
		</tr>
		<?php } ?>
		<?php if(isset($_POST['bananas']) && $_POST['bananas'] > 0) { ?>
		<tr>
			<td><span id="bananas"><?php echo $_POST['bananas']; ?></span> &#215; <label>Banana</label></td>
			<td style="text-align: center;">(39&#162;)</td>
			<td style="text-align: right;"><?php echo ($_POST['bananas'] * 39) < 100 ? ($_POST['bananas'] * 39) . '¢' : '$' . ($_POST['bananas'] * 39)/100; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr style="font-weight: bold;">
			<td colspan="2" style="text-align: center;">Total: </td>
			<td style="text-align: center;"><?php echo $total > 0 && $total < 100 ? $total . '¢' : '$' . $total/100; ?></td>
		</tr>
		<tr>
			<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">Payment method: </td>
			<td><span id="payment"><?php echo $_POST['payment']; ?></span></td>
		</tr>
	</table>
</fieldset>
<?php } else { ?>
<script>

	var validInput = /\d+/im;
	
	function validate() {
		var apples = document.getElementById("apples").value;
		var oranges = document.getElementById("oranges").value;
		var bananas = document.getElementById("bananas").value;
		
		if(!validInput.test(apples) || !validInput.test(oranges) || !validInput.test(bananas) || isNaN(apples) || isNaN(oranges) || isNaN(bananas) || apples < 0 || oranges < 0 || bananas < 0) {
			document.getElementById("textbox").value = "NaN";
			alert("input(s) is/are not valid, input again");
			
			return false;
		}
		else {
			document.getElementById("textbox").value = "Total number of apples: " + apples + "\nTotal number of oranges: " + oranges + "\nTotal number of bananas: " + bananas + "\n\nTotal cost: " + ((apples * 69 + oranges * 59 + bananas * 39) > 0 && (apples * 69 + oranges * 59 + bananas * 39) < 100 ? (apples * 69 + oranges * 59 + bananas * 39) + '¢' : '$' + (apples * 69 + oranges * 59 + bananas * 39)/100 + ' ' + '(' + (apples * 69 + oranges * 59 + bananas * 39) + '¢' + ')');
			
			if(apples == 0 && oranges == 0 && bananas == 0) { return false; }
		}
	}

</script>
<form action="index.php" method="post" name="form" onSubmit="return validate();">
	<table>
		<tr>
			<td><label for="name">Name: </label></td>
			<td><input type="text" name="name" id="name" tabindex="1"></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><label for="apples">Apple(s): </label></td>
			<td><input name="apples" type="text" id="apples" tabindex="2" onChange="validate();" value="0" size="14"> &#215; 69&#162;</td>
		</tr>
		<tr>
			<td><label for="oranges">Orange(s): </label></td>
			<td><input name="oranges" type="text" id="oranges" tabindex="3" onChange="validate();" value="0" size="14"> &#215; 59&#162;</td>
		</tr>
		<tr>
			<td><label for="bananas">Banana(s): </label></td>
			<td><input name="bananas" type="text" id="bananas" tabindex="4" onChange="validate();" value="0" size="14"> &#215; 39&#162;</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><textarea name="textbox" cols="38" rows="6" readonly id="textbox" onFocus="this.blur();"></textarea></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Payment method: </td>
			<td><input name="payment" type="radio" id="Visa" tabindex="5" value="Visa" checked>
				<label for="Visa">Visa</label>
				<br>
				<input type="radio" name="payment" value="MasterCard" id="MasterCard" tabindex="5">
				<label for="MasterCard">MasterCard</label>
				<br>
				<input type="radio" name="payment" value="Discover" id="Discover" tabindex="5">
				<label for="Discover">Discover</label></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" id="submit" tabindex="6" value="Submit"></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
<?php } ?>
</body>
</html>
