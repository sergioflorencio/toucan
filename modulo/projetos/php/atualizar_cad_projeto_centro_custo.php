<?php 
	session_start();
	include "php.php";

	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
			
			var_dump($_POST);
			
			$sql=new sql;
			
			
			//excluir
				$table='cad_projeto_centro_custo';
				$where="cod_projeto=".$_POST['cod_projeto']." and cod_centro_custo=".$_POST['cod_centro_custo']." ";
				$sql->delete($table,$where,'N');
			
			
			//incluir
				$table='cad_projeto_centro_custo';
				
				$campos="cod_projeto,";
				$campos.="cod_centro_custo,";
				$campos.="`check`";

				
				$values="'".$_POST['cod_projeto']."', ";
				$values.="'".$_POST['cod_centro_custo']."', ";
				$values.="'".$_POST['status']."'";


				$sql->insert($table,$campos,$values,'N');				
			
			
			
	}
	
?>