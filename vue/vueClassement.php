<?php
class VueClassement{

  private $classementListe;
  private $moyenneCoups;
  private $moyenneGagnee;

  function __construct($classementListe, $moyenneCoups, $moyenneGagnee){
    $this->classementListe = $classementListe;
    $this->moyenneCoups = $moyenneCoups;
    $this->moyenneGagnee = $moyenneGagnee;
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
                <form action='index.php' method='POST'>
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
                <?php
                echo "Cher ".$_SESSION['user_token'].", ";
                if($_SESSION['etatPartie'] == 1){
                  echo " félicitations pour votre victoire !";
                  echo "</br>";
                  echo "</br>";
                }else if($_SESSION['etatPartie'] == 0){
                  echo " vous réussirez mieux la prochaine fois !";
                  echo "</br>";
                  echo "</br>";
                }
                echo "Votre nombre de coups joués à cette partie s'élève à ".$_SESSION['nbCoups'].".";
                echo "</br>";
                echo "Votre moyenne de coups est de ".$this->moyenneCoups.", et vous avez un taux de victoire de ".$this->moyenneGagnee."%."

                ?>
              </div>
            </div>
          </div>
      </body>
    </html>
    <?php
  }
}
?>
