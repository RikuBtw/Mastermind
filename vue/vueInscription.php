<?php
class VueInscription{



function afficheInscription(){

  header("Content-type: text/html; charset=utf-8");
  ?>
  <html>
    <head>
      <title>Mastermind</title>
      <link rel="stylesheet" href="./css/styleAuthentification.css" />
      <link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
      <style type:"text/css">
        body { background:url(' ./img/background<?php echo $_COOKIE['background'] ?>') no-repeat center center fixed; background-size:cover;
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
						<input type="text" id="pseudo" name="pseudo-inscription" placeholder="Username">
					</div>
					<div class = "input-box">
						<input type="password" id="password" name="password-inscription" placeholder="Password">
					</div>
          <div class = "input-box">
            <input type="password" id="password" name="password2-inscription" placeholder="Confirm password">
          </div>
          <div class = "input-button">
            <input type="submit" style="cursor:pointer" name="inscrire" value = "Valider">
          </div>
				</form>
			</div>
      <div class="logout-cross" onclick="window.location='./controleur/controleurLogout.php'">
      X
      </div>
		</div>
      </div>
    </body>
  </html>
  <?php
  }
}
?>
