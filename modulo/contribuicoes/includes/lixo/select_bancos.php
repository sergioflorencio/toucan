<?php
					$select_option= "
							select 
								* 
								
							from 
								nico.cad_bancos
								
							
							group by 
								`nome_banco`
							order by 
								`nome_banco`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='cod_banco' name='cod_banco' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_banco) and $row_option['cod_banco']==$cod_banco){
								echo "<option value='".$row_option['cod_banco']."' selected >".$row_option['nome_banco']."</option>";
							}else{
								echo "<option value='".$row_option['cod_banco']."'>".$row_option['nome_banco']."</option>";
							}
						}	
					echo "</select>"
?>