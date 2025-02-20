<?php 
    class Humano{
        public String $nome;
        public int $idade;
        public String $endereco;
        public String $contato;
        public String $email;

        public function __construct($nome, $idade, $email,$endereco, $contato)
        {
            $this->nome = $nome;
            $this->idade = $idade;
            $this->endereco = $endereco;
            $this->contato = $contato;
            $this->email = $email;
        }

        
    }


?>