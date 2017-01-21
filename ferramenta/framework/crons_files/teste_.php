<?php 
	require "../classes/class_config.php";
	require FWCLASSES."class_command.php";
	
	$command = new Command();

	$commandSQLMap = $command->mt_listComand();

	
	require FWCLASSES."class_file.php";
	
	$urlCommand = str_replace("http://","",$commandSQLMap["url"])."/log";
	$urlCommand = explode("/", $urlCommand);
	
	$file = new File();
	$file->url = $urlCommand[0]."/log";
	$handle = $file->readFile(Config::$dir_logs.$file->url);
	$json_databases = json_encode($file->getDatabases($handle));
	$json_databases = json_decode($json_databases);

	print_r($json_databases);
	
	foreach ($json_databases as $database) {
		print_r($database);
		//$commandInsertDatabases = $command->mt_insertDatabases($commandSQLMap["id"],$database);
	}	
?>