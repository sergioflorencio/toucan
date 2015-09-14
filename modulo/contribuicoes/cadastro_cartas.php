<?php 

	session_start();
	include "../../php/login.php";
	$login=new login;
	$login->checklogin();
	
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		
		$salvar=new salvar;
		$salvar->cad_cartas();

		$campos_select=new selects; 
		$campos_inputs=new inputs;
		$captacoes=new tabelas; 
		$cadastros=new cadastros;
		$button=new button;
		$filtro=new filtros; 
		 
		 
		 
		if(isset($_GET['id']) and $_GET['id']!="novo"){$cod_carta=$_GET['id'];}else{$cod_carta="";}

?>




<link rel="stylesheet" href="../../js/jwysiwyg/jquery.wysiwyg.css" type="text/css" />
<script type="text/javascript" src="../../js/jwysiwyg/jquery/jquery-1.3.2.js"></script>
<script type="text/javascript" src="../../js/jwysiwyg/jquery.wysiwyg.js"></script>

<body>
	<div style="margin: 10px;">	
		<div class="uk-grid uk-grid-preserve"  id="submenu">
				<div class="uk-width-1-1">
						<div class="uk-button-group">
							<a href="?id=novo" class="uk-button uk-button-success uk-button-small"><i class="uk-icon-star"></i>  Novo</a>
						</div>
						<div class="uk-button-group">
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('xls','tm-content','html');" data-uk-tooltip="{pos:'bottom-left'}" title="exportar arquivo .xls"><i class="uk-icon-file-excel-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('doc','tm-content','html');" data-uk-tooltip="{pos:'bottom-left'}" title="exportar arquivo .doc"><i class="uk-icon-file-word-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="imprimir('tm-content');" data-uk-tooltip="{pos:'bottom-left'}" title="imprimir"><i class="uk-icon-print"></i></span>						

							
	<?php
								if(isset($_GET['id'])){
								echo 
									"<a href='comprovantes/comprovante_carta.php?cod_carta=".$cod_carta."' class='uk-button uk-button-small' style='padding-top: 7px; padding-bottom: 7px;' target='_blank' data-uk-tooltip={pos:'bottom-left'} title='Comprovante'><i class='uk-icon-info-circle'></i></a>
									<a class='uk-button  uk-button-small' onclick='salvar_carta();' style='padding-top: 7px; padding-bottom: 7px;' data-uk-tooltip={pos:'bottom-left'} title='Salvar' ><i class='uk-icon-save'></i></a>";
								}
	?>
							
						</div>
						<span  id="arquivo_gerado"></span>
						<div class='uk-button-group uk-navbar-flip'>
	<?php
								if(isset($_GET['id'])){

									$button->cancelar_carta($cod_carta,"cadastro_cartas.php");
									$button->renovar_carta($cod_carta);

								}else{
								?>
									<a href="#" style="padding-top: 7px; padding-bottom: 7px;" class="uk-button uk-button-small uk-button-danger" data-uk-modal="{target:'#modal'}" data-uk-tooltip="{pos:'left'}" title="Atualizar valor das cartas"><i class="uk-icon-refresh"></i> </a>
								<?php
								
								}
								

	?>					

						</div>
				<hr class="uk-article-divider" style="margin: 10px -10px 0px -10px;">	
				</div>

		</div>
		<div class="uk-grid" style="margin-top: 0px;" >	
			<div class="uk-width-medium-1-1">	
				<div class="uk-grid">	
					<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4" style=" border-right: 1px solid rgb(204, 204, 204); ">		
	
						<?php 
							if(isset($_GET['id'])==false){
								$filtro->cartas();	
							}
						?>
					</div>		
					<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-2-3 uk-width-large-3-4 uk-overflow-container " style=" padding-left: 0px; border-left: 1px solid rgb(204, 204, 204);" id="tm-content">			
						<?php
							if(isset($_GET['_data_inicio'])){$_data_inicio=$_GET['_data_inicio'];}else{$_data_inicio=date('d/m/Y',mktime (0, 0, 0, date("m"), date("d"),  date("Y")-1));}
							if(isset($_GET['_data_fim'])){$_data_fim=$_GET['_data_fim'];}else{$_data_fim=date('d/m/Y',mktime (0, 0, 0, date("m"), date("d"),  date("Y")+1));}

							
							//Listar cartas

							if(
								isset($_POST['cod_banco']) and 
								isset($_POST['cod_campanha']) and 
								isset($_POST['cod_carteira']) and 
								isset($_POST['cod_centro']) and 
								isset($_POST['cod_grupo']) and 
								isset($_POST['cod_pessoa']) and 
								isset($_POST['tipo_convenio']) and 
								isset($_POST['cod_colaborador']) and 
								isset($_POST['cod_ctrreceita']) and 
								isset($_POST['status_carta']) and 
								isset($_POST['valor_moeda_de']) and 
								isset($_POST['valor_moeda_ate']) and 
								isset($_POST['data_inicio_de']) and 
								isset($_POST['data_inicio_ate']) and 
								isset($_POST['data_fim_de']) and 
								isset($_POST['data_fim_ate']) and 
								isset($_POST['data_cancelamento_de']) and 
								isset($_POST['data_cancelamento_ate']) and 
								isset($_POST['periodicidade']) and 
								isset($_POST['dia_debito']) and 
								isset($_POST['cod_moeda']) and 
								isset($_POST['boleto_modo_envio']) and 
								isset($_POST['carta_aberta']) and 
								isset($_POST['cod_carta'])
							){
								$captacoes=new tabelas; $captacoes->listar_cartas($_POST['cod_banco'],$_POST['cod_campanha'],$_POST['cod_carteira'],$_POST['cod_centro'],$_POST['cod_grupo'],$_POST['cod_pessoa'],$_POST['tipo_convenio'],$_POST['cod_colaborador'],$_POST['cod_ctrreceita'],$_POST['status_carta'],$_POST['valor_moeda_de'],$_POST['valor_moeda_ate'],$_POST['data_inicio_de'],$_POST['data_inicio_ate'],$_POST['data_fim_de'],$_POST['data_fim_ate'],$_POST['data_cancelamento_de'],$_POST['data_cancelamento_ate'],$_POST['periodicidade'],$_POST['dia_debito'],$_POST['cod_moeda'],$_POST['carta_aberta'],$_POST['cod_carta'],$_POST['boleto_modo_envio']);
							}

							
							


						?>
					</div>
	<?php if(isset($_GET['id'])){ ?>
					<div class="uk-width-1-1">
						<div class="uk-grid">
							<div class="uk-width-small-1-1 uk-hidden-medium uk-hidden-large" style="padding-top: 10px; padding-bottom: 10px;">
								<ul class="uk-subnav uk-subnav-pill"   data-uk-switcher="{connect:'#subnav-pill-content'}">
									<li class=""><a href="#" style="padding-top: 7px; padding-bottom: 7px;" data-uk-tooltip="{pos:'right'}" title="Carta"><i class="uk-icon-edit"></i> </a></li>
									<li class=""><a href="#" style="padding-top: 7px; padding-bottom: 7px;" data-uk-tooltip="{pos:'right'}" title="Contatos"><i class="uk-icon-history"></i> </a></li>
									<li class=""><a href="#" style="padding-top: 7px; padding-bottom: 7px;" data-uk-tooltip="{pos:'right'}" title="Captações"><i class="uk-icon-tags"></i> </a></li>
									<li class=""><a href="#" style="padding-top: 7px; padding-bottom: 7px;" data-uk-tooltip="{pos:'right'}" title="Anexos"><i class="uk-icon-cloud-upload"></i> </a></li>
								</ul>
							</div>
							<div class="uk-width-medium-1-4 uk-width-large-1-4 uk-hidden-small"  style="padding-left: 0px; margin-left: 10px;">
								<ul class="uk-nav uk-nav-side uk-nav-parent-icon"  data-uk-switcher="{connect:'#subnav-pill-content'}">
									<li class=""><a href="#"><i class="uk-icon-edit"></i> Dados da Carta</a></li>
									<li class=""><a href="#"><i class="uk-icon-history"></i> Histórico de contratos</a></li>
									<li class=""><a href="#"><i class="uk-icon-tags"></i> Captações da carta</a></li>
									<li class=""><a href="#"><i class="uk-icon-cloud-upload"></i> Lista de anexos</a></li>
								</ul>
							</div>
							<div class="uk-width-medium-2-4" id="tm-content_" style="border-left: 1px solid rgb(204, 204, 204); padding-left: 10px; border-right: 1px solid rgb(204, 204, 204);">
							<div id="subnav-pill-content" class="uk-switcher ">
								<div class="">	
								<?php 
										
									if(isset($_GET['id'])){
										$cadastros->cad_cartas($cod_carta);
									}
									
								?>
								</div>
								<div class="">
								<?php
									if(isset($_GET['id']) and $_GET['id']!='novo'){
										include 'includes/historico_contato.php';
									}
								?>			
								</div>
								<div class="" >
								<?php
									if(isset($_GET['id']) and $_GET['id']!='novo'){ 
											$captacoes->listar_captacoes_carta($_GET['id'],$_data_inicio,$_data_fim);
									}		
								?>
								
								</div>
								<div class="">
								<?php 
									if(isset($_GET['id']) and $_GET['id']!='novo'){ 
											$captacoes->listar_anexos_carta($_GET['id']);
									}
								?>
								
									<script>
										function getFile(){
										document.getElementById('file').click();
										}
									</script>
								</div>
							</div>
								
							</div>
						</div>
					</div>
	<?php } ?>
				</div>
			</div>		
		</div>		
	</div>	
	
	<div id="modal" class="uk-modal" style="display: none; overflow-y: scroll;">
		<div class="uk-modal-dialog" id="div_msg">
			<button type="button" class="uk-modal-close uk-close"></button>
			<h2 class="uk-modal-header">Atualizar valor das cartas</h2>
			<p>Selecione a moeda que deseja utilizar para atualizar as cartas que estão vinculadas à ela. Apenas as cartas ativas e captações geradas serão atualizadas.</p>

			<?php 
				$campos_select->select_moeda_('cod_moeda_carta');
			
			?>
			<hr class="uk-article-divider">
			<div class="uk-modal-footer">
				<button type="button" class="uk-button  uk-modal-close ">Cancel</button>
				<button type="button" class="uk-button uk-button-primary" onclick="atualizar_valor_cartas();">Atualizar</button>
			</div>
		</div>
	</div>				
			

</body>

<?php } ?>


