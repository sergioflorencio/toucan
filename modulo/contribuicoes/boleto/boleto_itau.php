﻿<?php
	session_start();
	$cod_captacao=$_GET['id'];
	$convenio=$_GET['convenio'];
	include "../php/config.php";

					$select= "SELECT
								captacao_cartas.cod_captacao_cartas,
								captacao_cartas.cod_carta,
								IF(captacao_cartas.data_vencimento<NOW(),DATE_FORMAT(DATE_ADD(NOW(),INTERVAL 5 DAY),'%d/%m/%Y'),DATE_FORMAT(captacao_cartas.data_vencimento,'%d/%m/%Y')) as data_vencimento,
								cad_cartas.*,
								cad_pessoas.nome_razao_social,
								cad_pessoas.endereco,
								cad_pessoas.numero,
								cad_pessoas.complemento,
								cad_pessoas.cidade,
								cad_pessoas.uf,
								cad_pessoas.cep,
								cad_convenios.agencia,
								cad_convenios.conta,
								IFNULL(sum(captacao_cartas_baixas.valor_baixa),0) as somabaixas,
								(captacao_cartas.valor-IFNULL(sum(captacao_cartas_baixas.valor_baixa),0)) as saldocaptacao
								
							FROM 
								".$schema.".cad_convenios,
								".$schema.".captacao_cartas
								

							LEFT JOIN ".$schema.".cad_cartas ON
								".$schema.".cad_cartas.cod_carta=".$schema.".captacao_cartas.cod_carta

							LEFT JOIN ".$schema.".captacao_cartas_baixas ON 
								".$schema.".captacao_cartas_baixas.cod_captacao_cartas=".$schema.".captacao_cartas.cod_captacao_cartas

							LEFT JOIN ".$schema.".cad_pessoas ON
								".$schema.".cad_pessoas.cod_pessoa=".$schema.".cad_cartas.cod_contribuinte
							
							WHERE 
								captacao_cartas.cod_empresa=".$_SESSION['cod_empresa']." and
								captacao_cartas.cod_captacao_cartas = '".$cod_captacao."' and
								cad_convenios.codigo_convenio='".$convenio."'

							GROUP BY 	
								".$schema.".captacao_cartas.cod_captacao_cartas";

					$resultado=mysql_query($select,$conexao) or die (mysql_error());
						while($row = mysql_fetch_array($resultado))
						{
								// +----------------------------------------------------------------------+
								// | BoletoPhp - Vers�o Beta                                              |
								// +----------------------------------------------------------------------+
								// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
								// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
								// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
								// | esse pacote; se n�o, escreva para:                                   |
								// |                                                                      |
								// | Free Software Foundation, Inc.                                       |
								// | 59 Temple Place - Suite 330                                          |
								// | Boston, MA 02111-1307, USA.                                          |
								// +----------------------------------------------------------------------+

								// +----------------------------------------------------------------------+
								// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
								// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
								// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa				        |
								// | 														                                   			  |
								// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
								// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
								// +----------------------------------------------------------------------+

								// +----------------------------------------------------------------------+
								// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
								// | Desenvolvimento Boleto Ita�: Glauber Portella                        |
								// +----------------------------------------------------------------------+


								// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
								// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

								// DADOS DO BOLETO PARA O SEU CLIENTE
								date_default_timezone_set('America/Sao_Paulo');
								$taxa_boleto = 0;
								$valor_cobrado = $row['saldocaptacao']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
								$valor_cobrado = str_replace(",", ".",$valor_cobrado);
								$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

								$dadosboleto["nosso_numero"] = $row['cod_captacao_cartas'];  // Nosso numero - REGRA: M�ximo de 8 caracteres!
								$dadosboleto["numero_documento"] = $row['cod_carta'];	// Num do pedido ou nosso numero
								$dadosboleto["data_vencimento"] = $row['data_vencimento']; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
								$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
								$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
								$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

								// DADOS DO SEU CLIENTE
								$dadosboleto["sacado"] = $row['nome_razao_social'];
								$dadosboleto["endereco1"] = $row['endereco'].", ".$row['numero'].", ".$row['complemento'];
								$dadosboleto["endereco2"] = $row['cidade']." - ".$row['uf']." -  CEP: ".$row['cep'];

								// INFORMACOES PARA O CLIENTE
								$dadosboleto["demonstrativo1"] = "Boleto de doação";
								$dadosboleto["demonstrativo2"] = "Mensalidade referente a contribuição mensal para ".$_SESSION['razao_social'];
								$dadosboleto["demonstrativo3"] = $_SESSION['email']." - ".$_SESSION['telefone'];
								$dadosboleto["instrucoes1"] = "- Sr. Caixa, após o vencimento receber sem acréscimo de juros";
								$dadosboleto["instrucoes2"] = "- Receber até 10 dias após o vencimento";
								$dadosboleto["instrucoes3"] = "";
								$dadosboleto["instrucoes4"] = "";

								// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
								$dadosboleto["quantidade"] = "";
								$dadosboleto["valor_unitario"] = "";
								$dadosboleto["aceite"] = "";		
								$dadosboleto["especie"] = "R$";
								$dadosboleto["especie_doc"] = "";


								// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


								// DADOS DA SUA CONTA - ITA�
								$dadosboleto["agencia"] = $row['agencia']; // Num da agencia, sem digito
								$dadosboleto["conta"] = SubStr($row['conta'],0,strlen($row['conta'])-1);	// Num da conta, sem digito
								$dadosboleto["conta_dv"] = SubStr($row['conta'],strlen($row['conta'])-1,1); 	// Digito do Num da conta

								// DADOS PERSONALIZADOS - ITA�
								$dadosboleto["carteira"] = "175";  // C�digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

								// SEUS DADOS
								$dadosboleto["identificacao"] = $_SESSION['razao_social'];
								$dadosboleto["cpf_cnpj"] = $_SESSION['cnpj'];
								$dadosboleto["endereco"] = $_SESSION['endereco'].", ".$_SESSION['numero'].", ".$_SESSION['complemento'];
								$dadosboleto["cidade_uf"] = $_SESSION['cidade']." - ".$_SESSION['uf'];
								$dadosboleto["cedente"] = $_SESSION['razao_social'];

								// N�O ALTERAR!
								include("include/funcoes_itau.php"); 
								include("include/layout_itau.php");
						}

?>
