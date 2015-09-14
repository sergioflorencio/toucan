<?php
					$select_cad_pessoas= "
							select 
								* 
								
							from 
								nico.cad_pessoas
								
							
							group by 
								`nome_razao_social`
							order by 
								`nome_razao_social`
								
								;";
								
					$resultado_cad_pessoas=mysql_query($select_cad_pessoas,$conexao) or die ("nao foi possivel conectar");
					echo "<select class='uk-form-small' id='cod_pessoa' name='cod_pessoa' style='width: 100%;'>";
					echo "<option value=''></option>";
						while($row_cad_pessoas = mysql_fetch_array($resultado_cad_pessoas))
						{
						
						if(isset($cod_pessoa) and $row_cad_pessoas['cod_pessoa']==$cod_pessoa){
								echo "<option value='".$row_cad_pessoas['cod_pessoa']."' selected >".$row_cad_pessoas['nome_razao_social']."</option>";
							}else{
								echo "<option value='".$row_cad_pessoas['cod_pessoa']."'>".$row_cad_pessoas['nome_razao_social']."</option>";
							}
						}	
					echo "</select>";
?>