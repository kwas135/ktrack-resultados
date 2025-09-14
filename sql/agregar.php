<?php 
if (isset($_GET['id'])){
	include('../database.php');
	$cliente = new Database();
	$numero=intval($_GET['id']);
	$res = $cliente->agregar($numero);
	if($res){
		header('location: ../retapasc.php');
	}else{
		echo "Error al registrar";
	}
}
?>