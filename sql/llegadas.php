<meta http-equiv="refresh" content="0;url=../ctiempo.php"> 
<?php 
include 'conexion.php';
$numero= $_POST['numero'];
$registrado='no';


$sql2= "UPDATE tsalidas SET marcaje= NOW(2), total = (TIMEDIFF( `marcaje` , `salida`)) WHERE  numero='$numero' AND registrado='$registrado'";
 $sql3= "INSERT INTO  finonza (numero,tag,salida,marcaje,total,vuelta)
SELECT numero,tag,salida,marcaje,total,(SELECT COUNT(numero) FROM finonza WHERE numero='$numero')+1 FROM tsalidas WHERE numero='$numero' AND registrado='$registrado'";

 $sql4=  "UPDATE tsalidas SET salida= NOW(2), 
         vuelta=(SELECT MAX(vuelta)  FROM finonza WHERE numero='$numero'),
ttotal=(SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(marcaje, salida))))FROM finonza WHERE numero='$numero')
         WHERE  numero='$numero' AND registrado='$registrado'";
 
 $sql5= "UPDATE tsalidas SET registrado='si' WHERE  numero='$numero' AND tsalidas.vuelta=tsalidas.vueltas" ;


$sql6= "INSERT INTO finonza (numero,marcaje)  SELECT '$numero',NOW(2)
WHERE NOT EXISTS(SELECT '$numero' FROM tregistro WHERE  numero = '$numero')";

 if ($conn->query($sql2) === TRUE) {
  echo "";
} 

  else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}
  if ($conn->query($sql3) === TRUE) {
  echo "";
} 

  else {
  echo "Error: " . $sql3 . "<br>" . $conn->error;
}
  if ($conn->query($sql4) === TRUE) {
  echo "";
} 

  else {
  echo "Error: " . $sql4 . "<br>" . $conn->error;
}
   if ($conn->query($sql5) === TRUE) {
  echo "";
} 

  else {
  echo "Error: " . $sql5 . "<br>" . $conn->error;
}
 if ($conn->query($sql6) === TRUE) {
  echo "";
} 

  else {
  echo "Error: " . $sql6 . "<br>" . $conn->error;
}

?>


