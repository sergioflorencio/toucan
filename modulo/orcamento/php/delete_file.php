<?php 
	session_start();
	include "php.php";

	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
			
			$table='cad_anexo_projeto';
			$where="cod_anexo_projeto=".$_GET['cod_anexo']." ";
			$sql=new sql;
			$sql->delete($table,$where);	  

			header("Location:../index.php?act=cadastros&mod=cad_projeto&id=".$_GET['id']."");
			
			
	}
	
?>