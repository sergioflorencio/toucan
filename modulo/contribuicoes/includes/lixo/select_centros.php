<?php
					$select_cad_centros= "
							select 
								* 
								
							from 
								nico.cad_centros
								
							
							group by 
								`nome_centro`
							order by 
								`nome_centro`
								
								;";
								
					$resultado_cad_centros=mysql_query($select_cad_centros,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='cod_centro' name='cod_centro' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_cad_centros = mysql_fetch_array($resultado_cad_centros))
						{
						
						if(isset($cod_centro) and $row_cad_centros['cod_centro']==$cod_centro){
								echo "<option value='".$row_cad_centros['cod_centro']."' selected >".$row_cad_centros['nome_centro']."</option>";
							}else{
								echo "<option value='".$row_cad_centros['cod_centro']."'>".$row_cad_centros['nome_centro']."</option>";
							}
						}	
					echo "</select>";
?>