<?php



	$campos_select=new selects; 
	$campos_inputs=new inputs;



?>


<form class="uk-form" id="form_baixa" action="php/incluir_baixa.php" method="post">	
						<div class='uk-grid' style=" max-width: 550px; padding: 10px; border-right: 1px solid rgb(204, 204, 204); margin-left: 0px; margin-top: -20px; ">
								<div class='uk-panels uk-width-1-1 uk-panel-box'>
									<div id='msg'></div>
											<div class="uk-width-1-1" style="margin-bottom: -15px; margin-left: 0px; padding-left: 0px;">
												<h3 style="margin-left: 0px;">Dados da captação</h3>
											</div>									
											<div class="uk-grid">
														<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1">
															<?php 	
																	$campos_select->select_status_captacao($status);
															?>
														</div>
														<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1">
															<?php 
																	$campos_select->select_pessoas($cod_pessoa);
															?>
														</div>													
										
														<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4">
														<?php 
																$campos_inputs->input_form_row($cod_captacao_cartas,'cod_captacao_cartas','Captação','',' readonly ');
														?>
														</div>
														<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4">
														<?php 
																$campos_inputs->input_form_row($cod_carta,'cod_carta','Carta',' ',' readonly ');
														?>
														</div>
														<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4">
														<?php 
																$campos_inputs->input_form_row($numero_lote,'numero_lote','Lote de envio',' ',' readonly ');
														?>
														</div>
														<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4">
														<?php 
																$campos_inputs->input_form_row($data_vencimento,'data_vencimento','Vencimento',' ',' readonly ');
														?>
														</div>
														<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4"><br/>
														<?php 
																$campos_inputs->input_form_row($valor,'valor','Valor',' ',' readonly ');
														?>
														</div>



											</div>
											<hr></hr>
								</div>
								<div class="uk-panels uk-width-1-1 uk-panel-box">
										<div class="uk-grid">
										
										
											<div class="uk-width-1-1" style="margin-bottom: -15px; margin-left: 0px; padding-left: 0px;">
												<h3 style="padding-left: 10px;">Incluir baixa</h3>
											</div>
											<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2">
														<?php 
															$campos_select->select_carteiras(''); 
														?>
											</div>
											<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2">
												<div class="uk-grid">
													<div class="uk-width-1-2"></br>
														<?php
															$campos_inputs->input_form_row('',"data_baixa","Data",""," onkeyup=javascript:formatar_data(this); data-uk-datepicker={format:'DD/MM/YYYY'} ");
														?>
													</div>
													<div class="uk-width-1-2"></br>
														<?php
															$campos_inputs->input_form_row('',"valor_baixa","Valor",""," onkeyup=javascript:formatar_decimal(this); ");
														?>
													</div>

													
												</div>
											</div>
											<div class="uk-width-1-1">
												<button class="uk-button uk-button-success" type="button" style="margin-top: 20px;" onclick="javascript:document.getElementById('form_baixa').submit();"><i class="uk-icon-magic"></i> Baixar</button>
											</div>
										</div>
										<hr></hr>
								</div>
								<div class="uk-panels uk-width-1-1 uk-panel-box">
									<div class="uk-width-1-1" style="margin-bottom: -15px; margin-left: 0px; padding-left: 0px;">
										<h3 style="margin-left: 0px;">Baixas</h3>
									</div>
									<div class="uk-width-1-1">
											<?php 
													//// Lista de Baixas da captação
												$filtro=new tabelas; 
												$filtro->listar_baixas_captacao($cod_captacao_cartas);	
											?>
									</div>
									<div class="uk-grid">
										<div class="uk-width-1-4"><br/>
										</div>
										<div class="uk-width-1-4">
										<?php 
												$campos_inputs->input_form_row($valor,'valor','Total',' ',' readonly ');
										?>
										</div>
										<div class="uk-width-1-4">
										<?php 
												$campos_inputs->input_form_row($somabaixas,'somabaixas','Baixas',' ',' readonly ');
										?>
										</div>
										<div class="uk-width-1-4">
										<?php 
												$campos_inputs->input_form_row($saldocaptacao,'saldocaptacao','Saldo',' ',' readonly ');
										?>
										</div>
									</div>
									<hr></hr>
								</div>

						</div>
				
</form>			
<script>
	document.getElementById("cod_pessoa").disabled = true;
	document.getElementById("captacao_cartas_cod_retorno").disabled = true;
</script>	

