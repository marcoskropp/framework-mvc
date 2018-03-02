<?php

/**
 * <b>Delete.class</b>
 * Classe destinada a realizar exclusoes genericas do nosso sistema
 * */
class Delete extends Connection {

    private $tabela; // tabela que iremos trabalhar
    private $termos; //
    private $places; // 
    private $result; // flag para sabermos se foi inserido ou não

    /** @var PDOStatement = responsável pela nossa query = utilizaremos metodos da classe PDOStatement */
    private $delete;

    /** @var PDO */
    private $connection;

//métodos publicos
    /**
     * <b>exeDelete</b> Executa uma exclusao simples ao banco de dados
     * 
     * @param STRING $tabela = Informa a tabela que vai fazer a leitura;
     * @param ARRAY $termos = ex WHERE | ORDER | LIMIT | OFFSET
     * @param STRING $parseString = links
     * 
     * */
    public function exeDelete($tabela, $termos, $parseString) {
        $this->tabela = $tabela;
        $this->termos = $termos;
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
        return $this->delete->rowCount();
    }

    /**
     * <b>Alterar Places:</b> Chame esta funçaoapos fazer uma leitura.
     * O objetivo e alterar os valores dos links passados na leitura
     * do metodo utilizado, exeReal ou fullRead
     *   * */
    public function setPlaces($parseString) {
// armazando dentro do places os valores recebidos em $parceString
        parse_str($parseString, $this->places);
        $this->getSintaxe();
        $this->execute();
    }

// métodos privados

    /**
     * Obtem o objeto com o PDO e prepara a nossa query
     * */
    private function connect() {
        $this->connection = parent::getConnection();
        $this->delete = $this->connection->prepare($this->delete);
    }

    /*
     * Criamos a sintaxe para utilizar na query com Prepared Statements
     * */

    private function getSintaxe() {
        $this->delete = "DELETE FROM {$this->tabela} {$this->termos}";
    }

    /*
     * Obtem a conexão, a sintaxe e executa a query
     * */

    private function execute() {
        $this->connect();
        try {
            $this->delete->execute($this->places);
            $this->result = true;
        } catch (Exception $e) {
            $this->result = null;
            $mensagem = "<b>Erro ao ler:</b> {$e->getMessage()} ERRO #{$e->getCode()}";
            frontErro($mensagem, MS_ERROR, true);
        }
    }

}
