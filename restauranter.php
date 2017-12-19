<?php
include('db_con.php');
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Thai takeaway - Green Mango serverer autentisk mad fra det thailandske køkken. Maden er tilbedret med friske råverer som kan nydes hjemme eller i vores restauranter.">
	<meta name="page-topic" conten="Thai food">
	<meta name="Keywords" conten="Thai takeway, thaimad, restaurant, asiatisk, nudler, ris, wok, karry, forårsruller, thailand">
    <meta name="author" content="Green Mango">

    <title>Restauranter</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	 
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/clean-blog.css">
	  

  </head>

  <body>
   <!-- Page Header -->
    <header class="masthead" id="top">
    </header>
	  
<?php
	  require('navbar.php')
?> 
	  
	 
    <!-- Main Content -->
	 <div class="container-fluid">
		<div class="row">
		<div class="col-1-1 col-lg-12 menukortnav">
			<ul class="nav justify-content-center nav-pills mb-3" id="pills-tab" role="tablist">
  				<li class="nav-item">
   					 <a class="nav-link active" id="pills-christianshavn-tab" data-toggle="pill" href="#pills-christianshavn" role="tab" aria-controls="pills-christianshavn" aria-selected="true">Christianshavn</a>
  				</li>
  <li class="nav-item">
    <a class="nav-link" id="pills-soeborg-tab" data-toggle="pill" href="#pills-soeborg" role="tab" aria-controls="pills-soeborg" aria-selected="false">Søborg</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-gentofte-tab" data-toggle="pill" href="#pills-gentofte" role="tab" aria-controls="pills-gentofte" aria-selected="false">Gentofte</a>
  </li>
			</ul>
		</div>
	</div>
	</div>
	  
	 <!-- MENU NAV SMALL DEVICE-->
<div class="col-12 col-md-12 col-lg-12 btn-group menunavsmall">

<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Restauranter
  </button>
<div class="dropdown-menu menunavsmallbot">
<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active" id="pills-christianshavn-tab" data-toggle="pill" href="#pills-christianshavn" role="tab" aria-controls="pills-christianshavn" aria-selected="true">Christianshavn</a>
  <a class="nav-link" id="pills-soeborg-tab" data-toggle="pill" href="#pills-soeborg" role="tab" aria-controls="pills-soeborg" aria-selected="false">Søborg</a>
  <a class="nav-link" id="pills-gentofte-tab" data-toggle="pill" href="#pills-gentofte" role="tab" aria-controls="pills-gentofte" aria-selected="false">Gentofte</a>
	  
</div>
</div>
</div>
	  <div id="over" class="overlay">
  					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  					<div class="overlay-content">
					
					<?php
					if(isset($_POST["cmd"])){
						$cmd = $_POST["cmd"];
					}
	
					if(isset($cmd)){
						$fNavn = filter_input(INPUT_POST, 'fNavn');
					$eNavn = filter_input(INPUT_POST, 'eNavn');
					$email = filter_input(INPUT_POST, 'email');
					$telefon = filter_input(INPUT_POST, 'telefon');
	  				$dato = filter_input(INPUT_POST, 'dato');
					$startTid = filter_input(INPUT_POST, 'startTid');
	  				$antal = filter_input(INPUT_POST, 'antal');
					
					if($antal==2){
						$bord_idBord=2;
					} elseif($antal == 4){
						$bord_idBord=1;
					} elseif($antal == 6){
						$bord_idBord=3;
					} elseif($antal == 8){
						$bord_idBord=5;
					}
						
		
		
		$sql = 'INSERT INTO reservation(fNavn, eNavn, email, telefon, dato, startTid, antal, booket, bord_idBord)VALUES(?, ?, ?, ?, ?, ?, ?, 1, ?)';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('sssissii', $fNavn, $eNavn, $email, $telefon, $dato, $startTid, $antal, $bord_idBord);
		$stmt->execute();
		$stmt->bind_result($booket);
		
		/*
		if($booket==1){
			$startTid = 
		}
		*/
						
		if($stmt->affected_rows>0){
			echo 'Du er nu tilføjet til mail listen ';
			echo '<script>javascript:alert("asdad");</script>';
		}
		else {
			echo '<script>javascript:alert("2344");</script>';
			echo $email. 'var allerede på listen';
		
					}
						}
					?> 
  							
							<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
							<label class="screenread-only">Fornavn</label>
            					<input class="input-bred" type="text" name="fNavn" placeholder="Fornavn" required><br><br>
							<label class="screenread-only">Efternavn</label>
            					<input class="input-bred" type="text" name="eNavn" placeholder="Efternavn" required><br><br>
            				<label class="screenread-only">email</label>
            					<input class="input-bred" type="email" name="email" placeholder="E-mail" required><br><br>
							<label class="screenread-only">Telefon nummer</label>
            					<input class="input-bred" type="tel" name="telefon" placeholder="Telefon nummer" required><br><br>
							<label class="rejesdato">Dato:</label>
            					<input class="input-bred" type="date" name="dato" required><br><br>
							<label class="screenread-only">Tid</label>
								<select id="startTid" type="text" name="startTid" required>
									<option value="12:00">12:00</option>
									<option value="14:00">14:00</option>
									<option value="16:00">16:00</option>
									<option value="18:00">18:00</option>
									<option value="20:00">20:00</option>
								</select><br><br>
							<label class="screenread-only">Antal Personer</label>
								<select id="antal" type="text" name="antal" required>
									<option value="2">2</option>
									<option value="4">4</option>
									<option value="6">6</option>
									<option value="8">8</option>
								</select><br><br>
							<label class="screenread-only">Reserver</label>
            					<input class="book-tour input-bred" name="cmd" type="submit" value="reserver">
							</form>
  					</div>
					</div>
	
	 <div class="container">
		 
	 <div class="tab-content" id="pills-tabContent">
		 
  <!-- CHRISTIANSHAVN START -->
  		<div class="tab-pane fade show active" id="pills-christianshavn" role="tabpanel" aria-labelledby="pills-christianshavn-tab">
			 <div class="row menu-overskrift">
       			 <div class="col-12 col-lg-12 mx-auto">
				<br>
					<h1>Christianshavn</h1>
				<br>
				
				 
		<div id="restaurantslide" class="carousel slide" data-ride="carousel">
  			<ol class="carousel-indicators prik">
    			<li data-target="#restaurantslide" data-slide-to="0" class="active"></li>
    			<li data-target="#restaurantslide" data-slide-to="1"></li>
  			</ol>
  		<div class="carousel-inner slide1">
    		<div class="carousel-item active">
      			<img class="d-block w-100 picslide" src="img/gm_chris_1.jpg" alt="christianshavn restaurant">
    		</div>
    	<div class="carousel-item">
      			<img class="d-block w-100 picslide" src="img/gm_chris_2.jpg" alt="christianshavn restaurant">
    	</div>
    
  		</div>
  			<a class="carousel-control-prev" href="#restaurantslide" role="button" data-slide="prev">
    			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    				<span class="sr-only">Previous</span>
  			</a>
  			<a class="carousel-control-next" href="#restaurantslide" role="button" data-slide="next">
    			<span class="carousel-control-next-icon" aria-hidden="true"></span>
    				<span class="sr-only">Next</span>
  			</a>
		</div>	 

	  </div>	
				 
	</div>
			 
		<div class="container">
  			<div class="row info">
    			<div class="col-6 col-lg-6 info_restaurant">
					<h3>Adresse</h3>
					<p>Torvegade 16<br>
					1400 København</p>
					
    			</div>
    			<div class="col-6 col-lg-6 info_restaurant1">
					<h3>Bestil på</h3>
					<h2>28 11 40 00</h2>
    			</div>
  			</div>
			
			<div class="row info">
    			<div class="col-6 col-lg-3 info_restaurant ">
					<h3>Åbningstider</h3>
					<p>Man-fre<br>
					Lør, søn, helligdage</p>
					
    			</div>
    			<div class="col-6 col-lg-3 info_restaurant1">
					<h3>..</h3>
					<p>11.00 - 22.00<br>
					16.00 - 22.00</p>
    			</div>
	
						
				
			<div class="col-12 col-lg-6 info_restaurant1 bord">
					 

		<button type="button" class="btn- btn-success bookbord" onclick="openNav()">Book et bord</button>


		<script>
			function openNav() {
    		document.getElementById("over").style.display = "block";
			}

			function closeNav() {
    		document.getElementById("over").style.display = "none";
			}
		</script>
		</div>
	</div>
</div>
  		
			
		
				
</div>
  	
<!-- CHRISTIANSHAVN SLUT-->	 
		 
	
  <!-- SØBORG START-->
		 
  <div class="tab-pane fade" id="pills-soeborg" role="tabpanel" aria-labelledby="pills-soeborg-tab">
		<div class="row menu-overskrift">
       			 <div class="col-12 col-lg-12 mx-auto">
				<br>
					<h1>Søborg</h1>
				<br>
				
				 
<div id="restaurantslide1" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators prik">
    <li data-target="#restaurantslide1" data-slide-to="0" class="active"></li>
    <li data-target="#restaurantslide1" data-slide-to="1"></li>
    <li data-target="#restaurantslide1" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner slide1">
    <div class="carousel-item active">
      <img class="d-block w-100 picslide" src="img/gm_sb_1.jpg" alt="soeborg restaurant">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 picslide" src="img/gm_sb_2.jpg" alt="soeborg slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 picslide" src="img/gm_sb_3.jpg" alt="soeborg slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#restaurantslide1" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#restaurantslide1" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> 

	</div>	
		</div>
			 
		<div class="container">
  			<div class="row info">
    			<div class="col-6 col-lg-6 info_restaurant">
					<h3>Adresse</h3>
					<p>Søborg Hovedgade 62<br>
					2860 Søborg</p>
					
    			</div>
    			<div class="col-6 col-lg-6 info_restaurant1">
					<h3>Bestil på</h3>
					<h2>28 11 40 00</h2>
    			</div>
  			</div>
			
			<div class="row info">
    			<div class="col-6 col-lg-3 info_restaurant ">
					<h3>Åbningstider</h3>
					<p>Man-fre<br>
					Lør, søn, helligdage</p>
					
    			</div>
    			<div class="col-6 col-lg-3 info_restaurant1">
					<h3>..</h3>
					<p>12.00 - 22.00<br>
					12.00 - 22.00</p>
    			</div>
				<div class="col-12 col-lg-6 info_restaurant1 bord">
					 

		<button type="button" class="btn- btn-success bookbord" onclick="openNav()">Book et bord</button>


		<script>
			function openNav() {
    		document.getElementById("over").style.display = "block";
			}

			function closeNav() {
    		document.getElementById("over").style.display = "none";
			}
		</script>
		</div>
			</div>
			
		</div>
	  		
</div>
  <!--SØBORG SLUT-->
		 
  <!--GENTOFTE START-->
  	<div class="tab-pane fade" id="pills-gentofte" role="tabpanel" aria-labelledby="pills-gentofte-tab">
		 <div class="row menu-overskrift">
       			 <div class="col-1-1 col-lg-12 mx-auto">
				<br>
					<h1>Gentofte</h1>
				<br>
				
				 
		<div id="restaurantslide2" class="carousel slide" data-ride="carousel">
  			<ol class="carousel-indicators prik">
    			<li data-target="#restaurantslide2" data-slide-to="0" class="active"></li>
    			<li data-target="#restaurantslide2" data-slide-to="1"></li>
				<li data-target="#restaurantslide2" data-slide-to="2"></li>
  			</ol>
  		<div class="carousel-inner slide1">
    		<div class="carousel-item active">
      			<img class="d-block w-100 picslide" src="img/gm_gen_1.jpg" alt="gentofte restaurant">
    		</div>
    	<div class="carousel-item picslide">
      			<img class="d-block w-100 picslide" src="img/gm_gen_2.jpg" alt="gentofte restaurant">
    	</div>
		<div class="carousel-item picslide">
      			<img class="d-block w-100 picslide" src="img/gm_gen3.jpg" alt="gentofte restaurant">
    	</div>
    
  		</div>
  			<a class="carousel-control-prev" href="#restaurantslide2" role="button" data-slide="prev">
    			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    				<span class="sr-only">Previous</span>
  			</a>
  			<a class="carousel-control-next" href="#restaurantslide2" role="button" data-slide="next">
    			<span class="carousel-control-next-icon" aria-hidden="true"></span>
    				<span class="sr-only">Next</span>
  			</a>
		</div>	 

	  </div>	
				 
	</div>
			 
		<div class="container">
  			<div class="row info">
    			<div class="col-6 col-lg-6 info_restaurant">
					<h3>Adresse</h3>
					<p>Gentoftegade 49<br>
					2820 Gentofte</p>
					
    			</div>
    			<div class="col-6 col-lg-6 info_restaurant1">
					<h3>Bestil på</h3>
					<h2>28 11 40 00</h2>
    			</div>
  			</div>
			
			<div class="row info">
    			<div class="col-6 col-lg-3 info_restaurant ">
					<h3>Åbningstider</h3>
					<p>Man-fre<br>
					Lør, søn, helligdage</p>
					
    			</div>
    			<div class="col-6 col-lg-3 info_restaurant1">
					<h3>..</h3>
					<p>11.00 - 22.00<br>
					12.00 - 22.00</p>
    			</div>
				<div class="col-12 col-lg-6 info_restaurant1 bord">
					 

		<button type="button" class="btn- btn-success bookbord" onclick="openNav()">Book et bord</button>


		<script>
			function openNav() {
    		document.getElementById("over").style.display = "block";
			}

			function closeNav() {
    		document.getElementById("over").style.display = "none";
			}
		</script>
		</div>
			</div>
			
		</div>
	  		
</div>
	<!--Gentofte SLUT-->
	
	
	</div>
</div>
  
	<div class="container-fluid foothr">
			
	</div>
	  
		<?php
	  require('totop.php')
	  	?>

   		<?php
		  require('footer.php')
	  	?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>
	  
	 <!-- --> 


  </body>

</html>
		