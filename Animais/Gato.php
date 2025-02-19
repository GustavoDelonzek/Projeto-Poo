<?php
    require_once "Animal.php";

    class Gato extends Animal{
        public function __construct($nome, $raca, $qntdPAtas, $cor, $peso)
        {
            parent::__construct($nome, $raca, $qntdPAtas, $cor, $peso);
        }

        public function falar(){
            echo "MIauu miauu!";
        }

    }

?>