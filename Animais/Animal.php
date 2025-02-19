<?php 
    class Animal{
        public String $nome;
        public String $raca;
        public int $qntdPAtas;
        public String $cor;
        public float $peso;

        public function __construct($nome, $raca, $qntdPAtas, $cor, $peso)
        {
            $this->nome = $nome;
            $this->raca = $raca;
            $this->qntdPAtas = $qntdPAtas;
            $this->cor = $cor;
            $this->peso = $peso;
        
        }

        public function falar(){
            echo "Animal falando!!!";
        }
    }


?>