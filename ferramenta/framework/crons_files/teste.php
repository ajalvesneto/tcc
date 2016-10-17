<?php 
session_start();
if (isset($_SESSION["url_sqlmap"])){
	echo "tem";
}else{
	echo "nao";
}

//$command = escapeshellcmd('python D:/sqlmap/sqlmap.py --url "http://www.verdao.net/colunas.php?id=658" -D verda_dbverdao --tables --random-agent --dbs --batch --output-dir=C:\xampp\htdocs\tcc');
//$output = shell_exec($command);
//echo $output;

?>