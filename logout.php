<?php
// Initalisere sessionen.
// Glem ikke din session_navn!
session_start();
// Sluk alle session variablerne.
$_SESSION = array();
// Hvis du ønsker at dræbe sessionen, skal du også slette session cookie.
// Dette vil ødelægge sessionen, og ikke kun sessiondata!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// Ødelægger sessionen.
session_destroy();
header('refresh:1.5; url=login2.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Log out</title>

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
				<h1>Du er nu logget ud.</h1>
					
			</div>
		</div>
	</div>
	
</body>
</html>