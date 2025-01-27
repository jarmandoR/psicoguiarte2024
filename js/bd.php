<?php

if (basename($_SERVER['PHP_SELF']) == "bd.php")
    exit();

class bd {

    private $con;
    private $stm;
    private $rs;

    public function __construct() {
        try {
             $this->con = new PDO('mysql:host=localhost;dbname=u148816134_intranetBermud;charset=utf8', "u148816134_bermudas2", "Jose2022",
            // $this->con = new PDO('mysql:host=localhost:3306;dbname=huella;charset=utf8', "root", "",
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die();
        }
    }

    public function desconectar() {
        $this->rs = null;
        $this->stm = null;
        $this->con = null;
    }

    public function findAll($query, $opc = "") {
        $this->stm = $this->con->prepare($query);
        $this->stm->execute();
        if ($opc) {
            $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ);
        } else {
            $this->rs = $this->stm->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->rs;
    }
    
    
    public function exec($query){
         $this->stm = $this->con->prepare($query);
         $this->stm->execute();
         return $this->stm->rowCount();        
    }

}
