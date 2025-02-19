<?php 
    require_once "Produto.php";
    require_once "Humanos/Balconista.php";
    require_once "Humanos/Vendedor.php";
    require_once "Humanos/Veterinario.php";


    class Clinica{
        private $vendas;
        private $produtos;
        private $funcionarios;

        public function listarProdutos(){
            foreach($this->produtos as $produto){
                echo "Nome do produto: " . $produto->nome . ". Preço: R$" . $produto->getPreco() . ";";
            }
        }


    }


?>