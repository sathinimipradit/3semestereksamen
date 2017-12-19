<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reservationsændringer</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,700,900" rel="stylesheet">

    <!-- Custom styles for this template -->
   <link rel="stylesheet" href="css/clean-blog.css">
  </head>

<body class="aandringreservpage">

<div class="container-fluid">
	<div class="row">
		<div class="col-1 col-lg-12 text-center">
	<h1>Reservationsændringer</h1>
</div>
</div>
<?php session_start(); ?> 
<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){
	if($cmd == 'rename_reservation') {
		$idReservation = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal hej parameter');
		$dato = filter_input(INPUT_POST, 'dato') 
			or die('Missing/illegal dato parameter');
		$startTid = filter_input(INPUT_POST, 'startTid') 
			or die('Missing/illegal tid parameter');
		$antal = filter_input(INPUT_POST, 'antal') 
			or die('Missing/illegal antal parameter');

		
		require_once('db_con.php');
		$sql = 'UPDATE reservation SET dato=?, startTid=?, antal=? WHERE idReservation=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ssii', $dato, $startTid, $antal, $idReservation);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Din ændringer er du rettet ';
		}
		else {
			echo 'Could not change the name of the category';
		}	
	
}
}
	if(isset($_GET["id"])){
		$idReservation = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal hej parameter');
	}
?>


<hr class="light my-4">

<?php
		 // hvis man logger ud, og trykker på "pilen tilbage" vil man blive bedt om at logge ind igen, da bruger id'et nu er krypteret.  
	if(empty($_SESSION['id'])){
		echo '<h2><b><center>Du skal være logget ind, for at få adgang til din profil</center></b></h2>';
		echo '<br><center><a href="login2.php">
		<input name="submit" type="button" value="Log ind" /></a></center><br>';
die();
	}
	
	require_once('db_con.php');
	$sql = 'SELECT idReservation, dato, startTid, antal FROM reservation WHERE idReservation=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $idReservation);
	$stmt->execute();
	$stmt->bind_result($redid, $dato, $startTid, $antal);
	while($stmt->fetch()){
?>
<div class="row">
	<div class="col-1 col-lg-12 text-center">
<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Indtaste ændringer</legend>
		
			<input name="id" type="hidden" value="<?=$redid?>" />
		
			<label class="rejesdato">Dato:</label>
            	<input class="input-bred" type="date" name="dato" value="<?=$dato?>" /><br><br>
					<label class="screenread-only">Tid</label>
				<select id="startTid" type="text" name="startTid" />
					<option value="12:00"<?php if($startTid == "12:00"){ echo " selected"; } ?>>12:00</option>
					<option value="14:00"<?php if($startTid == "14:00"){ echo " selected"; } ?>>14:00</option>
					<option value="16:00"<?php if($startTid == "16:00"){ echo " selected"; } ?>>16:00</option>
					<option value="18:00"<?php if($startTid == "18:00"){ echo " selected"; } ?>>18:00</option>
					<option value="20:00"<?php if($startTid == "20:00"){ echo " selected"; } ?>>20:00</option>
					</select><br><br>
		
			<label class="screenread-only">Antal Personer</label>
					<select id="antal" type="text" name="antal" />
						<option value="2"<?php if($antal == "2"){ echo " selected"; } ?>>2</option>
						<option value="4"<?php if($antal == "4"){ echo " selected"; } ?>>4</option>
						<option value="6"<?php if($antal == "6"){ echo " selected"; } ?>>6</option>
						<option value="8"<?php if($antal == "8"){ echo " selected"; } ?>>8</option>
					</select><br><br>

		
    		<button name="cmd" type="submit" value="rename_reservation" id="aandringresergem">Gem ændringer</button>
	</fieldset>
	<br>
	<button id="aandringreserva"><a href="reservation.php">Tilbage</a></button>
</form>
</p>
	</div>
</div>
<?php
						}
?>
</div>

</body>
</html>