<?php if(!isset($_SESSION)) { session_start(); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CZ3006 Net Centric Computing Assignment 2: Web applications using JavaScript and PHP</title>
</head>
<body>
<?php if(isset($_POST) && (isset($_POST['submit']) && $_POST['submit'] == "Submit")) { ?>
<?php
	$total = $_POST['apples'] * 69 + $_POST['oranges'] * 59 + $_POST['bananas'] * 39;
	
	if($orderFile = fopen("order.txt", "x")) {
		$order = "Total number of apples: " . 12 . "\r\nTotal number of oranges: " . 23 . "\r\nTotal number of bananas: " . 35 . "\r\n";
		fwrite($orderFile, $order);
		fclose($orderFile);
	}
	
	$orderFile = fopen("order.txt", "r") or die("Unable to open file for read!");
	$apples = substr(fgets($orderFile), 24, -1);
	$oranges = substr(fgets($orderFile), 25, -1);
	$bananas = substr(fgets($orderFile), 25, -1);
	fclose($orderFile);
	
	$orderFile = fopen("order.txt", "w") or die("Unable to open file for write!");
	$order = "Total number of apples: " . ($apples+$_POST['apples']) . "\r\nTotal number of oranges: " . ($oranges+$_POST['oranges']) . "\r\nTotal number of bananas: " . ($bananas+$_POST['bananas']) . "\r\n";
	fwrite($orderFile, $order);
	fclose($orderFile);
?>
<fieldset style="width: -moz-max-content; width: max-content;">
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
			<td>Order No. <span id="order-number"><?php echo $total > 0 ? rand(1, getrandmax()) : 0; ?></span></td>
			<td style="text-align: center;"> &#124; </td>
			<td style="text-align: right;"><?php date_default_timezone_set("Asia/Singapore"); echo date("j/n/Y g:i A"); ?></td>
		</tr>
		<tr>
			<td colspan="3" style="border-top: 1px solid black;">&nbsp;</td>
		</tr>
		<?php //if(isset($_POST['name'])) { ?>
		<tr>
			<td colspan="3"><label>Name: </label> <span class="name"><?php echo !isset($_POST['name']) || empty($_POST['name']) || is_null($_POST['name']) ? "<em>Anonymous</em>" : $_POST['name']; ?></span></td>
		</tr>
		<?php //} ?>
		<?php if(isset($_POST['apples']) && $_POST['apples'] > 0) { ?>
		<tr>
			<td><span><?php echo $_POST['apples']; ?></span> &#215; <label>Apple</label></td>
			<td style="text-align: center;">(69&#162;)</td>
			<td style="text-align: right;"><?php echo ($_POST['apples'] * 69) < 100 ? ($_POST['apples'] * 69) . "&#162;" : '&#36;' . number_format(($_POST['apples'] * 69)/100, 2); ?></td>
		</tr>
		<?php } ?>
		<?php if(isset($_POST['oranges']) && $_POST['oranges'] > 0) { ?>
		<tr>
			<td><span><?php echo $_POST['oranges']; ?></span> &#215; <label>Orange</label></td>
			<td style="text-align: center;">(59&#162;)</td>
			<td style="text-align: right;"><?php echo ($_POST['oranges'] * 59) < 100 ? ($_POST['oranges'] * 59) . "&#162;" : '&#36;' . number_format(($_POST['oranges'] * 59)/100, 2); ?></td>
		</tr>
		<?php } ?>
		<?php if(isset($_POST['bananas']) && $_POST['bananas'] > 0) { ?>
		<tr>
			<td><span><?php echo $_POST['bananas']; ?></span> &#215; <label>Banana</label></td>
			<td style="text-align: center;">(39&#162;)</td>
			<td style="text-align: right;"><?php echo ($_POST['bananas'] * 39) < 100 ? ($_POST['bananas'] * 39) . "&#162;" : '&#36;' . number_format(($_POST['bananas'] * 39)/100, 2); ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr style="font-weight: bold;">
			<td colspan="2" style="text-align: center;">Total: </td>
			<td style="text-align: center;"><?php echo $total > 0 && $total < 100 ? "<span>" . $total . "</span>" . "&#162;" : "&#36; <span>" . number_format($total/100, 2) . "</span>"; ?></td>
		</tr>
		<tr>
			<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">Payment method: </td>
			<td><span><?php echo !isset($_POST['payment']) || empty($_POST['payment']) || is_null($_POST['payment']) ? "<em>COD (Cash on delivery)</em>" : $_POST['payment']; ?></span></td>
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
			document.getElementById("total").value = "NaN";
			
			if(!validInput.test(bananas) || isNaN(bananas) || bananas < 0) { document.getElementById("bananas").focus(); }
			if(!validInput.test(oranges) || isNaN(oranges) || oranges < 0) { document.getElementById("oranges").focus(); }
			if(!validInput.test(apples) || isNaN(apples) || apples < 0) { document.getElementById("apples").focus(); }
			
			alert("input(s) is/are not valid, input again");
			
			return false;
		}
		else {
			document.getElementById("textbox").value = "Total number of apples: " + apples + "\nTotal number of oranges: " + oranges + "\nTotal number of bananas: " + bananas + "\n\nTotal cost: " + ((apples * 69 + oranges * 59 + bananas * 39) > 0 && (apples * 69 + oranges * 59 + bananas * 39) < 100 ? (apples * 69 + oranges * 59 + bananas * 39) + '\u00A2' : '\u0024' + ((apples * 69 + oranges * 59 + bananas * 39)/100).toFixed(2));
			document.getElementById("total").value = ((apples * 69 + oranges * 59 + bananas * 39) > 0 && (apples * 69 + oranges * 59 + bananas * 39) < 100 ? (apples * 69 + oranges * 59 + bananas * 39) + '\u00A2' : '\u0024' + ((apples * 69 + oranges * 59 + bananas * 39)/100).toFixed(2));
			
			return apples == 0 && oranges == 0 && bananas == 0 ? false : true;
		}
	}

</script>
<form action="index.php" method="post" name="form" onSubmit="return validate();">
	<table>
		<tr>
			<td><label for="name">Name: </label></td>
			<td><input name="name" type="text" id="name" tabindex="1"></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><label for="apples">Apple(s): </label></td>
			<td><input name="apples" type="text" id="apples" tabindex="2" onChange="return validate();" value="0" size="14"> &#215; 69&#162;</td>
		</tr>
		<tr>
			<td><label for="oranges">Orange(s): </label></td>
			<td><input name="oranges" type="text" id="oranges" tabindex="3" onChange="return validate();" value="0" size="14"> &#215; 59&#162;</td>
		</tr>
		<tr>
			<td><label for="bananas">Banana(s): </label></td>
			<td><input name="bananas" type="text" id="bananas" tabindex="4" onChange="return validate();" value="0" size="14"> &#215; 39&#162;</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><textarea name="textbox" cols="38" rows="6" readonly style="cursor: default;" id="textbox" onFocus="this.blur();"></textarea></td>
		</tr>
		<tr>
			<td><strong>Total: </strong></td>
			<td><input name="total" type="text" readonly style="cursor: default; font-weight: bold; text-align: center;" id="total" onFocus="this.blur();"></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Payment method: </td>
			<td><input name="payment" type="radio" id="Visa" tabindex="5" value="Visa" checked>
				<label for="Visa">Visa</label>
				<br>
				<input name="payment" type="radio" id="MasterCard" tabindex="5" value="MasterCard">
				<label for="MasterCard">MasterCard</label>
				<br>
				<input name="payment" type="radio" id="Discover" tabindex="5" value="Discover">
				<label for="Discover">Discover</label></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><input name="submit" type="submit" style="cursor: pointer;" id="submit" tabindex="6" onClick="return validate();" value="Submit"></td>
			<td><input name="reset" type="reset" style="cursor: pointer;" id="reset" value="Reset"></td>
		</tr>
	</table>
</form>
<?php } ?>
</body>
</html>