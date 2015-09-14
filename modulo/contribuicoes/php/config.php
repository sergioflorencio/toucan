<?php
	//Mysql
	$servidor="127.0.0.1";
	$usuario="root";
	$senha="";
	$schema='contribuicoes';
	$conexao=mysql_connect($servidor,$usuario,$senha)  or die(mysql_error());
	
	//DNS
	$DNS="127.0.0.1";
	$ipexterno="127.0.0.1";
	
	
	//FTP
	$ftp_endereco='127.0.0.1';
	$ftp_usuario='root';
	$ftp_senha='';
	//$ftp_anexos='intranet/nico/arquivos_anexos/';
	$ftp_anexos='';
	
	//Timezone
	date_default_timezone_set('America/Sao_Paulo');
	$inicio=date("Y-m-d H:i:s");
	
	//Rotinas de banco
	$set=mysql_select_db($schema,$conexao);
	$set=mysql_query("SET GLOBAL event_scheduler = ON;");
	$set=mysql_query("SET @@global.event_scheduler = ON;");

?>