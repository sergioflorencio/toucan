<?php
	include "config.php";
	if(isset($_GET['cod_status']) and isset($_GET['cod_carta']) and $_GET['cod_carta']!=''){
				$up_date_carta=mysql_query("UPDATE `".$schema."`.`cad_cartas` SET `status_carta` = ".$_GET['cod_status'].",`data_cancelamento`=NOW() WHERE `cad_cartas`.`cod_carta` =".$_GET['cod_carta']." and ( `status_carta`='2' or `status_carta`='4' or `status_carta`='5' );",$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	

				$log=mysql_select_db('".$schema."',$conexao);
				$log=mysql_query("call function_log('1','atualizar_status_carta>cancelar','".$inicio."','". date("Y-m-d H:i:s") ."','".mysql_affected_rows()." linhas afetadas, ".mysql_error().", cod_carta: ".$_GET['cod_carta']."');",$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
				
				header("Location:../cadastro_cartas.php?id=".$_GET['cod_carta']."");
	}else{
				header("Location:../cadastro_cartas.php?id=novo");
	
	}


?>