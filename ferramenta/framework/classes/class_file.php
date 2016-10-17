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

    public function getLine($url,$numberLine){
        $file_content = file (Config::$dir_logs.$url);
        $line = $file_content[$numberLine];
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
        return $databases;
    }

    public function getTables($handle){
        $count = 0;
        $tables = array();
        while (($line = fgets($handle)) !== false) {
            
            if (strpos($line, 'tables]') !== false) {
                $numberTables = explode(" ", $line);
                $numberTables = str_replace("[", "", $numberTables[0]);

                for ($i=2; $i <= $numberTables ; $i++) { 
                    $table = str_replace("|","",$this::getLine($this->url,$count+$i)) . "<br>";
                    $tables[] = $table;
                }

            }

            $count++;   
        }

        return $tables;
    }

}
?>


