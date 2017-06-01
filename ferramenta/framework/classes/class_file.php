<?php 
class File{

    private $url;

    public function __set($atrib, $value){ 
        $this->$atrib = $value; 
    } 
    
    public function __get($atrib){ 
        return $this->$atrib;
    }

    public function readFile($url){
        $handle = fopen($url, "r");
        return $handle;
    }

    public function closeFile($handle){
        fclose($handle);
    }

    public function getLine($url,$numberLine){
        $file_content = file (Config::$dir_logs.$url);
        $line = $file_content[$numberLine];
        $line = preg_replace('/\s/',' ',$line);
        return $line;
    }

    public function getDatabases($handle){
        $count = 0;
        $databases = array();

        while (($line = fgets($handle)) !== false) {
            if (strpos($line, 'available databases') !== false) {
                $numberDatabases = explode(" ", $line);
                $numberDatabases = str_replace("[", "", $numberDatabases[2]);
                $numberDatabases = str_replace("]", "", $numberDatabases);
                for ($i=1; $i <= intval($numberDatabases) ; $i++) { 
                    $database = str_replace("[*] ","",$this::getLine($this->url,$count+$i));
                    $databases[] = $database;
                }
            }
            $count++;   
        }
        return json_encode($databases);
    }

    public function getTables($handle){
        $count = 0;
        $tables = array();
        while (($line = fgets($handle)) !== false) {
            
            if (strpos($line, 'tables]') !== false) {
                $numberTables = explode(" ", $line);
                $numberTables = str_replace("[", "", $numberTables[0]);

                for ($i=2; $i <= $numberTables ; $i++) { 
                    $table = str_replace("|","",$this::getLine($this->url,$count+$i));
                    $tables[] = $table;
                }

            }

            $count++;   
        }

        return json_encode($tables);
    }

    public function getColumns($handle){
        $count = 0;
        $tables = array();
        while (($line = fgets($handle)) !== false) {
            
            if (strpos($line, 'columns]') !== false) {
                $numberColumns = explode(" ", $line);
                $numberColumns = str_replace("[", "", $numberColumns[0]) + 3;
                for ($i=4; $i <= $numberColumns ; $i++) { 
                    $column = explode("|",$this::getLine($this->url,$count+$i));
                    $columns[] = $column[1].":".$column[2];
                }

            }

            $count++;   
        }

        return json_encode($columns);
    }

}
?>


