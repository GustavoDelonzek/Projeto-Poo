<?php 
    require_once("Humano.php");
    class Balconista extends Humano{
        private float $salario;

        public function __construct($nome, $email,$endereco, $idade, $contato, $salario)
        {
            parent::__construct($nome, $idade,$email, $endereco, $contato);
            $this->salario = $salario;
        }


        public function calculaSalario(){
            return $this->salario;
        }

        
    }





?>