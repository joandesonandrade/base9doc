<?php
class consultar
{

  function selecionar_documento($db,$id){
    $sql = 'select * from documentos where Id=:id';
    $st = $db->prepare($sql);
    $st->bindValue(':id',$id,PDO::PARAM_INT);
    $st->execute();
    if($st->rowCount()){
      return $st->fetch(PDO::FETCH_ASSOC);
    }
    return [];
  }

  function checar_login($db,$email,$senha){
    $sql = 'select * from usuarios where email=:email and senha=:senha';
    $st = $db->prepare($sql);
    $st->bindValue(':email',$email,PDO::PARAM_STR);
    $st->bindValue(':senha',$senha,PDO::PARAM_STR);
    $st->execute();
    if($st->rowCount()){
      return $st->fetch(PDO::FETCH_ASSOC);
    }
    return [];
  }

  function selecionar_informacoes_usuarios($db,$id){
    $sql = 'select * from usuarios where id=:id';
    $st = $db->prepare($sql);
    $st->bindValue(':id',$id,PDO::PARAM_INT);
    $st->execute();
    if($st->rowCount()){
      return $st->fetch(PDO::FETCH_ASSOC);
    }
    return [];
  }

  function selecionar_perguntas($db,$offset=0,$limit=5,$order='DESC'){
    $sql = 'select * from perguntas  order by id '.$order.' limit :limit offset :offset';
    $st = $db->prepare($sql);
    $st->bindValue(':offset',$offset,PDO::PARAM_INT);
    $st->bindValue(':limit',$limit,PDO::PARAM_INT);
    $st->execute();
    if($st->rowCount()){
      return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
  }

  function selecionar_documentos($db,$offset=0,$limit=5,$order='DESC'){
    $sql = 'select * from documentos  order by id '.$order.' limit :limit offset :offset';
    $st = $db->prepare($sql);
    $st->bindValue(':offset',$offset,PDO::PARAM_INT);
    $st->bindValue(':limit',$limit,PDO::PARAM_INT);
    $st->execute();
    if($st->rowCount()){
      return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
  }

  function selecionar_disciplinas($db){
    $sql = 'select * from disciplinas  order by id ASC';
    $st = $db->prepare($sql);
    $st->execute();
    if($st->rowCount()){
      return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
  }

}
?>
