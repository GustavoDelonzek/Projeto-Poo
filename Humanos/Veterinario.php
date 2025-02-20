<?php 
    require_once("Humano.php");
    class Veterinario extends Humano{
        private float $salario;

        public function __construct($nome, $endereco, $idade, $email,$contato, $salario)
        {
            parent::__construct($nome, $idade, $email,$endereco, $contato);
            $this->salario = $salario;
        }


        public function calculaSalario(){
            return $this->salario * 2;
        }

        
    }





?>