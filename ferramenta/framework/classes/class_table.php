<?php 

class Table extends Command{

    public function __set($atrib, $value){ 
        $this->$atrib = $value; 
    } 
    
    public function __get($atrib){ 
        return $this->$atrib;
    }

    public function mt_insertTables($id_request,$id_database,$name_table){
        try{
            $connInsert = $this->mt_conection()->prepare("INSERT INTO tb_avaliable_tables (id_request,id_database,name) VALUES (:id_request,:id_database,:name)");
            $connInsert->bindValue(":id_request",$id_request, PDO::PARAM_STR);
            $connInsert->bindValue(":id_database",$id_database, PDO::PARAM_STR);
            $connInsert->bindValue(":name",$name_table, PDO::PARAM_STR);
            $connInsert->execute();
            return $this->mt_conection()->lastInsertId();
        } catch (Exception $e) { 
            return "0";
        }   
    }

    public function mt_listTables(){
        $connConsult = $this->mt_conection()->query("SELECT t.id,t.name,d.name AS db, r.url FROM tb_avaliable_tables AS t INNER JOIN tb_avaliable_databases as d ON d.id = t.id_database INNER JOIN tb_requests AS r ON r.id = t.id_request");
        $command = $connConsult->fetchAll(PDO::FETCH_ASSOC);
        return $command;
    }
}
?>


