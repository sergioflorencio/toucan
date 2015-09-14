<?php
session_start();
include ('../php/config.php');
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
    header("Location:../index.php"); // redirect to user page
}
?>
<!DOCTYPE html>
<head>
    <script type="text/javascript">
        function loginShow(show)
        {
            if(show==true)
            {
                document.getElementById(login-div).style.display = ""
            }
            else
            {
                document.getElementById(login-div).style.display = "none"
            }
        }
    </script>
    <style>
        div#login
        {
            width : 400px;
            height: 150px;
            margin: 20% auto;
            border:thin dotted gray;
        }
        input[type=text], input[type=password]
        {
            text-align: center;
            width:250px;
        }
        input[type=submit]
        {
            width:80px;
        }
        div#login p
        {
            margin:5px auto;
            text-align: center;
        }
    </style>
</head>
<html>
    <body>
        <div id="logindiv">
            <div id="login">
                <form method="POST" name="login" action="loginform.php" id="login">
                    <p>Username</p>
                    <p><input type="text" id="username" name="username"/></p>
                    <p>Password</p>
                    <p><input type="password" id="password" name="password"/></p>
                    <p><input type="submit" name="logged" id="logged" value="Login"/></p>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
// Form processing engine goes here!
if ($_POST) {
    extract($_POST);
    $login = new Login();
    $status = $login->checkLogin($username, $password);

    if (!$status) {
        echo "<script>loginShow('true')</script>";
    } else {
        header("Location:../index.php");
        exit();
    }
} else {
    echo "<script>loginShow(true)</script>";
}
?>