<?php
class relatorios{
		function listagem_cartas_por_colaborador($cod_centro,$cod_grupo,$cod_colaborador,$status_carta,$tipo_convenio,$cod_campanha,$carta_aberta ){
			$relatorio='';
			include "config.php";
					$select_grupo= "
									SELECT 
										cad_colaboradores.cod_grupo as cod_grupo

									FROM 
										".$schema.".cad_colaboradores,
										".$schema.".cad_grupos
										
									WHERE
										cad_colaboradores.cod_empresa=".$_SESSION['cod_empresa']." and									
										cad_colaboradores.cod_grupo=".$schema.".cad_grupos.cod_grupo

										";
								
								if ($cod_centro!=""){ $select_grupo=$select_grupo. " and `".$schema."`.`cad_grupos`.`cod_centro` = '".$cod_centro."'";}
								if ($cod_grupo!=""){ $select_grupo=$select_grupo. " and `".$schema."`.`cad_grupos`.`cod_grupo` = '".$cod_grupo."'";}
								if ($cod_campanha!=""){ $select_grupo=$select_grupo. " and `".$schema."`.`cad_grupos`.`cod_campanha` = '".$cod_campanha."'";}
					$select_grupo.= "
									group by 
										cod_grupo";

					$resultado_grupo=mysql_query($select_grupo,$conexao) or die (mysql_error()."<br><br><br>".$select_grupo);
						while($row_grupo = mysql_fetch_array($resultado_grupo))
						{
								$select_colaborador= "

											SELECT 
												cad_colaboradores.cod_colaborador,
												cad_pessoas.nome_razao_social as colaborador,
												cad_centros.nome_centro as centro,
												cad_grupos.nome_grupo as grupo
											FROM 
												".$schema.".cad_colaboradores,
												".$schema.".cad_grupos,
												".$schema.".cad_pessoas,
												`".$schema."`.`cad_centros`,
												`".$schema."`.`cad_campanhas`

											where 
												cad_colaboradores.cod_empresa=".$_SESSION['cod_empresa']." and											
												`cad_grupos`.cod_centro= `".$schema."`.`cad_centros`.cod_centro and
												`cad_grupos`.cod_campanha=`".$schema."`.`cad_campanhas`.cod_campanha and
												cad_colaboradores.cod_grupo=".$schema.".cad_grupos.cod_grupo and
												cad_colaboradores.cod_pessoa=cad_pessoas.cod_pessoa and
												cad_colaboradores.cod_grupo='".$row_grupo['cod_grupo']."'  ";
											
											if ($cod_colaborador!=""){ $select_colaborador=$select_colaborador. "and `".$schema."`.`cad_colaboradores`.`cod_colaborador` = '".$cod_colaborador."'";}
						
										$select_colaborador=$select_colaborador."
											group by 
												cad_centros.nome_centro,
												cad_grupos.nome_grupo,
												colaborador
											order by 
												cad_centros.nome_centro,
												cad_grupos.nome_grupo,
												colaborador
												
												
												";
											
								$resultado_colaborador=mysql_query($select_colaborador,$conexao) or die (mysql_error()."<br><br><br>".$select_colaborador);
									while($row_colaborador = mysql_fetch_array($resultado_colaborador))
									{
//--------------------------------------------------------------------------------------------------------------------
							$relatorio.= "
								<div class='tm-top-a uk-grid tm-grid-block uk-panel-box'>
									<div style='page-break-after: always;' class='uk-width-1-1'  style='width: 100%;min-height: 350px;'>
										<p>
										<h1 style='font-family: arial;font-size: 13px;margin: 0px;padding: 0px;'>	
											".$row_colaborador['centro']."
										</h1>
										<h2 style='padding: 0px;margin: 0px;font-family: arial;font-size: 25px;'>	
											".$row_colaborador['grupo']."
										</h2>
										<h3 style='margin: 0px 0px 18px;font-size: 15px;line-height: 36px;color: #333;border-width: 0px 0px 1px;font-family: Arial;border-style: none none dotted;border-bottom: 1px dotted #CCC;'>	
											".$row_colaborador['cod_colaborador']." - ".$row_colaborador['colaborador']."
										</h3>
										</p>";
					$select= "
								select 
									cad_cartas.cod_carta,
									cad_cartas.cod_contribuinte,
									cad_pessoas.nome_razao_social,
									cad_cartas.cod_colaborador,
									cad_moedas.moeda,
									cad_cartas.carta_valor_moeda,
									DATE_FORMAT(cad_cartas.data_cancelamento,'%Y-%m-%d') as data_cancelamento,
									cad_cartas.carta_data_inicio,
									cad_cartas.carta_data_fim,
									cad_cartas.carta_forma_pagamento,
									cad_cartas.carta_aberta,
									cad_cartas.debito_banco as debito_banco,
									cad_cartas.boleto_modo_envio as boleto_modo_envio,
									cad_status.*,
									recebimentos.areceber,
									recebimentos.recebido

								from 
									`".$schema."`.`cad_status`,
									`".$schema."`.`cad_cartas`
									
								left join ".$schema.".cad_pessoas on
									`".$schema."`.`cad_pessoas`.`cod_pessoa`=`".$schema."`.`cad_cartas`.`cod_contribuinte`
								left join ".$schema.".cad_moedas on
									`".$schema."`.`cad_moedas`.`cod_moeda`=`".$schema."`.`cad_cartas`.`carta_moeda` 
								left join (select 
												cad_cartas.cod_carta,
												ifnull(recebido.recebido,0) as recebido,
												ifnull(areceber.areceber,0) as areceber
											from
												".$schema.".cad_cartas



											left join
											(
											select
												cad_cartas.cod_carta,
												sum(valor) as areceber

											from 
												".$schema.".captacao_cartas,
												".$schema.".cad_cartas

											where
												(data_vencimento between DATE_SUB(CURDATE(),INTERVAL 12 month) and CURDATE()) and
												".$schema.".captacao_cartas.cod_carta=".$schema.".cad_cartas.cod_carta and
												`cad_cartas`.`cod_colaborador` = '".$row_colaborador['cod_colaborador']."'

											group by
												cad_cartas.cod_carta) as areceber on 

											cad_cartas.cod_carta=areceber.cod_carta

											left join 
											(
											select
												cad_cartas.cod_carta,
												sum(valor_baixa) as recebido

											from 
												".$schema.".captacao_cartas,
												".$schema.".captacao_cartas_baixas,
												".$schema.".cad_cartas

											where
												(data_baixa between DATE_SUB(CURDATE(),INTERVAL 12 month) and CURDATE()) and
												captacao_cartas_baixas.cod_captacao_cartas=captacao_cartas.cod_captacao_cartas and
												".$schema.".captacao_cartas.cod_carta=".$schema.".cad_cartas.cod_carta and
												`cad_cartas`.`cod_colaborador` = '".$row_colaborador['cod_colaborador']."'

											group by
												cad_cartas.cod_carta) as recebido on
												cad_cartas.cod_carta=recebido.cod_carta
										where 
											`cad_cartas`.`cod_colaborador` = '".$row_colaborador['cod_colaborador']."'

											) as recebimentos on
									".$schema.".cad_cartas.cod_carta=recebimentos.cod_carta
								
							where
								`".$schema."`.`cad_status`.`cod_status`=`".$schema."`.`cad_cartas`.`status_carta`
								and `".$schema."`.`cad_cartas`.`cod_colaborador` = '".$row_colaborador['cod_colaborador']."' ";

							if ($status_carta!=""){ $select.="and `".$schema."`.`cad_cartas`.`status_carta` = '".$status_carta."'";}
							if ($tipo_convenio!=""){ $select.="and `".$schema."`.`cad_cartas`.`carta_forma_pagamento` = '".$tipo_convenio."'";}
							if ($carta_aberta!=""){ $select.="and `".$schema."`.`cad_cartas`.`carta_aberta` = '".$carta_aberta."'";}
	
								
								
							$select.=" order by 
												descricao,
												cad_pessoas.nome_razao_social
												
												
												";
					
					$resultado=mysql_query($select,$conexao) or die (mysql_error()."<br><br><br>".$select);

						$relatorio.= "<table class='tblista' id='tblista' style='border-spacing: 1px; font-size: 10px;font-family: arial;cursor: pointer;width: 100%;border: 1px dotted #CCC;'>";
						$relatorio.= "
							<tr style='height: 26px;'>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-bottom: 1px dotted #CCC;'>n</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>st</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>status</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Cod.Carta</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Cod.Contr.</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Contribuinte</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Pmto</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Aberta</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Inicio</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Fim</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Cancelada</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Moeda</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>Valor</th>
								<th class='cabecalho' style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>% *</th>
							</tr>";						
						$n=1;
						$total_carta=0;
						while($row = mysql_fetch_array($resultado))
							{
							//<img class='icone' title='".$row['status_resumido']."' src='imagens/".$row['status_resumido'].".png'></img>
							//<img id='".$row['cod_carta']."' style='height: 20px;width:20px;'  src='../imagens/".$row['status_resumido'].".png' title='".$row['status_resumido']."'></img>
							if($row['descricao']=='Ativa'){
									$cor="rgb(47, 207, 99)";//verde
							}else{
								if($row['descricao']=='Cancelada'){
									$cor="rgb(255, 174, 8)";//laranja	
								}else{
									if($row['descricao']=='Vencida'){
										$cor="rgb(255, 3, 3)";//vermelho	
									}else{
										if($row['descricao']=='Renovada'){
											$cor="rgb(204, 204, 204)";//vermelho	
										}else{
											$cor="rgb(255, 3, 3)";//vermelho	
										}
									}
								}
							}
							
							
							

								$relatorio.= "<tr id='".$row['cod_carta']."' >
									<th style='padding: 1px 5px;color: #000;border-bottom: 1px dotted #CCC;text-align: center;'>".$n."</th>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'><span style='width: 20px; height: 20px; background: none repeat scroll 0% 0% ".$cor."; border-radius: 10px; padding: 1px 7px;'>  </span></td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>	".$row['descricao']."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>".$row['cod_carta']."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>".$row['cod_contribuinte']."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;'>".$row['nome_razao_social']."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>".$row['carta_forma_pagamento']."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>".$row['carta_aberta']."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>".data($row['carta_data_inicio'])."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>".data($row['carta_data_fim'])."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>".data($row['data_cancelamento'])."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align: center;'>".$row['moeda']."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align:right;'>R$ ".number_format($row['carta_valor_moeda'], 2, ',', '.')."</td>
									<td style='padding: 1px 5px;color: #000;border-left: 1px dotted #CCC;border-bottom: 1px dotted #CCC;text-align:right;'>";
								if($row['areceber']!=0){$relatorio.=number_format($row['recebido']/$row['areceber']*100, 2, ',', '.');} else{$relatorio.=number_format(0, 2, ',', '.');}	
									$relatorio.="%</td>
								</tr>";	
							$n=$n+1;
							$total_carta=$total_carta+$row['carta_valor_moeda'];
							}	
						$relatorio.= "
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th style='text-align:right;'>".number_format($total_carta, 2, ',', '.')."</th>
										<th style='text-align:right;'></th>
									</tr>
								</table>
								<p>* % de recebimentos no últimos 12 meses</p>
							</div>
						</div>
							";

















									
//--------------------------------------------------------------------------------------------------------------------									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									}
									
						}
						
	echo $relatorio;					
}						
	

function resumo_carta_doacao($cod_carta){

	include "config.php";
					$select= "
					
			SELECT
				cad_cartas.cod_carta,
				cad_cartas.carta_valor_moeda,
				cad_cartas.carta_reajuste,
				cad_cartas.carta_aberta,
				DATE_FORMAT(cad_cartas.carta_data_inicio,'%d/%m/%Y') as carta_data_inicio, 
				DATE_FORMAT(cad_cartas.carta_data_fim,'%d/%m/%Y') as carta_data_fim ,
				cad_cartas.carta_dia_debito,
				cad_cartas.carta_forma_pagamento,
				cad_cartas.debito_banco,
				cad_cartas.debito_numero_agencia,
				cad_cartas.debito_digito_agencia,
				cad_cartas.debito_numero_conta,
				cad_cartas.debito_digito_conta,
				cad_pessoas.*,
				cad_convenios.*,
				colaborador.colaborador,
				colaborador.email_1 as colaborador_email_1,
				colaborador.telefone_1 as colaborador_telefone_1,
				cad_status.cod_status,
				cad_status.descricao
				
			FROM 
				".$schema.".cad_cartas
				
			
			LEFT JOIN ".$schema.".cad_pessoas ON cad_pessoas.cod_pessoa=cad_cartas.cod_contribuinte
			
			LEFT JOIN ".$schema.".cad_convenios ON cad_convenios.cod_do_banco=cad_cartas.debito_banco and cad_convenios.tipo_convenio=cad_cartas.carta_forma_pagamento
			
			LEFT JOIN (
							select 
								cad_colaboradores.cod_colaborador,
								cad_pessoas.nome_razao_social as colaborador,
								cad_pessoas.email_1,
								cad_pessoas.telefone_1
								
							from 
								".$schema.".cad_colaboradores,
								".$schema.".cad_pessoas
								
							where 
								".$schema.".cad_pessoas.cod_pessoa=".$schema.".cad_colaboradores.cod_pessoa
			
			) as colaborador ON colaborador.cod_colaborador=cad_cartas.cod_colaborador
			
			LEFT JOIN ".$schema.".cad_status on cad_cartas.status_carta=cad_status.cod_status
			
			
			WHERE 
				cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
				cad_cartas.cod_carta = '".$cod_carta."'";

					$resultado=mysql_query($select,$conexao) or die (mysql_error());
						while($row = mysql_fetch_array($resultado))
						{
													

							$contribuinte=$row['nome_razao_social'];
							$contribuinte_endereco=$row['endereco'].", ".$row['numero'].", ".$row['complemento'];
							$contribuinte_CEP=$row['cep'];
							$contribuinte_cidade=$row['cidade'];
							$contribuinte_UF=$row['uf'];
							$contribuinte_telefone=$row['telefone_1'];
							$contribuinte_email=$row['email_1'];
							if ($row['pessoa_juridica_fisica']=='PJ')
								{$contribuinte_CPF_CNPJ = $row['cnpj'];}
								else{$dadosboleto["cpfcnpj"] = $row['cpf'];}
							if ($row['pessoa_juridica_fisica']==null)
								{$contribuinte_CPF_CNPJ = '00.000.000/0000-00';}





							$moeda='R$';
							$total=$row['carta_valor_moeda'];
							$IGPM=$row['carta_reajuste'];


							$carta_aberta=$row['carta_aberta'];
							$inicio=$row['carta_data_inicio'];
							$fim=$row['carta_data_fim'];
							$dia=$row['carta_dia_debito'];

							$forma_pmto=$row['carta_forma_pagamento'];

							$banco=$row['debito_banco'];
							$agencia=$row['debito_numero_agencia'];
							if($row['debito_digito_agencia']!=null){$agencia.="-".$row['debito_digito_agencia'];}
							$conta=$row['debito_numero_conta']."-".$row['debito_digito_conta'];


							$colaborador=$row['colaborador'];
							$colaborador_email=$row['colaborador_email_1'];
							$colaborador_telefone=$row['colaborador_telefone_1'];
							$cod_status=$row['cod_status'];
							$descricao_status=$row['descricao'];

						}



					$select= "
							select 
								captacao_cartas.cod_captacao_cartas,
								DATE_FORMAT(captacao_cartas_baixas.data_baixa,'%d/%m/%Y') as data_baixa ,
								DATE_FORMAT(captacao_cartas.data_vencimento,'%d/%m/%Y') as data_vencimento,
								captacao_cartas_baixas.data_baixa as baixa,
								captacao_cartas_baixas.valor_baixa,
								cad_carteiras.nome_carteira

							from 
								".$schema.".captacao_cartas,
								".$schema.".captacao_cartas_baixas,
								".$schema.".cad_carteiras

							where
								captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
								captacao_cartas.cod_captacao_cartas=captacao_cartas_baixas.cod_captacao_cartas and
								captacao_cartas_baixas.cod_carteira=cad_carteiras.cod_carteira and
								captacao_cartas.cod_carta='".$cod_carta."'

							order by 
								baixa desc

							limit 0,24;";
					$captacoes='';
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
						while($row = mysql_fetch_array($resultado))
						{
							
							
							$captacoes.="
									 <tr style='border-bottom: 1px dotted #CCC;'>
										<td style='padding:3px 9px;border-bottom: 1px dotted #CCC;' align='left'>".$row['cod_captacao_cartas']."</td>
										<td style='padding:3px 9px;border-bottom: 1px dotted #CCC;' align='left'>".$row['nome_carteira']."</td>
										<td style='padding:3px 9px;border-bottom: 1px dotted #CCC;' align='center'>".$row['data_vencimento']."</td>
										<td style='padding:3px 9px;border-bottom: 1px dotted #CCC;' align='center'>".$row['data_baixa']."</td>
										<td style='padding:3px 9px;border-bottom: 1px dotted #CCC;' align='center'>".$row['valor_baixa']."</td>
									</tr>
							";
							
							
							
						}




		echo	"<table border='0' width='700' cellpadding='0' cellspacing='0'>
					<tbody><tr>
						<td style='padding:20px 0 20px 0' align='center' valign='top'>
							<table style='width:100%' style='font-size: 12px;' bgcolor='#FFFFFF' border='0'  cellpadding='10' cellspacing='0'>
								
								<tbody><tr>
									<td valign='top'><a href='http://osuc.org.br/' target='_blank'><img src='"."../../".$_SESSION['logo']."' alt='OSUC' style='margin-bottom:10px' border='0'></a></td>
								</tr>
								
								<tr>
									<td valign='top'>
										<h2>".$contribuinte.",</h2>
										<p>
											A ".$_SESSION['razao_social']." agradece a sua doação.<br>
										</p>

									</td>
								</tr>
								<tr>
									<td>
										<h3>O código da sua carta é  ".$cod_carta."</h3>
									</td>
								</tr>
								
								
								
								<tr>
									<td>
										<table border='0' width='650' cellpadding='0' cellspacing='0'>
											<thead>
											<tr>
												<th style='font-size:13px;padding:5px 9px 6px 9px;line-height:1em;background: #ccc;' align='left'  width='325'>Status da Carta:</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td style='font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc' valign='top'>"


			.$cod_status." - ".
			$descricao_status."


												</td>

											</tr>
											</tbody>
										</table>
									</td>
								</tr>
								
								
								
								<tr>
									<td>
										<table border='0' width='650' cellpadding='0' cellspacing='0'>
											<thead>
											<tr>
												<th style='font-size:13px;padding:5px 9px 6px 9px;line-height:1em;background: #ccc;' align='left'  width='325'>Informações do Doador:</th>
												<th width='10'></th>
												<th style='font-size:13px;padding:5px 9px 6px 9px;line-height:1em;background: #ccc;' align='left'  width='325'>Informações da Cobrança:</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td style='font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc' valign='top'>"
													
													.$contribuinte.'<br>'.
													$contribuinte_endereco.'<br>'.
													$contribuinte_CEP.', '.
													$contribuinte_cidade.'-'.
													$contribuinte_UF.'<br>'.
													$contribuinte_telefone.'<br>'.
													$contribuinte_email."
												</td>
												<td>&nbsp;</td>
												<td style='font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc' valign='top'>
			<table  style='font-size:11px;padding:3px 9px;'>
					<tr><td>Valor:</td><td>".$moeda." ".$total."</td></tr>
					<tr><td>Corrigir pelo IGPM?:</td><td>".$IGPM."</td></tr>

					<tr><td>Inicio:</td><td>".$inicio."</td></tr>
					<tr><td>Fim:</td><td>".$fim."</td></tr>
					<tr><td>Dia para débito:</td><td>".$dia."</td></tr>

					<tr><td>Forma de pagamento:</td><td>".$forma_pmto."</td></tr>

					<tr><td>Banco:</td><td>".$banco."</td></tr>
					<tr><td>Agência:</td><td>".$agencia."</td></tr>
					<tr><td>Conta:</td><td>".$conta."</td></tr>




			</table>

												</td>
											</tr>
											</tbody>
										</table>
										<br>
										
										<table border='0' width='650' cellpadding='0' cellspacing='0'>
											<thead>
											<tr>
												<th style='font-size:13px;padding:5px 9px 6px 9px;line-height:1em;background: #ccc;' align='left'  width='325'>Informações do Colaborador:</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td style='font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc' valign='top'>"

					.$colaborador."<br>".
					$colaborador_email."<br>".
					$colaborador_telefone."<br>
												</td>

											</tr>
											</tbody>
										</table>
										<br>
										
										<table style='border:1px solid #cccccc;font-size: 12px;' border='0' width='650' cellpadding='0' cellspacing='0'>
											<thead style='font-size: 10px;'>
												<tr>
													<th style='padding:3px 9px;font-size: 12px;background: #ccc;' colspan='5' align='left' >Últimas captações recebidas:</th>
												</tr>
												<tr style='background: #ccc;'>
													<th style='padding:3px 9px' align='left' >Captação</th>
													<th style='padding:3px 9px' align='left' >Banco</th>
													<th style='padding:3px 9px' align='center' >Data Vcto</th>
													<th style='padding:3px 9px' align='center' >Data Receb</th>
													<th style='padding:3px 9px' align='center' >Valor Recebido</th>
												</tr>
											</thead>

											<tbody style='font-size: 10px;'>"

											.$captacoes.

											"</tbody>


				

			</table>

										<p style='font-size:12px;margin:0 0 10px 0'></p>
									</td>
								</tr>
								<tr>
									<td style='background:#cccccc;text-align:center' align='center' ><center><p style='font-size:12px;margin:0'>Obrigado</p></center></td>
								</tr>
							</tbody></table>
						</td>
					</tr>
				</tbody></table>";
	
						
		}
		function resumo_campanha($data_inicio,$data_fim,$cod_campanha){
			include "config.php";

				if ($data_inicio!="01/01/1900"){$data_inicio=data($data_inicio);}else{$data_inicio=adddate(date("Y-m-d"),"-1 year");}
				if ($data_fim!="31/12/9999"){$data_fim=data($data_fim);}else{$data_fim=date("Y-m-d");}
				if ($cod_campanha!=""){$cod_campanha=$cod_campanha;}else{$cod_campanha="";}

				$inicio = new DateTime($data_inicio);
				$fim = new DateTime($data_fim);
				$meses = ($fim->format('m') - $inicio->format('m'))+($fim->format('Y') - $inicio->format('Y'))*12;
				//$interval = $inicio->diff($fim);
				//$meses=$interval->format('%m months');

				//$meses=$interval->format('%Y')*12+$interval->format('%M')+1;
				//	if ($cod_campanha!=""){ $select.=" and cad_grupos.cod_campanha = '".$cod_campanha."'";}
				$select="
					select 
						tb_grupos.*,
						ifnull(saldo_inicial.valor,0) as saldo_inicial,
						ifnull(novas.valor,0) as novas,
						ifnull(renovacao.valor,0) as renovacao,
						ifnull(-vencidas.valor,0) as vencidas,
						ifnull(-canceladas.valor,0) as canceladas,
						(
						ifnull(saldo_inicial.valor,0)
						+ifnull(novas.valor,0)
						+ifnull(renovacao.valor,0)
						-ifnull(vencidas.valor,0)
						-ifnull(canceladas.valor,0)
						) as saldo_atual,
						0 as valor_baixas

					from

							
						-- grupos
						(
							select 
								*
							from
								(SELECT 
									cad_grupos.cod_grupo as cod_grupo,
									cad_grupos.nome_grupo as grupo,
									cad_centros.nome_centro as centro,
									cad_campanhas.nome_campanha as campanha
								FROM 
									".$schema.".cad_grupos,
									".$schema.".cad_campanhas,
									".$schema.".cad_centros
								Where
									cad_grupos.cod_empresa=".$_SESSION['cod_empresa']." and								
									cad_grupos.cod_campanha=cad_campanhas.cod_campanha and
									cad_grupos.cod_centro=cad_centros.cod_centro
				";
				if ($cod_campanha!=""){ $select.=" and cad_grupos.cod_campanha = '".$cod_campanha."'";}
				$select.="
								
								) as grupos,
							-- carta aberta
							(SELECT 
								carta_aberta
							FROM 
								".$schema.".cad_cartas
							GROUP by
								carta_aberta) as tb_carta_aberta
					) as tb_grupos

				-- left join -------------------------------------------------------------------------------

				-- Saldo Inicial ---------------------------------------------------------------------------
					
					left join
							(select 
								sum(carta_valor_moeda) as valor,
								cod_grupo,
								carta_aberta
							from 
								".$schema.".cad_cartas,
								".$schema.".cad_colaboradores
							where
								cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
								cad_cartas.cod_colaborador=cad_colaboradores.cod_colaborador and
								-- filtro---------------------------------
								cad_cartas.carta_data_inicio<'".$data_inicio."' and 
								cad_cartas.carta_data_fim>='".$data_inicio."' and 
								(cad_cartas.data_cancelamento>='".$data_inicio."' or cad_cartas.data_cancelamento='0000-00-00 00:00:00')		
								-- filtro---------------------------------
							group by
								cod_grupo,
								carta_aberta) as saldo_inicial 
						on (saldo_inicial.cod_grupo=tb_grupos.cod_grupo and saldo_inicial.carta_aberta=tb_grupos.carta_aberta)

				-- Novas ---------------------------------------------------------------------------
					
					left join
							(select 
								sum(carta_valor_moeda) as valor,
								cod_grupo,
								carta_aberta
							from 
								".$schema.".cad_cartas,
								".$schema.".cad_colaboradores,
									(
									SELECT
										cod_contribuinte, 
										if(count(cod_contribuinte)>1,'renovacao','nova') as nova_renovacao
									FROM 
										".$schema.".cad_cartas 
									group by 
										cod_contribuinte
									)as tb_renovacao
							where
								cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
								cad_cartas.cod_colaborador=cad_colaboradores.cod_colaborador and
								cad_cartas.cod_contribuinte=tb_renovacao.cod_contribuinte and
								tb_renovacao.nova_renovacao='nova' and
								-- filtro---------------------------------
								cad_cartas.carta_data_inicio>='".$data_inicio."' and
								cad_cartas.carta_data_inicio<='".$data_fim."' 
								-- filtro---------------------------------
							group by
								cod_grupo,
								carta_aberta) as novas
						on (novas.cod_grupo=tb_grupos.cod_grupo and novas.carta_aberta=tb_grupos.carta_aberta)
				-- Renovacao ---------------------------------------------------------------------------
					
					left join
							(select 
								sum(carta_valor_moeda) as valor,
								cod_grupo,
								carta_aberta
							from 
								".$schema.".cad_cartas,
								".$schema.".cad_colaboradores,
									(
									SELECT
										cod_contribuinte, 
										if(count(cod_contribuinte)>1,'renovacao','nova') as nova_renovacao
									FROM 
										".$schema.".cad_cartas 
									group by 
										cod_contribuinte
									)as tb_renovacao
							where
								cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
								cad_cartas.cod_colaborador=cad_colaboradores.cod_colaborador and
								cad_cartas.cod_contribuinte=tb_renovacao.cod_contribuinte and
								tb_renovacao.nova_renovacao='renovacao' and
								-- filtro---------------------------------
								cad_cartas.carta_data_inicio>='".$data_inicio."' and
								cad_cartas.carta_data_inicio<='".$data_fim."' 
								-- filtro---------------------------------
							group by
								cod_grupo,
								carta_aberta) as renovacao
						on (renovacao.cod_grupo=tb_grupos.cod_grupo and renovacao.carta_aberta=tb_grupos.carta_aberta)

				-- Vencidas ---------------------------------------------------------------------------
					
					left join
							(select 
								sum(carta_valor_moeda) as valor,
								cod_grupo,
								carta_aberta
							from 
								".$schema.".cad_cartas,
								".$schema.".cad_colaboradores
							where
								cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
								cad_cartas.cod_colaborador=cad_colaboradores.cod_colaborador and
								-- filtro---------------------------------
								cad_cartas.carta_data_fim>='".$data_inicio."' and 
								cad_cartas.carta_data_fim<='".$data_fim."' and 
								(cad_cartas.data_cancelamento='0000-00-00 00:00:00' or cad_cartas.data_cancelamento>'".$data_fim."')
								-- filtro---------------------------------
							group by
								cod_grupo,
								carta_aberta) as vencidas
						on (vencidas.cod_grupo=tb_grupos.cod_grupo and vencidas.carta_aberta=tb_grupos.carta_aberta)
						
				-- Canceladas ---------------------------------------------------------------------------
					
					left join
							(select 
								sum(carta_valor_moeda) as valor,
								cod_grupo,
								carta_aberta
							from 
								".$schema.".cad_cartas,
								".$schema.".cad_colaboradores
							where
								cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
								cad_cartas.cod_colaborador=cad_colaboradores.cod_colaborador and
								-- filtro---------------------------------
								cad_cartas.carta_data_inicio<='".$data_fim."' and
								cad_cartas.carta_data_fim>='".$data_inicio."' and 
								(cad_cartas.data_cancelamento>='".$data_inicio."' and 
								cad_cartas.data_cancelamento<='".$data_fim."')
								-- filtro---------------------------------
							group by
								cod_grupo,
								carta_aberta) as canceladas
						on (canceladas.cod_grupo=tb_grupos.cod_grupo and canceladas.carta_aberta=tb_grupos.carta_aberta)

						
				order by
					tb_grupos.campanha,
					tb_grupos.centro,
					tb_grupos.grupo,
					tb_grupos.carta_aberta




				";



												
										$resultado=mysql_query($select,$conexao) or die (mysql_error());
										$data='';
										while($row_cartas = mysql_fetch_array($resultado))
										{
										
											$data.="{
													'cod_grupo':'".$row_cartas['cod_grupo']."',
													'centro':'".$row_cartas['centro']."',
													'grupo':'".$row_cartas['grupo']."',
													'carta_aberta':'".$row_cartas['carta_aberta']."', 
													'saldo_inicial':".round($row_cartas['saldo_inicial']).", 
													'novas':".round($row_cartas['novas']).", 
													'renovacao':".round($row_cartas['renovacao']).", 
													'vencidas':".round($row_cartas['vencidas']).", 
													'canceladas':".round($row_cartas['canceladas']).", 
													'saldo_atual':".round($row_cartas['saldo_atual']).",
													'variacao_v':".round($row_cartas['saldo_atual']-$row_cartas['saldo_inicial']).",";
											if($row_cartas['saldo_inicial']>0){
												$data.=	"'variacao_p':".round(($row_cartas['saldo_atual']-$row_cartas['saldo_inicial'])/$row_cartas['saldo_inicial']*100).", ";
												}
											else{
												$data.=	"'variacao_p':".round(0).", ";
												}		
											
													
											$data.=	"'valor_baixas':".round($row_cartas['valor_baixas']).", 
													'inadimplencia':".round($row_cartas['saldo_atual']-$row_cartas['valor_baixas']/$meses).", 
													'media_recebimentos':".round($row_cartas['valor_baixas']/$meses)."
												},
											";	

										}
		//relatório
		
		echo "
				<div class='tm-grid-truncate uk-text-center'>	
					<div class='tm-top-a uk-grid tm-grid-block uk-panel-box' style='padding: 10px;'>
						<div class='uk-width-1-1' style=''>		
							<table id='grid'></table>
						</div>
					</div>
				</div>			
				<script>
					$(function () {
						$('#grid').igGrid({
							autoGenerateColumns: false,
							width: '100%',
							columns: [
						
								{ headerText: 'Grupos', key: 'grupo', dataType: 'string', width: '30%' },

								{ headerText: 'Carta Aberta', key: 'carta_aberta', dataType: 'string', width: '30%' },
								{
									headerText: 'Movimento das cartas ativas',
									group: [
										{ headerText: 'Saldo Inicial', key: 'saldo_inicial', dataType: 'number', width: '20%', format: '0' },
										{
											headerText: 'Movimento',
											group: [
												{ headerText: 'Novas', key: 'novas', dataType: 'number', width: '20%' , format: '0'},						   
												{ headerText: 'renovacao', key: 'renovacao', dataType: 'number', width: '20%' , format: '0'},						   
												{ headerText: 'Vencidas', key: 'vencidas', dataType: 'number', width: '20%' , format: '0'},						   
												{ headerText: 'Canceladas', key: 'canceladas', dataType: 'number', width: '20%' , format: '0'}
											]
										},
										{ headerText: 'Saldo Atual', key: 'saldo_atual', dataType: 'number', width: '20%' , format: '0'},
										{ headerText: 'Variacao R$', key: 'variacao_v', dataType: 'number', width: '20%' , format: '0'},
										{ headerText: 'Variacao %', key: 'variacao_p', dataType: 'number', width: '20%' , format: 'percent'}
									]
								},

							],

							dataSource: [". $data ."],
							features: [
								{
									name: 'Summaries'
								},
								{
									name: 'Filtering',
									type: 'local',
									mode: 'advanced',
									filterDialogContainment: 'window'
								},
								{
									name: 'Sorting',
									type: 'local'
								},
								{
									name: 'Resizing'
								},
								{
									name: 'ColumnMoving',
									columnMovingDialogContainment: 'window'
								},
								{
									name: 'Hiding'
								},
			{
									name: 'MultiColumnHeaders'
								},
								{
									name: 'GroupBy',
									columnSettings: [
									   {
											columnKey: 'grupo',
											isGroupBy: true,
											groupComparerFunction: groupByFirstLetter
										}
									]
								}
							]
						});
					});
					function groupByFirstLetter(columnSetting, val1, val2) {
						if (val1 !== null && val2 !== null && val1.substring(0, 1000) === val2.substring(0, 1000)) {
							columnSetting.customGroupName = val1.substring(0, 1000);
							return true;
						} else if (val1 !== null && val2 !== null && val1.substring(0, 1000) !== val2.substring(0, 1000)) {
							columnSetting.customGroupName = val1.substring(0, 1000);
							return false;
						} else if (val1 === null && val2 !== null) {
							columnSetting.customGroupName = val2.substring(0, 1000);
							return false;
						} else if (val1 !== null && val2 === null) {
							columnSetting.customGroupName = val1.substring(0, 1000);
							return false;
						}
						return false;
					}
					

				</script>		
		
	
		";
		





			
							
							
		}
		function comprovante_doacoes($cod_pessoa,$data_inicio_de,$data_inicio_ate){
			
			include "config.php";
			
			$tabela="";
			$nome_contribuinte="";
			$cnpj_cpf_contribuinte="";
			$total=0;
			
			$data_inicio_de=data($data_inicio_de);
			$data_inicio_ate=data($data_inicio_ate);
			
			$select = "
						SELECT 
							DATE_FORMAT(captacao_cartas_baixas.data_baixa,'%d/%m/%Y') as data_baixa,
							captacao_cartas_baixas.valor_baixa,
							cad_carteiras.nome_carteira,
							cad_pessoas.nome_razao_social as nome_contribuinte,
							concat(cad_pessoas.cnpj,cad_pessoas.cpf) as cnpj_cpf_contribuinte


						FROM 
							".$schema.".captacao_cartas_baixas,
							".$schema.".captacao_cartas,
							".$schema.".cad_cartas,
							".$schema.".cad_pessoas,
							".$schema.".cad_carteiras


						where
							cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and	
							captacao_cartas_baixas.cod_captacao_cartas=captacao_cartas.cod_captacao_cartas and
							captacao_cartas_baixas.cod_carteira=cad_carteiras.cod_carteira and
							captacao_cartas.cod_carta=cad_cartas.cod_carta and
							cad_cartas.cod_contribuinte=cad_pessoas.cod_pessoa and
							cad_pessoas.nome_razao_social='".$cod_pessoa."' and
							captacao_cartas_baixas.data_baixa between '".$data_inicio_de."' and '".$data_inicio_ate."'	

							
						order by 
							captacao_cartas_baixas.data_baixa
							
			
			";
			

			
			$resultado=mysql_query($select,$conexao) or die (mysql_error());
			while($row = mysql_fetch_array($resultado))
			{
				$nome_contribuinte=$row['nome_contribuinte'];
				$cnpj_cpf_contribuinte=$row['cnpj_cpf_contribuinte'];

				$tabela.="
					<tr style='border: 1px solid;'>
						<td style='border-right: 1px solid; padding: 5px;'>
							".$row['nome_carteira']."
						</td>
						<td style='border-right: 1px solid; padding: 5px;width: 100px ! important;text-align: center;'>
							".$row['data_baixa']."
						</td>
						<td style='padding: 5px;width: 100px ! important;text-align: right;'>
							".number_format($row['valor_baixa'], 2, ',', '.')."
						</td>
					</tr>				
				
				";
				$total=$total+$row['valor_baixa'];
			}			




			$nome_beneficiada=$razao_social;
			$cnpj_beneficiada=$cnpj_;
			
			
			
			
			
			echo "
					<div class='uk-grid' style='padding: 30px; font-family: arial,verdana ! important; font-size: 12px ! important;'>
						<div class='uk-width-1-1'>
							<div class='uk-grid'>
								<div class='uk-width-1-1'>
									<a href='http://osuc.org.br/' target='_blank'><img src='"."../../".$_SESSION['logo']."' alt='OSUC' style='margin-bottom:10px' border='0'></a>
								</div>
								<div class='uk-width-1-2'>
									<h4 style='font-family: arial,verdana ! important; font-size: 12px ! important;'>
										".$razao_social."</br>
										".$endereco."</br>
										".$endereco_."</h4>
								</div>
								<div class='uk-width-1-2' style='text-align: right;'>
									<h1 style='font-family: arial,verdana ! important; font-size: 30px ! important;'>Comprovante de doações</h1>
									<p class='uk-article-lead' style='font-family: arial,verdana ! important; font-size: 15px ! important;'>De ".data($data_inicio_de)." a ".data($data_inicio_ate)."</p>
								
								</div>
							</div>
						
						
							<hr class='uk-grid-divider'>
						</div>

						<div class='uk-width-1-1'>
							<ol>
								<li>
									<h3>Pessoa Física ou Jurídica doadora</h3>
										<table style='width: 100%; border: 1px solid;'>
											<tbody>
												<tr style='border: 1px solid;'>
													<td style='border-right: 1px solid; padding: 5px;'>
														Nome do doador
													</td>
													<td style='padding: 5px;text-align: right;'>
														CNPJ/CPF
													</td>
												</tr>
												<tr>
													<td style='border-right: 1px solid; padding: 5px;'>
														".$nome_contribuinte."
													</td>
													<td style='padding: 5px;width: 200px;text-align: right;'>
														".$cnpj_cpf_contribuinte."
													</td>
												</tr>
											</tbody>
										</table>
								
								</li>
								<li>
									<h3>Entidade beneficiada</h3>
										<table style='width: 100%; border: 1px solid;'>
											<tbody>
												<tr style='border: 1px solid;'>
													<td style='border-right: 1px solid; padding: 5px;'>
														Nome da entidade beneficiada
													</td>
													<td style='padding: 5px;text-align: right;'>
														CNPJ
													</td>
												</tr>
												<tr>
													<td style='border-right: 1px solid; padding: 5px;'>
														".$nome_beneficiada."
													</td>
													<td style='padding: 5px;width: 200px;text-align: right;'>
														".$cnpj_beneficiada."
													</td>
												</tr>
											</tbody>
										</table>
								
								</li>
								<li>
									<h3>Valores doados no período</h3>
										<table style='width: 100%; border: 1px solid;'>
											<tbody>
												<tr style='border: 1px solid;'>
													<td style='border-right: 1px solid; padding: 5px;'>
														Conta da beneficiada
													</td>
													<td style='border-right: 1px solid; padding: 5px;width: 100px ! important;text-align: center;'>
														Data
													</td>
													<td style='padding: 5px;width: 100px ! important;text-align: center;'>
														Valor
													</td>
												</tr>
												".$tabela."
											</tbody>
										</table>
										<table style='width: 100%; border: 1px solid; margin-top: 20px;'>
											<tbody>
												<tr style='border: 1px solid;'>
													<td style='border-right: 1px solid; padding: 5px;'>
														Total
													</td>
													<td style='padding: 5px;width: 100px ! important;text-align: right;'>
														".number_format($total, 2, ',', '.')."
													</td>
												</tr>								
											</tbody>
										</table>	
											
								</li>

							</ol>
						
							<hr class='uk-grid-divider'>
						</div>
						<div class='uk-width-1-1'>
							<p class='uk-article-meta' style='padding: 30px; font-family: arial,verdana ! important; font-size: 10px ! important;'>
								<i>
									As doações feitas diretamente por carta de doação não são dedutíveis para fins de apuração do Imposto de Renda. O Regulamento do Imposto de Renda, decreto Nº 3000 de 26/03/1999, prevê que poderão ser deduzidas do importo a pagar apenas doações feitas a Programas de Incentivos às Atividades Culturais ou Artísticas (PRONAC), Programas de Incentivos às Atividades Audiovisuais (Lei Rouanet, Lei do Áudio Visual), e Doações a Fundos Controlados pelos Conselhos dos Direitos da Criança e do Adolescente (FUNCAD).
								</i>
							</p>
							<hr class='uk-grid-divider'>
						</div>						
					</div>					
								
			";
			
			
		}
		function captacoes_cod_status($data_inicio_de,$data_inicio_ate){
			include "config.php";
			
			if ($data_inicio_de!='01/01/1900'){$data_inicio=data($data_inicio_de);}else{$data_inicio=adddate(date("Y-m-d"),"-1 year");}
			if ($data_inicio_ate!='31/12/9999'){$data_fim=data($data_inicio_ate);}else{$data_fim=date("Y-m-d");}

						
			$select_status="
							select 
								status,
								descricao
							from
								".$schema.".captacao_cartas,
								".$schema.".cad_status
							where
								captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
								captacao_cartas.data_vencimento between '".$data_inicio."' and '".$data_fim."' and
								captacao_cartas.status=cad_status.cod_status
							group by 
								status
							order by 
								status";
				$cod_carteira='';
				$serie='';
				$filtro='';
				$campos='';
				$n=0;
			$resultado_status=mysql_query($select_status,$conexao) or die (mysql_error());
			while($row_status = mysql_fetch_array($resultado_status))
			{
				$filtro.="

				
							left join(select 
								status,
								month(data_vencimento) as mes,
								year(data_vencimento) as ano,
								sum(valor) as valor
							from
								".$schema.".captacao_cartas
							where
								captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
								(captacao_cartas.data_vencimento between '".$data_inicio."' and '".$data_fim."') and
								captacao_cartas.status='".$row_status['status']."'
							group by 
								status,ano,mes
							order by 
								status,ano,mes) as `status_".$n."` on `status_".$n."`.ano=cad_datas.ano and `status_".$n."`.mes=cad_datas.mes ";
				
				
				$campos.=", IFNULL(`status_".$n."`.`valor`,0) as `".$n."-".$row_status['descricao']."` ";
				$n=$n+1;
			}
			

			$baixas="
			
			
				select cad_datas.ano, cad_datas.mes ".$campos."
				from cad_datas

				".$filtro."			
				

				where (data between '".$data_inicio."' and '".$data_fim."')
				group by ano,mes
				order by ano,mes
			


					";
//echo $baixas;
			$serie_baixa='';
			$ano_mes='';
			$data='';
			$colunas="
				{ headerText: 'ano', key: 'ano', dataType: 'int', width: '10%' },
				{ headerText: 'mes', key: 'mes', dataType: 'int', width: '10%' },";
				for($i=2;$i<=$n+1;$i++){
				$serie_baixa[$i]="";
				}
			$resultado_baixas=mysql_query($baixas,$conexao) or die (mysql_error());
			while($row_baixas = mysql_fetch_array($resultado_baixas))
			{
				$data.="{'ano':'".$row_baixas['ano']."','mes':'".$row_baixas['mes']."',";
			
				for($i=2;$i<=$n+1;$i++){
				$serie_baixa[$i].=$row_baixas[$i].",";
				$data.="'".mysql_field_name($resultado_baixas,$i)."':".$row_baixas[$i].",";
				
		
				}
				$data.="},
				";
				
				$ano_mes.="'".$row_baixas['ano']."-".$row_baixas['mes']."',";
				
			}
			for($i=2;$i<=$n+1;$i++){
				$colunas.="
				{ headerText: '".mysql_field_name($resultado_baixas,$i)."', key: '".mysql_field_name($resultado_baixas,$i)."', format: 'currency', width: '20%' },";
			}
			
			$n=2;
			
			
			$resultado_status=mysql_query($select_status,$conexao) or die (mysql_error());
			while($row_status = mysql_fetch_array($resultado_status))
			{
				$serie.="
						{
						name: '".$row_status['status']."-".$row_status['descricao']."',
						data: [".$serie_baixa[$n]."]
						},";
				$n=$n+1;
			}
			
		echo "
				<div class='tm-grid-truncate uk-text-center'>	
					<div class='tm-top-a uk-grid tm-grid-block uk-panel-box' style='padding: 10px;'>
						<div class='uk-width-1-1'>
							<div id='grafico' style='width: 100%;height: 800px; margin: 0 auto'></div>
						</div>
						<div class='uk-width-1-1' style=''>		
							<table id='grid'></table>
						</div>
					</div>
				</div>	

				<script type='text/javascript'>
					$(function () {
							$('#grafico').highcharts({
								title: {
									text: 'Recebimentos por codigo de retorno',
									x: -20 //center
								},
								subtitle: {
									text: 'total de recebimentos mensais',
									x: -20
								},
								xAxis: {
									categories: [". $ano_mes ."]
								},
								yAxis: {
									title: {
										text: 'Reais (R$)'
									},
									plotLines: [{
										value: 0,
										width: 1,
										color: '#808080'
									}]
								},

								tooltip: {
									shared: true,
									useHTML: true,
									headerFormat: '<table><tr><th>Código de Retorno</th><th><small>{point.key}</small></th></tr>',
									pointFormat: '<tr><td style=color: {series.color}>{series.name} </td> <td style=text-align: right><b>R$ {point.y:,.0f}</b></td></tr>',
									footerFormat: '</table>',
									valueDecimals: 2
								},
								legend: {
									layout: 'vertical',
									align: 'bottom',
									verticalAlign: 'bottom',
									borderWidth: 0
								},
								series: [".$serie."]
							});
						});


						$(function () {
							$('#grid').igGrid({
								height: '100%',
								autoGenerateColumns: false,
								width: '100%',
								columns: [".$colunas."],
								dataSource: [".$data."],
								features: [
									{
										name: 'Filtering',
										type: 'local',
										mode: 'advanced',
										filterDialogContainment: 'window'
									},
									{
										name: 'Sorting',
										type: 'local'
									},
									{
										name: 'Resizing'
									},
									{
										name: 'ColumnMoving',
										columnMovingDialogContainment: 'window'
									},
									{
										name: 'Hiding'
									},
									{
										name: 'MultiColumnHeaders'
									},
									{
										name: 'GroupBy',
										columnSettings: [
											{
												columnKey: 'ano',
												isGroupBy: true,
												groupComparerFunction: groupByFirstLetter
											}
										]
									}
								]
							});
						});
						function groupByFirstLetter(columnSetting, val1, val2) {
							if (val1 !== null && val2 !== null && val1.substring(0, 1000) === val2.substring(0, 1000)) {
								columnSetting.customGroupName = val1.substring(0, 1000);
								return true;
							} else if (val1 !== null && val2 !== null && val1.substring(0, 1000) !== val2.substring(0, 1000)) {
								columnSetting.customGroupName = val1.substring(0, 1000);
								return false;
							} else if (val1 === null && val2 !== null) {
								columnSetting.customGroupName = val2.substring(0, 1000);
								return false;
							} else if (val1 !== null && val2 === null) {
								columnSetting.customGroupName = val1.substring(0, 1000);
								return false;
							}
							return false;
						}
						</script>
		";	
			
		}
		function captacoes_carteira($data_inicio_de,$data_inicio_ate){
			include "config.php";
			
			if ($data_inicio_de!='01/01/1900'){$data_inicio=data($data_inicio_de);}else{$data_inicio=adddate(date("Y-m-d"),"-1 year");}
			if ($data_inicio_ate!='31/12/9999'){$data_fim=data($data_inicio_ate);}else{$data_fim=date("Y-m-d");}
			
			
			$select_carteira="	SELECT
						max(captacao_cartas_baixas.cod_carteira) as cod_carteira,
						cad_carteiras.nome_carteira
						
					from
						".$schema.".captacao_cartas_baixas,
						".$schema.".cad_carteiras
						
					where
						cad_carteiras.cod_empresa=".$_SESSION['cod_empresa']." and
						(captacao_cartas_baixas.data_baixa between '".$data_inicio."' and '".$data_fim."') and
						captacao_cartas_baixas.cod_carteira=cad_carteiras.cod_carteira
						
					group by
						nome_carteira
						
					order by
						nome_carteira;
				";
				$cod_carteira='';
				$serie='';
				$filtro='';
				$campos='';
				$n=0;
			$resultado_carteira=mysql_query($select_carteira,$conexao) or die (mysql_error());
			while($row_carteira = mysql_fetch_array($resultado_carteira))
			{
				$filtro.="

				left join(select cod_carteira, sum(valor_baixa) as valor_baixa, year(data_baixa) as ano, month(data_baixa) as mes
				from
				".$schema.".captacao_cartas_baixas

				where
				(data_baixa between '".$data_inicio."' and '".$data_fim."') and
				cod_carteira=".$row_carteira['cod_carteira']."
				group by cod_carteira,ano,mes

				order by cod_carteira,ano,mes) as conta_".$row_carteira['cod_carteira']." on conta_".$row_carteira['cod_carteira'].".ano=cad_datas.ano and conta_".$row_carteira['cod_carteira'].".mes=cad_datas.mes ";
				
				
				$campos.=", IFNULL(conta_".$row_carteira['cod_carteira'].".valor_baixa,0) as `".$row_carteira['cod_carteira']."-".$row_carteira['nome_carteira']."` ";
				$n=$n+1;
			}
			

			$baixas="
			
			
				select cad_datas.ano, cad_datas.mes ".$campos."
				from cad_datas

				".$filtro."			
				

				where data between '".$data_inicio."' and '".$data_fim."'
				group by ano,mes
				order by ano,mes
			


					";

			$serie_baixa='';
			$ano_mes='';
			$data='';
			$colunas='
				{ headerText: "ano", key: "ano", dataType: "int", width: "10%" },
				{ headerText: "mes", key: "mes", dataType: "int", width: "10%" },';

				for($i=2;$i<=$n+1;$i++){
				$serie_baixa[$i]="";
				}
			$resultado_baixas=mysql_query($baixas,$conexao) or die (mysql_error());
			while($row_baixas = mysql_fetch_array($resultado_baixas))
			{
				$data.='{"ano":"'.$row_baixas['ano'].'","mes":"'.$row_baixas['mes'].'",';
				for($i=2;$i<=$n+1;$i++){
					$serie_baixa[$i].=$row_baixas[$i].",";
					$data.='"'.str_replace("(","",str_replace(")","",str_replace("-","",str_replace(".","",str_replace(" ","_",mysql_field_name($resultado_baixas,$i)))))).'":"'.$row_baixas[$i].'",';
				
				}
				$data.="},
				";
				$ano_mes.='"'.$row_baixas['ano'].'-'.$row_baixas['mes'].'",';
				
			}
			
			
			for($i=2;$i<=$n+1;$i++){
				$colunas.='
				{ headerText: "'.mysql_field_name($resultado_baixas,$i).'", key: "'.str_replace("(","",str_replace(")","",str_replace("-","",str_replace(".","",str_replace(" ","_",mysql_field_name($resultado_baixas,$i)))))).'", format: "currency", width: "20%" },';
			}
			
			
			$n=2;
			
			

			$resultado_carteira=mysql_query($select_carteira,$conexao) or die (mysql_error());
			while($row_carteira = mysql_fetch_array($resultado_carteira))
			{
				$serie.="
						{
						name: '".$row_carteira['nome_carteira']."',
						data: [".$serie_baixa[$n]."]
						},";
				$n=$n+1;
			}
			echo '
				<div class="tm-grid-truncate uk-text-center">	
					<div class="tm-top-a uk-grid tm-grid-block uk-panel-box" style="padding: 10px;">
						<div class="uk-width-1-1">
							<div id="grafico" style="width: 100%;height: 800px; margin: 0 auto"></div>
						</div>
						<div class="uk-width-1-1" style="">		
							<div id="grid"></div>
						</div>
					</div>
				</div>	
				<script type="text/javascript">
				$(function () {
						$("#grafico").highcharts({
							title: {
								text: "Recebimentos por carteira",
								x: -20 //center
							},
							subtitle: {
								text: "total de recebimentos mensais",
								x: -20
							},
							xAxis: {
								categories: ['.$ano_mes.']
							},
							yAxis: {
								title: {
									text: "Reais (R$)"
								},
								plotLines: [{
									value: 0,
									width: 1,
									color: "#808080"
								}]
							},
							plotOptions: {
								line: {
									dataLabels: {
										enabled: false
									},
									enableMouseTracking: true
								}
							},							
							tooltip: {
								valueSuffix: "R$",
								shared: true,
								crosshairs: true
							},
							series: ['. $serie .']
						});
					});
					
					$(function () {
						$("#grid").igGrid({
							height: "100%",
							autoGenerateColumns: false,
							width: "100%",
							columns: ['. $colunas .'],
							dataSource: ['. $data .'],
							features: [
								{
									name: "Filtering",
									type: "local",
									mode: "advanced",
									filterDialogContainment: "window"
								},
								{
									name: "Resizing"
								},
								{
									name: "ColumnMoving",
									columnMovingDialogContainment: "window"
								}
							]
						});
					});
					
					function groupByFirstLetter(columnSetting, val1, val2) {
						if (val1 !== null && val2 !== null && val1.substring(0, 1000) === val2.substring(0, 1000)) {
							columnSetting.customGroupName = val1.substring(0, 1000);
							return true;
						} else if (val1 !== null && val2 !== null && val1.substring(0, 1000) !== val2.substring(0, 1000)) {
							columnSetting.customGroupName = val1.substring(0, 1000);
							return false;
						} else if (val1 === null && val2 !== null) {
							columnSetting.customGroupName = val2.substring(0, 1000);
							return false;
						} else if (val1 !== null && val2 === null) {
							columnSetting.customGroupName = val1.substring(0, 1000);
							return false;
						}
						return false;
					}
				</script>
				
			
			';
			
			
			
			
			
			
			
			
			
			
			
		}
	
	
	
	
	
	
	
	
	
	}
	

	














?>