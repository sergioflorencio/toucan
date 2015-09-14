

<div>

	<head>
		<title>Comprovante</title>
		<link rel="stylesheet" href="comprovantes/style.css">
	</head>

<div class='layout2' text=#000000 bgColor=#ffffff topMargin=0 rightMargin=0>
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

<h1>Recibo</h1>
	<p>Recebemos de <?php echo $dadosboleto["doador"]; ?> a importância de R$ <?php echo $dadosboleto["valor_boleto"]; ?> a titulo de doação referente ao mês de <?php 
	
					date_default_timezone_set('America/Sao_Paulo');
										setlocale(LC_ALL, 'pt_BR');
										setlocale(LC_TIME, "pt_BR.UTF-8");
					echo strftime("%B de %Y",strtotime($dadosboleto["data_vencimento"]));
					
					?>.</p>

	<div class='linha'><label>Endereço:</label><span class="valor"><?php echo $dadosboleto["endereco1"]; ?></span></div>
	<div class='linha'><label>Cidade:</label><span class="valor"><?php echo $dadosboleto["cidade"]; ?></span></div>
	<div class='linha'><label>UF:</label><span class="valor"><?php echo $dadosboleto["uf"]; ?></span></div>
	<div class='linha'><label>CEP:</label><span class="valor"><?php echo $dadosboleto["cep"]; ?></span></div>
<br><br><br><br>
	<p>São Paulo, <?php 
					date_default_timezone_set('America/Sao_Paulo');
					setlocale(LC_ALL, 'pt_BR');
					setlocale(LC_TIME, "pt_BR.UTF-8");
					echo strftime("%e de %B de %Y");
					?></p>



	<div class='linha'><label>Código de controle:</label><span class="valor"><?php echo $dadosboleto["controle"]; ?></span></div>


</div>