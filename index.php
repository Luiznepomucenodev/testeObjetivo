<?php
//Criação da classe produto
class Produto{
    public $nome;
    public $preco;
    public $quantidade;

    //método Set, recebe um array como parâmetro onde será definido os dados dos atributos no momento da chamada do método.
    //usando o this para ajustar o contexto mostrando q os atributos são da propria classe.
    function setProduto($data = array()){

        $this->nome = $data[0];
        $this->preco = $data[1];
        $this->quantidade = $data[2];
    }

    //Médoto Get, retorna um array com os atributos já estabelecidos.
    function getProduto($data){
        echo "Ultimo produto cadastrado foi ". $data[0]. " valor do produto é ". $data[1]. " e a quantidade cadastrada foi ". $data[2]. " unidades";
        echo"<br>";
    }
}

//Criação da classe Venda hendando os atributos de Produto
class Venda extends Produto{
    public $qtdVendida;
    public $desconto;
    public $ultimaVenda;

//O método setVenda recebe quatro parametro, o array com os produtos cadastrados, o produto a ser vendido, quantidade a ser vendida e o desconto.
//Foi criada uma variavel contendo um valor boleano para verificar se a venda foi efetivada ou não. Forçando true ou false conforme necessario.
//O larço de repetição for foi criado para fazer a interação e testes para cada item dentro do array produtos, verificando se o nome do produto a ser vendido consta no array de cada produto.
//É verificado também se há no estoque a quantidade do produto a ser vendido
//Foi criado um array ultimaVenda para armazenar os dados da venda.
//Para identificar o produto não cadastrado será realizado um teste com a variavel onde contem um valor boleano com seu resultado invertido
    function setVenda($produtos, $produto, $qtdVendida, $desconto){
        $vendaSucesso = false;
        for($i = 0; $i < sizeof($produtos); $i++){
            if($produtos[$i]->nome == $produto){
                if($produtos[$i]->quantidade >= $qtdVendida){
                    $this->ultimaVenda = [
                        "produto" => $produto,
                        "valor" => $produtos[$i]->preco,
                        "total" => $produtos[$i]->preco * $qtdVendida - $desconto,
                        "estoqueAtual" => $produtos[$i]->quantidade - $qtdVendida
                    ];
                    echo "Venda de ". $qtdVendida. " " . $produto . " realizada com sucesso no valor unitário de: " . $this->ultimaVenda["valor"] . " com R$". $desconto . " de desconto";
                    echo"</br>";
                    echo "Total da venda: " . $this->ultimaVenda["total"];
                    $vendaSucesso = true;
                }else {
                    echo "Quantidade de ". $produto . " não disponível no estoque";
                    $vendaSucesso = true;
                }
            }
        }
        if(!$vendaSucesso){
            echo "Produto " . $produto . " não cadastrado!";
        }
    }

//método getVenda faz uma vefificação se existe o array ultimaVenda que contem os dados das vendas, se positivo imprime os seus respectivos dados.
//Se não foi setada ou relaizada alguma venda, cai no else onde apresenta uma mensagem negativa.
    function getVenda(){
        if($this->ultimaVenda){
            echo "Ultima venda foi o produto ". $this->ultimaVenda["produto"]. " no valor " . $this->ultimaVenda["valor"] . " no total de ". $this->ultimaVenda["total"];
            echo "<br>";
            echo "Quantidade atual do produto no estoque é: " . $this->ultimaVenda["estoqueAtual"];
        }else {
            echo "Nenhuma venda realizada";
        }
    }   
}

//instâncias e chamadas de métodos dos produtos, passando os dados das vendas no array como parametro do método.
$produto = new Produto();
$produto1 = new Produto();
$produto1->setProduto($data = array('Cerveja', 5.99, 15));

$produto2 = new Produto();
$produto2->setProduto($data = array('Camisa', 19.99, 20));

$produto3 = new Produto();
$produto3->setProduto($data = array('Bermuda', 59.99, 10));

$produto4 = new Produto();
$produto4->setProduto($data = array('Bola', 27.59, 20));

$produto5 = new Produto();
$produto5->setProduto($data = array('Meia', 7.50, 30));


//Criação do array produtos com cada produto criado.
$produtos = array($produto1, $produto2, $produto3, $produto4, $produto5);

//Chamada do método getProduto que exibe o último produto cadastrado, recebe como parâmetro os dados do último produto cadastrado.
$produto->getProduto($data);

//instâncias e chamadas de métodos das vendas, passando os dados como parametro do método.
$venda = new Venda();
$venda->setVenda($produtos, "Bermuda", 2, 2);
echo "<br>";
$venda->setVenda($produtos, "Cerveja", 10, 2);
echo "<br>";
$venda->setVenda($produtos, "Meia", 10, 5);
echo "<br>";

//Chamada do método getvendas que exibe a última venda realizada.
$venda->getVenda();