<?php
	$campos_select=new selects; 


?>
<div class=''  style="">
<form class='uk-form' action='#' method='POST'>

<div class="uk-panel uk-panel-box  uk-width-small-1-1 uk-width-medium-4-5 uk-width-large-4-5 uk-container-center uk-text-center">
<div style="text-align: left;">
    <div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row">
		<div class="uk-grid">
			<div class="uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-1-10">
								<label class='uk-form-label' for='Codigo Pessoa'>Código</label>
								<input class="uk-form-small"  type='text' name='cod_pessoa' id='cod_pessoa'  value='<?php echo $cod_pessoa; ?>' readonly>	
			</div>
			<div class="uk-width-small-2-3 uk-width-medium-3-4 uk-width-large-5-10">

								<label class='uk-form-label' for='Nome'>Nome ou Razao Social</label>
								<input class="uk-form-small"  type='text' name='nome_razao_social' id='nome_razao_social' style='width: 100%;' value='<?php echo $nome_razao_social; ?>'>
			</div>
			<div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-2-10">
						<label class='uk-form-label' for='cpf'>CPF</label>
						<input class="uk-form-small"  type='text' name='cpf' id='cpf'  style='width: 100%;' placeholder='000.000.000-00' value='<?php echo $cpf; ?>'>	

			</div>
			<div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-2-10">
						<label class='uk-form-label' for='cnpj'>CNPJ</label>
						<input class="uk-form-small"  type='text' name='cnpj' id='cnpj' style='width: 100%;' placeholder='00.000.000/0000-00' value='<?php echo $cnpj; ?>'>

			</div>
		</div>
	</div>
    <div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row">
		<div class="uk-grid">
			<div class="uk-width-small-1-1 uk-width-medium-3-5 uk-width-large-3-10">
						<label class='uk-form-label' for='Endereco'>Endereço</label>
						<input class="uk-form-small"  type='text' name='endereco'  id='endereco' style='width: 100%;' value='<?php echo $endereco; ?>'>

			</div>
			<div class="uk-width-small-1-3 uk-width-medium-1-5 uk-width-large-1-10">
							<label class='uk-form-label' for='Numero'>Número</label>
							<input class="uk-form-small"  type='text' name='numero' id='numero' style='width: 100%;' value='<?php echo $numero; ?>'>

			</div>
			<div class="uk-width-small-2-3 uk-width-medium-1-5 uk-width-large-1-10">
							<label class='uk-form-label' for='Complemento'>Complemento</label>
							<input class="uk-form-small"  type='text' name='complemento' id='complemento' style='width: 100%;' value='<?php echo $complemento; ?>'>

			</div>
			<div class="uk-width-small-1-1 uk-width-medium-3-10 uk-width-large-1-10">
							<label class='uk-form-label' for='CEP'>CEP</label>
							<input class="uk-form-small"  type='text' name='cep' id='cep' style='width: 100%;' value='<?php echo $cep; ?>'>

			</div>
			<div class="uk-width-small-1-1 uk-width-medium-3-10 uk-width-large-1-10">
							<label class='uk-form-label' for='bairro'>Bairro</label>
							<input class="uk-form-small"  type='text' name='bairro' id='bairro' style='width: 100%;' value='<?php echo $bairro; ?>'>

			</div>
			<div class="uk-width-small-3-4 uk-width-medium-3-10 uk-width-large-2-10">
							<label class='uk-form-label' for='Cidade'>Cidade</label>
							<input class="uk-form-small"  type='text' name='cidade' id='cidade' style='width: 100%;' value='<?php echo $cidade; ?>'>

			</div>
			<div class="uk-width-small-1-4 uk-width-medium-1-10 uk-width-large-1-10">
							<label class='uk-form-label' for='UF'>UF</label>
							<input class="uk-form-small"  type='text' name='uf' id='uf' style='width: 100%;' value='<?php echo $uf; ?>'>

			</div>
		</div>
	</div>
    <div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row">
		<div class="uk-grid">
			<div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-3-10">
						<label class='uk-form-label' for='Email'>E-mail</label>
						<div class='uk-form-icon' style='width: 100%;'>
							<i class='uk-icon-envelope-o'></i>
							<input class="uk-form-small"  type='text' style='width: 100%;' name='email_1' id='email_1' value='<?php echo $email_1; ?>'>
						</div>
			</div>
			<div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-3-10">
						<label class='uk-form-label' for='Email'>E-mail</label>
						<div class='uk-form-icon' style='width: 100%;'>
							<i class='uk-icon-envelope-o'></i>
							<input class="uk-form-small"  type='text' style='width: 100%;' name='email_2' id='email_2' value='<?php echo $email_2; ?>'>
						</div>
			</div>
			<div class="uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-10">
							<label class='uk-form-label' for='Telefone1'>Telefone 1</label>
							<div class='uk-form-icon' style='width: 100%;'>
								<i class='uk-icon-phone'></i>
								<input class="uk-form-small"  type='text' name='telefone_1' id='telefone_1' style='width: 100%;' value='<?php echo $telefone_1; ?>'>
							</div>
			</div>
			<div class="uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-10">
							<label class='uk-form-label' for='Telefone2'>Telefone 2</label>
							<div class='uk-form-icon' style='width: 100%;'>
								<i class='uk-icon-phone'></i>
								<input class="uk-form-small"  type='text' name='telefone_2' id='telefone_2' style='width: 100%;' value='<?php echo $telefone_2; ?>'>
							</div>
			</div>
			<div class="uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-10">
							<label class='uk-form-label' for='Celular1'>Celular 1</label>
							<div class='uk-form-icon' style='width: 100%;'>
								<i class='uk-icon-phone'></i>
								<input class="uk-form-small"  type='text' name='celular_1' id='celular_1' style='width: 100%;' value='<?php echo $celular_1; ?>'>
							</div>
			</div>
			<div class="uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-10">
							<label class='uk-form-label' for='Celular2'>Celular 2</label>
							<div class='uk-form-icon' style='width: 100%;'>
								<i class='uk-icon-phone'></i>
								<input class="uk-form-small"  type='text' name='celular_2' id='celular_2' style='width: 100%;' value='<?php echo $celular_2; ?>'>
							</div>
			</div>

		</div>
	</div>
    <div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3 uk-form-row">
		<div class="uk-grid">
			<div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3">
								<?php 
									$campos_select->select_pessoa_juridica_fisica($pessoa_juridica_fisica);
								?>
			</div>
			<div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3">
								<?php 
									$campos_select->select_manter_contato($manter_contato);
								?>
			</div>
			<div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3">
								<?php 
									$campos_select->select_mandar_newsletter($mandar_newsletter);
								?>
			</div>

			<div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3">
			
			</div>
		</div>
	</div>	
	<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-form-row">
		<hr class="uk-grid-divider">
		<button class='uk-button uk-button-small uk-button-primary'><i class='uk-icon-save'></i>  Salvar</button>
		<?php 
			if($cod_pessoa!=''){
			?>
				<span class='uk-button uk-button-small uk-button-danger uk-navbar-flip' onclick="excluir('cad_pessoas','cod_pessoa',<?php echo  $cod_pessoa; ?>);"><i class='uk-icon-trash'></i>  Excluir</span>
				<div id='msg'></div>
			
			<?php	
			}
		?>

	</div>

</div>
</div>


</form>
</div>

