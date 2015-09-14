<?php
					$select_option= "
							SELECT 
								cod_status,
								concat(status_resumido,' - ',descricao) as descricao

							FROM 
								nico.cad_status

							WHERE
								tabela='captacao_cartas_cod_retorno'

							ORDER BY
								cod_status

							;
							";
								
					$resultado_option=mysql_query($select_option,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='cod_status' name='cod_status' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_status) and $row_option['cod_status']==$cod_status){
								echo "<option value='".$row_option['cod_status']."' selected >".$row_option['descricao']."</option>";
							}else{
								echo "<option value='".$row_option['cod_status']."'>".$row_option['descricao']."</option>";
							}
						}	
					echo "</select>";
?>