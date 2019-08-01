<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php
    $titles = array(
      'home' => 'Início',
      'disciplinas' => 'Disciplinas',
      'enviar' => 'Enviar documento',
      'perguntas' => 'Perguntas e respostas'
    );
  ?>

  <title>Base9 - <?php if(isset($_GET['r'])){ if(isset($titles[$_GET['r']])){echo $titles[$_GET['r']];} } ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!--<i class="fas fa-laugh-wink"></i>-->
        </div>
        <div class="sidebar-brand-text mx-3">BASE9</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php if(isset($_GET['r']) && $_GET['r']=='home'){ ?>active<?php } ?>">
        <a class="nav-link" href="index.php?r=home">
          <i class="fas fa-home"></i>
          <span>Início</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Materiais
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <div>
      <li class="nav-item <?php if(isset($_GET['r']) && $_GET['r']=='disciplinas'){ ?>active<?php } ?>">
        <a class="nav-link" href="disciplinas.php?r=disciplinas">
          <i class="fas fa-file"></i>
          <span>Disciplinas</span>
        </a>
      </li>
        <li class="nav-item <?php if(isset($_GET['r']) && $_GET['r']=='enviar'){ ?>active<?php } ?>">
        <a class="nav-link" href="enviar.php?r=enviar">
          <i class="fas fa-upload"></i>
          <span>Enviar material</span>
        </a>
        </li>
      </div>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Social
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php if(isset($_GET['r']) && $_GET['r']=='perguntas'){ ?>active<?php } ?>">
        <a class="nav-link" href="perguntas.php?r=perguntas">
          <i class="fas fa-question-circle"></i>
          <span>Peguntas e respostas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../base9chat/">
          <i class="fas fa-comment-dots"></i>
          <span>Chat privado</span>
        </a>
      </li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form name="buscador" method="get" enctype="application/x-www-form-urlencoded" action="busca.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <input type="hidden" name="tipo" value="<?php if(isset($_GET['r'])){ echo $_GET['r']; } ?>" />
            <div class="input-group">
              <input type="text" name="q" class="form-control bg-light border-0 small" placeholder="Buscar material..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <li class="d-none d-lg-block nav-item no-arrow">
              <a class="nav-link" href="perguntas.php" role="button">
                <i class="fas fa-question-circle"></i>
              </a>
            </li>

            <li class="d-none d-lg-block nav-item no-arrow">
              <a class="nav-link" href="../base9chat/" role="button">
                <i class="fas fa-comment-dots"></i>
              </a>
            </li>

            <li class="nav-item no-arrow">
              <a class="nav-link" href="enviar.php" role="button">
                <i class="fas fa-upload"></i> ENVIAR MATERIAL
              </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $informacoes['nome']; ?></span>
                <img class="img-profile rounded-circle border" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Sair
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
