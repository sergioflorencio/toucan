<?php if(isset($_GET['id']) and $_GET['id']=="novo"){$disabled="";}else{$disabled=" ";}if(isset($_GET['id']) and $_GET['id']!="novo"){$disabled="disabled ";}?>
<div style=" padding: 10px;">
	<h3><i class="uk-icon-edit"></i> Dados da carta</h3>

	<form class='uk-form' action='#' method='POST' id='form_carta'>
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<div class="uk-grid">
				<div class="uk-width-1-4 uk-width-small-1-4 uk-width-medium-1-4 uk-width-large-1-4">
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


		<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2">
				<label class="uk-form-label" for="xxx">Contribuinte</label>
				<div class="uk-grid" style="margin-left: 0px;">
					<input class="uk-form-small uk-width-1-4" type="text" name="cod_pessoa" id="cod_pessoa" value="<?php echo $cod_pessoa;?>" style="" readonly>
					<script src="php/autocomplete.php?tb=pessoas"></script>
					<div class=" uk-autocomplete uk-width-3-4" data-uk-autocomplete="{source:filtro_pessoas}" style="">
						<input class="uk-form-small" type="text" name="nome_razao_social" id="nome_razao_social" value="<?php echo $contribuinte;?>" style="width: 100%;" <?php echo $disabled;?>>
						<script type="text/autocomplete">
							<ul class="uk-nav uk-nav-autocomplete uk-autocomplete-results">
								{{~items}}
								<li data-value="{{ $item.value }}">
									<a onclick="selecionarpessoa('{{ $item.id }}','{{ $item.value }}','cod_pessoa','nome_razao_social');">
										{{ $item.value }}
									</a>
								</li>
								{{/items}}
							</ul>
						</script>
					</div>
				</div>

		</div>
		<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2">
				<label class="uk-form-label" for="xxx">Colaborador</label>
				<div class="uk-grid" style="margin-left: 0px;">
					<input class="uk-form-small uk-width-1-4" type="text" name="cod_colaborador" id="cod_colaborador" value="<?php echo $cod_colaborador;?>" style="" readonly>
					<script src="php/autocomplete.php?tb=colaboradores"></script>
					<div class=" uk-autocomplete uk-width-3-4" data-uk-autocomplete="{source:filtro_colaboradores}" style="">
						<input class="uk-form-small" type="text" name="colaborador" id="colaborador" value="<?php echo $colaborador;?>" style="width: 100%;" <?php echo $disabled;?>>
						<script type="text/autocomplete">
							<ul class="uk-nav uk-nav-autocomplete uk-autocomplete-results">
								{{~items}}
								<li data-value="{{ $item.value }}">
									<a onclick="selecionarpessoa('{{ $item.id }}','{{ $item.value }}','cod_colaborador','colaborador');">
										{{ $item.value }}
									</a>
								</li>
								{{/items}}
							</ul>
						</script>
					</div>
				</div>

		<?php 
		//		$campos_select->select_colaborador($cod_colaborador);
		?>
		</div>


		<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1">
		<?php 
				$campos_select->select_ctrreceita($cod_ctrreceita);
		?>
		</div>


		<div class="uk-width-1-1">
			<div class="uk-grid">
				<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-4">
					<?php
					//carta_aberta
						$campos_select->select_carta_aberta($carta_aberta);
					?>
				</div>
				<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-4">
				<?php 
					//periodicidade
						$campos_select->select_periodicidade($periodicidade);
				?>
				</div>
				<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-4">
				<?php 
					//carta_dia_debito
						$campos_select->select_dia_debito($carta_dia_debito);
				?>
				</div>
				<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-4">
					<?php
					//moeda
						$campos_select->select_moeda($cod_moeda);
					?>
				</div>
			</div>
		</div>

	</div>
	<div class="uk-grid">
		<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3">
			<div class="uk-grid">
				<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2">
				<?php 
					//carta_data_inicio
						$campos_inputs->input_form_row($carta_data_inicio,'carta_data_inicio','Inicio','00/00/0000',"onkeyup=javascript:formatar_data(this); data-uk-datepicker={format:'DD/MM/YYYY'}  ".$disabled);
				?>
				</div>
				<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2">
				<?php 
					//carta_data_fim
						$campos_inputs->input_form_row($carta_data_fim,'carta_data_fim','Fim','00/00/0000',"onkeyup=javascript:formatar_data(this); data-uk-datepicker={format:'DD/MM/YYYY'} ".$disabled);
				?>
				</div>
			</div>
		</div>
		<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3">
		<?php 
			//carta_qtd_moeda
				$campos_inputs->input_form_row($carta_qtd_moeda,'carta_qtd_moeda','Quantidade','0,00','onkeyup=javascript:calculartotalcarta(); '.$disabled);
		?>
		</div>
		<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3">
		<?php 
			//carta_valor_moeda
				$campos_inputs->input_form_row($carta_valor_moeda,'carta_valor_moeda','Total','0,00',' readonly '.$disabled);
		?>
		</div>
	</div>

	<div class="uk-grid">
		<div class="uk-width-1-3 uk-width-small-1-3 uk-width-medium-1-3 uk-width-large-1-4">
			<?php
			//carta_forma_pagamento
				$campos_select->select_tipo_convenios($tipo_convenio);
			?>
		</div>
		<div class="uk-width-2-3 uk-width-small-2-3 uk-width-medium-2-3 uk-width-large-3-4">
		<?php 
			//debito_banco
				$campos_select->select_bancos($cod_banco);
		?>
		</div>
	</div>
	<div class="uk-grid">
		<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3">
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
		<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-2-3 uk-width-large-2-3">
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
	</form>

	<hr class="uk-article-divider">
	<div class="uk-grid">


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



