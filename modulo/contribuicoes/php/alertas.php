<?php
	session_start();
	include "php.php";
	if(isset($_POST['status']) and $_POST['status']!=null){
		$html=new html;
		echo  $html->cad_alertas($_POST['status']);
	}
	if(isset($_POST['funcao']) and isset($_POST['status_alerta']) and isset($_POST['cod_alerta']) and $_POST['status_alerta']!=null and $_POST['cod_alerta']!=null and $_POST['funcao']=="cad_alertas"){
		include "config.php";
		$consulta="UPDATE `".$schema."`.`cad_alertas` SET `status`='".$_POST['status_alerta']."' WHERE `cod_alerta`='".$_POST['cod_alerta']."';";
		$update=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	

		$html=new html;
		echo  $html->cad_alertas('ANV');
	}
	if(isset($_POST['funcao']) and isset($_POST['status_alerta']) and isset($_POST['cod_alerta']) and $_POST['status_alerta']!=null and $_POST['cod_alerta']!=null and $_POST['funcao']=="cad_alertas_numero"){
		include "config.php";
		$html=new html;
		echo  $html->cad_alertas_numero('ANV');
	}


?>