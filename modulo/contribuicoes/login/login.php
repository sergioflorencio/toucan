<?php

class Login {
	private $db = null;
    private $ip = null;
    private $uid = null;
 //   private $date = null;

    function Login() {
  //      $this->db = db_connect();
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->uid = 0;
//        $this->date = date('Y-m-d');
    }

    function checkLogin($username, $password) {
			include ('../php/config.php');

//       $username = sanitize($username, SQL);
//        $password = sha1($password);
//        if ($this->db) {
            $query = "SELECT * FROM nico.cad_usuarios WHERE username = '".$username."' AND password = '".$password."'";
            $result = mysql_query($query,$conexao);
            $var = mysql_fetch_object($result);

            if (is_object($var)) {
                $this->storeSession($var);
                return true;
            } else {
                $this->sessionDefault();
                return false;
            }
//        }
    }

    function sessionDefault() {
        $_SESSION['username'] = null;
        $_SESSION['session'] = null;
        $_SESSION['uid'] = 0;
        $_SESSION['logged'] = false;
    }

 //   function storeSession(&$login, $init = true, $credit = 'USER') {
    function storeSession($login) {
		include ('../php/config.php');
        $_SESSION['username'] = $login->username;
        $username = $login->username;
        $_SESSION['uid'] = $login->cod_usuario;
        $uid = $login->cod_usuario;
        $_SESSION['ip'] = $this->ip;
        $ip = $this->ip;
        $_SESSION['session'] = session_id();
        $sid = session_id();
		$_SESSION['logged'] = true;

 //       if ($this->db) {
            $query = "INSERT INTO nico.session (`username`,`sid`,`ip`) VALUES ('".$username."','".$sid."','".$ip."')";
 //          $query = "INSERT INTO nico.session VALUES ('aaaa','342','213243','2014-01-01','USER')";
            $result = mysql_query($query,$conexao) or die(mysql_error());
 //       }
		
    }

    function checkAuthorized($session, $ip) {

        if ($this->db) {
			include ('../php/config.php');
            $query = "SELECT * FROM nico.session WHERE " .
                    "(session='".$session."') AND (ip='".$ip."') ";
            $result = mysql_query($query,$conexao);
            $var = mysql_fetch_object($result);
            if (is_object($var)) {
                if ($var->credit == 'USER'){
                    return 'USER';}
                else{
                    return 'ADMIN';}
            } else{
                return false;}
        }
    }
    /* 
     * 
     * This function used to logout
     * @param: $session will receive session_id()
     * @return: Will return boolean
     * 
     */
    function logout() {
//			include ('../php/config.php');
//			$query = "UPDATE nico.session set date_logout='".date("Y-m-d H:i:s")."' WHERE sid='".$_SESSION['session']."';";
//			$result = mysql_query($query,$conexao);
			unset($_SESSION);
			session_destroy();

    }

}

?>