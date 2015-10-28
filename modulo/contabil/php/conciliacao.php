<?php
	session_start();
	include "../../../php/login.php";
	include "php.php";
	include "config.php";
	$sql=new sql;
	function data_($data){
		if($data!=null){
			$data = str_replace('/', '-', $data);
			return date('Y-m-d', strtotime($data));
		}
	}

	
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		if(isset($_POST['act']) and $_POST['act']=="conciliar" and isset($_POST['itens']) and $_POST['itens']!="" ){
			$key = md5(mt_rand(1,10000).strtotime(date('Y-m-d H:i:s')));
			
			$itens=explode(',',$_POST['itens']);
			$tabela="cad_documento_item";
			$campos="data_ultima_alteracao=DATE_FORMAT(now(),'%Y-%m-%d'), cod_documento_compensacao='".$key."' ";
			
			for($n=1;$n<count($itens);$n++){
				$where="cod_documento_item='".$itens[$n]."'";
				$sql->update($tabela,$campos,$where,'S');
				
			}

			
		}

	}

?>