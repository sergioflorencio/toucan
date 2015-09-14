<?php

	session_start();
	$arquivo = $_FILES['my_uploaded_file'];
	include "config.php";
	include "php.php";
//Salvando o Arquivo
	$nome_arquivo = md5(mt_rand(1,10000).$arquivo['name']).'.txt';
	$caminho_arquivo = "../arquivos_bancarios/retorno/";
	if (!file_exists($caminho_arquivo))
	{
	mkdir($caminho_arquivo, 0755);  
	}
	$caminho = $caminho_arquivo.$nome_arquivo;
	move_uploaded_file($arquivo['tmp_name'],$caminho);  

	$tamanho_arquivo=$_FILES["my_uploaded_file"]["size"] / 1024;
	$data = file_get_contents("../arquivos_bancarios/retorno/" . $nome_arquivo); //read the file
	$matriz = explode("\n", $data);

//Header

	$A00=SubStr($matriz[0],0,1);					//echo	"A: ".$A00."<br>";
	$A01=SubStr($matriz[0],1,1);					//echo	"A: ".$A01."<br>";

	IF ($A00=="A" AND $A01=='2'  ){
	
		$A02=SubStr($matriz[0],2,20);					//echo 	"B: ".$A02."<br>";
		$A03=SubStr($matriz[0],22,20);					//echo 	"C: ".$A03."<br>";
		$A04=SubStr($matriz[0],42,3);					//echo 	"D: ".$A04."<br>";
		$A05=SubStr($matriz[0],45,20);					//echo 	"E: ".$A05."<br>";
		$A06=SubStr($matriz[0],65,8);					//echo 	"F: ".$A06."<br>";
		$A07=SubStr($matriz[0],74,5);					//echo 	"G: ".$A07."<br>";
		$A08=SubStr($matriz[0],81,30);					//echo	"H: ".$A08."<br>";
		$B01=SubStr($matriz[count($matriz)-2],0,1);		//echo	"Z1: ".$B01."<br>";
		$B02=SubStr($matriz[count($matriz)-2],1,6);		//echo	"Z2: ".$B02."<br>";
		$B03=SubStr($matriz[count($matriz)-2],7,17);	//echo	"Z3: ".$B03."<br>";
			
		$data_inicio=$A06;
		$extensao='.txt';
		$cod_banco=	$A04;
		$cod_convenio=$A02;
		$total_registros=$B02-2;
		$total_lote=$B03/100;
		$numero_lote=$A07;
			
		$table="cad_arquivos_bancarios";
		$campos="
				`tipo_arquivo`,
				`nome_arquivo`,
				`data_geracao`,
				`tamanho`,
				`quantidade_registros`,
				`formato`,
				`cod_banco`,
				`cod_convenio`,
				`lote`,
				`total_lote`,
				`status_arquivo`,
				`id_arquivo`";
		$values="
				'retorno',
				'".$_FILES['my_uploaded_file']['name']."',
				STR_TO_DATE('".$data_inicio."','%Y-%d%m'),
				'".$tamanho_arquivo."',
				'".$total_registros."',
				'".$extensao."',
				'".$cod_banco."',
				'".$cod_convenio."',
				'".$numero_lote."',
				'".$total_lote."',
				'NP',
				'".$nome_arquivo."'
		";
		

		$sql=new sql;
		$sql->insert($table,$campos,$values);
		
		$arquivo_retorno=new arquivo_retorno;
		$arquivo_retorno->processar("../arquivos_bancarios/retorno/",$nome_arquivo,'NP','nao');	

	
	} else {
		IF ($A00=="0" AND $A01=='2'  ){
		
			$A02=SubStr($matriz[0],26,12);					//echo 	"B: ".$A02."<br>";
			$A04=SubStr($matriz[0],76,3);					//echo 	"D: ".$A04."<br>";
			$A06=SubStr($matriz[0],95,6);					//echo 	"F: ".$A06."<br>";
			$A07=SubStr($matriz[0],109,5);					//echo 	"G: ".$A07."<br>";
			$B01=SubStr($matriz[count($matriz)-2],0,1);		//echo	"Z1: ".$B01."<br>";
			$B02=SubStr($matriz[count($matriz)-2],395,6);		//echo	"Z2: ".$B02."<br>";
			$B03=SubStr($matriz[count($matriz)-2],221,14);	//echo	"Z3: ".$B03."<br>";
				
			$data_inicio=$A06;//
			$extensao='.txt';//
			$cod_banco=	$A04;//
			$cod_convenio=$A02;//
			$total_registros=$B02-2;//
			$total_lote=$B03/100;//
			$numero_lote=$A07;//

		$table="cad_arquivos_bancarios";
		$campos="
				`tipo_arquivo`,
				`nome_arquivo`,
				`data_geracao`,
				`tamanho`,
				`quantidade_registros`,
				`formato`,
				`cod_banco`,
				`cod_convenio`,
				`lote`,
				`total_lote`,
				`status_arquivo`,
				`id_arquivo`";
		$values="
				'retorno',
				'".$_FILES['my_uploaded_file']['name']."',
				STR_TO_DATE('".$data_inicio."','%Y-%d%m'),
				'".$tamanho_arquivo."',
				'".$total_registros."',
				'".$extensao."',
				'".$cod_banco."',
				'".$cod_convenio."',
				'".$numero_lote."',
				'".$total_lote."',
				'NP',
				'".$nome_arquivo."'
		";
		
		$sql=new sql;
		$sql->insert($table,$campos,$values);
		
		$arquivo_retorno=new arquivo_retorno;
		$arquivo_retorno->processar("../arquivos_bancarios/retorno/",$nome_arquivo,'NP','nao');	
	
	}}	
	


?>