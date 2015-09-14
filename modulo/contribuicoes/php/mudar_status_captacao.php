<?php
//	include "config.php";
//				$up_date_carta=mysql_query("UPDATE `".$schema."`.`cad_cartas` SET `status_carta` = '9', `cod_motivo_cancelamento`=".$_GET['cod_motivo_cancelamento'].",`data_cancelamento`=NOW() WHERE `cad_cartas`.`cod_carta` =".$_GET['cod_carta'].";",$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
//				$up_date_captacao=mysql_query("UPDATE `".$schema."`.`captacao_cartas` SET `status` = '99' WHERE  `captacao_cartas`.`status`='-02' and `captacao_cartas`.`cod_carta` =".$_GET['cod_carta'].";",$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
//
//				$log=mysql_select_db('".$schema."',$conexao);
//				$log=mysql_query("call function_log('1','atualizar_status_carta>cancelar','".$inicio."','". date("Y-m-d H:i:s") ."','".mysql_affected_rows()." linhas afetadas, ".mysql_error().", cod_carta: ".$_GET['cod_carta']."');",$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
//				
//				header("Location:../cadastro_cartas.php?id=".$_GET['cod_carta']."");
	session_start();
	include "php.php";
	$sql=new sql;
	$table="captacao_cartas";
	$campos=" numero_lote='0', status='-02' ";
	$where="cod_captacao_cartas='".$_POST['cod_captacao_carta']."' ";
	
	
	$sql-> update($table,$campos,$where);

?>