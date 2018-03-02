<?php
abstract class Connection{
  private static $host = HOST;
  private static $user = USER;
  private static $pass = PASS;
  private static $base = BASE;

  /** PDO retorno um obj PDO **/

  private static $connect = null;

  private static function conectar(){
    try {
      if(self::$connect == null){
        // cada banco tem o seu formato de DSN
        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$base;
        // configura como o meu banco vai trabalhar, neste caso configuramos os caracteres como UTF8
        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
        self::$connect = new PDO($dsn, self::$user, self::$pass, $options);
      }
    } catch (Exception $e) {
      backErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
      die;
    }
    // aqui setamos o tipo de erro que o PDO vai trabalhars
    self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //aqui retornamos a conexão
    return self::$connect;
  }

  protected static function getConnection(){
    //self::     métodos static
    return self::conectar();
  }

}
