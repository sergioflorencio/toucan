		
				
<?php

	session_start();
	/*include ('sanitize.php');*/
	include ('login.php');
	/* Create object based on Login Class */
	$auth = new Login();
	/* Fetch session ID and insert into $session */
	$session=session_id();
	/* Fetch IP of client. This is repeated code */
	$ip = $_SERVER['REMOTE_ADDR'];
	/* Below will check session authentication */
	$logincheck=$auth->checkAuthorized($session, $ip);
	if ($logincheck) // Condition if session already there prevent viewing login form
	{
		header("Location:index.php"); // redirect to user page
	}else{
	
	}

	if (isset($_SESSION['logged'])){
		if ($_SESSION['logged']==true) // Condition if session already there prevent viewing login form
		{
			header("Location:../index.php"); // redirect to user page
		}
	 }

?>





<head>
<title></title>
	<link rel="stylesheet" href="../js/uikit/css/uikit.css">
	<link rel="stylesheet" href="../js/uikit/css/uikit.avenue.css">
	<script src="../js/uikit/js/jquery.js"></script>
	<script src="../js/uikit/js/uikit.min.js"></script>
</head>
<body>	
			<div class=" uk-container-center " style="margin-top: 10%;width:300px">
				<div class="  tm-grid-block uk-panel-box ">
					<h1>Bem vindo!</h1>
					<form action="index.php" method="post" id="form-login" class="form-inline">

						<fieldset data-uk-margin="">

							<legend>Digite seus dados de acesso</legend>
							<div class="uk-form-row uk-margin-small-top">
								<input type="text" id="username" name="username" style="width:100%" class="uk-margin-small-top" placeholder="username">
							</div>
							<div class="uk-form-row uk-margin-small-top">	
								<input type="password" id="password" name="password" style="width:100%;" class="uk-margin-small-top" placeholder="Senha">
							</div>
							<div class="uk-form-row uk-margin-small-top">	
								<input type="submit" class="uk-button" value="Acessar">
							</div>
						</fieldset>

					</form>
				</div>
			</div>
		
			
			
			
			</body>





































<?php
// Form processing engine goes here!
if (isset($_POST) and isset($_POST['username']) and isset($_POST['password']) ) {
    $login = new Login();
    $status = $login->checkLogin($_POST['username'], $_POST['password']);
    if ($status) {
        header("Location:../index.php");
    } else {
      //  header("Location:index.php");
        exit();
    }
} else {
    exit();
}

?>
				