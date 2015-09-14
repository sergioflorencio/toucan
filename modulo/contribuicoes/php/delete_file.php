<?php 
	session_start();
	include "php.php";

	$table='cad_anexos';
	$where="cod_anexo=".$_GET['cod_anexo']." ";
	$sql=new sql;
	$sql->delete($table,$where);	  

	header("Location:../cadastro_cartas.php?id=".$_GET['cod_carta']."");

?>