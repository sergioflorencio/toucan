<?php
					$select_option= "
							select 
								* 
								
							from 
								nico.cad_grupos
								
							
							group by 
								`nome_grupo`
							order by 
								`nome_grupo`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='cod_grupo' name='cod_grupo' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_grupo) and $row_option['cod_grupo']==$cod_grupo){
								echo "<option value='".$row_option['cod_grupo']."' selected >".$row_option['nome_grupo']."</option>";
							}else{
								echo "<option value='".$row_option['cod_grupo']."'>".$row_option['nome_grupo']."</option>";
							}
						}	
					echo "</select>";
?>