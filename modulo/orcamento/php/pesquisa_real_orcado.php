<?php
	session_start();
	include "../../../php/login.php";
	include "php.php";
	include "config.php";

	
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		
		if(isset($_POST['act']) and $_POST['act']=='pesquisar' and isset($_POST['mod']) and $_POST['mod']=='cod_orcamento_centro_custo'){

				$selects=new selects;
				$selects->cod_orcamento_centro_custo($_POST['cod_orcamento'],'centro de custo');

		}

		
		
	}	
						//	$selects=new selects;
						//	$selects->cod_orcamento_centro_custo('3','centro de custo');

?>