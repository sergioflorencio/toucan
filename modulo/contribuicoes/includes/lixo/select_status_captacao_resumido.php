<?php
					$select_option= "
								SELECT 
									status_resumido

								FROM 
									nico.cad_status

								WHERE
									tabela='captacao_cartas_cod_retorno'

								group by
									status_resumido

								;
							";
								
					$resultado_option=mysql_query($select_option,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='status_resumido' name='status_resumido' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($status_resumido) and $row_option['status_resumido']==$status_resumido){
								echo "<option value='".$row_option['status_resumido']."' selected >".$row_option['status_resumido']."</option>";
							}else{
								echo "<option value='".$row_option['status_resumido']."'>".$row_option['status_resumido']."</option>";
							}
						}	
					echo "</select>";
?>