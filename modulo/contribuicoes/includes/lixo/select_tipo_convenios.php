<?php
					$select_option= "
							select 
								* 
								
							from 
								nico.cad_tipo_convenio
								
							
							group by 
								`tipo_convenio`
							order by 
								`tipo_convenio`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='tipo_convenio' name='tipo_convenio' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($tipo_convenio) and $row_option['tipo_convenio']==$tipo_convenio){
								echo "<option value='".$row_option['tipo_convenio']."' selected >".$row_option['tipo_convenio']."</option>";
							}else{
								echo "<option value='".$row_option['tipo_convenio']."'>".$row_option['tipo_convenio']."</option>";
							}
						}	
					echo "</select>";
?>