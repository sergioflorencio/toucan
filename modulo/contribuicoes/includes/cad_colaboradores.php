
<form class='uk-form' action='#' method='POST'>
	<div class="uk-panel uk-panel-box  uk-width-small-1-1 uk-width-medium-4-5 uk-width-large-3-5 uk-container-center uk-text-center">
		<div style="text-align: left;">
			<div class='uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row'>
					<div class="uk-grid">
						<div class="uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-2-10">
							<label class='uk-form-label' for='cod_colaborador'>cod_colaborador</label>
							<input class="uk-form-small"  type='text' name='cod_colaborador'  id='cod_colaborador' style='width: 100%;' value='<?php echo $cod_colaborador; ?>' readonly>
						</div>
						<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1">
							<?php $selects=new selects; $selects->select_pessoas($cod_pessoa);?>
						</div>
						<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1">
							<?php $selects=new selects; $selects->select_grupos($cod_grupo);?>
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
