<?php
	if(intval($_GET['id'])>0){
		$disabled=" disabled ";
	}else{
		$disabled="  ";
	}

?>




<?php
	$lancamento=new lancamento;
	$lancamento->listar_cad_documento_item($id);

?>
<hr class="uk-article-divider" style="margin-bottom: 10px;">


	<div class="">
		<div class=" uk-tab-flip">	
			<form class="uk-form">
				<div class="uk-grid">			
					<span class="uk-form-controls-condensed uk-width-1-5 uk-push-4-5" style="text-align: right;max-width: 230px !important;min-width: 120px !important;">
						Total de Débitos 
						<input id="debito" class=" uk-form-small" style="width: 100px;text-align: right;" value="" type="text" disabled>
					</span>
					<span class="uk-form-controls-condensed uk-width-1-5 uk-push-2-5" style="text-align: right;max-width: 230px !important;min-width: 120px !important;">
						Total de Créditos 
						<input id="credito" class=" uk-form-small" style="width: 100px;text-align: right;" value="" type="text" disabled>
					</span>
				</div>
				
			</form>
		</div>
	</div>
	<hr class="uk-article-divider" >	






