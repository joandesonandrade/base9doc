<?php
session_start();
if(!isset($_SESSION['base9'])){
  echo 'Você não possui permissão.';exit;
}

if(!isset($_GET['idFile'])){
  echo 'ID inválido';exit;
}

require_once('config/dbconexao.php');
require_once('util/consulta.php');
$consultar = new consultar();

$documento = $consultar->selecionar_documento($db,intval($_GET['idFile']));

if(count($documento) == 0){
  echo 'Arquivo inválido.';exit;
}
header('Content-type:application/octet-stream');
header('Content-Disposition: attachment; filename="'.$documento['Name'].$documento['Extension'].'"');
$data = file_get_contents('documentos/'.$documento['Subject_Id'].'/'.$documento['Name'].$documento['Extension']);
//$base64 = 'data:image/jpeg;base64,'.base64_encode($data);
echo $data;
?>
