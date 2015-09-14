
					<div class='uk-panels uk-width-1-3 uk-panels uk-width-1-3 uk-panel-box tm-top-a  tm-grid-block tm-grid-block' style="min-width: 350px;">
					<form class='uk-form' action='#' method='POST'>
					<h3>Cadastro de usuarios</h3>
						<hr class='uk-article-divider'>	
							<div  class='uk-width-1-1' id='div_msg'></div>
							<div class='uk-form-row uk-grid'>
								<div class='uk-width-1-4'>
									<label class='uk-form-label' for='cod_usuario'>cod_usuario</label>
									<input class="uk-form-small"  type='text' name='cod_usuario'  id='cod_usuario' style='width: 100%;' value='<?php echo $cod_usuario; ?>' readonly>
								</div>
								<div class='uk-width-3-4'>
									<label class='uk-form-label' for='nome'>Nome</label>
									<input class="uk-form-small"  type='text' name='nome'  id='nome' style='width: 100%;' value='<?php echo $nome; ?>'>
								</div>
							</div>

							<div class='uk-form-row uk-grid'>
								<div class='uk-width-2-4'>
									<label class='uk-form-label' for='username'>username</label>
									<input class="uk-form-small"  type='text' name='username'  id='username' style='width: 100%;' value='<?php echo $username; ?>'>
								</div>
								<div class='uk-width-2-4'><br>
									<a class='uk-button uk-button-small uk-button-primary' onclick='gerar_senha();' style='width: 100%;'><i class='uk-icon-save'></i> Gerar senha</a>
								</div>
							</div>
							<div class='uk-form-row'>
									<label class='uk-form-label' for='email'>email</label>
									<input class="uk-form-small"  type='text' name='email'  id='email' style='width: 100%;' value='<?php echo $email; ?>'>

							</div>
							<div class='uk-form-row'>
									<label class='uk-form-label' for='email'>Status</label>
									<select class="uk-form-small" name="status" id="status" style='width: 100%;'>
										<option value=""></option>
										<option value="A" <?php if($status=='A'){echo "selected";} ?>>Ativo</option>
										<option value="B" <?php if($status=='B'){echo "selected";} ?>>Bloqueado</option>
									</select>
							</div>
							<div class='uk-form-row'>
								<button class='uk-button uk-button-small uk-button-primary'><i class='uk-icon-save'></i>  Salvar</button>
							</div>
						</form>
					</div>
				