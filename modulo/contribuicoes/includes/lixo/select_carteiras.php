<?php
					$select_option= "
							select 
								* 
								
							from 
								nico.cad_carteiras
								
							
							group by 
								`nome_carteira`
							order by 
								`nome_carteira`
								
								;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='cod_carteira' name='cod_carteira' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_carteira) and $row_option['cod_carteira']==$cod_carteira){
								echo "<option value='".$row_option['cod_carteira']."' selected >".$row_option['nome_carteira']."</option>";
							}else{
								echo "<option value='".$row_option['cod_carteira']."'>".$row_option['nome_carteira']."</option>";
							}
						}	
					echo "</select>";
?>