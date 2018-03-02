<?php

define("HOST",'localhost');
define("USER",'root');
define("PASS",'toor');
define("BASE",'framework');

spl_autoload_register(function($class){
// diretorios que serão acessados
  $diretorio = ['connection','app'];
// verifica quando houve inclusão de arquivo
  $flagDir = null;

foreach ($diretorio as $dirName) {
  $arquivo = "{$dirName}/{$class}.class.php";
  if(!$flagDir && file_exists($arquivo) && !is_dir($arquivo)){
    require_once ($arquivo);
    $flagDir = true;
  }
}

if(!$flagDir){
  trigger_error("Não foi possível incluir o arquivo {$class}.class.php", E_USER_ERROR);
  die;
}
});

define ('MS_SUCCESS','alert-success');
define ('MS_INFO','alert-info');
define ('MS_ALERT','alert-warning');
define ('MS_ERROR','alert-danger');

function frontErro($erroMensagem, $erro, $erroDie = null){
  $class = ($erro == E_USER_NOTICE ? MS_INFO : ($erro == E_USER_WARNING ? MS_ALERT : ($erro == E_USER_ERROR ? MS_ERROR : $erro)));
  echo '<div class="alert '.$class.' alert-dismissible" role="alert">';
  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
  echo '<span aria-hidden="true">&times;</span></button>';
  echo "{$erroMensagem}";
  echo '</div>';
  if ($erroDie) {
    die;
  }
}

function backErro($erro, $erroMensagem, $erroFile, $erroLine){
  $class = ($erro == E_USER_NOTICE ? MS_INFO : ($erro == E_USER_WARNING ? MS_ALERT : ($erro == E_USER_ERROR ? MS_ERROR : $erro)));
  echo "<p class='alert {$class}'><b>Erro na linha: {$erroLine}</b> ::{$erroMensagem}<br>";
  echo "<small>Arquivo:{$erroFile}</small></p>";
  if($erro == E_USER_ERROR)
  die;
}

set_error_handler('backErro');
