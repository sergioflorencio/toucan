<?php
	session_start();
	include "config.php";
	include "php.php";

	if(isset($_POST['cod_arquivo_bancario']) and $_POST['cod_arquivo_bancario']!=null){
		
		$sql = new sql;
		
		$table="cad_arquivos_bancarios";
		$campos="status_arquivo='AB', numero_downloads=numero_downloads+1";
		$where="tipo_arquivo='envio' and cod_arquivo_bancario='".$_POST['cod_arquivo_bancario']."'";
		
		$sql->update($table,$campos,$where);
	}




?>