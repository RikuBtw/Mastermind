<?php
class Authentification{



function demandePseudo(){

  header("Content-type: text/html; charset=utf-8");
	$background = array('1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg');
	$i = rand(0, count($background)-1);
  $tempBackground = $background[$i];
	setcookie("background",$background[$i]);

  ?>
  <html>
    <head>
      <title>Mastermind</title>
      <link rel="stylesheet" href="./css/style.css" />
      <link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
      <style type:"text/css">
        body { background:url(' ./img/background<?php echo $tempBackground ?>') no-repeat center center fixed; background-size:cover;
        }
      </style>
    </head>
    <body>
	<div class="container-center">
		<div class = "container-login">
			<div class = "container-logo">
				<div class = "logo"></div>
			</div>
			<div class = "container-form">
				<form method="POST" action="index.php">
					<div class = "input-box">
						<input type="text" id="pseudo" name="pseudo" placeholder="Username">
					</div>
					<div class = "input-box">
						<input type="password" id="password" name="password" placeholder="Password">
					</div>
          <div class = "input-button">
						<input type="submit" style="cursor:pointer" value = "Valider">


          </div>
				</form>
			</div>
		</div>
      </div>
    </body>
  </html>
  <?php
  }
}
?>
