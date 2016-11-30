<?php
class VueErreur{

function afficheErreurAuthentification(){
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
            <input type="text" id="pseudo" name="pseudo" placeholder="Username">
          </div>
          <div class = "input-box">
            <input type="password" id="password" name="password" placeholder="Password">
          </div>
          <div class = "input-button">
            <input type="submit" style="cursor:pointer" name="valider" value="Valider">
          </div>
          <div class= "container-erreur">
            <div class = "erreur">
              Login incorrect
            </div>
          </div>
          <form method="POST" action="index.php">
            <input type="submit" class = "linkButton" style="cursor:pointer" name="inscription" value = "Pas de compte? Inscrivez vous">
          </form>
        </form>
      </div>
    </div>
      </div>
    </body>
  </html>
  <?php
  }

  function afficheErreurInscription($id_erreur){

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
            <?php
              if($id_erreur == 3){
                ?>
                <div class= "container-erreur">
                  <div class = "erreur">
                    Vérifiez les informations entrées
                  </div>
                </div>
                <?php
              }else if($id_erreur == 1){
                ?>
                <div class= "container-erreur">
                  <div class = "erreur">
                    Le nom est déjà prit
                  </div>
                </div>
                <?php
              }else if($id_erreur == 2){
                ?>
                <div class= "container-erreur">
                  <div class = "erreur">
                  Veuillez confimer votre mot de passe
                  </div>
                </div>
                <?php
              }
            ?>
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
