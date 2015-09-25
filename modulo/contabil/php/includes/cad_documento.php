<?php
	if(intval($_GET['id'])>0){
		$disabled=" disabled ";
	}else{
		$disabled="  ";
	}
		

?>


<div class='uk-width-1-1 ' style=''  id="msg">

	<div class="uk-grid" style="text-align: left !important;">
		<div class="uk-width-1-1">
			<div class="uk-grid" >
				<div class="uk-tab uk-width-1-1" data-uk-tab="{connect:'#subnav-pill-content-2'}">

						<li class="uk-active"><a href="#">Dados do documento</a></li>
						<li class=""><a href="#">Lançamentos</a></li>


				</div>
			</div>
			<div id="subnav-pill-content-2" class="uk-switcher">
							
					<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 '>
						<div  id="msg"></div>
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
														$inputs->input_form_row($data_estorno,'data_estorno','Dt.estorno',''," disabled ".$disabled);
													?>
												</div>
												<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-3-4 uk-width-large-1-4">
													<div class="uk-grid">
														<div class="uk-width-3-5">
															<?php 
																$inputs->input_form_row($exercicio,'exercicio','Exercicio (ano)',''," disabled ".$disabled);
															?>
														</div>
														<div class="uk-width-2-5">
															<?php 
																$inputs->input_form_row($periodo,'periodo','Período (mês)',''," disabled ".$disabled);
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
					<div class=' uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 '>
					<h3>Lançamentos</h3>
						<?php
							$cadastros=new cadastros;
							$cadastros->cad_documento_item($cod_documento);

						?>
						<script>
							calcular_total_debito_credito();
						</script>
						<hr class="uk-article-divider">
					
					</div>
					
							
			
			
			</div>
			<div class="uk-modal" id="div_importar_lancamentos">
				<div class="uk-form uk-modal-dialog" id="">
					<a class="uk-modal-close uk-close"></a>
					<div class="uk-form-row">
						<h3>Importar lançamentos</h3>
						<p class="uk-article-meta">Copie e cole sua planilha na área de texto abaixo. Certifique-se de que as colunas estejam separadas por ; ou por TAB (tabulação manual), geralmente apenas copiando e colando a os dados de uma planilha Excel as informações já estarão separadas por TAB. As colinas devem estar na mesma ordem que na tabela de lançamento acima (“CL” , “Ctr. Custo”, “Conta”, “Descrição”, “Valor”, “Vencimento”).</p>
						<textarea cols="" rows="10" style="width: 100%; margin-bottom: 20px;" placeholder title="copie e cole os dados" id="text_area_importar_lancamento"></textarea>
					</div>
					<button class="uk-button uk-button-mini uk-button-primary" type="button" onclick="importar_lancamentos();"><i class="uk-icon-refresh"></i> Importar</button>

				</div>
			</div>		
		
		</div>			

	

	
	
	</div>
</div>