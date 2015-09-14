<?php
session_start();

$ip = $_SERVER['REMOTE_ADDR'];
include ('../php/config.php');
require('login.php');
require('authorize.php');

$logout = new Login();
$logstatus = $logout->logout();
if ($logstatus)
{
    echo "<center>";
    echo "<h1>SESSION SUCCESSFULLY CLEARED</h1>";
    echo "<a href='loginform.php'>LOGIN</a>";
    echo "</center>";
}
else
{
    echo "<center>";
    echo "<h1>SESSION FAILED TO DELETE FROM DATABASE</h1>";
    echo "<a href='logout.php'>RETRY</a>";
    echo "</center>";
}

?>