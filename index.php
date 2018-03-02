<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Framework</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        require_once ('./includes/Config.inc.php');
        $create = new Create;
        $read = new Read;
        $delete = new Delete;
        $update = new Update;
// trigger_error("Ocorreu um erro!", E_USER_ERROR);
// frontErro("Cadastrado com Sucesso", MS_SUCCESS);
//  $dados = [
//    'produto'    => 'banana',
//    'quantidade' => 1.55,
//    'valor'      => 1.79
//  ];
//  $create->exeCreate("estoque",$dados);
//  if($create->getResultado()){
//    frontErro("Cadastro com sucesso", MS_SUCCESS);
//  }
//  echo "<pre>";
//  print_r($create);
//  echo "</pre>";
//        $read->exeRead("estoque");
//        echo "<pre>";
//        print_r($read);
//        echo "</pre>";
//        $dados = [
//            'tipo' => 1,
//            'especie' => 'humano',
//            'nome' => 'Marcos'
//        ];
//        $create->exeCreate("animal", $dados);
//        $read->exeRead('animal', "WHERE tipo = :tipo AND id > :num", "tipo=1&num=1");
//        $read->fullRead("SELECT nome,especie FROM animal WHERE tipo = :tipo", "tipo=1");
//        echo "<pre>";
//        print_r($read->getResult());
//        echo "</pre>";
//
//        echo "<hr>";
//
//        $read->setPlaces("tipo=2");
//        $read->exeRead('animal');
//        echo "<pre>";
//        print_r($read->getResult());
//        echo "</pre>";
//        echo "<hr>";
//        $delete->exeDelete("animal", "WHERE id = :id", "id=1");
//        $read->exeRead('animal');
//        echo "<pre>";
//        print_r($read->getResult());
//        echo "</pre>";
//        if($delete->getResult()){
//            frontErro("Foram excluidos {$delete->getRowCount()} registros.", MS_SUCCESS);
//        }

        $dados = [
            'produto'    => 'arroz',
            'quantidade' => 1,
            'valor'      => 8.8
        ];
        $update->exeUpdate("estoque", $dados, "WHERE id = :id","id=11");
        if($update->getResult()){
            frontErro("Atualizaçao com Sucesso", MS_SUCCESS);
        }
        
        echo "<pre>";
        print_r($update);
        echo "</pre>";
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
