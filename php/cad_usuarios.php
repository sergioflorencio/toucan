<?php
	session_start();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){

	include "php.php";
	include "sql.php";

		//		var_dump($_POST);
	if(isset($_POST)){
			
		if($_POST['act']=="salvar_usuario"){
			$sql=new sql;
			$table="cad_usuario";
			if($_POST['cod_usuario']==""){
				$campos="`email`,`nome`, `status`, `usuario`";
				$values="'".$_POST['email']."','".$_POST['nome']."','".$_POST['status']."','".$_POST['usuario']."'";
				$msg="S";
				$sql->insert($table,$campos,$values,$msg);
			
			}else{
				$campos="`email`='".$_POST['email']."',`nome`='".$_POST['nome']."', `status`='".$_POST['status']."', `usuario`='".$_POST['usuario']."' ";
				$where="cod_usuario='".$_POST['cod_usuario']."'";
				$msg="S";
				$sql->update($table,$campos,$where,$msg);
			
			}

		
		}
		if($_POST['act']=="enviar_senha"){
			include "config.php";
			$senha=substr(md5(mt_rand(1,10000).date("Y-m-d H:i:s")),0,6);
			$sql=new sql;
			$table="cad_usuario";
			$campos="senha='".$senha."'";
			$where="cod_usuario='".$_POST['cod_usuario']."'";
			$sql->update($table,$campos,$where,'N');
			$select= "
					select 
						*
					from 
						".$schema.".cad_usuario 
						
					where  
						`cad_usuario`.`cod_usuario` = ".$_POST['cod_usuario'].";";

			
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado))
			  {
					$username=$row['usuario'];
					$_email=$row['email'];
			  }
			$email=new email;
			$email->enviar_senha($_email,$username,$senha);
			echo "Uma nova senha foi encaminhada para o seu email.";

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		}
		if(isset($_POST) and ($_POST['cod_usuario']!="")){
			if($_POST['act']=="acesso_modulos"){
				
					include "config.php";
					if($_POST['checked']=='true'){
						$cheked='1';	
					}else{
						$cheked='0';
					
					}
					$consulta="
							INSERT INTO 
								".$schema.".`cad_menu_acessos` 
								(`cod_menu`, `cod_usuario`,`status`) 
							VALUES 
								('".$_POST['cod_menu']."', '".$_POST['cod_usuario']."','".$cheked."')
							ON DUPLICATE KEY UPDATE 
								`status`='".$cheked."' 
							
							;"; 
					$insert=mysql_query($consulta,$conexao);
				
				


			}
			if($_POST['act']=="acoes_banco_dados"){
					include "config.php";
					if($_POST['checked']=="true"){
						$checked=1;
					}else{
						$checked=0;
					}
					$consulta="
							INSERT INTO 
								".$schema.".`cad_usuarios_acoes_banco_dados` 
								(`cod_usuario`,`".$_POST['acesso']."`) 
							VALUES 
								('".$_POST['cod_usuario']."','".$checked."')
							ON DUPLICATE KEY UPDATE 
								`".$_POST['acesso']."`='".$checked."' 
							;"; 
					$insert=mysql_query($consulta,$conexao);

			}
		}else{
				if($_POST['cod_usuario']==""){ echo "Salve o cadatro de usuário antes de atribuir os acessos";}
		}
	}


}

?>