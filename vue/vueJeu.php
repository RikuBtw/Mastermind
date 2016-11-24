<?php

class VueJeu{

  private $isHidden;
  private $colorHidden;
  private $colorShowed;
  private $colorCorrect;
  private $colorPicker;
  private $authorizedColumn;


  function __construct($modeleJeu){
      $this->isHidden = $modeleJeu->getIsHidden();
      $this->colorHidden = $modeleJeu->getColorHidden();
      $this->colorShowed = $modeleJeu->getColorShowed();
      $this->colorCorrect = $modeleJeu->getColorCorrect();
      $this->colorPicker = $modeleJeu->getColorPicker();
      $this->authorizedColumn = $modeleJeu->getAuthorizedColumn();
  }

  function afficheJeu(){
    header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
      <head>
        <link rel="stylesheet" href="./css/styleJeu.css" />
        <link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
        <style type:"text/css">
          body { background:url(' ./img/background<?php echo $_COOKIE['background'] ?>') no-repeat center center fixed; background-size:cover;
          }
        </style>
        <title>Mastermind</title>
      </head>
      <body>
        <div class="container-message">
          <div class="menu-fin-partie">
            <div class ="container-circle-picker">
              <form action='index.php' method='GET'>
                <input type='submit' class="logout-logo" name='backward' value='backward' id='logout'>
              </form>
            </div>
          </div>
        </div>
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
          <div class="container-board">
            <?php
              for($i = 0; $i<10; $i++){
                echo "            <div class='container-column ".(($this->authorizedColumn == $i)? "selection" : "")."'>\n";
                for($j = 0; $j<4; $j++){
                  echo "             <div class = 'container-circle'>\n";
                  echo "               <div class = 'circle ".$this->colorShowed[$i][$j]."'>\n";
                  echo "               </div>\n";
                  echo "             </div>\n";
                }
                  echo "            <div class='container-square-helper'>\n";
                  echo "              <div class='container-square-row'>\n";
                  for($j = 0; $j<2; $j++){
                    echo "               <div class = 'container-circle-result'>\n";
                    echo "                 <div class = 'circle-result ".$this->colorCorrect[$i][$j]."'>\n";
                    echo "                  </div>\n";
                    echo "               </div>\n";
                  }
                  echo "              </div>\n";
                  echo "            <div class='container-square-row'>\n";
                  for($j = 2; $j<4; $j++){
                    echo "             <div class = 'container-circle-result'>\n";
                    echo "               <div class = 'circle-result ".$this->colorCorrect[$i][$j]."'>\n";
                    echo "               </div>\n";
                    echo "             </div>\n";
                  }
                  echo "            </div>\n";
                  echo "            </div>\n";
                  echo "            </div>\n";
              }
            ?>
            <div class="container-column solution">
              <?php
                for($i = 0; $i<4; $i++){
                  echo "            <div class = 'container-circle'>\n";
                  echo "               <div class = 'circle ".(($this->isHidden == true)? "hidden" : $this->colorHidden[$i])."'>\n";
                  echo "               </div>\n";
                  echo "              </div>\n";
                }
              ?>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class ="footer">

        <div class = "white-ribon">
          <div class="container-center">
            <div class="container-row">
              <div class ="container-circle-picker">
                <form action='index.php' method='GET'>
                  <input type='submit' class="backward-image" name='backward' value='backward' id='backward'>
                </form>
              </div>

              <?php
              for($i = 0; $i<8; $i++){
                echo "<div class = 'container-circle-picker'>";
                echo "<form action='index.php' method='GET'>";
                echo "<input type='submit' name='circle' value='".$this->colorPicker[$i]."' id='".$this->colorPicker[$i]."'>\n";
                echo "</form>";
                echo "</div>";
              }
              ?>
              <div class ="container-circle-picker">
                <form action='index.php' method='GET'>
                  <input type='submit' class="check-image" name='check' value='check' id='check'>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class = "logo-jeu-ribon">
          <div class ="logo-jeu-container">
            <div class="logo-jeu">
            </div>
          </div>
        </div>
      </div>
      </body>
    </html>
    <?php
  }
}
?>
