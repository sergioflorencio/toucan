<?php



if(isset($_POST['cod_carta'])){
	$cod_carta=$_POST['cod_carta'];
}
if(isset($_GET['cod_carta'])){
	$cod_carta=$_GET['cod_carta'];
}
														

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
				".$schema.".cad_cartas.cod_carta = '".$cod_carta."'";

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
								captacao_cartas.cod_captacao_cartas=captacao_cartas_baixas.cod_captacao_cartas and
								captacao_cartas_baixas.cod_carteira=cad_carteiras.cod_carteira and
								captacao_cartas.cod_carta='".$cod_carta."'

							order by 
								baixa desc

							limit 0,12;";
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























?>




<table border="0" width="700" cellpadding="0" cellspacing="0">
        <tbody><tr>
            <td style="padding:20px 0 20px 0" align="center" valign="top">
                <table style="width:100%" style="font-size: 12px;" bgcolor="#FFFFFF" border="0"  cellpadding="10" cellspacing="0">
                    
                    <tbody><tr>
                        <td valign="top"><a href="http://osuc.org.br/" target="_blank"><img src="http://osuc.org.br/wp-content/uploads/2012/02/osuc.png" alt="OSUC" style="margin-bottom:10px" border="0"></a></td>
                    </tr>
                    
                    <tr>
                        <td valign="top">
                            <h2><?php echo $contribuinte; ?>,</h2>
                            <p>
								A OSUC - Obras Sociais Universitárias e Culturais agradece a sua doação.<br>
								Você pode conhecer mais sobre a OSUC pelo nosso 
								<a href="http://osuc.org.br/" style="color:#1e7ec8" target="_blank">osuc.org.br</a> 
								ou entrando em contato pelo nosso email 
								<a href="captacao@osuc.org.br" style="color:#1e7ec8" target="_blank">captacao@osuc.org.br</a>
								 ou telefone (011) 3107-7887.
                            </p>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>O código da sua carta é  <small><?php echo $cod_carta; ?></small></h3>
                        </td>
                    </tr>
					
					
					
                    <tr>
                        <td>
                            <table border="0" width="650" cellpadding="0" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em;background: #ccc;" align="left"  width="325">Status da Carta:</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc" valign="top">
<?php
echo 
$cod_status." - ".
$descricao_status;

?>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
					
					
					
                    <tr>
                        <td>
                            <table border="0" width="650" cellpadding="0" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em;background: #ccc;" align="left"  width="325">Informações do Doador:</th>
                                    <th width="10"></th>
                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em;background: #ccc;" align="left"  width="325">Informações da Cobrança:</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc" valign="top">
 
<?php
									echo 
										$contribuinte."<br>".
										$contribuinte_endereco."<br>".
										$contribuinte_CEP.", ".
										$contribuinte_cidade."-".
										$contribuinte_UF."<br>".
										$contribuinte_telefone."<br>".
										$contribuinte_email;


?>

                                    </td>
                                    <td>&nbsp;</td>
                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc" valign="top">
<table  style='font-size:11px;padding:3px 9px;'>
<?php
echo 
		"<tr><td>Valor:</td><td>".$moeda." ".$total."</td></tr>".
		"<tr><td>Corrigir pelo IGPM?:</td><td>".$IGPM."</td></tr>".

		"<tr><td>Inicio:</td><td>".$inicio."</td></tr>".
		"<tr><td>Fim:</td><td>".$fim."</td></tr>".
		"<tr><td>Dia para débito:</td><td>".$dia."</td></tr>".

		"<tr><td>Forma de pagamento:</td><td>".$forma_pmto."</td></tr>".

		"<tr><td>Banco:</td><td>".$banco."</td></tr>".
		"<tr><td>Agência:</td><td>".$agencia."</td></tr>".
		"<tr><td>Conta:</td><td>".$conta."</td></tr>";



?>
</table>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            
                            <table border="0" width="650" cellpadding="0" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="font-size:13px;padding:5px 9px 6px 9px;line-height:1em;background: #ccc;" align="left"  width="325">Informações do Colaborador:</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="font-size:12px;padding:7px 9px 9px 9px;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc" valign="top">
<?php
echo 
		$colaborador."<br>".
		$colaborador_email."<br>".
		$colaborador_telefone."<br>";

?>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                            <br>
                            
                            <table style="border:1px solid #cccccc;font-size: 12px;" border="0" width="650" cellpadding="0" cellspacing="0">
								<thead style="font-size: 10px;">
									<tr>
										<th style="padding:3px 9px;font-size: 12px;background: #ccc;" colspan="5" align="left" >Últimas captações recebidas:</th>
									</tr>
									<tr style="background: #ccc;">
										<th style="padding:3px 9px" align="left" >Captação</th>
										<th style="padding:3px 9px" align="left" >Banco</th>
										<th style="padding:3px 9px" align="center" >Data Vcto</th>
										<th style="padding:3px 9px" align="center" >Data Receb</th>
										<th style="padding:3px 9px" align="center" >Valor Recebido</th>
									</tr>
								</thead>

								<tbody style="font-size: 10px;">
							<?php 
								echo $captacoes;
							?>

									
									
									
								</tbody>


    

</table>

                            <p style="font-size:12px;margin:0 0 10px 0"></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#cccccc;text-align:center" align="center" ><center><p style="font-size:12px;margin:0">Obrigado, <strong>OSUC</strong>.</p></center></td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>