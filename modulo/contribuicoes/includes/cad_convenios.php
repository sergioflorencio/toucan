
<form class='uk-form' action='#' method='POST'>
	<div class="uk-panel uk-panel-box  uk-width-small-1-1 uk-width-medium-4-5 uk-width-large-3-5 uk-container-center uk-text-center">
		<div style="text-align: left;">
			<div class='uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row'>
					<div class="uk-grid">
						<div class="uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-2-10">
							<label class='uk-form-label' for='cod_convenio'>Cod.Convenio</label>
							<input class="uk-form-small"  type='text' name='cod_convenio'  id='cod_convenio' style='width: 100%;' value='<?php echo $cod_convenio; ?>' readonly>
						</div>
						<div class="uk-width-small-2-3 uk-width-medium-3-4 uk-width-large-8-10">
							<label class='uk-form-label' for='codigo_convenio'>Numero do convênio bancário</label>
							<input class="uk-form-small"  type='text' name='codigo_convenio'  id='codigo_convenio' style='width: 100%;' value='<?php echo $codigo_convenio; ?>'>
						</div>
						<div class="uk-width-small-1-2 uk-width-medium-2-4 uk-width-large-3-10">
							<?php $selects=new selects; $selects->select_tipo_convenios($tipo_convenio);?>	
						</div>
						<div class="uk-width-small-1-2 uk-width-medium-2-4 uk-width-large-7-10">
							<?php $selects=new selects; $selects->select_bancos($cod_banco);?>	
						</div>
						<div class="uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-2-10">
							<label class='uk-form-label' for='agencia'>agencia</label>
							<input class="uk-form-small"  type='text' name='agencia'  id='agencia' style='width: 100%;' value='<?php echo $agencia; ?>'>
						</div>
						<div class="uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-6-10">
							<label class='uk-form-label' for='conta'>conta</label>
							<input class="uk-form-small"  type='text' name='conta'  id='conta' style='width: 100%;' value='<?php echo $conta; ?>'>
						</div>
						<div class="uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-2-10">
							<label class='uk-form-label' for='ultimo_lote'>ultimo_lote</label>
							<input class="uk-form-small"  type='text' name='ultimo_lote'  id='ultimo_lote' style='width: 100%;' value='<?php echo $ultimo_lote; ?>'>
						</div>
						<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1">
							<?php $selects=new selects; $selects->select_carteiras($cod_carteira);?>
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


				