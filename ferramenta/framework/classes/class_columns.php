<?php 

class Columns extends Request{

    public function __set($atrib, $value){ 
        $this->$atrib = $value; 
    } 
    
    public function __get($atrib){ 
        return $this->$atrib;
    }

    public function mt_insertColumns($id_request,$id_database,$id_table,$name,$type){
        try{
            $connInsert = $this->mt_conection()->prepare("INSERT INTO tb_avaliable_columns (id_request,id_database,id_table,name,type) VALUES (:id_request,:id_database,:id_table,:name,:type)");
            $connInsert->bindValue(":id_request",$id_request, PDO::PARAM_STR);
            $connInsert->bindValue(":id_database",$id_database, PDO::PARAM_STR);
            $connInsert->bindValue(":id_table",$id_table, PDO::PARAM_STR);
            $connInsert->bindValue(":name",$name, PDO::PARAM_STR);
            $connInsert->bindValue(":type",$type, PDO::PARAM_STR);
            $connInsert->execute();
            return $this->mt_conection()->lastInsertId();
        } catch (Exception $e) { 
            return "0";
        }   
    }

    public function mt_listColumns(){
        $connConsult = $this->mt_conection()->query("SELECT c.id,c.name,c.type, d.name as db, t.name as tb, r.url FROM tb_avaliable_columns as c INNER JOIN tb_avaliable_tables AS t ON t.id = c.id_table INNER JOIN tb_avaliable_databases as d ON d.id = c.id_database INNER JOIN tb_requests AS r ON r.id = c.id_request");
        $columns = $connConsult->fetchAll(PDO::FETCH_ASSOC);
        return $columns;
    }
}
?>


