<?php 
class Command extends Connection{

    public function __set($atrib, $value){ 
        $this->$atrib = $value; 
    } 
    
    public function __get($atrib){ 
        return $this->$atrib;
    }

    public function mt_insertComand($url,$session){
    	try{
    		$connConsult =  $this->mt_conection()->prepare("SELECT * FROM tb_requests WHERE session_id = :session_id AND status = '1'");
    		$connConsult->bindValue(":session_id",$session, PDO::PARAM_STR);
    		$connConsult->execute();
    		$numRows = $connConsult->rowCount();
    		if ($numRows == 0){
    			$connInsert = $this->mt_conection()->prepare("INSERT INTO tb_requests (url,session_id,request_date) VALUES (:url,:session_id,:request_date)");
				$connInsert->bindValue(":url",$url, PDO::PARAM_STR);
				$connInsert->bindValue(":session_id",$session, PDO::PARAM_STR);
                $connInsert->bindValue(":request_date",date("Y-m-d H:i:s"), PDO::PARAM_STR);
				$connInsert->execute();
				return "1";
    		}else{
    			return "2";
    		}
		} catch (Exception $e) { 
			return "0";
		} 	
    }

    public function mt_updateComand($id,$status){
        try{
           
            $conn = $this->mt_conection()->prepare("UPDATE tb_requests SET status = :status, processing_date=:processing_date WHERE id = :id");
            $conn->bindValue(":id",$id, PDO::PARAM_STR);
            $conn->bindValue(":status",$status, PDO::PARAM_STR);
            $conn->bindValue(":processing_date",date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $conn->execute();
            return "1";
        } catch (Exception $e) { 
            return "0";
        }   
    }

    public function mt_listComand(){
    	$connConsult = $this->mt_conection()->query("SELECT * FROM tb_requests WHERE status = '1' LIMIT 0,1");
    	$command = $connConsult->fetch(PDO::FETCH_ASSOC);
    	return $command;
    }

    public function mt_listComands(){
        $connConsult = $this->mt_conection()->query("SELECT * FROM tb_requests ORDER BY id ASC");
        $commands = $connConsult->fetchAll(PDO::FETCH_ASSOC);
        return $commands;
    }
}
?>


