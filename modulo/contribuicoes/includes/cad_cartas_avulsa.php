<div style="max-width: 600px; padding: 45px 10px 10px; border-right: 1px solid rgb(204, 204, 204); margin-top: -45px;">
<h3><i class="uk-icon-edit"></i> Dados da carta</h3>
<div>
	<form class='uk-form' action='#' method='POST' id='form_carta'>
	<div class="uk-grid">
		<div class='uk-button-group uk-navbar-flip' style="">
		<?php
			if(isset($_GET['id'])){
				$button=new button; $button->cancelar_carta($cod_carta,"doacoes_avulsas.php");
				$button=new button; $button->renovar_carta($cod_carta);
			}								
		?>					
		</div>
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
				<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3">
				<?php 
						$campos_select->select_status_carta($status_carta);
				?>
				</div>
				<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3">
				<?php 
						$campos_select->select_status_captacoes($status_captacoes);
				?>
				</div>
				<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3">
				<?php 
						$campos_select->select_motivo_cancelamento($cod_motivo_cancelamento);
				?>
				</div>			
			</div>
		</div>

	</div>
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<div class="uk-grid">
				<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2">
					<div class="uk-form-row">
						<label class="uk-form-label" for="xxx">Contribuinte</label>
						<div>
							<input class="uk-form-small" type="text" name="cod_pessoa" id="cod_pessoa" value="<?php echo $cod_pessoa;?>" style="width: 20%;" readonly>
							<script src="php/autocomplete.php?tb=pessoas"></script>
							<div class=" uk-autocomplete uk-form" data-uk-autocomplete="{source:filtro_pessoas}" style="width: 75%">
								<input class="uk-form-small" type="text" name="nome_razao_social" id="nome_razao_social" value="<?php echo $contribuinte;?>" style="width: 100%;" >
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
				</div>
				<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2">
					<div class="uk-form-row">
						<label class="uk-form-label" for="xxx">Colaborador</label>
						<div>
							<input class="uk-form-small" type="text" name="cod_colaborador" id="cod_colaborador" value="<?php echo $cod_colaborador;?>" style="width: 20%;" readonly>
							<script src="php/autocomplete.php?tb=colaboradores"></script>
							<div class=" uk-autocomplete uk-form" data-uk-autocomplete="{source:filtro_colaboradores}" style="width: 75%">
								<input class="uk-form-small" type="text" name="colaborador" id="colaborador" value="<?php echo $colaborador;?>" style="width: 100%;" >
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
					</div>
				<?php 
				//		$campos_select->select_colaborador($cod_colaborador);
				?>
				</div>
			</div>
		</div>
	</div>
	<div class="uk-grid">
		<div class="uk-width-3-5">
		<?php 
				$campos_select->select_ctrreceita($cod_ctrreceita);
		?>
		</div>

		<div class="uk-width-2-5">
			<?php
			//moeda
				$campos_select->select_moeda($carta_moeda);
			?>
		</div>	
		<div class="uk-width-1-3">
				<?php 
					//carta_data_inicio
						$campos_inputs->input_form_row($carta_data_inicio,'carta_data_inicio','Data','00/00/0000',"data-uk-datepicker={format:'DD/MM/YYYY'} onkeyup=javascript:formatar_data(this);");
				?>
		</div>	
		<div class="uk-width-1-3">
		<?php 
			//carta_qtd_moeda
				$campos_inputs->input_form_row($carta_qtd_moeda,'carta_qtd_moeda','Valor','0,00','onkeyup=javascript:calculartotalcarta();');
		?>
		</div>
		<div class="uk-width-1-3">
		<?php 
			//carta_valor_moeda
				$campos_inputs->input_form_row($carta_valor_moeda,'carta_valor_moeda','Total','0,00',' readonly ');
		?>
		</div>
	</div>

	</form>
	<hr class="uk-article-divider">
</div>
<div>
	<?php
	if(isset($_GET['id']) and $_GET['id']!='novo'){ 
		$captacoes=new tabelas; 
		$captacoes->listar_captacoes_carta_();
	}							

	?>
</div>	

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



