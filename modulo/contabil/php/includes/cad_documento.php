<?php
	if(intval($_GET['id'])>0){
		$disabled=" disabled ";
	}else{
		$disabled="  ";
	}
		

?>


<div class='uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-3-4 uk-container-center uk-text-center ' style=''>
	<div class="uk-grid" style="text-align: left !important;">
		<div class="uk-width-1-1">
			<div class="uk-grid" >
				<div class="uk-tab uk-width-1-2" data-uk-tab="{connect:'#subnav-pill-content-2'}">

						<li class="uk-active"><a href="#">Dados do documento</a></li>
						<li class=""><a href="#">Lançamentos</a></li>


				</div>
				<div class='uk-tab uk-width-1-2 uk-tab-flip' >	
					<li class="<?php if(intval($_GET['id'])>0){echo " uk-disabled ";}?>"> 
						<a href='#' >
							<button class="uk-button uk-button-mini uk-button-primary" type="button" onclick="salvar_documento()" <?php echo $disabled ; ?> ><i class="uk-icon-floppy-o"></i> Salvar</button>
						</a>
					</li>
				</div>
			</div>
			<div id="subnav-pill-content-2" class="uk-switcher">
							
					<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 '>
						<h3>Dados do documento</h3>
						<form action="#" method="post" class="uk-form" id="form_cadastro">
										<div class="uk-width-1-1">
											<div class="uk-grid">
												<div class="uk-width-1-4">
													<?php 
														$inputs->input_form_row($cod_documento,'cod_documento','cod_documento','',' readonly '.$disabled);
													?>
												</div>
												<div class="uk-width-1-4">
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
														$inputs->input_form_row($referencia,'referencia','Referência','',$disabled);
													?>
												</div>
												<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-2-4">
													<?php 
														$inputs->input_form_row($texto_cabecalho_documento,'texto_cabecalho_documento','Texto cabeçalho de documento','',$disabled);
													?>
												</div>
												<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
													<?php 
														$inputs->input_form_row($data_lancamento,'data_lancamento','Dt.lançamento','',"data-uk-datepicker={format:'DD/MM/YYYY'}".$disabled);
													?>
												</div>
												<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
													<?php 
														$inputs->input_form_row($data_base,'data_base','Dt.base','',"data-uk-datepicker={format:'DD/MM/YYYY'}".$disabled);
													?>
												</div>
												<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
													<?php 
														$inputs->input_form_row($data_estorno,'data_estorno','Dt.estorno','',"data-uk-datepicker={format:'DD/MM/YYYY'}".$disabled);
													?>
												</div>
												<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
													<div class="uk-grid">
														<div class="uk-width-3-5">
															<?php 
																$inputs->input_form_row($exercicio,'exercicio','Exercicio (ano)','',$disabled);
															?>
														</div>
														<div class="uk-width-2-5">
															<?php 
																$inputs->input_form_row($periodo,'periodo','Período (mês)','',$disabled);
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
														$inputs->input_form_row($historico,'historico','Histórico','',$disabled);
													?>
												</div>
											</div>
										</div>
						</form>
						<hr class="uk-article-divider">
					</div>
					<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 ' >
					<h3>Lançamentos</h3>
					
						<?php
							$cadastros=new cadastros;
							$cadastros->cad_documento_item($cod_documento);

						?>
						<hr class="uk-article-divider">
					
					</div>
					
							
			
			
			</div>
		</div>			

	

	
	
	</div>
</div>