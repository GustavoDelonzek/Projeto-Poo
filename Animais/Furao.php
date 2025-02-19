<?php
    require_once "Animal.php";

    class Furao extends Animal{
        public function __construct($nome, $raca, $qntdPAtas, $cor, $peso)
        {
            parent::__construct($nome, $raca, $qntdPAtas, $cor, $peso);
        }

        public function falar(){
            echo "Sniff sniff";
        }

    }

?>