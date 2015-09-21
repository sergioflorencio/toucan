<?php
					//	var_dump($_POST);

	session_start();
	include "../../../php/login.php";
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		if(isset($_POST) and isset($_POST['tabela']) and $_POST['tabela']=='cad_conta'){
					
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
						//var_dump($x);	
						
						
					for($a=0;$a<count($x);$a++){
						//var_dump($x[$a]);
						
						if(isset($x[$a][0]['ig_pk']) or (isset($x[$a][0]['ID']) and $x[$a][0]['ID']==0)){
							//novo
							$tabela=$_POST['tabela'];
							$campos_insert="`cod_conta_mae`,`numero_conta`,`cod_plano_conta`,`descricao`,`cod_tipo_conta`,`saldo_inicial`,`saldo_atual`,`status`";
							$values="'".$x[$a][1]['cod_conta_mae']."','".$x[$a][2]['numero_conta']."','".$_POST['plano_conta']."','".$x[$a][3]['descricao']."','".$x[$a][4]['cod_tipo_conta']."','".$x[$a][5]['saldo_inicial']."','".$x[$a][6]['saldo_atual']."','".$x[$a][7]['status']."'";
							$sql->insert($tabela,$campos_insert,$values,'N');
							
						}	
						if(isset($x[$a][0]['ID']) and $x[$a][0]['ID']!=0){
							//atualizar
							$tabela=$_POST['tabela'];
							$campos="`cod_conta_mae`='".$x[$a][1]['cod_conta_mae']."',`numero_conta`='".$x[$a][2]['numero_conta']."',`cod_plano_conta`='".$_POST['plano_conta']."',`descricao`='".$x[$a][3]['descricao']."',`cod_tipo_conta`='".$x[$a][4]['cod_tipo_conta']."',`saldo_inicial`='".$x[$a][6]['saldo_inicial']."',`saldo_atual`='".$x[$a][7]['saldo_atual']."',`status`='".$x[$a][8]['status']."'";
							$where="`cod_conta`='".$x[$a][0]['ID']."'";
							$sql->update($tabela,$campos,$where,'N');

						}	
						
						
						
					}
					 
								
			
			
		}
		if(isset($_POST) and isset($_POST['tabela']) and $_POST['tabela']=='cad_centro_custo'){
					
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
		
		
		
		
		
	}	


?>