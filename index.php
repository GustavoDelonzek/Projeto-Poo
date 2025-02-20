<?php
require_once "Clinica.php";

$clinica = new Clinica();
function printarMensagem($mensagem)
{

    echo "-------------------------------------\n";
    echo "$mensagem\n";
    echo "-------------------------------------\n";
}

$balconista = new Balconista("Maria", "maria@gmail.com", "Rua dos balcões", 23, "42 99999-9999", 2200);
$clinica->adicionarFuncionario($balconista);
$clienteTeste = new Humano("gus", 31, "gustavo2016delonzek@gmail.com", "rua xx", "42 99");
$clinica->cadastrarCliente($clienteTeste);

function formularioAnimal($dono, $animal)
{
    global $clinica;
    $nome = readline("Nome do animal: ");
    $raca = readline("Raça do animal: ");
    $cor = readline("Cor do animal: ");
    $peso = readline("Peso do animal: ");

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


while (true) {
    limparTela();
    printarMensagem("Bem vindo ao sistema do nosso PET SHOP!");

    echo "[1] Funcionário\n[2] Cliente \n[3] Sair\n";
    $opcao = readline("-");
    if ($opcao == 1) {
        $funcionario = readline("Digite o nome do funcionário: ");
        $funcionario = ucfirst(strtolower($funcionario));
        if ($clinica->identificarFuncionario($funcionario)) {
            while (true) {
                limparTela();
                printarMensagem("Boas vindas ao sistema");
                echo "[1]Animais agendados\n[2]Mandar próximo animal pra consulta\n[3]Ver seu salário\n[4]Sair\n";
                $opcao = readline('-');
                if ($opcao == 1) {
                    limparTela();
                    printarMensagem("Lista de animais agendados!");
                    $clinica->listarAnimais();
                    readline("\nPressione enter para voltar...");
                } else if ($opcao == 2) {
                    limparTela();
                    printarMensagem("Atendimento");
                    sleep(2);
                    $clinica->atenderAnimal();
                    sleep(2);

                } else if ($opcao == 3) {
                    limparTela();
                    echo "Seu sálario atual é de R$" . number_format($balconista->calculaSalario(), 2);
                    sleep(5);
                } else if ($opcao == 4) {
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
                            readline("Pressione ENTER para voltar...");
                        } else if($opcao == 2){
                            limparTela();
                            printarMensagem("Adicionar produto ao carrinho");
                            $produto = readline("Digite o nome do produto: ");
                            if($clinica->getProduto($produto)){
                                $carrinhoCliente[] = $clinica->getProduto($produto);
                            } else{
                                echo "Produto não encontrado!";
                                sleep(1);
                            }

                        } else if($opcao == 3){
                            $clinica->realizarVenda($carrinhoCliente, $clienteAtual);
                        } else if($opcao == 4){
                            break;
                        }

                    }
                } else if ($opcao == 3) {
                    break;
                }
            }
        } else {
            while (true) {
                limparTela();
                printarMensagem("CADASTRO DE CLIENTE");
                echo "Vai ser necessário as seguintes informações sobre você:\n";
                $nomeCliente = readline("Nome: ");
                $idadeCliente = readline("Idade: ");
                $emailCliente = readline("Email: ");
                $contatoCliente = readline("Contato: ");
                $enderecoCliente = readline("Endereço (Rua xx, numero xx): ");
                $novoCliente = new Humano($nomeCliente, $idadeCliente, $emailCliente, $enderecoCliente, $contatoCliente);
                $clinica->cadastrarCliente($novoCliente);
                echo "Cadastrando usuário...";
                sleep(2);
                break;
            }

        }
    } elseif ($opcao == 3) {
        break;
    }


}