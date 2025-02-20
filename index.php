<?php
require_once "Clinica.php";

$clinica = new Clinica();
function printarMensagem($mensagem)
{

    echo "-------------------------------------\n";
    echo "$mensagem\n";
    echo "-------------------------------------\n";
}

$balconista = new Balconista("Maria", "Rua dos balcões", 23, "42 99999-9999", 2200);
$clinica->adicionarFuncionario($balconista);


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
            echo "[1] Funcionário\n[2] Cliente \n[3] Sair\n";
            $opcao = readline("-");
        }

    } else if($opcao == 2){
       //fazer logica de adicionar animal e comprar produtos
    } 
    elseif ($opcao == 3) {
        break;
    }


}