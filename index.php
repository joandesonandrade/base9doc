<?php
session_start();
if(!isset($_SESSION['base9'])){
  header('Location:login.php');
  exit;
}

require_once('config/dbconexao.php');
require_once('util/tratamento.php');
require_once('util/consulta.php');

$consultar = new consultar();
$tratamento = new tratar();

$informacoes = $consultar->selecionar_informacoes_usuarios($db,$_SESSION['base9_id']);

if(!isset($_GET['r']) && $_GET['r']!='home'){
  header('Location:index.php?r=home');
  exit;
}

if($informacoes['active'] == 0){
  $_SESSION['base9_active'] = $informacoes['active'];
  ?><script>window.location='confirme.php';</script><?php
  exit;
}
?>

<?php include_once('fragment/header.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Início</h1>

          <form class="d-lg-none d-sm-inline-block col-12 form-inline mr-auto my-2 my-md-0 mw-100 pb-5">
            <div class="input-group">
              <input type="text" class="form-control bg-white border-1 small" placeholder="Buscar material..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <?php
            $perguntas = $consultar->selecionar_perguntas($db);
            if(count($perguntas) > 0){

          ?>
          <h5 class="h5 mb-4 text-gray-700">Perguntas <span class="badge badge-primary badge-pill">novo</span></h5>

          <div class="list-group">
            <?php
            $borders = [
              'border-left-primary',
              'border-left-success',
              'border-left-info',
              'border-left-warning',
              'border-left-danger '
            ];
            ?>

            <?php

            $do=0; foreach ($perguntas as $pergunta) { $do++;
              $usuario = $consultar->selecionar_informacoes_usuarios($db,$pergunta['id_usuario']);
              ?>
            <a href="#" class="list-group-item mt-3 <?php if($do>4){$do=0;} echo $borders[$do]; ?>">
              <div class="w-100">
                <p class="h3"><i class="fas fa-question text-primary"></i></p>
                <h5 class="text-gray-900"><?php echo $tratamento->tratar_string($pergunta['titulo']); ?></h5>
                <p class="text-gray-700"><?php echo $tratamento->tratar_texto($pergunta['texto']); ?></p>
                <div class="float-right"><img class="border rounded-circle" width="50px" height="50px" src="img/user.png" /><p class="text-gray-600"><?php echo $tratamento->tratar_normal($usuario['nome']); ?></p></div>
              </div>
            </a>
            <?php
              }
            ?>
            <a href="#vermais" class="btn">Ver Mais Perguntas</a>
          </div>
        <?php } ?>

          <?php
            $documentos = $consultar->selecionar_documentos($db);
            if(count($documentos) > 0){
          ?>

          <h5 class="h5 mb-4 text-gray-700 mt-5">Documentos <span class="badge badge-primary badge-pill">novo</span></h5>
          <div class="list-group">

          <?php $do=0; foreach ($documentos as $documento) { $do++; ?>
            <?php $usuario = $consultar->selecionar_informacoes_usuarios($db,$documento['Author_Id']); ?>
            <a href="#" onclick="javascript:baixar(<?php echo $documento['Id']; ?>,'<?php echo $documento['Name']; ?>');" data-toggle="modal" data-target="#exampleModalLong" class="list-group-item mt-3 <?php if($do>4){$do=0;} echo $borders[$do]; ?>">
              <div class="w-100">
                <p class="h3"><i class="fas fa-file"></i></p>
                <h5 class="text-gray-900"><?php echo $tratamento->tratar_string($documento['Name']); ?></h5>
                <div class="float-right"><img class="border rounded-circle" width="50px" height="50px" src="img/user.png" /><p class="text-gray-600"><?php if(count($usuario) >0){echo $tratamento->tratar_normal($usuario['nome']);}else{echo 'Usuário';} ?></p></div>
              </div>
            </a>
            <?php
                  }
            ?>

            <a href="#vermais" class="btn">Ver Mais Documentos</a>
          </div>
        <?php } ?>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Base9 <?php echo date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    <script>
      function baixar(id,titulo){
        $("#documento_nome").html(titulo);
        $("#documento_link").attr('href','baixar.php?idFile='+id);
      }
    </script>


<?php include_once('fragment/footer.php'); ?>

</html>
