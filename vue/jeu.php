<?php
class Jeu{

  private $isHidden;
  private $colorHidden;
  private $colorShowed;
  private $colorCorrect;
  private $colorPicker;
  private $authorizedColumn;

  function __construct(){
      $this->isHidden = true;
      $this->colorPicker = ["bleu", "rouge", "jaune", "vert", "blanc", "orange", "violet", "fushia"];
      $this->colorHidden = ["bleu", "rouge", "vert", "blanc"];
      $this->colorShowed = array(
        array("bleu","rouge","rouge","jaune"),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","vert",""),
      );
      $this->colorCorrect = array(
        array("blanc","noir","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
      );
      $this->authorizedColumn = 8;
  }

  function demandeAfficheJeu(){
    header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
      <head>
        <link rel="stylesheet" href="./css/style.css" />
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
        </div>
        <div class = "container-center">
          <div class="container-board">
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
          </div>
          </div>
        </div>
      </div>
      <div class ="footer">

        <div class = "white-ribon">
          <div class="container-center">
            <div class="container-row">
              <?php
              for($i = 0; $i<8; $i++){
                echo "<div class = 'container-circle-picker'>";
                echo "<div class = 'circle ".$this->colorPicker[$i]."'>\n";
                echo "</div>";
                echo "</div>";
              }
              ?>
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
