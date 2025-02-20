<?php
require_once "Produto.php";
require_once "Humanos/Balconista.php";
require_once "Humanos/Vendedor.php";
require_once "Humanos/Veterinario.php";
require_once "Venda.php";
require_once "Animais/Cachorro.php";
require_once "Animais/Gato.php";
require_once "Animais/Furao.php";



class Clinica
{
    private $vendas;
    private $produtos;
    private $funcionarios;
    private $animais;
    private $clientes;

    public function __construct(){
        $this->vendas = [];
        $this->produtos = [];
        $this->funcionarios = [];
        $this->animais = [];
        $this->clientes = [];
    }

    public function listarProdutos()
    {
        if(count($this->produtos) > 0){
        foreach ($this->produtos as $produto) {
            echo "Nome do produto: " . $produto->nome . ". Preço: R$" . $produto->getPreco() . ";";
        }} else{
            echo "Não há produtos no PET SHOP\n";
        }
    }
    public function adicionarProduto($produto)
    {
        $this->produtos[] = $produto;
    }

    public function adicionarVenda($venda)
    {
        $this->vendas[] = $venda;
    }

    public function listarVendas()
    {
        if (count($this->vendas) > 0) {

            foreach ($this->vendas as $venda) {
                echo "Venda de " . count($venda->produtos) . " para o cliente " . $venda->getComprador() . "\n";
            }
        } else {
            echo "Não há vendas registradas";
        }
    }

    public function realizarVenda($produtos, $comprador)
    {
        $venda = new Venda($produtos, $comprador);
        $this->adicionarVenda($venda);
    }

    public function adicionarFuncionario($funcionario)
    {
        $this->funcionarios[] = $funcionario;
    }

    public function identificarFuncionario($nome)
    {
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->nome == $nome) {
                return true;
            }

        }
        return false;
    }

    public function identificarCliente($email){
        foreach($this->clientes as $cliente){
            if($cliente->email == $email){
                return $cliente;
            }
        }
        return false;
    }

    public function cadastrarCliente($cliente){
        $this->clientes[] = $cliente;
    }

    public function agendarAnimal($animal)
    {
        $this->animais[] = $animal;
    }

    public function listarAnimais()
    {
        if (count($this->animais) > 0) {
            foreach ($this->animais as $animal) { 
                echo "Nome do animal: " . $animal->nome . ". Raça: " . $animal->raca .". Dono:  " . $animal->dono->nome .  "\n";
            }
        } else{
            echo "Não há animais agendados";
        }
    }

    public function atenderAnimal(){
        if(count($this->animais) > 0){
            echo $this->animais[0]->nome . " atendido!\n";
            $this->animais[0]->falar();
            array_shift($this->animais);
        } else{
            echo "Não há animais agendados";
        }
    }









}


?>