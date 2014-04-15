<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
   <link rel="stylesheet" href="style.css" />
    <script id='donnees'></script>
    <script src="jquery.js"></script>   
    <script src="base64.js"></script>
    <script src="sprintf.js"></script>
    <script src="FileSaver.js"></script>
    <script src="jspdf.js"></script>
    <script src="jspdf.plugin.addimage.js"></script>
    <script src="script.js"></script>
    <script src="chart.js"></script>
    </head>
  <body>
   <header>
      <div class="header_images">
<img class="logo" id="logoEductice" src="images/logo_eductice.jpg">
<img class="logo" id="logoENS" src="images/logo_ens.jpg">
<img class="logo" id="logoIFE" src="images/logo_ife.jpg">
      </div>
    <div class="header_titre">
      <h1 class= "titre">TAMAGOCOURS-FORMATEURS</h1>
    </div>
   </header></br>
<a href='index.html'/><button>Accueil</button></a>
    <h1>Présentation des données</h1>

<?php
  mysql_connect("localhost", "root", "") or die(mysql_error());
  mysql_select_db("inf42") or die(mysql_error());
  $result = mysql_query("SELECT DISTINCT name FROM table2")
  or die(mysql_error());  
  $result2 = mysql_query("SELECT DISTINCT user_id FROM table2")
  or die(mysql_error());  
  
$noms=array();
while($row = mysql_fetch_array($result)){
$stock = $row['name'];
$noms[]=$stock;
}

$identifiants=array();
while($row2 = mysql_fetch_array($result2)){
$stock2 = $row2['user_id'];
$identifiants[]=$stock2;
}

$nombrejoueurs = sizeof($noms);
$valeurgroupe = array_sum($identifiants);



        echo utf8_encode ( "<form id='JqPostForm'>
        <input type='radio' onClick='affiche3();' name='choix_donnees' value='$valeurgroupe'> Le groupe");
        for($i=0 ; $i< $nombrejoueurs  ; $i++){
        echo utf8_encode ("<input type='radio' onClick='affiche3();' name='choix_donnees' value='$identifiants[$i]'> $noms[$i]");
        }
        echo utf8_encode("</form>
          <div id='boutons'>
          <button id='visu5'>Tous</button>
          <button id='visu0'>Graphe 1</button>
          <button id='visu1'>Graphe 2</button>
          <button id='visu2'>Graphe 3</button>
          <button id='visu3'>Graphe 4</button>
          <button id='visu4'>Graphe 5</button>
          <button id='visu6'>Pdf</button>
          </div>

          <div id='intitule'></div>
           <p id='intit6'>Export pdf des traces</p>
           <iframe id='pdf' src='' width='800' height='400'></iframe>");      

     
?>
</body>
</html>