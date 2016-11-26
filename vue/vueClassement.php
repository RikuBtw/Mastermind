<?php
class VueClassement{

  private $classementListe;

  function __construct($classementListe){
    $this->classementListe = $classementListe;
  }

  function afficheClassement(){
    header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
      <head>
        <link rel="stylesheet" href="./css/styleClassement.css" />
        <link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
        <style type:"text/css">
          body { background:url(' ./img/background<?php echo $_COOKIE['background'] ?>') no-repeat center center fixed; background-size:cover;
          }
        </style>
        <title>Mastermind</title>
      </head>
      <body>

          <div class="header">
            <div class="title">
              <div class="replay-container">
                <form action='index.php' method='GET'>
                  <input type='submit' class="replay-image" name='replay' value='replay' id='replayHeader'>
                </form>
              </div>
              <div class=title-logo>
              </div>
            </div>
            <div class="logout-container">
              <div class="logout"; onclick="window.location='./controleur/controleurLogout.php'">
                <div class="logout-logo">
                </div>
              </div>
            </div>
          </div>

          <div class = "container-center">
            <div class = "container-stats">
              <div class = "container-rank">
                <div class = 'container-text'>
                  <div class= 'container-text-title'>
                    Joueur
                  </div>
                  <br>
                  <?php
                    for($i = 0; $i <5; $i++){
                      echo $this->classementListe[$i][0];
                      echo "<br>";
                    }
                  ?>
                </div>
                <div class = 'container-text'>
                  <div class= 'container-text-title'>
                    Nb Coups
                  </div>
                  <br>
                  <?php
                    for($i = 0; $i <5; $i++){
                      echo $this->classementListe[$i][1];
                      echo "<br>";
                    }
                  ?>
                </div>
                <div class = 'container-text'>
                  <div class= 'container-text-title'>
                    % Victoire
                  </div>
                  <br>
                  <?php
                    for($i = 0; $i <5; $i++){
                      echo $this->classementListe[$i][2];
                      echo "<br>";
                    }
                  ?>
                </div>
              </div>

              <div class = "container-partie">
                blabla
              </div>
            </div>
          </div>
      </body>
    </html>
    <?php
  }
}
?>
