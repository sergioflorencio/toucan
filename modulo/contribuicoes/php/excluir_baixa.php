<?php
//print_r($_GET);


 session_start();
 include "php.php";
 
 if(
	isset($_GET['baixa']) and
	isset($_GET['cod_captacao']) and
	
	$_GET['baixa']!='' and
	$_GET['cod_captacao']!='' 
	
 ){
 //		$select= "DELETE FROM `".$schema."`.`captacao_cartas_baixas` WHERE `captacao_cartas_baixas`.`cod_captacao_cartas_baixas` = ".$cod_captacao_cartas_baixas.";";

 
	$sql=new sql;
	$sql->delete('captacao_cartas_baixas'," cod_captacao_cartas_baixas= ".$_GET['baixa']." and cod_captacao_cartas=".$_GET['cod_captacao']);
	$sql->update('captacao_cartas'," status='-02' "," cod_captacao_cartas=".$_GET['cod_captacao']);
//	$sql->baixar_captacao('00',$_GET['data_baixa'],$_GET['valor_baixa'],$_GET['cod_captacao_cartas'],$_GET['cod_carteira'],"","","BAIXA MANUAL");
 }
 
					header("Location:../cadastro_captacoes.php?id=".$_GET['cod_captacao']."");
 

?>