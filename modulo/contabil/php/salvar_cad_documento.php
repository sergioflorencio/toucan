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
		//var_dump($_POST);
		if(
			isset($_POST['cod_tipo_documento']) and
			isset($_POST['texto_cabecalho_documento']) and
			isset($_POST['data_lancamento']) and
			isset($_POST['data_base']) and
			isset($_POST['exercicio']) and
			isset($_POST['periodo']) and
			isset($_POST['referencia']) and
			isset($_POST['itens'])		
		){
			$pesquisa=new pesquisa;
			$periodo_aberto=$pesquisa->periodo_aberto();			//var_dump($periodo_aberto);
			$data_base= data_($_POST['data_base']);
			if($data_base>=$periodo_aberto['data_inicio'] and $data_base<=$periodo_aberto['data_fim']){

						
						$key = md5(mt_rand(1,10000).strtotime(date('Y-m-d H:i:s')));


					//1//incluir
						$tabela="cad_documento";
						$campos_insert="`cod_tipo_documento`,`referencia`,`texto_cabecalho_documento`,`data_lancamento`,`data_base`,`exercicio`,`periodo`";
						$values = "
						'".$_POST['cod_tipo_documento']."',
						'".$key."',
						'".$_POST['texto_cabecalho_documento']."',
						'".data_($_POST['data_lancamento'])."',
						'".data_($_POST['data_base'])."',
						'".$_POST['exercicio']."',
						'".$_POST['periodo']."'";
						$sql->insert($tabela,$campos_insert,$values,'S');

					//2//pesquisar cod_documento
						$select="SELECT cod_documento FROM ".$schema.".cad_documento WHERE referencia='".$key."' and cod_empresa=".$_SESSION['cod_empresa']."; ";
						$resultado=mysql_query($select,$conexao) or die (mysql_error());
						$cod_documento = mysql_fetch_array($resultado);
						$cod_documento=$cod_documento[0];

					//3//update referencia
						$campos="referencia='".$_POST['referencia']."'";
						$where="referencia='".$key."'";
						$sql->update($tabela,$campos,$where,'N');

					//4//cad_documento_item
						$itens=$_POST['itens'];
						$itens=str_replace("[","",$itens);	
						$itens=str_replace("]","",$itens);
						$itens=str_replace("},{","}@#$%$#@{",$itens);
						$itens=str_replace("}{","}@#$%$#@{",$itens);
						$itens=str_replace("'",'"',$itens);
						$itens=explode("@#$%$#@",$itens);
						for($n=0;$n<count($itens);$n++){
							$itens[$n]=json_decode($itens[$n]);
						}


				
						class pesquisa_cod_{
							function cod_conta($numero_conta){
								$numero_conta = explode (" ",$numero_conta,2);
								$numero_conta = $numero_conta[0];
								include "config.php";
								$select="SELECT cod_conta FROM ".$schema.".cad_conta where numero_conta='".$numero_conta."' and cod_empresa=".$_SESSION['cod_empresa']." ; ";
								$resultado=mysql_query($select,$conexao) or die (mysql_error());
								$cod_conta = mysql_fetch_array($resultado);
								$cod_conta=$cod_conta[0];
								return $cod_conta;
							}
							function cod_centro_custo($numero_centro_custo){
								$numero_centro_custo = explode (" ",$numero_centro_custo,2);
								$numero_centro_custo = $numero_centro_custo[0];
								include "config.php";
								$select="SELECT cod_centro_custo FROM ".$schema.".cad_centro_custo where numero_centro_custo='".$numero_centro_custo."' and cod_empresa=".$_SESSION['cod_empresa']." ; ";
								$resultado=mysql_query($select,$conexao) or die (mysql_error());
								$cod_centro_custo = mysql_fetch_array($resultado);
								$cod_centro_custo=$cod_centro_custo[0];
								return $cod_centro_custo;
							}
							function cod_projeto($cod_projeto){
								$cod_projeto = explode (" ",$cod_projeto,2);
								$cod_projeto = $cod_projeto[0];
								include "config.php";
								$select="SELECT cod_projeto FROM ".$schema_projetos.".cad_projeto where cod_projeto='".$cod_projeto."' and cod_empresa=".$_SESSION['cod_empresa']." ; ";
								$resultado=mysql_query($select,$conexao) or die (mysql_error());
								$cod_projeto = mysql_fetch_array($resultado);
								$cod_projeto=$cod_projeto[0];
								return $cod_projeto;
							}
						}
						
						
						$pesquisa_cod_=new pesquisa_cod_;
						for($n=0;$n<count($itens);$n++){

							$numero_item=$n+1;
							$cod_conta=$pesquisa_cod_->cod_conta($itens[$n]->cod_conta);
							$cod_ctr_custo=$pesquisa_cod_->cod_centro_custo($itens[$n]->cod_ctr_custo);
							$cod_projeto=$pesquisa_cod_->cod_projeto($itens[$n]->cod_projeto);
							$codigo_lancamento=$itens[$n]->codigo_lancamento;
							$montante=$itens[$n]->montante;
							$historico=$itens[$n]->historico;
							$data_vencimento_liquidacao=data_($itens[$n]->data_vencimento_liquidacao);
							
							$tabela="cad_documento_item";
							$campos_insert="`cod_documento`, `numero_item`,  `codigo_lancamento`,`cod_conta`, `cod_ctr_custo`,`cod_projeto`, `montante`, `historico`, `data_vencimento_liquidacao`";
							$values = "'".$cod_documento."','".$numero_item."','".$codigo_lancamento."','".$cod_conta."','".$cod_ctr_custo."','".$cod_projeto."','".$montante."','".$historico."','".$data_vencimento_liquidacao."'";
							$sql->insert($tabela,$campos_insert,$values,'N');
							//echo $values;
						}
				
			}else{
				
				echo "<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>Não há um período aberto para a data base de lançamento. O documento não foi salvo,corrija a data e tente novamente.</div>";
				
			}

			
		}

	}	


?>