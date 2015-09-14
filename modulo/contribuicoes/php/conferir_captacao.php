<?php
	include "config.php";
	include "php.php";

	$result = mysql_query("SELECT * FROM ".$schema.".captacao_cartas where cod_captacao_cartas=".$_GET['cod_captacao'].";", $conexao);
	$num_rows = mysql_num_rows($result);
	return $num_rows;




?>