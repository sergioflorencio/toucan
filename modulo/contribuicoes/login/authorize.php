<?php
session_start();

$session=session_id();
$ip = $_SERVER['REMOTE_ADDR'];

/* Create object based on Login Class */
$login = new Login();

/* Below will check and authenticate session and ip is valid */
$logincheck = $login->checkAuthorized($session, $ip);

if (!$logincheck) // Condition if login is not authentic or no session
{
    header("Location:index.php"); // redirect to login form
}
else // Condition if session is valid and good
{
    echo "<center>";
    echo "<h1>Session already valid. No need to login</h1>";
    echo "<a href='logout.php'>LOGOUT</a>";
    echo "</center>";
}    
?>