<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Log ind</title>

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

<?php
if(filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	require_once('db_con.php');
	$sql = 'SELECT id, pwhash FROM admin_users WHERE username=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash);
	
	while($stmt->fetch()) { }
	
	if (password_verify($pw, $pwhash)){
		echo "<script>window.open('reservation.php','_self')</script>";
		$_SESSION['id'] = $uid;
		$_SESSION['username'] = $un;
		
	}
	else{
		echo 'Illegal username/password combination';
	}
	echo '<hr>';
}
	
?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-1 col-lg-12 text-center">
				<p>
					<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
						<fieldset>
    						<legend>Login</legend>
    							<input name="un" type="text"     placeholder="Brugernavn" required />
    							<input name="pw" type="password" placeholder="Password"   required />
    							<input name="submit" type="submit" value="Login" />
						</fieldset>
					</form>
				</p>
			</div>
		</div>
	</div>
	
</body>
</html>