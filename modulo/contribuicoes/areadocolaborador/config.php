<?php
	//Mysql
	$servidor="127.0.0.1";
	$usuario="root";
	$senha="";
	$schema="contribuicoes";
	$conexao=mysql_connect($servidor,$usuario,$senha)  or die(mysql_error());
	
	//DNS
	$DNS="http://127.0.0.1/tucan.cnt.br/";
	$ipexterno="127.0.0.1";
	
	
	//Timezone
	date_default_timezone_set('America/Sao_Paulo');
	$inicio=date("Y-m-d H:i:s");


?>