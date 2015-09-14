
<form class='uk-form' action='#' method='POST'>
	<div class="uk-panel uk-panel-box  uk-width-small-1-1 uk-width-medium-4-5 uk-width-large-3-5 uk-container-center uk-text-center">
		<div style="text-align: left;">
			<div class='uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row'>
					<div class="uk-grid">
						<div class="uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-2-10">
							<label class='uk-form-label' for='cod_campanha'>Cod.Campanha</label>
							<input class="uk-form-small"  type='text' name='cod_campanha'  id='cod_campanha' style='width: 100%;' value='<?php echo $cod_campanha; ?>' readonly>
						</div>
						<div class="uk-width-small-2-3 uk-width-medium-3-4 uk-width-large-4-10">
							<label class='uk-form-label' for='nome_campanha'>Nome da Campanha</label>
							<input class="uk-form-small"  type='text' name='nome_campanha'  id='nome_campanha' style='width: 100%;' value='<?php echo $nome_campanha; ?>'>
						</div>
						<div class="uk-width-small-1-2 uk-width-medium-2-4 uk-width-large-2-10">
							<label class='uk-form-label' for='data_inicio'>Data inicio</label>
							<input class="uk-form-small"  type='text' name='data_inicio'  id='data_inicio' style='width: 100%;' value='<?php echo $data_inicio; ?>'  data-uk-datepicker={format:'DD/MM/YYYY'}>
						</div>
						<div class="uk-width-small-1-2 uk-width-medium-2-4 uk-width-large-2-10">
							<label class='uk-form-label' for='data_fim'>Data fim</label>
							<input class="uk-form-small"  type='text' name='data_fim'  id='data_fim' style='width: 100%;' value='<?php echo $data_fim; ?>'  data-uk-datepicker={format:'DD/MM/YYYY'}>
						</div>
						<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1">
							<label class='uk-form-label' for='observacao'>Observação</label>
							<input class="uk-form-small"  type='text' name='observacao'  id='observacao' style='width: 100%;' value='<?php echo $observacao; ?>'>
						</div>
					</div>
			</div>
			<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row">
				<hr class="uk-grid-divider">
				<button class='uk-button uk-button-small uk-button-primary'><i class='uk-icon-save'></i>  Salvar</button>
			</div>
		</div>
	</div>
</form>	