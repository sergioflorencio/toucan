	<div class="uk-panel uk-panel-box  uk-width-small-1-1 uk-width-medium-4-5 uk-width-large-3-5 uk-container-center uk-text-center">
		<div style="text-align: left;">
			<form class='uk-form' action='#' method='POST'>
			<div class='uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row'>
				<div class="uk-grid">
					<div class='uk-width-1-4'>
						<label class='uk-form-label' for='cod_moeda'>cod_moeda</label>
						<input class="uk-form-small"  type='text' name='cod_moeda'  id='cod_moeda' style='width: 100%;' value='<?php echo $cod_moeda; ?>' readonly>
					</div>
					<div class='uk-width-3-4'>
						<label class='uk-form-label' for='moeda'>moeda</label>
						<input class="uk-form-small"  type='text' name='moeda'  id='moeda' style='width: 100%;' value='<?php echo $moeda; ?>'>
					</div>
				</div>
			</div>
			<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row">
				<hr class="uk-grid-divider">
				<button class='uk-button uk-button-small uk-button-primary'><i class='uk-icon-save'></i>  Salvar</button>
			</div>
			</form>
			
			<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row" style="margin-top: 100px;">
						<hr class='uk-article-divider'>	
						<h3>Cotações da moeda</h3>
						<form class='uk-form' action='#' method='POST'>
						
							<div class='uk-form-row uk-grid'>
								<div class='uk-width-3-6' >
									<input class="uk-form-small"  type="date" style="width: 100%;"  name="novo_moeda_data" placeholder="Data 00/00/0000" id="novo_moeda_data" data-uk-datepicker="{format:'DD/MM/YYYY'}" name="data_inicio_de" id="data_inicio_de" value="01/01/1900" placeholder="00/00/0000" onkeyup="javascript:formatar_data(this);">
								</div>
								<div class='uk-width-2-6' >
									<input class="uk-form-small"  type="text" style="width: 100%;" onkeyup="formatar_decimal(this);" name="novo_moeda_valor" placeholder="Valor 00,00" id="novo_moeda_valor">
								</div>
								<div class='uk-width-1-6' >
									<button class='uk-button uk-button-small uk-button-primary' title="Incluir"><i class='uk-icon-plus-circle'></i></button>
									<input class="uk-form-small"  style="width: 0px;visibility: hidden;" type="text"  name="novo_cod_moeda" id="novo_moeda_data" value='<?php echo $cod_moeda; ?>'>
								</div>
							</div>
						</form>
						
						<div class='uk-form-row uk-grid'>
							<div class='uk-width-1-1'>
								<?php 
								
				$select= "
						select 
							cod_moedas_valores,
							DATE_FORMAT(data_inicio,'%d/%m/%Y') as data,
							valor
							
						from 
							".$schema.".cad_moedas_valores
						
						where 
							cod_moeda=".$cod_moeda."

						order by 
							data_inicio desc";

				$resultado=mysql_query($select,$conexao) or die ($select);
				
					echo "<table class='uk-table uk-table-hover uk-table-condensed'>";
					echo  
						"<tr>
							<th>Código</th>
							<th>Data Inicio</th>
							<th>Valor</th>
						</tr>";						
					$n=1;
					
					while($row = mysql_fetch_array($resultado))
					{
					echo  
						"<tr>
							<td>".$row['cod_moedas_valores']."</td>
							<td>".$row['data']."</td>
							<td>".$row['valor']."</td>
						</tr>";
						$n=$n+1;
					}	
					echo "</table>";
								
								
								?>
							</div>
						</div>





			</div>			
		</div>
	</div>

					
