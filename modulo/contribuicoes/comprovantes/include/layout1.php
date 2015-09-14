

<div>
	<head>
		<title>Comprovante</title>
		<link rel="stylesheet" href="comprovantes/style.css">
	</head>

<div class='layout1' text=#000000 bgColor=#ffffff topMargin=0 rightMargin=0>
<table width=666 cellspacing=5 cellpadding=0 border=0 align=Default>
  <tr>
    <td width=41><IMG SRC="<?php  echo "../../".$_SESSION['logo'] ?>"></td>
    <td class=ti width=455><?php echo $dadosboleto["identificacao"]; ?> <?php echo isset($dadosboleto["cpf_cnpj"]) ? "<br>".$dadosboleto["cpf_cnpj"] : '' ?><br>
	<?php echo $dadosboleto["endereco"]; ?><br>
	<?php echo $dadosboleto["cidade_uf"]; ?><br>
    </td>
    <td align=RIGHT width=150 class=ti>&nbsp;</td>
  </tr>
</table>

<h1>Comprovante de doação</h1>
<p>Declaramos para os devidos fins que recebemos a seguinte doação:</p>
<h2>Dados do doador</h2>
<table style="font-size: 12px;width: 100%;">
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>Nome do Doador:</td><td><?php echo $dadosboleto['doador']; ?></td></tr>
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>CPF ou CNPJ:</td><td><?php echo $dadosboleto['cpfcnpj']; ?></td></tr>
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>Endereço:</td><td><?php echo $dadosboleto['endereco1']; ?></td></tr>
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>Cidade - UF:</td><td><?php echo $dadosboleto['cidade'].' - '.$dadosboleto['uf']; ?></td></tr>
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>CEP:</td><td><?php echo $dadosboleto['cep']; ?></td></tr>
</table>	
	
	

<h2>Dados da doação</h2>
<table style="font-size: 12px;width: 100%;">
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>Data da doação:</td><td><?php echo strftime("%e/%b/%Y",strtotime($dadosboleto["data_baixa"]));; ?></td></tr>
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>Valor da doação:</td><td><?php echo $row['somabaixas']; ?></td></tr>
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>Meio de pagamento:</td><td><?php echo $dadosboleto["forma_pagamento"]; ?></td></tr>
	<tr><td style='font-size: 12px;width: 30%;text-align: right;'>Conta de recebimento:</td><td><?php echo $dadosboleto["nome_carteira"]; ?></td></tr>
	
</table>	
	

<h2>Controle</h2>
	<div class='linha'><label>Código de controle:</label><span class="valor"><?php echo $dadosboleto["controle"]; ?></span></div>

</div>