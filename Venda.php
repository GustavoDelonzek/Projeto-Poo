<?php 
    require_once "Humanos/Humano.php";

    class Venda{
        public $produtos;
        private Humano $comprador;

        public function __construct($produtos, $comprador)
        {
            $this->produtos = $produtos;
            $this->comprador = $comprador;
        }

        public function getComprador(){
            return $this->comprador;
        }



    }


?>