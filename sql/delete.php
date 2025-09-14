<?php 
if (isset($_GET['id'])){
	include('database.php');
	$cliente = new Database();
	$numero=intval($_GET['id']);
	$res = $cliente->delete($numero);
	if($res){
		header('location: index.php');
	}else{
		echo "Error al eliminar el registro";
	}
}
?>