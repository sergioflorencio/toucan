<div class="uk-grid">	
	<div class="uk-width-1-2">

		<div class="uk-grid">	
			<div class="uk-width-1-1">
				<div class="uk-panel uk-panel-box">
					<h3 class="uk-panel-title"><i class="uk-icon-file"></i> Resumo do Projeto</h3>
					<form action="#" method="post" class="uk-form" id="form_cadastro">
					
						<div class="uk-form-row uk-width-1-4">
							<div class="uk-grid">
								<div class="uk-width-1-2">
									<?php 
										$inputs->input_form_row($cod_projeto,'cod_projeto','cod_projeto','',' readonly');
									?>
								</div>
							</div>
						</div>
						<div class="uk-form-row">
							<div class="uk-grid">	

								<div class="uk-width-1-4">
									<?php 
										$inputs->input_form_row($numero_projeto,'numero_projeto','numero_projeto','','');
									?>
								</div>
								<div class="uk-width-3-4">
									<?php 
										$inputs->input_form_row($nome_projeto,'nome_projeto','nome_projeto','','');
									?>
								</div>
							</div>
						</div>
						<div class="uk-form-row">
							<div class="uk-grid">	
								<div class="uk-width-1-6">
									<?php 
										$inputs->input_form_row($data_inicio,'data_inicio','data_inicio','','');
									?>
								</div>
								<div class="uk-width-1-6">
									<?php 
										$inputs->input_form_row($data_fim,'data_fim','data_fim','','');
									?>
								</div>
								<div class="uk-width-1-6">
									<?php 
										$selects->cod_status_projeto($cod_status_projeto,'Status');
									?>
								</div>
							</div>
						</div>
						<div class="uk-form-row">
							<div class="uk-grid">	
								<div class="uk-width-1-1">
									<textarea name="decricao" id="decricao" style="width: 100%; min-height: 150px;"><?php echo $decricao; ?></textarea>						
								</div>

							</div>
						</div>

					</form>
				</div>	
			</div>	
			<div class="uk-width-1-1">
				<div class="uk-panel uk-panel-box">
					<h3 class="uk-panel-title"><i class="uk-icon-paperclip"></i> Anexos</h3>
					<?php 
						if(isset($_GET['id']) and $_GET['id']!='novo'){ 
								$html=new html;
								$html->listar_anexos($_GET['id']);
						}
					?>
					
						<script>
							function getFile(){
							document.getElementById('file').click();
							}
							function enviar_arquivo(){
								document.getElementById('form_anexos').submit();
								
							}
						</script>
											
				</div>
			</div>
		</div>	
	
	


						
					

	
	</div>
	<div class="uk-width-1-2">
		<div class="uk-grid">	
			<div class="uk-width-1-1">
				<div class="uk-panel uk-panel-box">
					<a href="#" class="uk-button"><i class="uk-icon-area-chart"></i> abrir orçamento do projeto</a>
				</div>	

			</div>
			<div class="uk-width-1-1">
				<div class="uk-panel uk-panel-box">
				<h3 class="uk-panel-title"><i class="uk-icon-sitemap"></i> Centros de Custo do projeto</h3>
				<div id='msg'></div>
				<?php
					$html->cad_centro_custo($cod_projeto);
				?>
				<script>
					$('tbody tr').click(function(){ 
							//mudar status
							if(this.getElementsByTagName('input')[0].disabled==false){
								
								if(this.getElementsByTagName('input')[0].checked==true){
										this.getElementsByTagName('input')[0].checked=false;}
								else{
										this.getElementsByTagName('input')[0].checked=true;
									}
							
							}
							
							//enviar
							//id_responseText="msg";
							id_responseText="";
							metodo="POST";
							url="php/atualizar_cad_projeto_centro_custo.php";
							var formData = new FormData();
								formData.append("cod_projeto",document.getElementById("cod_projeto").value );
								formData.append("cod_centro_custo",this.id );
								formData.append("status",this.getElementsByTagName('input')[0].checked );
							ajax(id_responseText, metodo, url,formData,'');	
											
					});
				
				
				</script>
				
				
				</div>	
		
			</div>
		</div>

	
	
	
	</div>
</div>










