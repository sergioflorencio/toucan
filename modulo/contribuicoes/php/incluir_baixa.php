<?php
//print_r($_POST);

 session_start();

 include "php.php";
 
 if(
	isset($_POST['cod_captacao_cartas']) and
	isset($_POST['cod_carteira']) and
	isset($_POST['data_baixa']) and
 	isset($_POST['valor_baixa']) and
	
	$_POST['cod_captacao_cartas']!='' and
	$_POST['cod_carteira']!='' and
	$_POST['data_baixa']!='' and
 	$_POST['valor_baixa']>0
	
 ){
	$sql=new sql;
	$sql->baixar_captacao('00',$_POST['data_baixa'],$_POST['valor_baixa'],$_POST['cod_captacao_cartas'],$_POST['cod_carteira'],"","","BAIXA MANUAL");
 }
 
					header("Location:../cadastro_captacoes.php?id=".$_POST['cod_captacao_cartas']."");
 

?>