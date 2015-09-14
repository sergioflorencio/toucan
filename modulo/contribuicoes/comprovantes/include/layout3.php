
	<head>
		<title>Comprovante</title>
		<link rel="stylesheet" href="comprovantes/style.css">
	</head>

<div class='layout1' text=#000000 bgColor=#ffffff topMargin=0 rightMargin=0 style="height: 800px;border: 0px;">
<table width=666 cellspacing=5 cellpadding=0 border=0 align=Default>
  <tr>
    <td width=41><IMG SRC="<?php  echo "../../".$_SESSION['logo'] ?>"></td>
    <td class=ti width=455><?php echo $dadosboleto["identificacao"]; ?>
	<?php echo isset($dadosboleto["cpf_cnpj"]) ? "<br>".$dadosboleto["cpf_cnpj"] : '' ?><br>
	<?php echo $dadosboleto["endereco"]; ?><br>
	<?php echo $dadosboleto["cidade_uf"]; ?><br>
    </td>
    <td align=RIGHT width=150 class=ti>&nbsp;</td>
  </tr>
</table>


	<p style="text-align: right;line-height: 250%;font-size: 18px;">São Paulo, <?php 
					date_default_timezone_set('America/Sao_Paulo');
					setlocale(LC_ALL, 'pt_BR');
					setlocale(LC_TIME, "pt_BR.UTF-8");
					echo strftime("%e de %B de %Y");
					?></p>
<h1>Recibo</h1>
<?php
if($dadosboleto["forma_pagamento"]=='boleto'){$forma_pmto='boleto bancário';}
if($dadosboleto["forma_pagamento"]=='debito'){$forma_pmto='débito bancário';}
if($dadosboleto["forma_pagamento"]=='cheque'){$forma_pmto='cheque';}
if($dadosboleto["forma_pagamento"]=='recibo'){$forma_pmto='dinheiro em espécie';}
if($dadosboleto["forma_pagamento"]=='credito'){$forma_pmto='cartão de crédito';}
if($dadosboleto["forma_pagamento"]=='deposito'){$forma_pmto='depósito bancario';}
if($dadosboleto["forma_pagamento"]=='dinheiro'){$forma_pmto='dinheiro em espécie';}
if($dadosboleto["forma_pagamento"]=='transferencia'){$forma_pmto='transferência bancária';}

?>

<p style="line-height: 250%;font-size: 18px;text-align: justify;">
Declaramos para os devidos fins que recebemos de 
 <?php echo $dadosboleto['doador']; ?> 

<?php 
	if($dadosboleto['pessoa_juridica_fisica']=='PF' and $dadosboleto['cpfcnpj']!=""){echo "inscrito/a no Cadastro de Pessoa Física sob o nº ".$dadosboleto['cpfcnpj'];}
	if($dadosboleto['pessoa_juridica_fisica']=='PJ' and $dadosboleto['cpfcnpj']!=""){echo "inscrito/a no Cadastro de Pessoa Jurídica sob o nº ".$dadosboleto['cpfcnpj'];}?>

o valor de R$
<?php echo $row['somabaixas']; ?>
, referente a doação efetuada no dia <?php 
					echo strftime("%e de %B de %Y",strtotime($dadosboleto["data_baixa"]));
					?> por meio de 
<?php 
echo $forma_pmto.", ";
if($dadosboleto["forma_pagamento"]=='debito'){
	echo ", " .$dadosboleto["banco"]. ", agência " .$dadosboleto["agencia"] .", conta corrente " .$dadosboleto["conta"];
}else{ echo $dadosboleto["nome_carteira"];}
 ?>
, a 
<?php echo $dadosboleto["identificacao"]; ?>
<?php echo isset($dadosboleto["cpf_cnpj"]) ? ", inscrita no CNPJ nº ".$dadosboleto["cpf_cnpj"] : '' ?>
.
</p>
<p style="line-height: 250%;font-size: 18px;">
Atenciosamente,
</p>
</div>


