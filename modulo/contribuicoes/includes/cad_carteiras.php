
<form class='uk-form' action='#' method='POST'>
	<div class="uk-panel uk-panel-box  uk-width-small-1-1 uk-width-medium-4-5 uk-width-large-3-5 uk-container-center uk-text-center">
		<div style="text-align: left;">
			<div class='uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row'>
					<div class="uk-grid">
						<div class="uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-2-10">
							<label class='uk-form-label' for='cod_carteira'>Cod.Carteira</label>
							<input class="uk-form-small"  type='text' name='cod_carteira'  id='cod_carteira' style='width: 100%;' value='<?php echo $cod_carteira; ?>' readonly>
						</div>
						<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1">
							<label class='uk-form-label' for='nome_carteira'>Nome da Carteira</label>
							<input class="uk-form-small"  type='text' name='nome_carteira'  id='nome_carteira' style='width: 100%;' value='<?php echo $nome_carteira; ?>'>
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

