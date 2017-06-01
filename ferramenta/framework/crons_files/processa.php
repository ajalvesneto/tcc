<?php 
	require "../classes/class_config.php";
	require FWCLASSES."class_request.php";
	require FWCLASSES."class_database.php";
	require FWCLASSES."class_table.php";
	require FWCLASSES."class_columns.php";
	require FWCLASSES."class_file.php";
	
	$request = new Request();
	$databases = new Database();
	$tables = new Table();
	$columns = new Columns();
	$file = new File();

	//retorna a primeira a url da fila de urls
	$commandSQLMap = $request->mt_listRequest();

	if (!empty($commandSQLMap)){
		$request->mt_updateRequest($commandSQLMap["id"],2);
	
		$script = escapeshellcmd('python '.Config::$dir_sqlmap.' --url "'.$commandSQLMap["url"].'" --random-agent --dbs --batch --output-dir='.Config::$dir_logs.' --purge-output');
		$output = shell_exec($script);

		$urlCommand = str_replace("http://","",$commandSQLMap["url"])."/log";
		$urlCommand = explode("/", $urlCommand);
		
		
		$file->url = $urlCommand[0]."/log";
		$dirLog = Config::$dir_logs.$file->url;
		$handle = $file->readFile(Config::$dir_logs.$file->url);
		$json_databases = $file->getDatabases($handle);
		$json_databases = json_decode($json_databases);
		$file->closeFile($handle);
		
		foreach ($json_databases as $database) {
			$commandInsertDatabases = $databases->mt_insertDatabases($commandSQLMap["id"],$database);
			unlink($dirLog);
			
			$script2 = escapeshellcmd('python '.Config::$dir_sqlmap.' --url "'.$commandSQLMap["url"].'" -D '.$database.' --tables --random-agent --batch --output-dir='.Config::$dir_logs.'');

			$output2 = shell_exec($script2);

			$handle2 = $file->readFile(Config::$dir_logs.$file->url);
			$json_tables = $file->getTables($handle2);		
			$json_tables = json_decode($json_tables);
			$file->closeFile($handle2);

			foreach ($json_tables as $table) {
				$commandInsertTables = $tables->mt_insertTables($commandSQLMap["id"],$commandInsertDatabases,$table);

				$script3 = escapeshellcmd('python '.Config::$dir_sqlmap.' --url "'.$commandSQLMap["url"].'" -D '.$database.' -T '.$table.' --columns --random-agent --batch --output-dir='.Config::$dir_logs.'');

				$output3 = shell_exec($script3);

				$handle3 = $file->readFile(Config::$dir_logs.$file->url);
				$json_columns = $file->getColumns($handle3);		
				$json_columns = json_decode($json_columns);
				$file->closeFile($handle3);

				foreach ($json_columns as $column) {
					$column = split(":",$column);
					$commandInsertColumns = $columns->mt_insertColumns($commandSQLMap["id"],$commandInsertDatabases,$commandInsertTables,$column[0],$column[1]);
				}
			}
		}
	$request->mt_isInjectable($commandSQLMap["id"]);
	$request->mt_updateRequest($commandSQLMap["id"],3);
	
	}
?>