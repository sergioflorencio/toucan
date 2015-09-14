<?php



$campos_select=new selects; 
$campos_inputs=new inputs;

if(isset($_GET['id']) and $_GET['id']!=''){






}else{








}	


?>



					<div class='uk-panels uk-width-1-1  uk-panel-box' style="min-width: 350px;">
						<a href="comprovantes/comprovante_carta.php?cod_carta=<?php echo $cod_carta; ?>" class="uk-button uk-button-small" target="_blank"><i class="uk-icon-print"></i> Imprimir</a>

						<h3>Dados da carta</h3>
						<form class='uk-form' action='#' method='POST' id='form_carta'>
						<div class="uk-grid">
							<div class="uk-width-1-1">
								<div class="uk-grid">
									<div class="uk-width-1-4">
									<?php 
											$campos_inputs->input_form_row($cod_carta,'cod_carta','Carta','nova',' readonly ');
									?>
									</div>
								</div>
							</div>
							<div class="uk-width-1-1">
								<div class="uk-grid">
									<div class="uk-width-1-3">
									<?php 
											$campos_select->select_status_carta($status_carta);
									?>
									</div>
									<div class="uk-width-2-3">
									<?php 
											$campos_select->select_status_captacoes($status_captacoes);
									?>
									</div>
								</div>
							</div>
							<div class="uk-width-1-1">
									<?php 
											$campos_select->select_motivo_cancelamento($cod_motivo_cancelamento);
									?>
							</div>
						</div>
						<div class="uk-grid">
							<div class="uk-width-1-1">
								<div class="uk-grid">
									<div class="uk-width-1-2">
									<?php 
											$campos_select->select_pessoas($cod_pessoa);
									?>
									</div>
									<div class="uk-width-1-2">
									<?php 
											$campos_select->select_colaborador($cod_colaborador);
									?>
									</div>
								</div>
							</div>
							<div class="uk-width-1-1">
							<?php 
									$campos_select->select_ctrreceita($cod_ctrreceita);
							?>
							</div>
						</div>
						<div class="uk-grid">
							<div class="uk-width-1-1">
								<div class="uk-grid">
									<div class="uk-width-1-4">
										<?php
										//carta_aberta
											$campos_select->select_carta_aberta($carta_aberta);
										?>
									</div>
									<div class="uk-width-1-4">
									<?php 
										//periodicidade
											$campos_select->select_periodicidade($periodicidade);
									?>
									</div>
									<div class="uk-width-1-4">
									<?php 
										//carta_dia_debito
											$campos_select->select_dia_debito($carta_dia_debito);
									?>
									</div>
									<div class="uk-width-1-4">
										<?php
										//moeda
											$campos_select->select_moeda($cod_moeda);
										?>
									</div>
								</div>
							</div>

						</div>
						<div class="uk-grid">
							<div class="uk-width-1-3">
								<div class="uk-grid">
									<div class="uk-width-1-2">
									<?php 
										//carta_data_inicio
											$campos_inputs->input_form_row($carta_data_inicio,'carta_data_inicio','Inicio','00/00/0000',"data-uk-datepicker={format:'DD/MM/YYYY'} onkeyup=javascript:formatar_data(this);");
									?>
									</div>
									<div class="uk-width-1-2">
									<?php 
										//carta_data_fim
											$campos_inputs->input_form_row($carta_data_fim,'carta_data_fim','Fim','00/00/0000',"data-uk-datepicker={format:'DD/MM/YYYY'} onkeyup=javascript:formatar_data(this);");
									?>
									</div>
								</div>
							</div>
							<div class="uk-width-1-3">
							<?php 
								//carta_qtd_moeda
									$campos_inputs->input_form_row($carta_qtd_moeda,'carta_qtd_moeda','Quantidade','0,00','onkeyup=javascript:calculartotalcarta();');
							?>
							</div>
							<div class="uk-width-1-3">
							<?php 
								//carta_valor_moeda
									$campos_inputs->input_form_row($carta_valor_moeda,'carta_valor_moeda','Total','0,00',' readonly ');
							?>
							</div>
						</div>

						<div class="uk-grid">
							<div class="uk-width-1-4">
								<?php
								//carta_forma_pagamento
									$campos_select->select_tipo_convenios($tipo_convenio);
								?>
							</div>
							<div class="uk-width-3-4">
							<?php 
								//debito_banco
									$campos_select->select_bancos($cod_banco);
							?>
							</div>
						</div>
						<div class="uk-grid">
							<div class="uk-width-1-3">
								<div class=" uk-grid">
										<div class="uk-width-2-3">
											<?php
											//debito_numero_agencia
												$campos_inputs->input_form_row($debito_numero_agencia,'debito_numero_agencia','Agência','0000','');
											?>
										</div>
										<div class="uk-width-1-3">
										<?php 
											//debito_digito_agencia
												$campos_inputs->input_form_row($debito_digito_agencia,'debito_digito_agencia','Dig.','0','');
										?>
										</div>
								</div>
							</div>
							<div class="uk-width-2-3">
								<div class=" uk-grid">
									<div class="uk-width-3-4">
										<?php
										//debito_numero_conta
											$campos_inputs->input_form_row($debito_numero_conta,'debito_numero_conta','Conta','00000','');
										?>
									</div>
									<div class="uk-width-1-4">
									<?php 
										//debito_digito_conta
											$campos_inputs->input_form_row($debito_digito_conta,'debito_digito_conta','Dig.','00','');
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="uk-grid">
							<div class="uk-width-1-1">
								<?php
								//boleto_modo_envio
									$campos_select->select_boleto_modo_envio($boleto_modo_envio);
								?>
							</div>
						</div>
						<div class="uk-grid">
							<div class="uk-width-1-2">
									<a class='uk-button uk-button-primary uk-button-small' onclick='salvar_carta();'><i class='uk-icon-save'></i>  Salvar</a>

								<?php  $button=new button; $button->cancelar_carta($cod_carta);?>


						</div>

		
						</form>
						<script>
						<?php if(isset($alerta)){echo $alerta;};?>
							document.getElementById("status_carta").disabled = true;
							document.getElementById("status_captacoes").disabled = true;
							document.getElementById("cod_motivo_cancelamento").disabled = true;
							$('#carta_aberta').change(function() {
								data_fim_carta_aberta();
							});
							$('#carta_data_inicio').change(function() {
								data_fim_carta_aberta();
							});
							$('#carta_data_fim').change(function() {
								data_fim_carta_aberta();
							});
						</script>
						
						
					</div>
					</div>
				
				
				
				