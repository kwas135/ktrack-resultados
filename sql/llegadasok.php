<meta http-equiv="refresh" content="0;url=../ctiempo.php">
<?php 
$numero= $_POST['numero'];
$registrado='no';


$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ktrack", $con);
$sql2= "UPDATE tsalidas SET marcaje= NOW(2), total = (TIMEDIFF( `marcaje` , `salida`)) WHERE  numero='$numero' AND registrado='$registrado'";
 $sql3= "INSERT INTO  finonza (numero,tag,salida,marcaje,total,vuelt)
SELECT numero,tag,salida,marcaje,total,(SELECT COUNT(numero) FROM finonza WHERE numero=".$numero.")+1 FROM tsalidas WHERE numero='$numero' AND registrado='$registrado'";
 /*$sql4= "INSERT INTO  vueltas (numero,vuelta)
SELECT numero, COUNT(*) AS vuelt FROM finonza WHERE numero=".$numero;
*/
 $sql4=  "UPDATE tsalidas SET salida= NOW(2), 
         vuelta=(SELECT MAX(vuelt)  FROM finonza WHERE numero=".$numero."),
ttotal=(SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(marcaje, salida))))FROM finonza WHERE numero=".$numero.")
         WHERE  numero='$numero' AND registrado='$registrado'";
 
 $sql5= "UPDATE tsalidas SET registrado='si' WHERE  numero='$numero' AND tsalidas.vuelta=tsalidas.vueltas" ;





  if 
(!mysql_query($sql2,$con))
  {
  die('Error: ' . mysql_error());
 }
 if 
(!mysql_query($sql3,$con))
  {
  die('Error: ' . mysql_error());
 }
  if 
(!mysql_query($sql4,$con))
  {
  die('Error: ' . mysql_error());
 
 }
if 
(!mysql_query($sql5,$con))
  {
  die('Error: ' . mysql_error());
 
 }
 

mysql_close($con);

?>


