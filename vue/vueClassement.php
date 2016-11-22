<?php
class VueClassement{

  private $classementListe;

  function __construct(){
    $this->classementListe = ["1","2","3","4","5"];
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
                <ul style="list-style-type:none">
                  <?php
                  for($i = 0; $i <5; $i++){
                    echo "<li>".$this->classementListe[$i]."</li>";
                  }
                  ?>
                </ul>
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
