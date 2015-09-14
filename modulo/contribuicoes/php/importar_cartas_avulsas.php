<?php


	session_start();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		include "php.php";
		
			$sql=new sql;
			
			$table='cad_cartas';

			$campos ="cod_contribuinte,";
			$campos.="cod_colaborador,";
			$campos.="cod_ctrreceita,";
			$campos.="carta_valor_moeda,";
			$campos.="carta_data_inicio,";
			$campos.="carta_dia_debito,";
			$campos.="carta_data_fim,";
			$campos.="carta_moeda,";
			$campos.="carta_qtd_moeda,";
			$campos.="carta_aberta,";
			$campos.="periodicidade,";
			$campos.="carta_forma_pagamento";

			$_POST['json']=str_replace("'","",$_POST['json']);
			$_POST['json']=str_replace(")(",")|(",$_POST['json']);
			$_POST['json']=str_replace(")","",$_POST['json']);
			$_POST['json']=str_replace("(","",$_POST['json']);
			$linhas=explode("|", $_POST['json']);
		
		for($n=0;$n< count($linhas);$n++){
			$colunas=explode("@",$linhas[$n]);

			$cod_pessoa=$colunas[0];
			$cod_colaborador=$colunas[1];
			$cod_ctrreceita=$colunas[2];
			$carta_valor_moeda=decimal($colunas[3]);				
			$carta_data_inicio=data($colunas[4]);
			$dia_debito=substr($colunas[4],0,2);	
			$carta_data_fim=$carta_data_inicio;
			$cod_moeda=1;
			$carta_qtd_moeda=$carta_valor_moeda;
			$carta_aberta='avulso';
			$periodicidade='1';
			$tipo_convenio='recibo';
			
			$values="'".$cod_pessoa."',";	
			$values.="'".$cod_colaborador."',";	
			$values.="'".$cod_ctrreceita."',";	
			$values.="'".$carta_valor_moeda."',";	
			$values.="'".$carta_data_inicio."',";	
			$values.="'".$dia_debito."',";	
			$values.="'".$carta_data_fim."',";	
			$values.="'".$cod_moeda."',";	
			$values.="'".$carta_qtd_moeda."',";	
			$values.="'".$carta_aberta."',";	
			$values.="'".$periodicidade."',";	
			$values.="'".$tipo_convenio."'";	

			$sql->insert($table,$campos,$values);
			
		}		
		echo 
		"<div class='uk-alert uk-alert-success' data-uk-alert=''>
			<a href='' class='uk-alert-close uk-close'></a>
			<p>As cartas foram incluídas com sucesso!</p>
		</div>";
		
		
	}


?>