¢<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login system</title>
</head>

<body>
<?php
if(filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	$pw = password_hash($pw, PASSWORD_DEFAULT);
	
//	echo 'Opretter bruger<br>'.$un.' : '.$pw;
	
	require_once('db_con.php');
	$sql = 'INSERT INTO admin_users (username, pwhash) VALUES (?, ?)';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('ss', $un, $pw);
	$stmt->execute();
	
	if($stmt->affected_rows > 0){
		echo 'user '.$un.' created :-)';
	}
	else {
		echo 'could not create user - does he exist???';
	}
	
}
?>

<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Tilføj ny bruger</legend>
    	<input name="un" type="text"     placeholder="Brugernavn" required />
    	<input name="pw" type="password" placeholder="Password"   required />
    	<input name="submit" type="submit" value="Tilføj bruger" />
	</fieldset>
</form>
</p>
</body>
</html>