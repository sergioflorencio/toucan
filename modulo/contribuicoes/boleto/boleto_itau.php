<?php
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
								// | BoletoPhp - Versão Beta                                              |
								// +----------------------------------------------------------------------+
								// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
								// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
								// | Você deve ter recebido uma cópia da GNU Public License junto com     |
								// | esse pacote; se não, escreva para:                                   |
								// |                                                                      |
								// | Free Software Foundation, Inc.                                       |
								// | 59 Temple Place - Suite 330                                          |
								// | Boston, MA 02111-1307, USA.                                          |
								// +----------------------------------------------------------------------+

								// +----------------------------------------------------------------------+
								// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
								// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
								// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				        |
								// | 														                                   			  |
								// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
								// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
								// +----------------------------------------------------------------------+

								// +----------------------------------------------------------------------+
								// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
								// | Desenvolvimento Boleto Itaú: Glauber Portella                        |
								// +----------------------------------------------------------------------+


								// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
								// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

								// DADOS DO BOLETO PARA O SEU CLIENTE
								date_default_timezone_set('America/Sao_Paulo');
								$taxa_boleto = 0;
								$valor_cobrado = $row['saldocaptacao']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
								$valor_cobrado = str_replace(",", ".",$valor_cobrado);
								$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

								$dadosboleto["nosso_numero"] = $row['cod_captacao_cartas'];  // Nosso numero - REGRA: Máximo de 8 caracteres!
								$dadosboleto["numero_documento"] = $row['cod_carta'];	// Num do pedido ou nosso numero
								$dadosboleto["data_vencimento"] = $row['data_vencimento']; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
								$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
								$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
								$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

								// DADOS DO SEU CLIENTE
								$dadosboleto["sacado"] = $row['nome_razao_social'];
								$dadosboleto["endereco1"] = $row['endereco'].", ".$row['numero'].", ".$row['complemento'];
								$dadosboleto["endereco2"] = $row['cidade']." - ".$row['uf']." -  CEP: ".$row['cep'];

								// INFORMACOES PARA O CLIENTE
								$dadosboleto["demonstrativo1"] = "Boleto de doaÃ§Ã£o";
								$dadosboleto["demonstrativo2"] = "Mensalidade referente a contribuiÃ§Ã£o mensal para ".$_SESSION['razao_social'];
								$dadosboleto["demonstrativo3"] = $_SESSION['email']." - ".$_SESSION['telefone'];
								$dadosboleto["instrucoes1"] = "- Sr. Caixa, apÃ³s o vencimento receber sem acrÃ©scimo de juros";
								$dadosboleto["instrucoes2"] = "- Receber atÃ© 10 dias apÃ³s o vencimento";
								$dadosboleto["instrucoes3"] = "";
								$dadosboleto["instrucoes4"] = "";

								// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
								$dadosboleto["quantidade"] = "";
								$dadosboleto["valor_unitario"] = "";
								$dadosboleto["aceite"] = "";		
								$dadosboleto["especie"] = "R$";
								$dadosboleto["especie_doc"] = "";


								// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


								// DADOS DA SUA CONTA - ITAÚ
								$dadosboleto["agencia"] = $row['agencia']; // Num da agencia, sem digito
								$dadosboleto["conta"] = SubStr($row['conta'],0,strlen($row['conta'])-1);	// Num da conta, sem digito
								$dadosboleto["conta_dv"] = SubStr($row['conta'],strlen($row['conta'])-1,1); 	// Digito do Num da conta

								// DADOS PERSONALIZADOS - ITAÚ
								$dadosboleto["carteira"] = "175";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

								// SEUS DADOS
								$dadosboleto["identificacao"] = $_SESSION['razao_social'];
								$dadosboleto["cpf_cnpj"] = $_SESSION['cnpj'];
								$dadosboleto["endereco"] = $_SESSION['endereco'].", ".$_SESSION['numero'].", ".$_SESSION['complemento'];
								$dadosboleto["cidade_uf"] = $_SESSION['cidade']." - ".$_SESSION['uf'];
								$dadosboleto["cedente"] = $_SESSION['razao_social'];

								// NÃO ALTERAR!
								include("include/funcoes_itau.php"); 
								include("include/layout_itau.php");
						}

?>
