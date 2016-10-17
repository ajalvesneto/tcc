<?php 
class Commands extends Banco{



    public function __set($atrib, $value){ 
        $this->$atrib = $value; 
    } 
    
    public function __get($atrib){ 
        return $this->$atrib;
    }

    public function mt_insertComand($url,$database,$table,$session){
    	

    }


}
?>


