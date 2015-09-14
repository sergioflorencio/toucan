<?php
					$select_cad_campanhas= "
							select 
								* 
								
							from 
								nico.cad_campanhas
								
							
							group by 
								`nome_campanha`
							order by 
								`nome_campanha`
								
								;";
								
					$resultado_cad_campanhas=mysql_query($select_cad_campanhas,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small'id='cod_campanha' name='cod_campanha' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_cad_campanhas = mysql_fetch_array($resultado_cad_campanhas))
						{
						
						if(isset($cod_campanha) and $row_cad_campanhas['cod_campanha']==$cod_campanha){
								echo "<option value='".$row_cad_campanhas['cod_campanha']."' selected >".$row_cad_campanhas['nome_campanha']."</option>";
							}else{
								echo "<option value='".$row_cad_campanhas['cod_campanha']."'>".$row_cad_campanhas['nome_campanha']."</option>";
							}
						}	
					echo "</select>";
?>