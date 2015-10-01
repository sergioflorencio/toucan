<div class='uk-width-2-4' style=''>
<form action="#" method="post" class="uk-form" id="form_cadastro">

<div class="uk-grid" style="max-width: 650px;min-width: 500px;">




					<div class="uk-width-1-4">
						<div class="uk-grid">
							<div class="uk-width-1-2">
								<?php 
									$inputs->input_form_row($cod_conta,'cod_conta','Cod. Conta','','readonly');
								?>
							</div>
						</div>
					</div>
					<div class="uk-width-1-1">
						<div class="uk-grid">	
							<div class="uk-width-1-4" >
								<?php 
									$inputs->input_form_row($numero_conta_mae,'numero_conta_mae','Número Conta Mãe','','readonly');
								?>
							</div>						
							<div class="uk-width-3-4" >
								<?php 
									$inputs->input_form_row($descricao_conta_mae,'descricao_conta_mae','Descrição Conta Mãe','','readonly');
								?>
							</div>
							<div class="uk-width-1-4" >
								<?php 
									$inputs->input_form_row($numero_conta,'numero_conta','Número Conta','',' onchange=pesquisar_conta_mae(this); onkeyup=pesquisar_conta_mae(this);');
								?>
							</div>						
							<div class="uk-width-3-4" >
								<?php 
									$inputs->input_form_row($descricao,'descricao','Descrição','','');
								?>
							</div>
							<div class="uk-width-1-4" >
								<?php 
									$inputs->input_form_row($saldo_inicial,'saldo_inicial','Saldo inicial','','style=text-align:right; onchange=formatar_numero(this); onkeyup=formatar_numero(this);');
								?>
							</div>
							<div class="uk-width-1-4" >
								<?php 
									$inputs->input_form_row($saldo_atual,'saldo_atual','Saldo atual','','style=text-align:right; onchange=formatar_numero(this); onkeyup=formatar_numero(this);');
								?>
							</div>
							<div class="uk-width-1-4" >
								<?php 
									$selects->status($status,"Status");
								?>
							</div>
							<div class="uk-width-1-4" >
								<?php 
									$selects->cod_tipo_conta($cod_tipo_conta,'Tipo de conta');
								?>
							</div>							
						</div>
					</div>


</div>

</form>








</div>