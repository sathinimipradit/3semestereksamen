<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reservation</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,700,900" rel="stylesheet">

    <!-- Custom styles for this template -->
   <link rel="stylesheet" href="css/clean-blog.css">
  </head>
	
	<?php
		require_once('db_con.php');
	 if($submit = filter_input(INPUT_POST, 'submit')){
    if($submit == 'del') {
        
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) 
            or die('Missing/illegal id parameter');
        
        
        require_once('db_con.php');
        $sql = 'DELETE FROM reservation WHERE idReservation=?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    
        if($stmt->affected_rows > 0){
            echo "<script type='text/javascript'>alert('Reservationen er nu slettet.');</script>";
        
        }
        else {
            echo 'Could not delete  '.$id;
        }
    }
    else {
        die('Unknown cmd: '.$submit);
    }
    }
	
	?>

<body class="reservpage">
<?php session_start(); ?> 
<?php

	  require_once('db_con.php');
	  $sql = "select*from reservation ORDER BY dato, startTid ASC";
      $stmt = $con->prepare($sql);
      $stmt->bind_result($idReservation, $fNavn, $eNavn, $email, $telefon, $dato, $startTid, $antal, $booket, $bord_idBord);
      $stmt->execute();
			
	 if(isset($_POST['slet'])){
     $sql = "DELETE FROM reservation WHERE idReservation = ?";
     $stmt = $con->prepare($sql);
     $stmt->bind_param('i', $idReservation);
     $stmt->execute();
        
         if($stmt->affected_rows>0){
			echo "<script type='text/javascript'>alert('Kunne ikke slette din bestilling');</script>";
         }
		 
         else {
           echo "<script type='text/javascript'>alert('Kunne ikke slette din bestilling');</script>";
         }
       }			

    
    // hvis man logger ud, og trykker på "pilen tilbage" vil man blive bedt om at logge ind igen, da bruger id'et nu er krypteret.  
	if(empty($_SESSION['id'])){
		echo '<h2><b><center>Du skal være logget ind, for at få adgang til din profil</center></b></h2>';
		echo '<br><center><a href="login2.php">
		<input name="submit" type="button" value="Log ind" /></a></center><br>';

	}
	//Hvis det er lykkedes brugeren at logge ind, vil der komme en personlig besked til brugeren. 
	else {
		echo '<center><h2><i class="fa fa-user"></i> Velkommen ' .$_SESSION ['username']. '</h2> <h3>Her vises oversigten over bordreservationer</h3>' ;
		echo '<br><a href="logout.php">
		<input name="submit" type="button" value="Log ud" /></a><br>';
		
		while($stmt->fetch()) {     	
	
	  ?>
	  
	<table id="reservationpage">
		<tr>
		<th width='150px'>Dato</th>
		<th width='100px'>Start tid</th>
		<th width='120px'>Fornavn</th>
		<th width='120px'>Efternavn</th>
		<th width='200px'>Email</th>
		<th width='100px'>Telefon</th>
		<th width='150px'>Antal personer</th>
		<th width='150px'>Booket</th>
		<th width='150px'>Id bord</th>
		<th width='150px'>ID Reservation</th>
		<th width='50px'>Rediger</th>
		<th width='50px'>Slet</th>
		</tr>
		
		<tr><td><?=$dato?></td>
			<td><?=$startTid?></td>
			<td><?=$fNavn?></td>
			<td><?=$eNavn?></td>
			<td><?=$email?></td>
			<td><?=$telefon?></td>
			<td><?=$antal?></td>
			<td><?=$booket?></td>
			<td><?=$bord_idBord?></td>
			<td><?=$idReservation?></td>
			
			<td>
				<a href="aendringer_reservation.php?id=<?=$idReservation?>"><button><i class="fa fa-wrench" aria-hidden="true"></i></button></a>
			</td>
			
			<td>
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
       <input type="hidden" value="<?=$idReservation?>" name="id">
          <button name="submit" type="submit" value="del"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				</form>
			</td>
			
		</tr>
	</table>
	

	<?php } 
		
		
	}
		




?>
	
	

</body>
</html>