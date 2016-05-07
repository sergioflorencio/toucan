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


	if(isset($_GET['cod_usuario'])){
		$id=$_GET['cod_usuario'];
		
		
	}else{
		$id="";
		
		
		
	}
	


	$cadastro=new cadastro;
	$cadastro->cad_usuarios($id);	




?>

 <div class="uk-width-4-5 uk-container-center uk-text-center ">

	<div class="uk-grid ">
	
			<div class=' uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-4'>

				<ul class='uk-list  uk-width-1-1'>
					<?php
						$html= new html;
						$html->listar_usuarios(); 
					?>
					<li>
						<a class='uk-thumbnail uk-width-1-1' href='?cod_usuario=novo'>
							<div class='uk-thumbnail-caption' style='padding-top: 0px !important;text-align: left !important;'><i class="uk-icon-plus-circle"></i> Novo Usuário</div>
						</a>
					</li>
				</ul>

			</div>
            <div class=' uk-width-small-1-1 uk-width-medium-2-3 uk-width-large-3-4'>

				
				<div class='uk-grid  uk-text-left '>
						<div id="div_msg"  class=""></div>
						<div class='uk-width-1-1 uk-form'>
								<h3>Cadastro de usuarios</h3>
								
									<div class='uk-width-1-1' id='div_msg'></div>
									<div class='uk-form-row uk-grid'>
										<div class='uk-width-1-4'>
											<label class='uk-form-label' for='cod_usuario'>cod_usuario</label>
											<input class='uk-form-small' name='cod_usuario' id='cod_usuario' style='width: 100%;' value='<?php echo $id; ?>' readonly='' type='text'>
										</div>
										<div class='uk-width-3-4'>
											<label class='uk-form-label' for='nome'>Nome</label>
											<input class='uk-form-small' name='nome' id='nome' style='width: 100%;' value='<?php echo $nome; ?>' type='text'>
										</div>
									</div>

									<div class='uk-form-row uk-grid'>
										<div class='uk-width-1-2'>
											<label class='uk-form-label' for='usuario'>usuario</label>
											<input class='uk-form-small' name='usuario' id='usuario' style='width: 100%;' value='<?php echo $usuario; ?>' type='text'>
										</div>
										<div class='uk-width-1-2'>

											<label class='uk-form-label' for='email'>email</label>
											<input class='uk-form-small' name='email' id='email' style='width: 100%;' value='<?php echo $email; ?>' type='text'>
										</div>
									</div>
									<div class='uk-form-row uk-grid'>
								
										<div class='uk-width-1-4'>	
											<label class='uk-form-label' for='email'>Status</label>
											<select class='uk-form-small' name='status' id='status' style='width: 100%;'>
												<option value=''></option>
												<option value='A' <?php if($status=='A') { echo "selected";} ?>>Ativo</option>
												<option value='B' <?php if($status=='B') { echo "selected";} ?>>Bloqueado</option>
											</select>
										</div>
										<div class='uk-width-3-4'><br>
											<a class='uk-button uk-button-small uk-button-primary' onclick='enviar_senha();' style='width: 100%;'><i class='uk-icon-save'></i> Gerar senha</a>
										</div>	
											
											
									</div>
									<div class='uk-form-row'>
										<span class='uk-button uk-button-small uk-button-primary' onclick='salvar_usuario();'><i class='uk-icon-save'></i>  Salvar</span>
									</div>

									<hr class='uk-article-divider  <?php if($id==""){echo "uk-hidden";}?>'>	

						</div>
						<div class='uk-width-1-1 <?php if($id==""){echo "uk-hidden";}?>'>
								<h3>Acessos de banco</h3>
								<div class='uk-form'>
									<label class='uk-margin-small-top'><input type='checkbox' onclick="cad_usuarios_acoes_banco_dados(this);" name='update' id='update' <?php if($update=='1') { echo "checked";} ?>> Update</label>
									<label class='uk-margin-small-top'><input type='checkbox' onclick="cad_usuarios_acoes_banco_dados(this);" name='insert' id='insert' <?php if($insert=='1') { echo "checked";} ?>> Insert</label>
									<label class='uk-margin-small-top'><input type='checkbox' onclick="cad_usuarios_acoes_banco_dados(this);" name='delete' id='delete' <?php if($delete=='1') { echo "checked";} ?>> Delete</label>
								</div>								
								<hr class='uk-article-divider'>	
						</div>
						<div class='uk-width-1-1 <?php if($id==""){echo "uk-hidden";}?>'>
								<h3>Acessos a Empresas</h3>
								<div class='uk-form'>
									<?php $html->listar_cad_empresa($id); ?>
								</div>								
								<hr class='uk-article-divider'>	
						</div>
						<div class='uk-width-1-1 <?php if($id==""){echo "uk-hidden";}?>'>
								<h3>Acessos de módulo</h3>
								<div class="uk-grid">
									<div class='uk-width-medium-1-1 uk-width-small-1-1 uk-width-large-1-1 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Módulos</h4>
											<?php $html->listar_cad_menu('tucan','0',$id); ?>
										</div>	
									</div>
									
									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Contabilidade</h4>
											<?php $html->listar_cad_menu('contabil','0',$id); ?>
										</div>	
									</div>	
									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Orçamento</h4>
											<?php $html->listar_cad_menu('orcamento','0',$id); ?>
										</div>	
									</div>	
									
									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Contribuições</h4>
											<?php $html->listar_cad_menu('contribuicoes','0',$id); ?>
										</div>	
									</div>
									
									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Imobilizado</h4>
											<?php $html->listar_cad_menu('imobilizado','0',$id); ?>
										</div>	
									</div>

									<div class='uk-width-medium-1-2 uk-width-small-1-1 uk-width-large-1-2 uk-panel uk-panel-box'>
										<div class="uk-form uk-panel uk-panel-box-primary">
											<h4>Projetos</h4>
											<?php $html->listar_cad_menu('projetos','0',$id); ?>
										</div>	
									</div>
								</div>	



						</div>
				</div>
			 
			 
			 
			</div>	

	</div>

 
 </div>


 <script src="js/script.js"></script>
 
	<?php } ?>