<?php 
	require "../classes/class_config.php";
	require FWCLASSES."class_command.php";
	
	$command = new Command();

	$databases = $command->mt_listDatabases();
	

	foreach ($databases as $database) {
		$script = escapeshellcmd('python '.Config::$dir_sqlmap.' --url "'.$commandSQLMap["url"].'" -D '.$database["name"].' --tables --random-agent --batch --output-dir='.Config::$dir_logs.'');
		$output = shell_exec($script);
		echo $output;
	}

?>