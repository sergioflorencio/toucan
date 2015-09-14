<?php

class login{
	function checklogin(){
		$login=new login;
		if(isset($_SESSION['user']) and isset($_SESSION['loged']) and isset($_SESSION['session']) and $_SESSION['loged']==true){
			include "body.php";
		}else{
			$login->logwindow();
		}
		if(isset($_GET['login']) and $_GET['login']=="logout" and  $_SESSION['loged']==true){
			$login->logout();
		}
		if(isset($_POST['usuario']) and isset($_POST['senha']) and $_POST['usuario']!="" and $_POST['senha']!="" and isset($_SESSION['cod_usuario'])==false){
			$login->login();
		}		

	}
	function login(){
	
		include "config.php";
		if(isset($_POST['usuario']) and isset($_POST['senha']) and $_POST['usuario']!="" and $_POST['senha']!="" ){
			$select="SELECT * FROM ".$schema.".cad_usuario where usuario='".$_POST['usuario']."';";
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado)){
				$cod_user=$row['cod_usuario'];
				$senha_usuario=$row['senha'];
			}
				if($senha_usuario==$_POST['senha'] and  (isset($_SESSION['loged'])==false or $_SESSION['loged']==false)){
					$_SESSION['cod_usuario']=$cod_user;
					$_SESSION['user']=$_POST['usuario'];
					$_SESSION['loged']=true;
					$_SESSION['session']=md5(mt_rand(1,10000));

					$sql=new sql;
					$table="session";
					$campos="username,session,ip";
					$values="'".$_SESSION['user']."','".$_SESSION['session']."','".$_SERVER['REMOTE_ADDR']."'";
					$sql->insert($table,$campos,$values,'N');	


				}else{
				//	$login=new login;
				//	$login->logout();
				}			

		}
	}
	function logout(){

					$sql=new sql;
					$table="session";
					$campos="date_logout=now()";
					$where="session='".$_SESSION['session']."'";
					$sql->update($table,$campos,$where,'N');
					
					$_SESSION['cod_usuario']="";
					$_SESSION['user']="";
					$_SESSION['loged']=false;
					$_SESSION['session']="";
					$_SESSION['cod_empresa']="";
					$_SESSION['razao_social']="";
					$_SESSION['endereco']="";
					$_SESSION['numero']="";
					$_SESSION['complemento']="";
					$_SESSION['cep']="";
					$_SESSION['cidade']="";
					$_SESSION['uf']="";
					$_SESSION['cnpj']="";
					$_SESSION['logo']="";					
					$_SESSION['email']="";					
					$_SESSION['telefone']="";					
					//header("Location: index.php");

					
	}
	function logwindow(){
		include "config.php";
		echo	"<link rel='stylesheet' href='../js/uikit/css/uikit.css' />";
		echo	"<link rel='stylesheet' href='../js/uikit/css/uikit.avenue.css' />";
		echo	"<link rel='stylesheet' href='../js/uikit/css/uikit.theme.css' />";		
		echo "<div class=' ' style='padding-left: 20px; padding-right: 20px;'>
					<div class='uk-container-center uk-panel uk-panel-box uk-panel-hover uk-width-small-3-4 uk-width-medium-1-3 uk-width-large-1-4'  style='margin-top: 10%;'>
						<h3 class='uk-panel-title'>Bem vindo!</h3>
						<form class='uk-form' action='".$DNS."' method='post'>

							<fieldset>
								<div class='uk-form-row'>
									<div class='uk-form-icon' style='width: 100%;'>
										<i class='uk-icon-user'></i>
										<input id='usuario' name='usuario' placeholder='Usuário' type='text' style='width: 100%;'>
									</div>
								</div>
								<div class='uk-form-row'>
									<div class='uk-form-icon' style='width: 100%;'>
										<i class='uk-icon-key'></i>
										<input id='senha' name='senha' placeholder='Senha' type='password'  style='width: 100%;'>
									</div>
								</div>
								<div class='uk-form-row'>
									<button class='uk-button'><i class='uk-icon-unlock'></i> Confirmar</button>
								</div>
							</fieldset>

						</form>					
					
					
					</div>
				</div>";
	
	
	
	
	}
	function login_empresa(){
		if(isset($_POST['cod_empresa'])){
		
			//verificar se há acesso a empresa para o usuario
			include "config.php";
			$select="SELECT cad_empresa.* FROM ".$schema.".cad_empresa_acessos,".$schema.".cad_empresa where cad_empresa_acessos.cod_empresa=cad_empresa.cod_empresa and cad_empresa.cod_empresa=".$_POST['cod_empresa']." and status=1 and cod_usuario='".$_SESSION['cod_usuario']."';";
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado)){
				//logar na empresa
				$_SESSION['cod_empresa']=$row['cod_empresa'];
				$_SESSION['razao_social']=$row['razao_social'];
				$_SESSION['endereco']=$row['endereco'];
				$_SESSION['numero']=$row['numero'];
				$_SESSION['complemento']=$row['complemento'];
				$_SESSION['cep']=$row['cep'];
				$_SESSION['cidade']=$row['cidade'];
				$_SESSION['uf']=$row['uf'];
				$_SESSION['cnpj']=$row['cnpj'];
				$_SESSION['logo']=$row['logo'];
				$_SESSION['email']=$row['email'];
				$_SESSION['telefone']=$row['telefone'];
			}
			

		
		}
	}
	
}

?>