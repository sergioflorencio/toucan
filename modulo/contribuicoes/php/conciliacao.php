<?php

	 session_start();

	include "php.php";
	if(isset($_POST['arquivo']) and isset($_POST['sistema']) and $_POST['arquivo']!='' and $_POST['sistema']!=''){

		$concliacao=new conciliacao;
		$concliacao->conciliar($_POST['arquivo'],$_POST['sistema']);
	}

	if(isset($_POST['conciliacao']) and $_POST['conciliacao']=='upload' ){

		$concliacao = new conciliacao();
		$concliacao ->upload();

	}
	if(isset($_POST['conciliacao']) and $_POST['conciliacao']=='inserir_arquivo_ofx_lancamentos' ){

		$data_inicio = substr($_POST['data_inicio'],0,4)."-".substr($_POST['data_inicio'],4,2)."-".substr($_POST['data_inicio'],6,2);
		$data_fim = substr($_POST['data_fim'],0,4)."-".substr($_POST['data_fim'],4,2)."-".substr($_POST['data_fim'],6,2);
		$_POST['tb']=str_replace(")",",'".$_SESSION["cod_empresa"]."','".$_SESSION['cod_usuario']['cod_usuario']."')",$_POST['tb']);
		$concliacao = new conciliacao();
		
		//var_dump($_POST['tb']);
		$concliacao ->inserir_arquivo_ofx_lancamentos($_POST['tb'],$data_inicio,$data_fim,$_POST['carteira']);

	}

?>