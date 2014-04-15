<?php

$donneesrecues = $_POST['choix_donnees'];

$couleurs = array( 0 => '#D97041', 1 => '#FFC0CB', 2 => '#EA1B1B',3 => '#FF8C00',4 => '#800080',5 => '#010801',6 => '#DE9EEE9',7 => '#E01DD4',);

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("inf42") or die(mysql_error());

$result = mysql_query("SELECT DISTINCT name FROM table2")
  or die(mysql_error());  
$result1 = mysql_query("SELECT DISTINCT user_id FROM table2")
  or die(mysql_error());  

$noms=array();
while($row = mysql_fetch_array($result)){
$stock = $row['name'];
$noms[]=$stock;
}

$identifiants=array();
while($row2 = mysql_fetch_array($result1)){
$stock2 = $row2['user_id'];
$identifiants[]=$stock2;
}

$nombrejoueurs = sizeof($noms);
$valeurgroupe = array_sum($identifiants);

if ($donneesrecues == $valeurgroupe) {
$result2 = mysql_query("SELECT DISTINCT logType FROM table2 ORDER BY logType")
or die(mysql_error()); 
$result3 = mysql_query("SELECT COUNT(logType) FROM table2 GROUP BY logType ORDER BY logType")
or die(mysql_error());  

$intitules=array();
while($row = mysql_fetch_array($result2)){
$stock = $row['logType'];
$intitules[]=$stock;
}
$intitulesexploses = implode("','",$intitules);

$donnees=array();
while($row3 = mysql_fetch_array($result3)){
$stock3 = $row3['COUNT(logType)'];
$donnees[]=$stock3;
}
$donneesexplosees = implode("','",$donnees);

echo "var data0 = {labels:['$intitulesexploses'],
datasets : [
     {
      fillColor : 'rgba(151,187,205,0.5)',
      strokeColor : 'rgba(151,187,205,1)',
      pointColor : 'rgba(151,187,205,1)',
      pointStrokeColor : '#fff',
      data : ['$donneesexplosees']
    }
  ]
};";  
 
$result4 = mysql_query("SELECT DISTINCT resourceType FROM table2 ORDER BY resourceType")
or die(mysql_error()); 
$result5 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE logType= 'feedTamagoAction' AND legal=1 GROUP BY `resourceType` ORDER BY resourceType")
or die(mysql_error()); 
$result6 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE logType= 'feedTamagoAction' AND legal=0 GROUP BY `resourceType` ORDER BY resourceType ")
or die(mysql_error());  

$donnees0=array();
while($row3 = mysql_fetch_array($result4)){
$stock2 = $row3['resourceType'];
$donnees0[]=$stock2;
}
$donneesexplosees0 = implode("','",$donnees0);

$donnees1=array();
while($row3 = mysql_fetch_array($result5)){
$stock2 = $row3['theCount'];
$donnees1[]=$stock2;
}
$donneesexplosees1 = implode(",",$donnees1);

$donnees2=array();
while($row3 = mysql_fetch_array($result6)){
$stock3 = $row3['theCount'];
$donnees2[]=$stock3;
}
$donneesexplosees2 = implode(",",$donnees2);

echo "var data1 = {labels:['$donneesexplosees0'],
datasets : [
     {
      fillColor : 'rgba(220,220,220,0.5)',
      strokeColor : 'rgba(220,220,220,1)',
      data : [$donneesexplosees1]
    },
    {
      fillColor : 'rgba(151,187,205,0.5)',
      strokeColor : 'rgba(151,187,205,1)',
      pointColor : 'rgba(151,187,205,1)',
      pointStrokeColor : '#fff',
      data : [$donneesexplosees2]
  }
  ]
};";  

$result7 = mysql_query("SELECT DISTINCT level_id FROM table2")
or die(mysql_error()); 

$donnees3=array();
while($row3 = mysql_fetch_array($result7)){
$stock2 = $row3['level_id'];
$donnees3[]=$stock2;
}

echo "var data2 = {labels:['Niveau1','Niveau2','Niveau3','Niveau4','Niveau5',],
datasets : [
     {
      fillColor : 'rgba(220,220,220,0.5)',
      strokeColor : 'rgba(220,220,220,1)',
      
      data : [";  
for ($w=0; $w <5 ; $w++) { 
$numeroniveau = $w + 1;
if ($donnees3[$w] == $numeroniveau) {
$tableau=array(",",",",",",",","");
echo utf8_encode("100$tableau[$w]");   
 } 
else {
echo utf8_encode("1$tableau[$w]");   
 } 
}

echo utf8_encode("]
    },
    ]
};");   
      
$result8 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE logType= 'feedTamagoAction' AND legal=0 GROUP BY `resourceType` ORDER BY theCount DESC LIMIT 2")
or die(mysql_error()); 

$donnees4=array();
while($row3 = mysql_fetch_array($result8)){
$stock2 = $row3['resourceType'];
$donnees4[]=$stock2;
}

$result9 = mysql_query("SELECT logType, COUNT(logType) from `table2` WHERE  resourceType='$donnees4[0]' AND legal=0 GROUP BY logType ORDER BY logType")
or die(mysql_error()); 
$result10 = mysql_query("SELECT logType, COUNT(logType) from `table2` WHERE  resourceType='$donnees4[0]' AND legal=0 GROUP BY logType ORDER BY logType")
or die(mysql_error()); 

$donnees5=array();
while($row3 = mysql_fetch_array($result9)){
$stock2 = $row3['logType'];
$donnees5[]=$stock2;
}
$donneesexplosees3 = implode("','",$donnees5);

$donnees6=array();
while($row3 = mysql_fetch_array($result10)){
$stock2 = $row3['COUNT(logType)'];
$donnees6[]=$stock2;
}
$donneesexplosees4 = implode(",",$donnees6);


echo "var data3 = {labels:['$donneesexplosees3'],
datasets : [
     {
      fillColor : 'rgba(151,187,205,0.5)',
      strokeColor : 'rgba(151,187,205,1)',
      pointColor : 'rgba(151,187,205,1)',
      pointStrokeColor : '#fff',
      data : [$donneesexplosees4]
    }
  ]
};";  

$result11 = mysql_query("SELECT logType, COUNT(logType) from `table2` WHERE  resourceType='$donnees4[1]' AND legal=0 GROUP BY logType ORDER BY logType")
or die(mysql_error()); 
$result12 = mysql_query("SELECT logType, COUNT(logType) from `table2` WHERE  resourceType='$donnees4[1]' AND legal=0 GROUP BY logType ORDER BY logType")
or die(mysql_error()); 

$donnees7=array();
while($row3 = mysql_fetch_array($result11)){
$stock2 = $row3['logType'];
$donnees7[]=$stock2;
}
$donneesexplosees5 = implode("','",$donnees7);

$donnees8=array();
while($row3 = mysql_fetch_array($result12)){
$stock2 = $row3['COUNT(logType)'];
$donnees8[]=$stock2;
}
$donneesexplosees6 = implode(",",$donnees8);


echo "var data4 = {labels:['$donneesexplosees5'],
datasets : [
     {
      fillColor : 'rgba(151,187,205,0.5)',
      strokeColor : 'rgba(151,187,205,1)',
      pointColor : 'rgba(151,187,205,1)',
      pointStrokeColor : '#fff',
      data : [$donneesexplosees6]
    }
  ]
};";  


}

















































for ($i=0; $i < $nombrejoueurs ; $i++) {
if ($donneesrecues ==  $identifiants[$i]) {

$result2 = mysql_query("SELECT DISTINCT logType FROM table2 ORDER BY logType")
or die(mysql_error()); 
$result3 = mysql_query("SELECT COUNT(logType) FROM table2 WHERE name = '$noms[$i]' GROUP BY logType ORDER BY logType")
or die(mysql_error());  

$intitules=array();
while($row = mysql_fetch_array($result2)){
$stock = $row['logType'];
$intitules[]=$stock;
}
$intitulesexploses = implode("','",$intitules);

$donnees=array();
while($row3 = mysql_fetch_array($result3)){
$stock1 = $row3['COUNT(logType)'];
$donnees[]=$stock1;
}
$donneesexplosees = implode("','",$donnees);

echo "var data0 = {labels:['$intitulesexploses'],
datasets : [
     {
      fillColor : 'rgba(151,187,205,0.5)',
      strokeColor : 'rgba(151,187,205,1)',
      pointColor : 'rgba(151,187,205,1)',
      pointStrokeColor : '#fff',
      data : ['$donneesexplosees']
    }
  ]
};";  

$result4 = mysql_query("SELECT DISTINCT resourceType FROM table2 ORDER BY resourceType")
or die(mysql_error()); 
$result5 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE name = '$noms[$i]' AND logType= 'feedTamagoAction' AND legal=1 GROUP BY `resourceType` ORDER BY resourceType")
or die(mysql_error()); 
$result6 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE name = '$noms[$i]' AND logType= 'feedTamagoAction' AND legal=0 GROUP BY `resourceType` ORDER BY resourceType ")
or die(mysql_error());  

$donnees0=array();
while($row3 = mysql_fetch_array($result4)){
$stock2 = $row3['resourceType'];
$donnees0[]=$stock2;
}
$donneesexplosees0 = implode("','",$donnees0);

$donnees1=array();
while($row3 = mysql_fetch_array($result5)){
$stock2 = $row3['theCount'];
$donnees1[]=$stock2;
}
$donneesexplosees1 = implode(",",$donnees1);

$donnees2=array();
while($row3 = mysql_fetch_array($result6)){
$stock3 = $row3['theCount'];
$donnees2[]=$stock3;
}
$donneesexplosees2 = implode(",",$donnees2);

echo "var data1 = {labels:['$donneesexplosees0'],
datasets : [
     {
      fillColor : 'rgba(220,220,220,0.5)',
      strokeColor : 'rgba(220,220,220,1)',
      data : [$donneesexplosees1]
    },
    {
      fillColor : 'rgba(151,187,205,0.5)',
      strokeColor : 'rgba(151,187,205,1)',
      pointColor : 'rgba(151,187,205,1)',
      pointStrokeColor : '#fff',
      data : [$donneesexplosees2]
  }
  ]
};";  

$result7 = mysql_query("SELECT DISTINCT level_id FROM table2 WHERE name = '$noms[$i]'")
or die(mysql_error()); 

$donnees3=array();
while($row3 = mysql_fetch_array($result7)){
$stock2 = $row3['level_id'];
$donnees3[]=$stock2;
}

echo "var data2 = {labels:['Niveau1','Niveau2','Niveau3','Niveau4','Niveau5',],
datasets : [
     {
      fillColor : 'rgba(220,220,220,0.5)',
      strokeColor : 'rgba(220,220,220,1)',
      data : [";  
for ($z=0; $z <5 ; $z++) { 
$numeroniveau = $z + 1;
if ($donnees3[$z] == $numeroniveau) {
echo utf8_encode("100,");   
 } 
else {
echo utf8_encode("1,");   
 } 
}
echo utf8_encode("]
    },
    ]
};");   

$result8 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE name = '$noms[$i]' AND logType= 'feedTamagoAction' AND legal=0 GROUP BY `resourceType` ORDER BY theCount DESC LIMIT 2")
or die(mysql_error()); 

$donnees4=array();
while($row3 = mysql_fetch_array($result8)){
$stock2 = $row3['resourceType'];
$donnees4[]=$stock2;
}

$result9 = mysql_query("SELECT logType, COUNT(logType) from `table2` WHERE  name = '$noms[$i]' AND resourceType='$donnees4[0]' AND legal=0 GROUP BY logType ORDER BY logType")
or die(mysql_error()); 
$result10 = mysql_query("SELECT logType, COUNT(logType) from `table2` WHERE name = '$noms[$i]' AND resourceType='$donnees4[0]' AND legal=0 GROUP BY logType ORDER BY logType")
or die(mysql_error()); 

$donnees5=array();
while($row3 = mysql_fetch_array($result9)){
$stock2 = $row3['logType'];
$donnees5[]=$stock2;
}
$donneesexplosees3 = implode("','",$donnees5);

$donnees6=array();
while($row3 = mysql_fetch_array($result10)){
$stock2 = $row3['COUNT(logType)'];
$donnees6[]=$stock2;
}
$donneesexplosees4 = implode(",",$donnees6);


echo "var data3 = {labels:['$donneesexplosees3'],
datasets : [
     {
      fillColor : 'rgba(151,187,205,0.5)',
      strokeColor : 'rgba(151,187,205,1)',
      pointColor : 'rgba(151,187,205,1)',
      pointStrokeColor : '#fff',
      data : [$donneesexplosees4]
    }
  ]
};";  

$result11 = mysql_query("SELECT logType, COUNT(logType) from `table2` WHERE  name = '$noms[$i]' AND resourceType='$donnees4[1]' AND legal=0 GROUP BY logType ORDER BY logType")
or die(mysql_error()); 
$result12 = mysql_query("SELECT logType, COUNT(logType) from `table2` WHERE  name = '$noms[$i]' AND resourceType='$donnees4[1]' AND legal=0 GROUP BY logType ORDER BY logType")
or die(mysql_error()); 

$donnees7=array();
while($row3 = mysql_fetch_array($result11)){
$stock2 = $row3['logType'];
$donnees7[]=$stock2;
}
$donneesexplosees5 = implode("','",$donnees7);

$donnees8=array();
while($row3 = mysql_fetch_array($result12)){
$stock2 = $row3['COUNT(logType)'];
$donnees8[]=$stock2;
}
$donneesexplosees6 = implode(",",$donnees8);


echo "var data4 = {labels:['$donneesexplosees5'],
datasets : [
     {
      fillColor : 'rgba(151,187,205,0.5)',
      strokeColor : 'rgba(151,187,205,1)',
      pointColor : 'rgba(151,187,205,1)',
      pointStrokeColor : '#fff',
      data : [$donneesexplosees6]
    }
  ]
};";  

} 
}


















































if ($donneesrecues == $valeurgroupe) {

$result20 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE logType= 'feedTamagoAction' AND legal=0 GROUP BY `resourceType` ORDER BY theCount DESC LIMIT 2")
or die(mysql_error());
$resourceexaminee=array();
while($row3 = mysql_fetch_array($result20)){
$stock2 = $row3['resourceType'];
$resourceexaminee[]=$stock2;
}

echo "function pdf () {
      var tableau = new Array ();
for (var i = 0; i < 5; i++) {
var backgroundColor = 'rgba(255,65536,255,256.255)';
var canvas = document.getElementById('myChart' + i);
var context = canvas.getContext('2d'); 
var data; 
var w = canvas.width;
var h = canvas.height;

data = context.getImageData(0, 0, w, h);

var compositeOperation = context.globalCompositeOperation;
context.globalCompositeOperation = 'destination-over';
context.fillStyle = backgroundColor;
context.fillRect(0,0,w,h);

var imageData = context.canvas.toDataURL('image/jpeg');
tableau[i] = imageData;
}



var doc = new jsPDF();
  doc.setFontSize(25);
  doc.text(38, 25, 'Visualisation des traces du groupe');
  doc.setFontSize(10);
  doc.text(20, 39, 'Actions realisees par le groupe');
  doc.addImage(tableau[0], 'JPEG', 15, 40, 60, 60);
  doc.setFontSize(10);
  doc.text(120, 37, 'Echec succes du nourrissage par ressource');
  doc.addImage(tableau[1], 'JPEG', 125, 40, 60, 60);
  doc.setFontSize(10);
  doc.text(36, 120, 'Niveaux franchis');
  doc.addImage(tableau[2], 'JPEG', 20, 130, 60, 60);
  doc.setFontSize(10);
  doc.text(120, 120, 'Actions entreprises pour $resourceexaminee[0]');
  doc.addImage(tableau[3], 'JPEG', 125, 130, 60, 60);
 doc.text(80, 210, 'Actions entreprises pour $resourceexaminee[1]');
  doc.addImage(tableau[4], 'JPEG', 73, 220, 60, 60);
  var u = doc.output('datauristring');
  $('#pdf').attr('src',u) 
};";
}

for ($s=0; $s < $nombrejoueurs ; $s++) {
if ($donneesrecues ==  $identifiants[$s]) {

$result20 = mysql_query("SELECT COUNT(logType) AS theCount, `resourceType` from `table2` WHERE name = '$noms[$s]' AND logType= 'feedTamagoAction' AND legal=0 GROUP BY `resourceType` ORDER BY theCount DESC LIMIT 2")
or die(mysql_error());
$resourceexaminee=array();
while($row3 = mysql_fetch_array($result20)){
$stock2 = $row3['resourceType'];
$resourceexaminee[]=$stock2;
}

echo utf8_encode("function pdf() {
      var tableau = new Array ();
for (var i = 0; i < 5; i++) {
var backgroundColor = 'rgba(255,65536,255,256.255)';
var canvas = document.getElementById('myChart' + i);
var context = canvas.getContext('2d'); 
var data; 
var w = canvas.width;
var h = canvas.height;

data = context.getImageData(0, 0, w, h);

var compositeOperation = context.globalCompositeOperation;
context.globalCompositeOperation = 'destination-over';
context.fillStyle = backgroundColor;
context.fillRect(0,0,w,h);

var imageData = context.canvas.toDataURL('image/jpeg');
tableau[i] = imageData;
}

var doc = new jsPDF();
  doc.setFontSize(25);
  doc.text(17, 25, 'Visualisation des traces de $noms[$s]');
  doc.setFontSize(10);
  doc.text(20, 39, 'Actions realisees par $noms[$s]');
  doc.addImage(tableau[0], 'JPEG', 15, 40, 60, 60);
  doc.setFontSize(10);
  doc.text(120, 37, 'Echec succes du nourrissage par ressource');
  doc.addImage(tableau[1], 'JPEG', 125, 40, 60, 60);
  doc.setFontSize(10);
  doc.text(36, 120, 'Niveaux franchis');
  doc.addImage(tableau[2], 'JPEG', 20, 130, 60, 60);
  doc.setFontSize(10);
  doc.text(120, 120, 'Actions entreprises pour $resourceexaminee[0]');
  doc.addImage(tableau[3], 'JPEG', 125, 130, 60, 60);
   doc.text(80, 210, 'Actions entreprises pour $resourceexaminee[1]');
  doc.addImage(tableau[4], 'JPEG', 73, 220, 60, 60);
  var u = doc.output('datauristring');
  $('#pdf').attr('src',u) ;
}");

  }
}

?>