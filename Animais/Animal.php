<?php 
    require_once "Humanos/Humano.php";
    class Animal{
        public String $nome;
        public String $raca;
        public int $qntdPAtas;
        public String $cor;
        public float $peso;

        public Humano $dono;

        public function __construct($nome, $raca, $qntdPAtas, $cor, $peso, $dono)
        {
            $this->nome = $nome;
            $this->raca = $raca;
            $this->qntdPAtas = $qntdPAtas;
            $this->cor = $cor;
            $this->peso = $peso;
            $this->dono = $dono;
        }

        public function falar(){
            echo "Animal falando!!!";
        }
    }


?>