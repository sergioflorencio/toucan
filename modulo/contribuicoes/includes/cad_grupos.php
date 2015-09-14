
<form class='uk-form' action='#' method='POST'>
	<div class="uk-panel uk-panel-box  uk-width-small-1-1 uk-width-medium-4-5 uk-width-large-3-5 uk-container-center uk-text-center">
		<div style="text-align: left;">
			<div class='uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row'>
					<div class="uk-grid">
						<div class="uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-2-10">
							<label class='uk-form-label' for='cod_grupo'>Cod.Grupo</label>
							<input class="uk-form-small"  type='text' name='cod_grupo'  id='cod_grupo' style='width: 100%;' value='<?php echo $cod_grupo; ?>' readonly>
						</div>
						<div class="uk-width-small-2-3 uk-width-medium-3-4 uk-width-large-8-10">
							<label class='uk-form-label' for='nome_grupo'>Nome do Grupo</label>
							<input class="uk-form-small"  type='text' name='nome_grupo'  id='nome_grupo' style='width: 100%;' value='<?php echo $nome_grupo; ?>'>
						</div>
						<div class="uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2">
							<?php $selects=new selects; $selects->select_campanhas($cod_campanha);?>						</div>
						<div class="uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2">
							<?php $selects=new selects; $selects->select_centros($cod_centro);?>
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



		