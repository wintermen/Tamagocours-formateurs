function affiche1 (){
var valeurtransmise1 = $("#JqPostForm").serialize();
       var transmission1 = $.post("donnees.php", valeurtransmise1, "json");
       transmission1.done(function(donnees) {
          $( "#donnees" ).html(donnees);                                                         
                 });   
}

function affiche2 (){
var valeurtransmise = $("#JqPostForm").serialize();
       var transmission = $.post("donnees2.php", valeurtransmise, "json");
       transmission.done(function(donnees) {
        $( "#intitule" ).html(donnees);  
                        });                                    
}

function affiche3 (){
 $("#boutons").css("display","block");
                                                   
}

function affichegraphiques() {
        var ctx0 = $("#myChart0").get(0).getContext("2d");
        var ctx1 = $("#myChart1").get(0).getContext("2d");
        var ctx2 = $("#myChart2").get(0).getContext("2d");
        var ctx3 = $("#myChart3").get(0).getContext("2d");
        var ctx4 = $("#myChart4").get(0).getContext("2d");

        ctx0.canvas.width = 400;
        ctx0.canvas.height = 400;
        ctx1.canvas.width = 400;
        ctx1.canvas.height = 400;
        ctx2.canvas.width = 400;
        ctx2.canvas.height = 400;
        ctx3.canvas.width = 400;
        ctx3.canvas.height = 400;
        ctx4.canvas.width = 400;
        ctx4.canvas.height = 400;

        var myNewChart = new Chart(ctx0).Radar(data0);               
        var myNewChart = new Chart(ctx1).Bar(data1);                  
        var myNewChart = new Chart(ctx2).Radar(data2);               
        var myNewChart = new Chart(ctx3).Bar(data3);        
        var myNewChart = new Chart(ctx4).Bar(data4);        

        

          };

$(document).ready(function() {
        $("iframe").hide();
        $("#intit6").hide();
         $("input").click(function() {
      $("form").hide(300);
      var tableau = ['pdf()',];
      $( "#donnees" ).empty();
      $( "#intitule" ).empty();  
      affiche1();
      affiche2();
      setTimeout("affichegraphiques()", 300);
      setTimeout(tableau[0], 400);
      affiche3();
      });
       
       $('div button').click(function() {
 var a = $(this).attr("id");
 var b = a.replace(/[^0-9]+/g, '');
 var c = "#myChart" + b;
 var d = "#intit" + b;
 $("iframe").hide();
 $("canvas").hide();
 $('#intitule p').hide();
$("#intit6").hide();
 $(d).show("slow");
  $(c).show("slow");
 });
       $('#visu5').click(function() {
 $("iframe").hide();
        $("#intit6").hide();
  $("#intitule p").show("slow");
  $("canvas").show("slow");
  });

$('#visu6').click(function() {
  $('canvas').hide();
 $('#intitule p').hide();
  $("iframe").show("slow");
 });

           })
        
          
