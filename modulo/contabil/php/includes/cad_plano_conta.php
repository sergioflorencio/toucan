<div class='uk-width-2-4' style=''>
<form action="#" method="post" class="uk-form" id="form_cadastro">

<div class="uk-grid" style="max-width: 650px;min-width: 500px;">




					<div class="uk-width-1-4">
						<div class="uk-grid">
							<div class="uk-width-1-2">
								<?php 
									$inputs->input_form_row($cod_plano_conta,'cod_plano_conta','cod_grupo_patrimonio','','readonly');
								?>
							</div>
						</div>
					</div>
					<div class="uk-width-1-1">
						<div class="uk-grid">	
							<div class="uk-width-2-3" >
								<?php 
									$inputs->input_form_row($descricao,'descricao','Descrição','','');
								?>
							</div>
							<div class="uk-width-1-3" >
								<?php 
									$selects->status($status,"Status");
								?>
							</div>
						</div>
					</div>


</div>

</form>








</div>