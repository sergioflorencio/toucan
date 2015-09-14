<?php
session_start();
	$cod_captacao=$_GET['id'];
	include "../php/config.php";
					$conexao=mysql_connect($servidor,$usuario,$senha)  or die('sem conexao');
					$select= "
			SELECT
				captacao_cartas.cod_captacao_cartas as cod_captacao,
				captacao_cartas.cod_carta,
				DATE_FORMAT(captacao_cartas.data_vencimento,'%d/%m/%Y') as data_vencimento,
				cad_cartas.*,
				captacao_cartas.*,
				baixas.cod_captacao_cartas_baixas,
				cad_carteiras.nome_carteira,
				baixas.cod_carteira,
				baixas.data_baixa as data_baixa,
				baixas.somabaixas,
				cad_pessoas.cod_pessoa,
				cad_pessoas.nome_razao_social,
				cad_pessoas.endereco,
				cad_pessoas.numero,
				cad_pessoas.complemento,
				cad_pessoas.cidade,
				cad_pessoas.uf,
				cad_pessoas.cep,
				cad_pessoas.cpf,
				cad_pessoas.cnpj,
				cad_pessoas.pessoa_juridica_fisica,
				cad_convenios.*,
				cad_bancos.nome_banco
	
				
			FROM 
				".$schema.".captacao_cartas
				
				

			LEFT JOIN 	(
						select 
							cod_captacao_cartas as cod_captacao,
							cod_carteira as cod_carteira,
							max(captacao_cartas_baixas.cod_captacao_cartas_baixas) as cod_captacao_cartas_baixas,
							captacao_cartas_baixas.data_baixa as data_baixa,
							IFNULL(sum(captacao_cartas_baixas.valor_baixa),0) as somabaixas
							

						from 
							".$schema.".captacao_cartas_baixas

						where captacao_cartas_baixas.cod_captacao_cartas='".$cod_captacao."'

						GROUP BY 	
							cod_captacao_cartas
					) as baixas ON baixas.cod_captacao=cod_captacao

			LEFT JOIN ".$schema.".cad_cartas ON cad_cartas.cod_carta=captacao_cartas.cod_carta
				
			LEFT JOIN ".$schema.".cad_pessoas ON cad_pessoas.cod_pessoa=cad_cartas.cod_contribuinte
			
			LEFT JOIN ".$schema.".cad_carteiras ON cad_carteiras.cod_carteira=baixas.cod_carteira
			
			LEFT JOIN ".$schema.".cad_convenios ON cad_convenios.cod_do_banco=cad_cartas.debito_banco and cad_convenios.tipo_convenio=cad_cartas.carta_forma_pagamento
			
			LEFT JOIN ".$schema.".cad_bancos ON cad_bancos.cod_banco=cad_convenios.cod_do_banco 
			
			
			
			WHERE 
				".$schema.".captacao_cartas.cod_captacao_cartas = '".$cod_captacao."'";

					$resultado=mysql_query($select,$conexao) or die (mysql_error());
						while($row = mysql_fetch_array($resultado))
						{
								//DADOS DA CONTRIBUIÇÃO
								date_default_timezone_set('America/Sao_Paulo');
								$dadosboleto["nosso_numero"] = $row['cod_captacao_cartas'];  // Nosso numero - REGRA: Máximo de 8 caracteres!
								$dadosboleto["numero_documento"] = $row['cod_carta'];	// Num do pedido ou nosso numero
								$dadosboleto["data_vencimento"] = $row['data_vencimento'];
								$dadosboleto["data_baixa"] = $row['data_baixa'];
								$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
								$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
								$dadosboleto["valor_boleto"] = $row['carta_valor_moeda']; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
								$dadosboleto["forma_pagamento"] = $row['carta_forma_pagamento'];
								$dadosboleto["controle"] = str_repeat("0",6-strlen($row['cod_pessoa'])).$row['cod_pessoa'];
								$dadosboleto["controle"] = $dadosboleto["controle"].".".str_repeat("0",6-strlen($row['cod_carta'])).$row['cod_carta'];
								$dadosboleto["controle"] = $dadosboleto["controle"].".".str_repeat("0",9-strlen($row['cod_captacao_cartas'])).$row['cod_captacao_cartas'];
								$dadosboleto["controle"] = $dadosboleto["controle"].".".str_repeat("0",9-strlen($row['cod_captacao_cartas_baixas'])).$row['cod_captacao_cartas_baixas'];
								$dadosboleto["nome_carteira"] = $row['nome_carteira'];
								$dadosboleto["banco"] = $row['nome_banco'];
								$dadosboleto["agencia"] = str_repeat("0",4-strlen($row['agencia'])).$row['agencia'];
								$dadosboleto["conta"] = str_repeat("0",10-strlen($row['conta'])).$row['conta'];
								
								// DADOS DO SEU CLIENTE
								$dadosboleto["doador"] = $row['nome_razao_social'];
								$dadosboleto["endereco1"] = $row['endereco'].", ".$row['numero'].", ".$row['complemento'];
								$dadosboleto["cidade"] = $row['cidade'];
								$dadosboleto["uf"] = $row['uf'];
								$dadosboleto["pessoa_juridica_fisica"] = $row['pessoa_juridica_fisica'];
								$dadosboleto["cep"] = $row['cep'];
								if ($row['pessoa_juridica_fisica']=='PJ')
									{$dadosboleto["cpfcnpj"] = $row['cnpj'];}
								if ($row['pessoa_juridica_fisica']=='PF')
									{$dadosboleto["cpfcnpj"] = $row['cpf'];}
								if ($row['pessoa_juridica_fisica']==null)
									{$dadosboleto["cpfcnpj"] = '00.000.000/0000-00';}
								



								// SEUS DADOS
								$dadosboleto["identificacao"] = $_SESSION['razao_social'];
								$dadosboleto["cpf_cnpj"] = $_SESSION['cnpj'];
								$dadosboleto["endereco"] = $_SESSION['endereco'].", ".$_SESSION['numero'].", ".$_SESSION['complemento'];
								$dadosboleto["cidade_uf"] = $_SESSION['cidade']." - ".$_SESSION['uf'];
								$dadosboleto["cedente"] = $_SESSION['razao_social'];
								
							include "include/layout".$_GET['layout'].".php";
						}

?>
