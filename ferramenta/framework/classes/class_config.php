<?php 
session_start();
date_default_timezone_set("America/Recife");
define("FWCLASSES","C:/xampp/htdocs/tcc/ferramenta/framework/classes/");
require FWCLASSES."class_connection.php";

class Config{

    public static $dir_logs = "C:/xampp/htdocs/tcc/ferramenta/framework/logs/";
    //public static $dir_sqlmap = "C:/xampp/htdocs/tcc/ferramenta/framework/sqlmap/sqlmap.py";
    public static $dir_sqlmap = "D:/sqlmap/sqlmap.py";
}

require FWCLASSES."class_usefuls.php";

?>


