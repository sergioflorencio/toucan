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
		//print_r($_POST);
		if(isset($_POST['cadastro']) and isset($_POST['valor'])){
			//classe de pesquisa
			class pesquisa_cod_{
				function cod_conta($numero_conta){
					$numero_conta = explode (" ",$numero_conta,2);
					$numero_conta = $numero_conta[0];
					include "config.php";
					$select="SELECT cod_conta FROM ".$schema.".cad_conta where numero_conta='".$numero_conta."' and cod_empresa=".$_SESSION['cod_empresa']." ; ";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					if(mysql_num_rows($resultado)>=1){return true;}else{return false;}
					//$cod_conta = mysql_fetch_array($resultado);
					//if($cod_conta==false){return 'false';}else{ return 'true';}
					//$cod_conta=$cod_conta[0];
					//return $cod_conta;
				}
				function cod_centro_custo($numero_centro_custo){
					$numero_centro_custo = explode (" ",$numero_centro_custo,2);
					$numero_centro_custo = $numero_centro_custo[0];
					include "config.php";
					$select="SELECT cod_centro_custo FROM ".$schema.".cad_centro_custo where numero_centro_custo='".$numero_centro_custo."' and cod_empresa=".$_SESSION['cod_empresa']." ; ";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					if(mysql_num_rows($resultado)>=1){return true;}else{return false;}
					//$cod_centro_custo = mysql_fetch_array($resultado);
					//if($cod_centro_custo==false){return 'false';}else{ return 'true';}
					//$cod_centro_custo=$cod_centro_custo[0];
					//return $cod_centro_custo;
				}
			}		

			$pesquisa_cod_=new pesquisa_cod_;
			
			
			if($pesquisa_cod_->$_POST['cadastro']($_POST['valor'])==true){
				echo " uk-form-small uk-form-success";
				
			}else{
				echo " uk-form-small uk-form-danger";
				
			}
						
			
			
			
		}
	}	


?>