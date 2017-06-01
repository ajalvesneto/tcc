<?php 
    require "/framework/classes/class_config.php";
    require FWCLASSES."class_request.php";
    require FWCLASSES."class_database.php";
    require FWCLASSES."class_table.php";
    require FWCLASSES."class_columns.php";
    require FWCLASSES."class_file.php";
    
    $request = new Request();
    $databases = new Database();
    $tables = new Table();
    $columns = new Columns();

    //retorna a primeira a url da fila de urls
    $commandSQLMap = $request->mt_listRequest();
    

        $urlCommand = str_replace("http://","",$commandSQLMap["url"])."/log";
        $urlCommand = explode("/", $urlCommand);
        
        $file = new File();
        $file->url = $urlCommand[0]."/log";
        $dirLog = Config::$dir_logs.$file->url;

        echo $dirLog;

        echo gettype($dirLog);

        if (file_exists($dirLog)){
            
            unlink($dirLog);
            
            echo " foi";
        }else{
            echo "nao";
        }
        
        
        