<?php

	session_start();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){

	include "php.php";
	include "sql.php";

	if(isset($_POST)){
			
		if($_POST['act']=="upload_logo"){
			$imagens=new imagens;
			$imagens->upload_logo();
		}
		if($_POST['act']=="salvar_empresa"){
			$sql=new sql;
			$table="cad_empresa";
			if($_POST['cod_empresa']==""){
				$campos="`cod_empresa`, `razao_social`, `endereco`, `numero`, `complemento`, `cep`, `cidade`, `uf`, `cnpj`, `cod_empresa_matriz`, `matriz_filial`, `email`, `telefone`";
				$values="'".$_POST['cod_empresa']."','".$_POST['razao_social']."','".$_POST['endereco']."','".$_POST['numero']."','".$_POST['complemento']."','".$_POST['cep']."','".$_POST['cidade']."','".$_POST['uf']."','".$_POST['cnpj']."','".$_POST['cod_empresa_matriz']."','".$_POST['matriz_filial']."','".$_POST['email']."','".$_POST['telefone']."'";
				$msg="S";
				$sql->insert($table,$campos,$values,$msg);
			}else{
				$campos="`cod_empresa`='".$_POST['cod_empresa']."',`razao_social`='".$_POST['razao_social']."',`endereco`='".$_POST['endereco']."',`numero`='".$_POST['numero']."',`complemento`='".$_POST['complemento']."',`cep`='".$_POST['cep']."',`cidade`='".$_POST['cidade']."',`uf`='".$_POST['uf']."',`cod_empresa_matriz`='".$_POST['cod_empresa_matriz']."',`matriz_filial`='".$_POST['matriz_filial']."',`cnpj`='".$_POST['cnpj']."',`email`='".$_POST['email']."',`telefone`='".$_POST['telefone']."' ";
				$where="cod_empresa='".$_POST['cod_empresa']."'";
				$msg="S";
				$sql->update($table,$campos,$where,$msg);
			
			}

		
		}
		if($_POST['act']=="acesso_empresas"){
			
				include "config.php";
				if($_POST['checked']=='true'){
					$cheked='1';	
				}else{
					$cheked='0';
				
				}
				$consulta="
						INSERT INTO 
							".$schema.".`cad_empresa_acessos` 
							(`cod_empresa`, `cod_usuario`,`status`) 
						VALUES 
							('".$_POST['cod_empresa']."', '".$_POST['cod_usuario']."','".$cheked."')
						ON DUPLICATE KEY UPDATE 
							`status`='".$cheked."' 
						;"; 
				$insert=mysql_query($consulta,$conexao);
		}	

	}



}
?>