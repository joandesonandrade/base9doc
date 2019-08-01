<?php
session_start();
if(isset($_SESSION['base9'])){
  header('Location:index.php');
  exit;
}

require_once('config/dbconexao.php');
require_once('util/consulta.php');
require_once('util/alert.php');

$consultar = new consultar();
$alerta = new alertBehavior();

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Base9 - Entrar</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
<?php
    if(isset($_POST['submetido'])){
      if(!isset($_POST['usuario:email'])){
        echo $alerta->alerta_erro('Campo email não existe.');
        exit;
      }

      if(!isset($_POST['usuario:senha'])){
        echo $alerta->alerta_erro('Campo senha não existe.');
        exit;
      }

      if(empty($_POST['usuario:email'])){
        echo $alerta->alerta_erro('Campo email não pode ser vázio.');
        exit;
      }

      if(empty($_POST['usuario:senha'])){
        echo $alerta->alerta_erro('Campo senha não pode ser vázio.');
        exit;
      }

      $email = $_POST['usuario:email'];
      $senha = md5($_POST['usuario:senha']);

      $login = $consultar->checar_login($db,$email,$senha);
      if(count($login) == 0){
        echo $alerta->alerta_erro('E-mail ou/e Senha inválidos.','.',false);
      }else{

        $_SESSION['base9_nome'] = $login['nome'];
        $_SESSION['base9_email'] = $login['email'];
        $_SESSION['base9_token'] = $login['token'];
        $_SESSION['base9_id'] = $login['id'];
        $_SESSION['base9_active'] = $login['active'];
        $_SESSION['base9'] = 1;

        if($_SESSION['base9_active'] == 0){
          ?><script>window.location='confirme.php';</script><?php
          exit;
        }else{
          ?><script>window.location='index.php';</script><?php
          exit;
        }

      }

    }
?>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem-Vindo!</h1>
                  </div>
                  <form class="user" action="login.php" name="form" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="submetido" value="1" />
                    <div class="form-group">
                      <input type="email" required name="usuario:email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="@dce.ufpb.br">
                    </div>
                    <div class="form-group">
                      <input type="password" required name="usuario:senha" class="form-control form-control-user" id="exampleInputPassword" placeholder="Senha" maxlength="50">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      <i class="fas fa-sign-in-alt"></i> Entrar agora
                    </button>
                    <a href="index.php" class="btn btn-user btn-block">
                      Criar uma conta
                    </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

<?php include_once('fragment/footer.php'); ?>

</html>
