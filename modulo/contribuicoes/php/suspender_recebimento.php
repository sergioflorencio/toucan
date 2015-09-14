<?php
	session_start();
	include "php.php";
	$sql=new sql;
	$table="captacao_cartas";
	$campos=" numero_lote='0', status='-04' ";
	$where="cod_captacao_cartas='".$_POST['cod_captacao_carta']."' ";
	
	
	$sql-> update($table,$campos,$where);

?>