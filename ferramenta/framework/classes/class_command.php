<?php 
class Command extends Database{

    public function __set($atrib, $value){ 
        $this->$atrib = $value; 
    } 
    
    public function __get($atrib){ 
        return $this->$atrib;
    }

    public function mt_insertComand($url,$database,$table,$session){
    	try{
    		$connConsult =  $this->mt_conection()->prepare("SELECT * FROM tb_consultas WHERE session_id = :session_id AND status = '1'");
    		$connConsult->bindValue(":session_id",$session, PDO::PARAM_STR);
    		$connConsult->execute();
    		$numRows = $connConsult->rowCount();
    		if ($numRows == 0){
    			$connInsert = $this->mt_conection()->prepare("INSERT INTO tb_consultas (url,name_database,name_table,session_id) VALUES (:url,:name_database,:name_table,:session_id)");
				$connInsert->bindValue(":url",$url, PDO::PARAM_STR);
				$connInsert->bindValue(":name_database",$database, PDO::PARAM_STR);
				$connInsert->bindValue(":name_table",$table, PDO::PARAM_STR);
				$connInsert->bindValue(":session_id",$session, PDO::PARAM_STR);
				$connInsert->execute();
				return "1";
    		}else{
    			return "2";
    		}
		} catch (Exception $e) { 
			return "0";
		} 	
    }

    public function mt_listComand(){
    	$connConsult = $this->mt_conection()->query("SELECT * FROM tb_consultas WHERE status = '1' LIMIT 0,1");
    	$command = $connConsult->fetch(PDO::FETCH_ASSOC);
    	return $command;
    }
}
?>


