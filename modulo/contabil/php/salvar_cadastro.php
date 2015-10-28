<?php
	session_start();
	include "../../../php/login.php";
	include "php.php";
	include "config.php";
	$sql=new sql;

	
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){

		//svar_dump($_POST);
		
		if(
			isset($_POST['tabela']) and
			((
				isset($_POST['cod_conta']) and
				isset($_POST['numero_conta_mae']) and
				isset($_POST['numero_conta']) and
				$_POST['numero_conta_mae']!="" and 
				$_POST['numero_conta']!="" 					
			)or(
				isset($_POST['cod_centro_custo']) and
				isset($_POST['numero_centro_custo_mae']) and
				isset($_POST['numero_centro_custo']) and
				$_POST['numero_centro_custo_mae']!="" and 
				$_POST['numero_centro_custo']!="" 				

			)) and 
			isset($_POST['descricao']) and
			isset($_POST['status']) and
			$_POST['descricao']!="" and 
			$_POST['status']!=""

		
		){
			
			
					$sql=new sql;
					
					//$_POST['cod_conta_mae']
				function id_conta($numero_conta){

					//$numero_conta = explode (" ",$numero_conta,2);
					//$numero_conta = $numero_conta[0];
					include "config.php";
					$select="SELECT cod_conta FROM ".$schema.".cad_conta where numero_conta='".$numero_conta."' and cod_empresa=".$_SESSION['cod_empresa']." ; ";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					//if(mysql_num_rows($resultado)>=1){return true;}else{return false;}
					$cod_conta = mysql_fetch_array($resultado);
					//if($cod_conta==false){return 'false';}else{ return 'true';}
					$cod_conta=$cod_conta[0];
					return $cod_conta;
				}
				function id_centro_custo($numero_centro_custo){
					//$numero_centro_custo = explode (" ",$numero_centro_custo,2);
					//$numero_centro_custo = $numero_centro_custo[0];
					include "config.php";
					$select="SELECT cod_centro_custo FROM ".$schema.".cad_centro_custo where numero_centro_custo='".$numero_centro_custo."' and cod_empresa=".$_SESSION['cod_empresa']." ; ";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					//if(mysql_num_rows($resultado)>=1){return true;}else{return false;}
					$cod_conta = mysql_fetch_array($resultado);
					//if($cod_conta==false){return 'false';}else{ return 'true';}
					$cod_conta=$cod_conta[0];
					return $cod_conta;
				}
				function cod_plano_conta(){
					include "config.php";
					$select="SELECT cod_plano_conta FROM ".$schema.".cad_plano_conta where cod_empresa=".$_SESSION['cod_empresa']." ; ";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					//if(mysql_num_rows($resultado)>=1){return true;}else{return false;}
					$cod_conta = mysql_fetch_array($resultado);
					//if($cod_conta==false){return 'false';}else{ return 'true';}
					$cod_conta=$cod_conta[0];
					return $cod_conta;
				}
				function cod_plano_centro_custo(){
					include "config.php";
					$select="SELECT cod_plano_centro_custo FROM ".$schema.".cad_plano_centro_custo where cod_empresa=".$_SESSION['cod_empresa']." ; ";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					//if(mysql_num_rows($resultado)>=1){return true;}else{return false;}
					$cod_centro_custo = mysql_fetch_array($resultado);
					//if($cod_centro_custo==false){return 'false';}else{ return 'true';}
					$cod_centro_custo=$cod_centro_custo[0];
					return $cod_centro_custo;
				}

	

		if(isset($_POST) and isset($_POST['act']) and isset($_POST['mod']) and $_POST['act']=='editar' and $_POST['mod']=='cad_conta'){
					if(isset($_POST['cod_conta']) and $_POST['cod_conta']==0){
						//novo
						$cod_conta_mae=id_conta($_POST['numero_conta_mae']);
						$cod_plano_conta=cod_plano_conta();
						$tabela="cad_conta";
						$campos_insert="`cod_conta_mae`,`numero_conta`,`cod_plano_conta`,`descricao`,`cod_tipo_conta`,`saldo_inicial`,`saldo_atual`,`status`";
						$values="'".$cod_conta_mae."','".$_POST['numero_conta']."','".$cod_plano_conta."','".$_POST['descricao']."','".$_POST['cod_tipo_conta']."','".$_POST['saldo_inicial']."','".$_POST['saldo_atual']."','".$_POST['status']."'";
						$sql->insert($tabela,$campos_insert,$values,'S');
						
					}	
					if(isset($_POST['cod_conta']) and $_POST['cod_conta']!=""){
						//atualizar
						$cod_conta_mae=id_conta($_POST['numero_conta_mae']);
						$cod_plano_conta=cod_plano_conta();						
						$tabela="cad_conta";
						$campos="`cod_conta_mae`='".$cod_conta_mae."',`numero_conta`='".$_POST['numero_conta']."',`cod_plano_conta`='".$cod_plano_conta."',`descricao`='".$_POST['descricao']."',`cod_tipo_conta`='".$_POST['cod_tipo_conta']."',`saldo_inicial`='".$_POST['saldo_inicial']."',`saldo_atual`='".$_POST['saldo_atual']."',`status`='".$_POST['status']."'";
						$where="`cod_conta`='".$_POST['cod_conta']."'";
						$sql->update($tabela,$campos,$where,'S');

					}	
			
		}
		if(isset($_POST) and isset($_POST['act']) and isset($_POST['mod']) and $_POST['act']=='editar' and $_POST['mod']=='cad_centro_custo'){

						if(isset($_POST['cod_centro_custo']) and ($_POST['cod_centro_custo']=="" or $_POST['cod_centro_custo']==0)){
							//novo
							$cod_centro_custo_mae=id_centro_custo($_POST['numero_centro_custo_mae']);
							$cod_plano_centro_custo=cod_plano_centro_custo();
							$tabela=$_POST['tabela'];
							$campos_insert="`cod_centro_custo_mae`,`numero_centro_custo`,`cod_plano_centro_custo`,`descricao`,`saldo_inicial`,`saldo_atual`,`status`";
							$values="'".$cod_centro_custo_mae."','".$_POST['numero_centro_custo']."','".$cod_plano_centro_custo."','".$_POST['descricao']."','".$_POST['saldo_inicial']."','".$_POST['saldo_atual']."','".$_POST['status']."'";
							$sql->insert($tabela,$campos_insert,$values,'S');
						}	
						if(isset($_POST['cod_centro_custo']) and ($_POST['cod_centro_custo']!="" or $_POST['cod_centro_custo']!=0)){
							//atualizar
							$cod_centro_custo_mae=id_centro_custo($_POST['numero_centro_custo_mae']);
							$cod_plano_centro_custo=cod_plano_centro_custo();						
							$tabela=$_POST['tabela'];
							$campos="`cod_centro_custo_mae`='".$cod_centro_custo_mae."',`numero_centro_custo`='".$_POST['numero_centro_custo']."',`cod_plano_centro_custo`='".$cod_plano_centro_custo."',`descricao`='".$_POST['descricao']."',`saldo_inicial`='".$_POST['saldo_inicial']."',`saldo_atual`='".$_POST['saldo_atual']."',`status`='".$_POST['status']."'";
							$where="`cod_centro_custo`='".$_POST['cod_centro_custo']."'";
							$sql->update($tabela,$campos,$where,'S');
						}	
		}

	

		}else{
			$html=new html;
			$html->mensage("danger","Preencha os campos corretamente");
			
		}
		
		
		
		
	}



?>