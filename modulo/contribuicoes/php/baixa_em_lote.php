<?php
	session_start();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
	include "php.php";
	//var_dump($_POST);
	
	$data_baixa=data($_POST["data_baixa_lote"]);
	$data_baixa=str_replace("-","",$data_baixa);
	$cod_carteira=$_POST["cod_carteira_baixa_lote"];
	
	$cod_captacao_carta=$_POST["cod_captacao_carta_baixa_lote"];
	$cod_captacao_carta=str_replace("}{","|",$cod_captacao_carta);
	$cod_captacao_carta=str_replace("}","",$cod_captacao_carta);
	$cod_captacao_carta=str_replace("{","",$cod_captacao_carta);
	$cod_captacao_carta=explode("|",$cod_captacao_carta);
	
	$valor_baixa=$_POST["valor_baixa_lote"];
	$valor_baixa=str_replace("}{","|",$valor_baixa);
	$valor_baixa=str_replace("}","",$valor_baixa);
	$valor_baixa=str_replace("{","",$valor_baixa);
	$valor_baixa=explode("|",$valor_baixa);

	$arquivo_retorno=new arquivo_retorno;
	
	
	for($n=0;$n<count($cod_captacao_carta);$n++){

		$cod_captacao=$cod_captacao_carta[$n];
		$cod_retorno="00";
		$data_recebimento=$data_baixa;
		$valor_recebido=$valor_baixa[$n]*100;
		$lote="0";
		$historico="BAIXA EM LOTE";
		
		$arquivo_retorno->baixar_captacao($cod_captacao,$cod_retorno,$data_recebimento,$valor_recebido,$cod_carteira,$lote,$historico);
		
	}
	
	echo "
	<div class='uk-panel uk-panel-box uk-panel-box-primary uk-width-1-2 uk-container-center uk-text-center'>
	As baixas foram feitas com sucesso!
	</div>
	";
	
//	$tabelas=new tabelas;
//	$tabelas->listar_itens_baixa_em_lote($_POST['cod_captacao_carta']);
	
	
	}
?>