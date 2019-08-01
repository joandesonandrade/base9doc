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

if(!isset($_GET['r']) && $_GET['r']!='disciplinas'){
  header('Location:disciplinas.php?r=disciplinas');
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
          <h1 class="h3 mb-4 text-gray-800">Disciplinas</h1>
          <?php
          $borders = [
            'border-left-primary',
            'border-left-success',
            'border-left-info',
            'border-left-warning',
            'border-left-danger '
          ];
          ?>
      <?php $disciplinas = $consultar->selecionar_disciplinas($db); if(count($disciplinas) >0){?>
      <div class="row">
          <!-- Earnings (Monthly) Card Example -->
        <?php $do=0; foreach ($disciplinas as $disciplina) { $do++; ?>
          <a href="#" class="col-xl-3 col-md-6 mb-4">
            <div class="card <?php if($do>4){$do=0;} echo $borders[$do]; ?> shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tratamento->tratar_string($disciplina['Name']); ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-graduation-cap  fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        <?php }} ?>
      </div>
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
