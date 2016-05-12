<div class="uk-grid">	
	<div class="uk-width-1-2">

		<div class="uk-grid">	
			<div class="uk-width-1-1">
				<div class="uk-panel uk-panel-box">
					<h3 class="uk-panel-title"><i class="uk-icon-area-chart"></i> Cadastro de orçamento</h3>
					<form action="#" method="post" class="uk-form" id="form_cadastro">
					
						<div class="uk-form-row uk-width-1-4">
							<div class="uk-grid">
								<div class="uk-width-1-2">
									<?php 
										$inputs->input_form_row($cod_orcamento,'cod_orcamento','cod_orcamento','',' readonly');
									?>
								</div>
							</div>
						</div>

						<div class="uk-form-row">
							<div class="uk-grid">	
								<div class="uk-width-1-2">
									<div class="uk-grid">	
										<div class="uk-width-1-1">
											<?php 
												$selects->cod_projeto($cod_projeto,'cod_projeto')
											?>
										</div>							
									</div>
								</div>

								<div class="uk-width-1-2">
									<div class="uk-grid">	
				
										<div class="uk-width-1-2">
											<?php 
												$inputs->input_form_row($data_inicio,'data_inicio','data_inicio','','');
											?>
										</div>
										<div class="uk-width-1-2">
											<?php 
												$inputs->input_form_row($data_fim,'data_fim','data_fim','','');
											?>
										</div>
									</div>
								</div>

							</div>
						</div>

					</form>
				</div>	
			</div>	
		</div>	
	
	


						
					

	
	</div>

	</div>










