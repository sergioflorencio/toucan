<?php

	//Mysql
	$servidor="127.0.0.1";
	$usuario="root";
	$senha="";
	$schema='orcamento';
	$conexao=mysql_connect($servidor,$usuario,$senha)  or die(mysql_error());
	
	//DNS
	$DNS="127.0.0.1";
	$ipexterno="127.0.0.1";
	
	$conexao=mysql_connect($servidor,$usuario,$senha)  or die(mysql_error());
	date_default_timezone_set('America/Sao_Paulo');
	$hoje=date("Y-m-d H:i:s");


?>
