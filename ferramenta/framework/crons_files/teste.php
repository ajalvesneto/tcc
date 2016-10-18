<?php 
	require "../classes/class_config.php";
	require FWCLASSES."class_command.php";
	
	$command = new Command();

	$commandSQLMap = $command->mt_listComand();
	
	if ($commandSQLMap["name_database"] != ""){
		$consulta .= '-D '. $commandSQLMap["name_database"].' ';

		if ($commandSQLMap["name_table"] != ""){
			$consulta .= '--tables -T '. $commandSQLMap["name_table"]. ' --columns ';
		}else{
			$consulta .= ' --tables';
		}
	}
	$script = escapeshellcmd('python '.Config::$dir_sqlmap.' --url "'.$commandSQLMap["url"].'" '.$consulta.' --random-agent --dbs --batch --output-dir='.Config::$dir_logs.'');

	$output = shell_exec($script);
	echo $output;

?>