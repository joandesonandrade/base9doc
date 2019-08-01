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

if(!isset($_GET['r']) && $_GET['r']!='enviar'){
  header('Location:enviar.php?r=enviar');
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
          <h1 class="h3 mb-4 text-gray-800">Enviar material</h1>

            <div class="p-5 bg-gray-200">
              <form action="enviar.php" method="post" enctype="multipart/form-data">
                <div class="input-group mb-3">
                  <input type="file" class="w-100 bg-gray-300" style="height:100px;" name="arquivo" value="">
                </div>
                <button type="submit" class="btn btn-primary float-right" name="btUpload"><i class="fas fa-file-upload"></i> Subir o documento</button>
              </form>
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
