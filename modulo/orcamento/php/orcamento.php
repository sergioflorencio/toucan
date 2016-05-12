<?php 
	session_start();
	include "php.php";

	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		
		//var_dump($_POST);
		
		if(isset($_POST['cod_orcamento']) and isset($_POST['cod_centro_custo']) and isset($_POST['act']) and $_POST['act']=="pesquisar"){
			
		///pesquisar orcamento
			$select="
					SELECT 
						`cad_lancamento`.`cad_lancamento`,
						`cad_lancamento`.`cod_orcamento`,
						`cad_lancamento`.`cod_centro_custo`,
						`cad_lancamento`.`cod_conta`,
						DATE_FORMAT(`cad_lancamento`.`data`,'%m-%Y') as data,
						`cad_lancamento`.`valor`,
						`cad_lancamento`.`historico`,
						`cad_lancamento`.`cod_empresa`
					FROM 
						`orcamento`.`cad_lancamento`

					where
						cod_orcamento='".$_POST['cod_orcamento']."' and
						cod_centro_custo='".$_POST['cod_centro_custo']."' and
						cod_empresa='".$_SESSION['cod_empresa']."' ";
			
			$pesquisa=new pesquisa;
			$json=$pesquisa->json($select);
			echo $json;
			$sql=new sql;
			
		}
		
		if(isset($_POST['cod_orcamento']) and isset($_POST['cod_centro_custo']) and isset($_POST['act']) and $_POST['act']=="salvar"){
		
			//var_dump($_POST);
			
			$sql=new sql;
			//excluir
				$table='cad_lancamento';
				$where="cod_orcamento='".$_POST['cod_orcamento']."' and cod_centro_custo='".$_POST['cod_centro_custo']."' ";
				$sql->delete($table,$where,'N');
				
			//incluir
				$table='cad_lancamento';
				
				$campos=$_POST['campos'];
				
				$bs=$_POST['bs'];
				$bs=str_replace("[[","(",$bs);
				$bs=str_replace("]]",")",$bs);
				$bs=str_replace("[","(",$bs);
				$bs=str_replace("]",")",$bs);

				$bs=str_replace(")",",'".$_SESSION['cod_empresa']."','".$_SESSION['cod_usuario']."')",$bs);
				$sql->insert_($table,$campos,$bs,'S');

		
		
		}
			

			
	}
	
?>