<?php
    require_once "Animal.php";

    class Cachorro extends Animal{
        public function __construct($nome, $raca, $qntdPAtas, $cor, $peso, $dono)
        {
            parent::__construct($nome, $raca, $qntdPAtas, $cor, $peso, $dono);
        }

        public function falar(){
            echo "Auauau";
        }

    }

?>