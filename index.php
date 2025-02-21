<?php
require_once "Clinica.php";

$clinica = new Clinica();
function printarMensagem($mensagem)
{

    echo "-------------------------------------\n";
    echo "$mensagem\n";
    echo "-------------------------------------\n";
}
//produtos teste
$produto1 = new Produto("Ração", 4);
$produto2 = new Produto("Coleira", 20);
$produto3 = new Produto("Shampoo para cachorro", 14);
$produto4 = new Produto("Desverminante", 7);
$produto5 = new Produto("Shampoo para furao", 77);

$clinica->adicionarProduto($produto1);
$clinica->adicionarProduto($produto2);
$clinica->adicionarProduto($produto3);
$clinica->adicionarProduto($produto4);
$clinica->adicionarProduto($produto5);


//funcionarios
$balconista = new Balconista("Maria", "maria@gmail.com", "Rua dos balcões", 23, "42 99999-9999", 2200);
$veterinaria = new Veterinario("Paula", "rua xx", 22, "paula@gmail.com", "42 99999-1121", 2200);

//sistema
$clinica->adicionarFuncionario($balconista);
$clinica->adicionarFuncionario($veterinaria);

//cliente
$clienteTeste = new Humano("gus", 31, "gustavo2016delonzek@gmail.com", "rua xx", "42 99");
$clinica->cadastrarCliente($clienteTeste);

function formularioAnimal($dono, $animal)
{
    global $clinica;
    $nome = verificaString("Nome do animal: ", "AGENDAMENTO DE PET");
    $raca = verificaString("Raça do animal: ", "AGENDAMENTO DE PET");
    $cor = verificaString("Cor do animal: ", "AGENDAMENTO DE PET");
    $peso = verificaNumerico("Peso do animal: ", "AGENDAMENTO DE PET");

    if ($animal == 1) {
        $animalInstancia = new Cachorro($nome, $raca, 4, $cor, $peso, $dono);
        $clinica->agendarAnimal($animalInstancia);
    } else if ($animal == 2) {
        $animalInstancia = new Gato($nome, $raca, 4, $cor, $peso, $dono);
        $clinica->agendarAnimal($animalInstancia);
    } else {
        $animalInstancia = new Furao($nome, $raca, 4, $cor, $peso, $dono);
        $clinica->agendarAnimal($animalInstancia);
    }

    echo "Agendando...";
    sleep(2);
}
function limparTela()
{
    echo "\033[H\033[J";
}

function verificaString($mensagem, $cabecalho){
    $string = readline($mensagem);

    while(true){
        if(strlen(trim($string)) < 3){ 
            limparTela();
            printarMensagem($cabecalho);
            echo "Digite pelo menos 3 caracteres\n";
            $string = readline($mensagem);
        } else{
            break;
        }

    }
    return $string;
}

function verificaNumerico($mensagem, $cabecalho){
    $inteiro = readline($mensagem);
    while(true){
        if(is_numeric($inteiro)){
            break;
        } else{
            limparTela();
            printarMensagem($cabecalho);
            echo "Apenas números são válidos\n";
            $inteiro = readline($mensagem);
        }
    }

    return $inteiro;
}


while (true) {
    limparTela();
    printarMensagem("Bem vindo ao sistema do nosso PET SHOP!");

    echo "[1] Funcionário\n[2] Cliente \n[3] Sair\n";
    $opcao = readline("-");
    if ($opcao == 1) {
        $funcionario = readline("Digite o nome do funcionário: ");
        $funcionario = ucfirst(strtolower($funcionario));
        if ($clinica->identificarFuncionario($funcionario)) {
            $funcionario = $clinica->identificarFuncionario($funcionario);
            while (true) {
                limparTela();
                printarMensagem("SEÇÃO FUNCIONÁRIO");
                echo "[1]Animais agendados\n[2]Mandar próximo animal pra consulta\n[3]Vendas feitas\n[4]Ver seu salário\n[5]Sair\n";
                $opcao = readline('-');
                if ($opcao == 1) {
                    limparTela();
                    printarMensagem("Lista de animais agendados!");
                    $clinica->listarAnimais();
                    echo "\n";
                    readline("Pressione enter para voltar...");
                } else if ($opcao == 2) {
                    limparTela();
                    printarMensagem("Atendimento");
                    sleep(2);
                    $clinica->atenderAnimal();
                    sleep(2);

                } else if($opcao == 3){
                    limparTela();
                    printarMensagem("Lista de vendas");
                    $clinica->listarVendas();
                    echo "\n";
                    readline("Pressione enter para voltar...");
                }    
                else if ($opcao == 4) {
                    limparTela();
                    echo "Seu sálario atual é de R$" . number_format($funcionario->calculaSalario(), 2);
                    sleep(2);
                } else if ($opcao == 5) {
                    break;
                }

            }
        } else {
            printarMensagem("Funcionário não existe! Tente outra opção.");
            sleep(1);
        }

    } else if ($opcao == 2) {
        $email = trim(readline("Digite seu email: "));
        if ($clinica->identificarCliente($email)) {
            $clienteAtual = $clinica->identificarCliente($email);
            while (true) {
                limparTela();
                printarMensagem("SEÇÃO CLIENTE");
                echo "[1]Agendar consulta pets \n[2]Comprar produto\n[3]Sair\n";
                $opcao = readline("-");
                if ($opcao == 1) {
                    while (true) {
                        limparTela();
                        printarMensagem("AGENDAMENTO DE PET");
                        echo "Qual o seu pet?\n";
                        echo "[1]Cachorro\n[2]Gato\n[3]Furão\n";
                        $opcao = readline("-");
                        if ($opcao > 0 && $opcao < 4) {
                            formularioAnimal($clienteAtual, $opcao);

                            break;
                        }
                    }
                } else if ($opcao == 2) {
                    $carrinhoCliente = [];
                    while(true){
                        limparTela();
                        printarMensagem("Venda de produtos");
                        echo "[1]Ver produtos\n[2]Adicionar produto ao seu carrinho\n[3]Efetuar compra \n[4]Cancelar\n";
                        $opcao = readline("-");
                        if ($opcao == 1) {
                            limparTela();
                            printarMensagem("PRODUTOS DA LOJA");
                            $clinica->listarProdutos();
                            echo "\n";
                            readline("Pressione ENTER para voltar...");
                        } else if($opcao == 2){
                            limparTela();
                            printarMensagem("Adicionar produto ao carrinho");
                            $produto = readline("Digite o nome do produto: ");
                            if($clinica->getProduto($produto)){
                                $carrinhoCliente[] = $clinica->getProduto($produto);
                                echo "Produto adicionado ao carrinho!";
                                sleep(1);
                            } else{
                                echo "Produto não encontrado!";
                                sleep(1);
                            }

                        } else if($opcao == 3){
                            if(count($carrinhoCliente) > 0){

                                $clinica->realizarVenda($carrinhoCliente, $clienteAtual);
                                $carrinhoCliente = [];
                                echo "Compra realizada com sucesso!";
                                sleep(2);
                                break;
                            } else{
                                echo "Carrinho vazio. Por favor, adicione algum produto ao carrinho.";
                                sleep(2);
                            }
                        } else if($opcao == 4){
                            break;
                        }

                    }
                } else if ($opcao == 3) {
                    break;
                }
            }
        } else {
            limparTela();
            printarMensagem("NOVO POR AQUI?");
            echo "[1]Cadastrar como cliente\n[*]Cancelar\n";
            $opcao = readline("-");
            if($opcao == 1){
                while (true) {
                    limparTela();
                    printarMensagem("CADASTRO DE CLIENTE");
                    echo "Vai ser necessário as seguintes informações sobre você:\n";
                    $nomeCliente = verificaString("Nome: ", "CADASTRO DE CLIENTE");
                    $idadeCliente = verificaNumerico("Idade: ","CADASTRO DE CLIENTE");
                    $emailCliente = verificaString("Email: ", "CADASTRO DE CLIENTE");
                    $contatoCliente = verificaString("Contato: ", "CADASTRO DE CLIENTE");
                    $enderecoCliente = verificaString("Endereço (Rua xx, numero xx): ", "CADASTRO DE CLIENTE");
                    $novoCliente = new Humano($nomeCliente, $idadeCliente, $emailCliente, $enderecoCliente, $contatoCliente);
                    $clinica->cadastrarCliente($novoCliente);
                    echo "Cadastrando usuário...";
                    sleep(2);
                    break;
                }
            }

        }
    } elseif ($opcao == 3) {
        break;
    }


}