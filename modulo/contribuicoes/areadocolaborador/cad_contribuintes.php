<?php
	
						$select_contribuintes= 
							"select
								cod_carta,
								cod_contribuinte,
								cad_pessoas.nome_razao_social,
								cad_status.descricao as status,
								cad_status.status_resumido as status_resumido
								
							from
								".$schema.".cad_cartas,
								".$schema.".cad_pessoas,
								".$schema.".cad_status
							where
								cad_pessoas.cod_pessoa=cad_cartas.cod_contribuinte and
								cad_status.cod_status=cad_cartas.status_carta and
								cad_cartas.status_carta!=8 and
								cod_colaborador=".$_POST['cod_colaborador']."
							order by
								status,
								nome_razao_social
								
								;";
				
					$resultado_contribuintes=mysql_query($select_contribuintes,$conexao) or die ("<div class='uk-alert uk-alert-danger' data-uk-alert=''><p>".mysql_error()."</p></div>");
					$n=1;
					$cartas='';
						while($row_contribuintes = mysql_fetch_array($resultado_contribuintes))
						{
							
							if ($row_contribuintes['status_resumido']=='carta_ativa') {$span="uk-badge uk-badge-success";}
							if ($row_contribuintes['status_resumido']=='carta_cancelada') {$span="uk-badge uk-badge-danger";}
							if ($row_contribuintes['status_resumido']=='carta_vencida') {$span="uk-badge uk-badge-warning";}
							if ($row_contribuintes['status_resumido']=='carta_inadimplente') {$span="uk-badge uk-badge-warning";}
							if ($row_contribuintes['status_resumido']=='carta_renovada') {$span="uk-badge uk-badge-notification";}

						
							$cartas.=
							"
														<tr>
															<td  style='width: 30px;'><div style='width: 80%;padding:1px;' class='".$span."'>".$row_contribuintes['status']."</div></td>
															<td  style='width: 30px;'>".$n."</td>
															<td  style='width: 60px;'>".$row_contribuintes['cod_carta']."</td>
															<td><a href='#detalhe_carta' data-uk-modal onclick='detalhe_carta(".$row_contribuintes['cod_carta'].");'><i class='uk-icon-info-circle'></i> Detalhe da carta</a></td>
															<td>".$row_contribuintes['nome_razao_social']."</td>
															<td><a href='#dados_contribuinte' data-uk-modal onclick='pesquisar_contribuinte(".$row_contribuintes['cod_contribuinte'].");'><i class='uk-icon-home'></i> Editar Endereço e dados para contato</a></td>

														</tr>
							
							";
							$n=$n+1;

						}

?>