<?php

	session_start();
	include "php/login.php";
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){





?>
 <head>
	<title>sistema.osuc.org.br</title>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<link rel="stylesheet" href="js/uikit/css/uikit.css" />
	<link rel="stylesheet" href="js/uikit/css/uikit.avenue.css" />
	<link rel="stylesheet" href="js/uikit/css/uikit.theme.css" />
 </head>

<?php


	if(isset($_GET['cod_empresa'])){
		$cod_empresa=$_GET['cod_empresa'];
		
		
	}else{
		$cod_empresa="";
		
		
		
	}
	


	$cadastro=new cadastro;
	$cadastro->cad_empresas($cod_empresa);	




?>

 <div class="uk-width-4-5 uk-container-center uk-text-center ">

	<div class="uk-grid ">
	
			<div class=' uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-4'>

				<ul class='uk-list  uk-width-1-1'>
					<?php
						$html= new html;
						$html->listar_empresas(); 
					?>
					<li>
						<a class='uk-thumbnail uk-width-1-1' href='?cod_empresa=novo'>
							<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'><i class="uk-icon-plus-circle"></i> Nova Empresa</div>
						</a>
					</li>
				</ul>

			</div>
            <div class=' uk-width-small-1-1 uk-width-medium-2-3 uk-width-large-3-4'>






	
				<div class='uk-grid  uk-text-left '>
						<div id="div_msg"  class=""></div>
						<div class='uk-width-1-1 uk-form'>
								<h3>Cadastro de Empresas</h3>
								
									<div class='uk-width-1-1' id='div_msg'></div>
									<div class='uk-form-row uk-grid'>
										<div class="uk-navbar-flip" >
											<div class="uk-form-row" >
												<a class="uk-thumbnail" href="#" height="100" width="200" id='logo_'  onclick="getFile();" style="background: none repeat scroll 0% 0% rgb(255, 255, 255);">
													<img src="<?php echo $logo ?>" class="uk-cover-background" alt="" height="100" width="200">
												</a>
											</div>
											<div class="uk-form-row uk-navbar-flip" >
													<span class="uk-button uk-button-mini uk-button-primary" type="button" name="bt_upload_logo" id="bt_upload_logo" onclick="getFile();">Escolha um logo <i class="uk-icon-image"></i></span>
											</div>										
										</div>
									</div>
									<div class='uk-form-row uk-grid'>
										<div class='uk-width-1-4'>
											<label class='uk-form-label' for='cod_empresa'>cod_empresa</label>
											<input class='uk-form-small' name='cod_empresa' id='cod_empresa' style='width: 100%;' value='<?php echo $cod_empresa; ?>' readonly='' type='text'>
										</div>
										<div class='uk-width-3-4'>
											<label class='uk-form-label' for='razao_social'>razao_social</label>
											<input class='uk-form-small' name='razao_social' id='razao_social' style='width: 100%;' value='<?php echo $razao_social; ?>' type='text'>
										</div>
									</div>

									<div class='uk-form-row uk-grid'>
										<div class='uk-width-1-4'>
											<label class='uk-form-label' for='matriz_filial'>matriz_filial</label>
											<select class='uk-form-small' id='matriz_filial' name='matriz_filial' style='width: 100%;'>
											<?php 
												$selects=new selects;
												$selects->select_matriz_filial($matriz_filial);
										
											?>
											</select>										</div>
										<div class='uk-width-3-4'>
											<label class='uk-form-label' for='cod_empresa_matriz'>cod_empresa_matriz</label>
											<select class='uk-form-small' id='cod_empresa_matriz' name='cod_empresa_matriz' style='width: 100%;'>
											<?php 
												$selects=new selects;
												$selects->select_empresa($cod_empresa_matriz);
										
											?>
											</select>
											
										</div>
									</div>

									<div class='uk-form-row uk-grid'>
										<div class='uk-width-2-4'>
											<label class='uk-form-label' for='endereco'>endereco</label>
											<input class='uk-form-small' name='endereco' id='endereco' style='width: 100%;' value='<?php echo $endereco; ?>' type='text'>
										</div>
										<div class='uk-width-1-4'>
											<label class='uk-form-label' for='numero'>numero</label>
											<input class='uk-form-small' name='numero' id='numero' style='width: 100%;' value='<?php echo $numero; ?>' type='text'>
										</div>
										<div class='uk-width-1-4'>

											<label class='uk-form-label' for='complemento'>complemento</label>
											<input class='uk-form-small' name='complemento' id='complemento' style='width: 100%;' value='<?php echo $complemento; ?>' type='text'>
										</div>
									</div>
		
									<div class='uk-form-row uk-grid'>
										<div class='uk-width-2-6'>
											<label class='uk-form-label' for='cep'>cep</label>
											<input class='uk-form-small' name='cep' id='cep' style='width: 100%;' value='<?php echo $cep; ?>' type='text'>
										</div>
										<div class='uk-width-3-6'>
											<label class='uk-form-label' for='cidade'>cidade</label>
											<input class='uk-form-small' name='cidade' id='cidade' style='width: 100%;' value='<?php echo $cidade; ?>' type='text'>
										</div>
										<div class='uk-width-1-6'>

											<label class='uk-form-label' for='uf'>uf</label>
											<input class='uk-form-small' name='uf' id='uf' style='width: 100%;' value='<?php echo $uf; ?>' type='text'>
										</div>
									</div>

									<div class='uk-form-row uk-grid'>
										<div class='uk-width-3-6'>
											<label class='uk-form-label' for='email'>email</label>
											<input class='uk-form-small' name='email' id='email' style='width: 100%;' value='<?php echo $email; ?>' type='text'>
										</div>
										<div class='uk-width-1-6'>
											<label class='uk-form-label' for='telefone'>telefone</label>
											<input class='uk-form-small' name='telefone' id='telefone' style='width: 100%;' value='<?php echo $telefone; ?>' type='text'>
										</div>
										<div class='uk-width-2-6'>
											<label class='uk-form-label' for='cnpj'>cnpj</label>
											<input class='uk-form-small' name='cnpj' id='cnpj' style='width: 100%;' value='<?php echo $cnpj; ?>' type='text'>
										</div>
										<div class='uk-width-1-1'>
											<input class='uk-form-small' name='upload_logo' id='upload_logo' onchange='upload_logo();' style='width: 100%;' type='file' hidden>
											<script>
												function getFile(){
												document.getElementById('upload_logo').click();
												}
											
											</script>											
										</div>
										<div class='uk-width-1-4'>

										</div>
										<div class='uk-width-1-4'>
										
										</div>
									</div>

									<div class='uk-form-row'>
										<span class='uk-button uk-button-small uk-button-primary' onclick='salvar_empresa();'><i class='uk-icon-save'></i>  Salvar</span>
									</div>

									<hr class='uk-article-divider  <?php if($cod_empresa==""){echo "uk-hidden";}?>'>	

						</div>
				</div>
			 
			 
			 
			</div>	

	</div>

 
 </div>


 <script src="js/script.js"></script>
 
	<?php } ?>