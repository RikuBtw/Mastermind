<?php
class Erreur{

function afficheErreurAuthentification(){
  header("Content-type: text/html; charset=utf-8");

  ?>
  <html>
    <head>
      <title>Mastermind</title>
      <link rel="stylesheet" href="./css/style.css" />
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
            <input type="submit"; style="cursor:pointer";>
          </div>
          <div class= "container-erreur">
            <div class = "erreur">
              Login incorrect
            </div>
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
