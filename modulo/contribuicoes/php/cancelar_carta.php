<?php
	include "config.php";

	if(isset($_GET['cod_motivo_cancelamento']) and isset($_GET['cod_carta']) and $_GET['cod_carta']!=''){
				$up_date_carta=mysql_query("UPDATE `".$schema."`.`cad_cartas` SET `status_carta` = '9', `cod_motivo_cancelamento`=".$_GET['cod_motivo_cancelamento'].",`data_cancelamento`=NOW() WHERE `cad_cartas`.`cod_carta` =".$_GET['cod_carta'].";",$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
				$up_date_captacao=mysql_query("UPDATE `".$schema."`.`captacao_cartas` SET `status` = '99' WHERE  `captacao_cartas`.`status`='-02' and `captacao_cartas`.`cod_carta` =".$_GET['cod_carta'].";",$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
				$up_status_carta=mysql_query("update ".$schema.".cad_cartas, (select cad_cartas.cod_contribuinte from ".$schema.".cad_cartas where  cod_carta=".$_GET['cod_carta'].") as tb_cartas set cad_cartas.status_carta = '2' where cad_cartas.status_carta = '8' and tb_cartas.cod_contribuinte=cad_cartas.cod_contribuinte;",$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	

				$log=mysql_select_db('vepinho',$conexao);
				$log=mysql_query("call function_log('1','atualizar_status_carta>cancelar','".$inicio."','". date("Y-m-d H:i:s") ."','".mysql_affected_rows()." linhas afetadas, ".mysql_error().", cod_carta: ".$_GET['cod_carta']."');",$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
				
				header("Location:../".$_GET["callback"]."?id=".$_GET['cod_carta']."");
	}else{
				header("Location:../".$_GET["callback"]."?id=novo");
	
	}


?>