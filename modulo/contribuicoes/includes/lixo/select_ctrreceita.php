<?php
					$select_option= "
							select 
								* 
								
							from 
								nico.cad_ctrreceitas
								
							where 
								analitico_sintetico='analitico' and 
								status=1 
								
							order by 
								`nome`;";
								
					$resultado_option=mysql_query($select_option,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='cod_ctrreceita' name='cod_ctrreceita' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_option = mysql_fetch_array($resultado_option))
						{
						
						if(isset($cod_ctrreceita) and $row_option['cod_ctrreceita']==$cod_ctrreceita){
								echo "<option value='".$row_option['cod_ctrreceita']."' selected >".$row_option['nome']."</option>";
							}else{
								echo "<option value='".$row_option['cod_ctrreceita']."'>".$row_option['nome']."</option>";
							}
						}	
					echo "</select>";
?>