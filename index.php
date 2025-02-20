<?php
require_once "Clinica.php";

$clinica = new Clinica();
function printarMensagem($mensagem)
{

    echo "-------------------------------------\n";
    echo "$mensagem\n";
    echo "-------------------------------------\n";
}

$balconista = new Balconista("Maria", "maria@gmail.com","Rua dos balcões", 23, "42 99999-9999", 2200);
$clinica->adicionarFuncionario($balconista);
$clienteTeste = new Humano("gus", 31, "gustavo2016delonzek@gmail.com", "rua xx", "42 99");
$clinica->cadastrarCliente($clienteTeste);

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
                
                }else if($opcao == 3){
                    limparTela();
                    echo "Seu sálario atual é de R$" . number_format($balconista->calculaSalario(), 2);
                    sleep(5);
                }   
                else if ($opcao == 4) {
                    break;
                }

            }
        } else {
            printarMensagem("Funcionário não existe! Tente outra opção.");
            sleep(1);
        }

    } else if($opcao == 2){
        $email = trim(readline("Digite seu email: "));
        if($clinica->identificarCliente($email)){
            $clienteAtual = $clinica->identificarCliente($email);
            while(true){
                limparTela();
                printarMensagem("SEÇÃO CLIENTE");
                echo "[1]Agendar consulta pet\n[2]Ver produtos \n[3]Comprar produto\n[4]Sair\n";
                $opcao = readline("-");
                if($opcao == 1){
                    //lógica consulta cadastrar animal na consulta
                } else if($opcao == 2){
                    limparTela();
                    printarMensagem("PRODUTOS DA LOJA");
                    $clinica->listarProdutos();
                    readline("Pressione ENTER para voltar...");
                }else if($opcao == 3){
                //lógica de compra
                } else if($opcao == 4){
                    break;
                }
            }
        } else{
            while (true){
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
    } 
    elseif ($opcao == 3) {
        break;
    }


}