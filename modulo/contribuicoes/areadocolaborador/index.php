<?php
	include "config.php";



if(isset($_POST['cod_colaborador']) and isset($_POST['token'])and $_POST['token']!=''and $_POST['cod_colaborador']!=''){

$select_token="select 
					cod_colaborador,
					cod_pessoa,
					cod_grupo,
					data_inclusao 
				from 
					".$schema.".cad_colaboradores
				where
					cod_colaborador=".$_POST['cod_colaborador'].";";
			
					$resultado_token=mysql_query($select_token,$conexao) or die ("<div class='uk-alert uk-alert-danger' data-uk-alert=''><p>".mysql_error()."</p></div>");
					$n=1;
						while($row_token = mysql_fetch_array($resultado_token))
						{
						$token=md5($row_token['cod_colaborador'].$row_token['cod_pessoa'].$row_token['cod_grupo'].$row_token['data_inclusao']);
						
						}
					

	if(isset($_POST['token']) and $_POST['token']==$token){

		$consulta="INSERT INTO `".$schema."`.`log_colaborador` (`cod_colaborador`, `ip`) VALUES ('".$_POST['cod_colaborador']."', '".$_SERVER['REMOTE_ADDR']."');";
		$insert=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	

		include "cad_colaborador.php";
		include "cad_contribuintes.php";			
						
						
						
						
						
						
						

	
	
	


?>


<html>
    <head>
        <title><?php echo $nome; ?></title>
        <link rel="stylesheet" href="javascript/uikit/css/uikit.almost-flat.css" />
        <link rel="stylesheet" href="javascript/uikit/css/uikit.everest.css" />
        <script src="javascript/uikit/js/jquery.js"></script>
        <script src="javascript/uikit/js/uikit.min.js"></script>
        <script src="javascript/js.js"></script>
		
		<!-- Highcharts -->	
		<script type="text/javascript" src="Highcharts/js/highcharts.js"></script>
		<script type="text/javascript" src="Highcharts/js/modules/exporting.js"></script>
    </head>
    <body>
	
	
<div class="tm-grid-truncate uk-panel uk-panel-box uk-width-2-3 uk-container-center " style="min-width: 800px;margin-top: 20px;margin-bottom: 20px;">
								<?php echo $dados_colaborador;?>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1"  style='margin-top: 40px;'>
									<h3>Cartas do Colaborador</h3>
									<hr class='uk-article-divider' style="margin: 10px;">									
										<div class="uk-overflow-container">
											<table class="uk-table uk-table-condensed uk-table-hover" style="font-size: 11px;">
												<thead>
													<tr>
														<th style="width: 100px;">Status</th>
														<th style="width: 30px;">nº</th>
														<th style="width: 60px;">Carta</th>
														<th>Detalhe</th>
														<th>Contribuinte</th>
														<th>Atualizar dados cadastrais</th>
													</tr>
												</thead>
												<tbody>
													<?php echo $cartas;?>
												</tbody>
											</table>
										</div>
										<script src="data_grafico.php?cod_colaborador=<?php echo $_POST['cod_colaborador'];?>"></script>
										<script>
												$(function () {
													$('#grafico_cartas').highcharts({
														chart: {
															type: 'column'
														},
														title: {
															text: 'Grafico de cartas do colaborador'
														},
														xAxis: {
															categories: categories_grafico
														},
														yAxis: {
															min: 0,
															title: {
																text: 'Valor (R$)'
															}
														},
														tooltip: {
															headerFormat: '<span style="font-size:10px">{point.key}: </span>',
															pointFormat: '<span style="font-size:10px">R${point.y:.1f}</span>',
															footerFormat: '',
															shared: true,
															useHTML: true
														},
														 legend:false,
														plotOptions: {
															column: {
																stacking: 'normal',
																dataLabels: {
																	enabled: true,
																	color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
																}
															}
														},
														series: [{
															data: data_grafico
														}]
													});
												});
										
										</script>
									<div class="uk-width-1-1 " style='margin-top: 40px;'>
										<div class="uk-grid">
											<div class="uk-width-1-2" >
												<h3>Gráfico</h3>
												<hr class='uk-article-divider' style="margin: 10px;">
												<div id="grafico_cartas"></div>
											</div>
											<div id="grafico_cartas" class="uk-width-1-2" >
												<h3>Downloads</h3>
												<hr class='uk-article-divider' style="margin: 10px;">	
													<table class="uk-table">

														<thead>
															<tr>
																<th  style="width: 30px;">Tipo arquivo</th>
																<th>Descrição</th>
																<th  style="width: 50px;">Tamanho</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td style="width: 30px;">pdf</td>
																<td >
																	<a href="downloads/CEAP - Folder Institucional.pdf" download="CEAP - Folder Institucional.pdf">
																	<i class="uk-icon-cloud-download"></i>  Folder Institucional CEAP
																	</a>
																</td>
																<td  style="width: 50px;">1.631kb</td>
															</tr>
															<tr>
																<td style="width: 30px;">pdf</td>
																<td >
																	<a href="downloads/Folheto novo logo CEAP.pdf" download="Folheto novo logo CEAP.pdf">
																	<i class="uk-icon-cloud-download"></i> Folheto com novo logo CEAP
																	</a>
																</td>
																<td  style="width: 50px;">183kb</td>
															</tr>
															<tr>
																<td style="width: 30px;">pdf</td>
																<td >
																	<a href="downloads/OSUC_folheto atual.pdf" download="OSUC_folheto atual.pdf">
																	<i class="uk-icon-cloud-download"></i>  Folheto OSUC
																	</a>
																</td>
																<td  style="width: 50px;">748kb</td>
															</tr>
															<tr>
																<td style="width: 30px;">jpg</td>
																<td >
																	<a href="downloads/OSUC_news1.jpg" download="OSUC_news1.jpg">
																	<i class="uk-icon-cloud-download"></i>  News Letter OSUC 001
																	</a>
																</td>
																<td  style="width: 50px;">733kb</td>
															</tr>
														</tbody>
													</table>
												
											</div>
										</div>
									</div>
										
										
									</div>
						<!--
									<div class="uk-width-1-1 " style='margin-top: 40px;'>

										<div  class="uk-width-1-1" class=''>
											<h3>Pesquisar contribuintes</h3>
											<hr class='uk-article-divider' style="margin: 10px;">	
										</div>
										<div class="uk-width-3-5 uk-form uk-form-stacked" style="padding-top: 20px;">
											<input type="text" class=" form-small" id="pesquisa" placeholder="pesquisar" style="width: 100%;">
										</div>

										<div class="uk-width-2-5 uk-form uk-form-stacked" style="padding-top: 20px;padding-bottom: 20px;">
											<button class="uk-button uk-button-primary" type="button" onclick="pesquisar_carta();"><i class="uk-icon-search"></i> Pesquisar</button>
										</div>
										<div  class="uk-width-1-1" id='resultado_pesquisa' class=''></div>
									
									</div>
							-->
                                </div>

								
								
								


</div>
	
	
	
<div id="detalhe_carta" class="uk-modal">
    <div class="uk-modal-dialog" style="width: 720px;">
		<a href="" class="uk-modal-close uk-close"></a>
		<div id="conteudo_detalhe_carta"></div>
    </div>
</div>
<div id="dados_contribuinte" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
		<div id="conteudo_dados_contribuinte"></div>
        
    </div>
</div>
<div id="email" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
		<div id="corpo_email" class="uk-form uk-form-stacked">
			<h3>Entrar em contato</h3>
			<hr class="uk-article-divider">
				<div class="uk-width-1-1 uk-form-row">
					<label class="uk-form-label" for="Nome">Nome</label>
					<input type="text" class=" form-small" id="email_nome" placeholder="" style="width: 100%;" value="<?php echo $nome;?>">
				</div>
				<div class="uk-width-1-1 uk-form-row">
					<label class="uk-form-label" for="Nome">Email</label>
					<input type="text" class=" form-small" id="email_email" placeholder="" style="width: 100%;" value="<?php echo $email;?>">
				</div>
				<div class="uk-width-1-1 uk-form-row">
					<label class="uk-form-label" for="Nome">Mensagem</label>
					<textarea class=" form-small" id="email_mensagem" style="width: 100%;height: 200px;"></textarea>
				</div>
				<div class="uk-width-1-1 uk-form-row">
					<button class="uk-button uk-button-primary" type="button" onclick="enviar_email();"><i class="uk-icon-paper-plane"></i> Enviar</button>		
				
				</div>
		
		
		</div>
    </div>
</div>

		<div id="lista" name="lista" class="lista" style="width: auto;color: #000;font-size: 10px;position: absolute;z-index: 1;overflow: auto;padding: 10px;background-color: #fff;padding: 2px;max-height: 350px;border-radius: 4px 4px 4px 4px;border: 1px solid #ccc;visibility: hidden;"></div>
	
    </body>
</html>


<?php




 	}else{
		echo "
		<head>
			<title></title>
			<link rel='stylesheet' href='javascript/uikit/css/uikit.almost-flat.css' />
			<link rel='stylesheet' href='javascript/uikit/css/uikit.everest.css' />
			<script src='javascript/uikit/js/jquery.js'></script>
			<script src='javascript/uikit/js/uikit.min.js'></script>
		</head>

		<body>	
			<div class=' uk-container-center ' style='margin-top: 10%;width:300px'>

				<div class='uk-alert uk-alert-danger' data-uk-alert=''>
					<a href='' class='uk-alert-close uk-close'></a>
					<p>Os dados estão incorretos, tente novamente!</p>
					<a href='index.php' ><< Volvar</a>
				</div>

			</div>
		</bady>
		
		
		";
	}

}else{
	include "login.php";
	}

if(isset($_POST['atualizar']) and $_POST['atualizar']==1 and isset($_POST['cod_pessoa'])){
//Atualizar Cadastro


		$sql=new sql;
		$table="cad_pessoas";
		$campos="
					nome_razao_social='".$_POST['nome_razao_social']."',
					endereco='".$_POST['endereco']."',
					numero='".$_POST['numero']."',
					complemento='".$_POST['complemento']."',
					cep='".$_POST['cep']."',
					bairro='".$_POST['bairro']."',
					cidade='".$_POST['cidade']."',
					uf='".$_POST['uf']."',
					email_1='".$_POST['email_1']."',
					email_2='".$_POST['email_2']."',
					telefone_1='".$_POST['telefone_1']."',
					telefone_2='".$_POST['telefone_2']."',
					celular_1='".$_POST['celular_1']."',
					celular_2='".$_POST['celular_2']."'
		";
		$where="cod_pessoa='".$_POST['cod_pessoa']."'";
		$sql->update($table,$campos,$where);
}




?>