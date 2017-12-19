<?php
	$fn = basename($_SERVER['PHP_SELF']); //gør så man kan se hvilken en man er på
/*	
	if ($fn == 'p2.php'){
		echo 'selected';
	}
*/
// (a>20)? 'wee' : 'nooo';
?>


<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
       <div class="logo"><img src="img/gmlogo_01.png" class="logogm"></div>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>
		  
		  	  
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link menu<?= ($fn== 'index.php')?' selected':'' ?>" href="index.php">Forside</a>
            </li>
            <li class="nav-item">
              <a class="nav-link menu<?= ($fn== 'menukort.php')?' selected':'' ?>" href="menukort.php">Menukort</a>
            </li>
			<li class="nav-item">
              <a class="nav-link menu<?= ($fn== 'restauranter.php')?' selected':'' ?>" href="restauranter.php">Restauranter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link menu<?= ($fn== 'udbringning.php')?' selected':'' ?>" href="udbringning.php">Udbringning</a>
            </li>
            <li class="nav-item">
              <a class="nav-link menu<?= ($fn== 'info.php')?' selected':'' ?>" href="info.php">Info</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
