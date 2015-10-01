<?php

		if(isset($_POST) and isset($_GET['act']) and isset($_GET['mod']) and $_GET['act']=='editar' and $_GET['mod']=='cad_conta'){
					

					$sql=new sql;
					
					//$_POST['cod_conta_mae']
				function id_conta($numero_conta){
					//print_r($_POST);
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
				function cod_plano_conta($cod_plano_conta){
					include "config.php";
					$select="SELECT cod_plano_conta FROM ".$schema.".cad_plano_conta where cod_empresa=".$_SESSION['cod_empresa']." ; ";
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
					//if(mysql_num_rows($resultado)>=1){return true;}else{return false;}
					$cod_conta = mysql_fetch_array($resultado);
					//if($cod_conta==false){return 'false';}else{ return 'true';}
					$cod_conta=$cod_conta[0];
					return $cod_conta;
				}
			
			
					

					//var_dump($x[$a]);
					
					if(isset($_POST['cod_conta']) and $_POST['cod_conta']==0){
						//novo
						$cod_conta_mae=id_conta($_POST['numero_conta_mae']);
						$cod_plano_conta=cod_plano_conta($_POST['numero_conta_mae']);
						$tabela="cad_conta";
						$campos_insert="`cod_conta_mae`,`numero_conta`,`cod_plano_conta`,`descricao`,`cod_tipo_conta`,`saldo_inicial`,`saldo_atual`,`status`";
						$values="'".$cod_conta_mae."','".$_POST['numero_conta']."','".$cod_plano_conta."','".$_POST['descricao']."','".$_POST['cod_tipo_conta']."','".$_POST['saldo_inicial']."','".$_POST['saldo_atual']."','".$_POST['status']."'";
						$sql->insert($tabela,$campos_insert,$values,'S');
						
					}	
					if(isset($_POST['cod_conta']) and $_POST['cod_conta']!=""){
						//atualizar
						$cod_conta_mae=id_conta($_POST['numero_conta_mae']);
						$cod_plano_conta=cod_plano_conta($_POST['numero_conta_mae']);						
						$tabela="cad_conta";
						$campos="`cod_conta_mae`='".$cod_conta_mae."',`numero_conta`='".$_POST['numero_conta']."',`cod_plano_conta`='".$cod_plano_conta."',`descricao`='".$_POST['descricao']."',`cod_tipo_conta`='".$_POST['cod_tipo_conta']."',`saldo_inicial`='".$_POST['saldo_inicial']."',`saldo_atual`='".$_POST['saldo_atual']."',`status`='".$_POST['status']."'";
						$where="`cod_conta`='".$_POST['cod_conta']."'";
						$sql->update($tabela,$campos,$where,'S');

					}	
						

						
					
					 
								
			
			
		}
		if(isset($_POST) and isset($_GET['act']) and isset($_GET['mod']) and $_GET['act']=='editar' and $_GET['mod']=='cad_centro_custo'){
					
					include "php.php";
					$sql=new sql;
					
					
					
					//var_dump($_GET);

					
					$json=$_POST['json'];
					$json=str_replace("[","",$json);
					$json=str_replace("]","",$json);
					$json=str_replace("}","",$json);
					$json=str_replace('"',"",$json);
					$json=explode('{',$json);
					for($a=0;$a<count($json);$a++){
						$b=explode(',',$json[$a]);
						for($c=0;$c<count($b);$c++){
							$b[$c]=explode(':',$b[$c]);
							if(isset($b[$c][0]) and isset($b[$c][1])){
								$b[$c]=array($b[$c][0]=>$b[$c][1]);	
							}
						}	
						$x[$a]=$b;
					}
					//	var_dump($x);	
						
						
					for($a=0;$a<count($x);$a++){
					//	var_dump($x[$a]);
						
						if(isset($x[$a][0]['ig_pk']) or (isset($x[$a][0]['ID']) and $x[$a][0]['ID']==0)){
							//novo
							$tabela=$_POST['tabela'];
							$campos_insert="`cod_centro_custo_mae`,`numero_centro_custo`,`cod_plano_centro_custo`,`descricao`,`saldo_inicial`,`saldo_atual`,`status`";
							$values="'".$x[$a][1]['cod_centro_custo_mae']."','".$x[$a][2]['numero_centro_custo']."','".$_POST['plano_conta']."','".$x[$a][3]['descricao']."','".$x[$a][4]['saldo_inicial']."','".$x[$a][5]['saldo_atual']."','".$x[$a][6]['status']."'";
							$sql->insert($tabela,$campos_insert,$values,'N');
							
						}	
						if(isset($x[$a][0]['ID']) and $x[$a][0]['ID']!=0){
							//atualizar
							$tabela=$_POST['tabela'];
							$campos="`cod_centro_custo_mae`='".$x[$a][1]['cod_centro_custo_mae']."',`numero_centro_custo`='".$x[$a][2]['numero_centro_custo']."',`cod_plano_centro_custo`='".$_POST['plano_conta']."',`descricao`='".$x[$a][3]['descricao']."',`saldo_inicial`='".$x[$a][4]['saldo_inicial']."',`saldo_atual`='".$x[$a][5]['saldo_atual']."',`status`='".$x[$a][6]['status']."'";
							$where="`cod_centro_custo`='".$x[$a][0]['ID']."'";
							$sql->update($tabela,$campos,$where,'N');

						}	
						
						
						
					}
					 
								
			
			
		}

	


?>