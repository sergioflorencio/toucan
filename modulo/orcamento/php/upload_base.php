<?php
	include "php.php";
	print_r($_FILES);

	$arquivo = $_FILES['uploaded_base_'];

	if(isset($_FILES)){
		//Salvando o Arquivo
		$ID = md5(mt_rand(1,10000).$arquivo['name']).'.sec3';
		$caminho_arquivo = "../bases_sec3/";
		if (!file_exists($caminho_arquivo))
		{
		mkdir($caminho_arquivo, 0755);  
		}
		$caminho = $caminho_arquivo.$ID;
		move_uploaded_file($arquivo['tmp_name'],$caminho);  

		$tamanho_arquivo=$_FILES["uploaded_base_"]["size"] / 1024;

		$schema="orcamento";
		$table="tb_base";
		$campos ="`ID`, `nome`";
		$values="'".$ID."','". $arquivo['name'] ."'";
		
		$sql= new sql;
		$sql-> insert($schema,$table,$campos,$values);
	
	}else{
		echo "selecione um arquivo.";
	}
	






?>