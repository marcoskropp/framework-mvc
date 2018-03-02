<?php

/**
 * <b>Read.class</b>
 * Classe destinada as leituras genéricas de nosso sistema
 * */
class Update extends Connection {

    private $tabela; // tabela que iremos trabalhar
    private $dados; // 
    private $termos; // recebe a nossa query
    private $places; // recebe os campos que serao lidos
    private $result; // flag para sabermos se foi inserido ou não

    /** @var PDOStatement = responsável pela nossa query = utilizaremos metodos da classe PDOStatement */
    private $update;

    /** @var PDO */
    private $connection;

    //métodos publicos
    /**
     * <b>exeUpdate</b> Executa uma atualizaçao simples junto ao banco de dados
     * utilizando prepared statements
     *  Basta informar o nome da tabela
     * 
     * @param STRING $tabela = Informa a tabela que vai fazer a leitura;
     * @param ARRAY $dados = Recebemos os valores a serem inseridos
     * @param STRING $termos = ex WHERE | ORDER | LIMIT | OFFSET 
     * @param STRING $parseString = links
     * 
     * */
    public function exeUpdate($tabela, array $dados, $termos, $parseString) {
        $this->tabela = (string) $tabela;
        $this->dados = $dados;
        $this->termos = (string) $termos;
        parse_str($parseString, $this->places);
        $this->getSintaxe();
        $this->execute();
    }

    /**
     * <b>Obter resultado:</b> Numero de registros encontrados.
     * @return ARRAY $valor = array com os resultados
     * */
    public function getResult() {
        return $this->result;
    }

    /**
     * <b>Contar Linhas:</b> Retorna o numero de registros encontrados pela query.
     *  @return INT $valor = Quantidade de registros encontrados no BD
     *   * */
    public function getRowCount() {
        return $this->update->rowCount();
    }

    /**
     * <b>Alterar Places:</b> Chame esta funçaoapos fazer uma leitura.
     * O objetivo e alterar os valores dos links passados na leitura
     * do metodo utilizado, exeReal ou fullRead
     *   * */
    public function setPlaces($parseString) {
        // armazando dentro do places os valores recebidos em $parceString
        parse_str($parseString, $this->places);
        $this->execute();
    }

    // métodos privados

    /**
     * Obtem o objeto com o PDO e prepara a nossa query
     * */
    private function connect() {
        $this->connection = parent::getConnection();
        $this->update = $this->connection->prepare($this->update);
    }

    /*
     * Criamos a sintaxe para utilizar na query com Prepared Statements
     * */

    private function getSintaxe() {
     foreach($this->dados as $key => $value){
         $place[] = $key . '= :' . $key;
     }   
     $place = implode(', ', $place);
     $this->update = "UPDATE {$this->tabela} SET {$place} {$this->termos}";
    }

    /*
     * Obtem a conexão, a sintaxe e executa a query
     * */

    private function execute() {
        $this->connect();
        try {
            $this->update->execute(array_merge($this->dados, $this->places));
            $this->result = true;
            } catch (Exception $e) {
            $this->result = null;
            $mensagem = "<b>Erro ao atualizar :</b> {$e->getMessage()} ERRO #{$e->getCode()}";
            frontErro($mensagem, MS_ERROR, true);
        }
    }

}
