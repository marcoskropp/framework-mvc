<?php
/**
* Classe destinada a criar genéricos de nosso sistema,
* a mesma é responsável por popular nosso banco de dados
**/

class Create extends Connection{
  private $tabela; // guardar a tabela que estamos trabalhando
  private $dados; // array de dados a serem inseridos no BD
  private $result; // flag para sabermos se foi inserido ou não

  /** @var PDOStatement = responsável pela nossa query = utilizaremos metodos da classe PDOStatement */
  private $create;

  /** @var PDO */
  private $connection;

  //métodos publicos
  /**
  * <b>exeCreate</b> Executa um cadastro simples junto ao banco de dados
  * utilizando prepared statements
  * @param STRING $destino = Informa a tabela que vai receber os registros;
  * @param ARRAY $dados = Informa um array com os dados que serão utilizados
  * É um array atributivo - (nome da tabela => valor)
  **/
  public function exeCreate($tabela, array $dados){
    $this->tabela = (string) $tabela;
    $this->dados = $dados;
    $this->getSintaxe();
    $this->execute();
  }

  /**
  * <b>Obter resultado:</b> Retorna o ID do registro inserido ou FALSE caso não seja possível inserir valores
  * @return INT $valor = ultimo ID ou FALSE
  **/
  public function getResult(){
    return $this->result;
  }

  // métodos privados

  /**
  * Obtem o objeto com o PDO e prepara a nossa query
  **/
  private function connect(){
    $this->connection = parent::getConnection();
    $this->create = $this->connection->prepare($this->create);
  }

  /*
  * Criamos a sintaxe para utilizar na query com Prepared Statements
  **/
  private function getSintaxe(){
    // aqui nós pegamos as colunas da tabela, vem no indice do array dados
    $colunas = implode(', ', array_keys($this->dados));
    $valores = ':' . implode(', :', array_keys($this->dados));
    $this->create = "INSERT INTO {$this->tabela} ({$colunas}) VALUES ({$valores})";
  }

  /*
  * Obtem a conexão, a sintaxe e executa a query
  **/
  private function execute(){
    $this->connect();
    try{
      $this->create->execute($this->dados);
      $this->resultado = $this->connection->lastInsertId();
    } catch(Exception $e){
      $mensagem = "<b>Erro ao cadastrar:</b> {$e->getMessage()}";
      frontErro($mensagem, $e->getCode());
    }
  }

}
