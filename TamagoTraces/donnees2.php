<?php

$donneesrecues = $_POST['choix_donnees'];

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

if ($donneesrecues == $valeurgroupe) {

$result3 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE logType= 'feedTamagoAction' AND legal=0 GROUP BY `resourceType` ORDER BY theCount DESC LIMIT 2")
or die(mysql_error());
$resourceexaminee=array();
while($row3 = mysql_fetch_array($result3)){
$stock2 = $row3['resourceType'];
$resourceexaminee[]=$stock2;
}                      
                                                 
                          
echo "<h3>Statistiques du Groupe</h3>
		    <p id='intit0'>Nombre d'actions entreprises</p>
         <canvas id='myChart0'></canvas>
          <p id='intit1'>Echec succès du nourrissage par ressource</p>
          <canvas id='myChart1'></canvas>
          <p id='intit2'>Niveaux franchis</p>
          <canvas id='myChart2'></canvas>
          <p id='intit3'>Actions entreprises lors d'échec nourrissage pour $resourceexaminee[0]</p>
          <canvas id='myChart3'></canvas>
          <p id='intit4'>Actions entreprises lors d'échec nourrissage pour $resourceexaminee[1]</p>
          <canvas id='myChart4'></canvas>
          ";
}

for ($i=0; $i < $nombrejoueurs ; $i++) {
if ($donneesrecues ==  $identifiants[$i]) {

$result3 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE name = '$noms[$i]' AND logType= 'feedTamagoAction' AND legal=0 GROUP BY `resourceType` ORDER BY theCount DESC LIMIT 2")
or die(mysql_error());
$resourceexaminee=array();
while($row3 = mysql_fetch_array($result3)){
$stock2 = $row3['resourceType'];
$resourceexaminee[]=$stock2;
}

echo utf8_encode("<h3>Statistiques de $noms[$i]</h3>");
echo "<p id='intit0'>Nombre d'actions entreprises</p>
      <canvas id='myChart0'></canvas>
          <p id='intit1'>Echec succès du nourrissage par ressource</p>
          <canvas id='myChart1'></canvas>
          <p id='intit2'>Niveaux franchis</p>
          <canvas id='myChart2'></canvas>
          <p id='intit3'>Actions entreprises lors d'échec nourrissage pour $resourceexaminee[0]</p>
          <canvas id='myChart3'></canvas>
          <p id='intit4'>Actions entreprises lors d'échec nourrissage pour $resourceexaminee[1]</p>
          <canvas id='myChart4'></canvas>";
          
}



}


?>