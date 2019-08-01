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

if(!isset($_GET['r']) && $_GET['r']!='perguntas'){
  header('Location:perguntas.php?r=perguntas');
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
          <h1 class="h3 mb-4 text-gray-800">Perguntas e respostas</h1>

          <div class="list-group">
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

                ?>
              <a href="#" class="list-group-item mt-3 <?php if($do>4){$do=0;} echo $borders[$do]; ?>">
                <div class="w-100">
                  <p class="h3"><i class="fas fa-question text-primary"></i></p>
                  <h5 class="text-gray-900"><?php echo $tratamento->tratar_string($pergunta['titulo']); ?></h5>
                  <p class="text-gray-700"><?php echo $tratamento->tratar_texto($pergunta['texto']); ?></p>
                  <div class="float-right"><img class="border rounded-circle" width="50px" height="50px" src="img/user.png" /><p class="text-gray-600">Usuário</p></div>
                </div>
              </a>
              <?php
                }
              ?>
              <button type="button" class="btn btn-primary mt-2">Ver Mais</button>
              <input type="hidden" value="5" id="offset" name="offset" />
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

<?php include_once('fragment/footer.php'); ?>

</html>
