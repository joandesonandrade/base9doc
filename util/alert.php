<?php
class alertBehavior{
  function alerta_erro($texto='',$url='.',$showButton=true){
      $html = '<div class="alert alert-danger mt-2" role="alert">
              '.$texto.'<br>';
    if($showButton){
      $html .= '<a href="'.$url.'" class="btn btn-danger mt-2">voltar</a>';
    }
      $html .=  '</div>';
    return $html;
  }
}
?>
