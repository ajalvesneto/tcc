<?php 
class Database extends Command{

    public function __set($atrib, $value){ 
        $this->$atrib = $value; 
    } 
    
    public function __get($atrib){ 
        return $this->$atrib;
    }

    public function mt_insertDatabases($id_request,$database_name){
        try{
            $connInsert = $this->mt_conection()->prepare("INSERT INTO tb_avaliable_databases (id_request,name) VALUES (:id_request,:name)");
            $connInsert->bindValue(":id_request",$id_request, PDO::PARAM_STR);
            $connInsert->bindValue(":name",$database_name, PDO::PARAM_STR);
            $connInsert->execute();
            return $this->mt_conection()->lastInsertId();
        } catch (Exception $e) { 
            return "0";
        }   
    }

    public function mt_listDatabases(){
        $connConsult = $this->mt_conection()->query("SELECT * FROM tb_avaliable_databases");
        $command = $connConsult->fetchAll(PDO::FETCH_ASSOC);
        return $command;
    }


}
?>


