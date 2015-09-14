<?php
	session_start();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
	include "php.php";
	//var_dump($_POST);
	$tabelas=new tabelas;
	$tabelas->listar_itens_baixa_em_lote($_POST['cod_captacao_carta']);
	
	
	}
?>