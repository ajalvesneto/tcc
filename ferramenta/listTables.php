<?php 
	require "framework/classes/class_config.php";

	require FWCLASSES."class_file.php";

	$file = new File();
	$file->url = $_GET["url"]."/log";
	$handle = $file->readFile(Config::$dir_logs.$file->url);
	$json_tables = json_encode($file->getTables($handle));
	print_r($json_tables);

?>