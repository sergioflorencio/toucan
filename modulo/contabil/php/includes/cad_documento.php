<div class='uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-3-4 uk-container-center uk-text-center ' style=''>
	<div class="uk-grid" style="text-align: left !important;">
	
	
	<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 '>
		<h3>Dados do documento</h3>
		<form action="#" method="post" class="uk-form" id="form_cadastro">
						<div class="uk-width-1-1">
							<div class="uk-grid">
								<div class="uk-width-1-4">
									<?php 
										$inputs->input_form_row($cod_documento,'cod_documento','cod_documento','',' readonly');
									?>
								</div>
								<div class="uk-width-1-4">
									<div aria-expanded="false" aria-haspopup="true" class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" >
										<span style="padding-right: 0px; padding-left: 0px; border-radius: 21px ! important; margin-top: 10px;" class="uk-button uk-navbar-flip uk-icon-button "><i style="padding: 7px;" class="uk-icon-info-circle"></i></span>
										<div style="" class="uk-dropdown">
											<div class="uk-width-1-1">
												<?php 
													$inputs->input_form_row($usuario_ultima_alteracao,'usuario_ultima_alteracao','Usuário da ultima alteração','','');
												?>
											</div>
											<div class="uk-width-1-1">
												<?php 
													$inputs->input_form_row($usuario_inclusao,'usuario_inclusao','Usuário de inclusão','','');
												?>
											</div>
										</div>
									</div>
								
								
								
								</div>								
							</div>
						</div>

						<div class="uk-form-row">
							<div class="uk-grid">	
								<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
									<?php 
									//	$inputs->input_form_row($cod_tipo_documento,'cod_tipo_documento','cod_tipo_documento','','');
									
										if($cod_tipo_documento==""){$cod_tipo_documento=1;}else{$cod_tipo_documento=$cod_tipo_documento;}
										$selects->cod_tipo_documento($cod_tipo_documento,'Tipo Doc.');
									?>
								</div>
								<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
									<?php 
										$inputs->input_form_row($referencia,'referencia','Referência','','');
									?>
								</div>
								<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-2-4">
									<?php 
										$inputs->input_form_row($texto_cabecalho_documento,'texto_cabecalho_documento','Texto cabeçalho de documento','','');
									?>
								</div>
								<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
									<?php 
										$inputs->input_form_row($data_lancamento,'data_lancamento','Dt.lançamento','',"value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
									?>
								</div>
								<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
									<?php 
										$inputs->input_form_row($data_base,'data_base','Dt.base','',"value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
									?>
								</div>
								<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
									<?php 
										$inputs->input_form_row($data_estorno,'data_estorno','Dt.estorno','',"value='01/01/9999' data-uk-datepicker={format:'DD/MM/YYYY'}");
									?>
								</div>
								<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
									<div class="uk-grid">
										<div class="uk-width-3-5">
											<?php 
												$inputs->input_form_row($exercicio,'exercicio','Exercicio (ano)','','');
											?>
										</div>
										<div class="uk-width-2-5">
											<?php 
												$inputs->input_form_row($periodo,'periodo','Período (mês)','','');
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="uk-form-row">
							<div class="uk-grid">	
								<div class="uk-width-1-1">
									<?php 
										$inputs->input_form_row($historico,'historico','Histórico','','');
									?>
								</div>
							</div>
						</div>
		</form>
		<hr class="uk-article-divider">
	</div>
	<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 '>
	<h3>Lançamentos</h3>
		<div class="uk-grid">
			<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 '>
				<span style="margin-top: 10px;" class="uk-button uk-button-mini uk-button-primary"  id="bt_add_lancamentos" type="button" onclick="salvar_documento();"><i class="uk-icon-plus-circle"></i> salvar</span>
			</div>
			<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 ' id="div_lancamentos">
	
			</div>
			<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 '>
	
			</div>
			
			
			
		</div>
	
	<?php
		$cadastros=new cadastros;
		$cadastros->cad_documento_item('0');

	?>
	
	
	
	
		<hr class="uk-article-divider">
	
	</div>
	</div>
</div>