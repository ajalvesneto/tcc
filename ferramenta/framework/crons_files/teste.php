<?php 
	require "../classes/class_config.php";
	require FWCLASSES."class_command.php";
	require FWCLASSES."class_database.php";
	require FWCLASSES."class_table.php";
	require FWCLASSES."class_columns.php";
	
	$command = new Command();
	$databases = new Database();
	$tables = new Table();
	$columns = new Columns();

	$commandSQLMap = $command->mt_listComand();

	$command->mt_updateComand($commandSQLMap["id"],2);
	
	$script = escapeshellcmd('python '.Config::$dir_sqlmap.' --url "'.$commandSQLMap["url"].'" --random-agent --dbs --batch --output-dir='.Config::$dir_logs.' --purge-output');
	$output = shell_exec($script);

	
	require FWCLASSES."class_file.php";
	
	$urlCommand = str_replace("http://","",$commandSQLMap["url"])."/log";
	$urlCommand = explode("/", $urlCommand);
	
	$file = new File();
	$file->url = $urlCommand[0]."/log";
	$handle = $file->readFile(Config::$dir_logs.$file->url);
	$json_databases = json_encode($file->getDatabases($handle));
	$json_databases = json_decode($json_databases);
	
	foreach ($json_databases as $database) {
		$commandInsertDatabases = $databases->mt_insertDatabases($commandSQLMap["id"],$database);
		
		
		$script2 = escapeshellcmd('python '.Config::$dir_sqlmap.' --url "'.$commandSQLMap["url"].'" -D '.$database.' --tables --random-agent --batch --output-dir='.Config::$dir_logs.'');

		$output2 = shell_exec($script2);

		echo $output2;

		$handle2 = $file->readFile(Config::$dir_logs.$file->url);
		$json_tables = json_encode($file->getTables($handle2));		
		$json_tables = json_decode($json_tables);

		foreach ($json_tables as $table) {
			$commandInsertTables = $tables->mt_insertTables($commandSQLMap["id"],$commandInsertDatabases,$table);

			$script3 = escapeshellcmd('python '.Config::$dir_sqlmap.' --url "'.$commandSQLMap["url"].'" -D '.$database.' -T '.$table.' --columns --random-agent --batch --output-dir='.Config::$dir_logs.'');

			$output3 = shell_exec($script3);

			echo $output3;

			$handle3 = $file->readFile(Config::$dir_logs.$file->url);
			$json_columns = json_encode($file->getColumns($handle3));		
			$json_columns = json_decode($json_columns);

			foreach ($json_columns as $column) {
				$column = split(":",$column);
				$commandInsertColumns = $columns->mt_insertColumns($commandSQLMap["id"],$commandInsertDatabases,$commandInsertTables,$column[0],$column[1]);
			}
		}
	}
$command->mt_updateComand($commandSQLMap["id"],3);


?>