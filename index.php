<?php
    require_once 'core/init.php';
    if(Session::exists('usuario')){
        if(Session::verify('usuario',2)){
            Redirect::to('home.php');
            exit();
        }
    }else{
        Redirect::to('login.php?sessao nao criada');
        exit();
      }
   $user=new User();
    if($user->isLoggedIn()){
       // $user->relatorio()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faculdade De económia e Gestão</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilo2.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/formulario.css">
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h1><span><img src="assets/feg-logo.png" alt="" height="30px" width="30px"></span><span>Sec.Feg</span></h1>
        </div><!-- ./sidebar brand -->
        <div class="sidebar-menue">
            <ul class="dropdown">
                <li>
                    <a href="index.php" class="active"><span class="las la-igloo"></span><span>Dashbaord</span></a>
                </li>
                <li>
                    <a href="home.php"><span class="las las la-home"></span>  <span>Home</span>
                    </a>
                 
                </li>
                <!-- <li>
                    <a href="#"><span class="las la-clipboard-list"></span><span>Projects</span></a>
                    
                </li>
                <li>
                    <a href="#"><span class="las la-shopping-bag"></span> <span>Orders</span></a>
                   
                </li> -->
                <li>
                    <a href="DocData.php"><span class="las la-receipt"></span><span>Lista de documentos</span></a>
                    
                </li>
                <li>
                    <a href="registro.php"><span class="las la-users"></span> <span>Lista de usuários</span></a>
                   
                </li>
                <!--<li>
                    <a href="#"><span class="las la-clipboard-list"></span>   <span>Tasks</span></a>
                 
                </li>
                <li>
                    <a href="#"><span class="las la-sign-out-alt"></span>   <span>Arabic</span></a>
                </li> -->
                
                <!-- <li class="border-top my-3"></li> -->
    <li >
      <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          <a href="#"><span class="las la-sign-out-alt"></span>   <span>Sign out</span></a>
      </button>
      <div class="collapse" id="account-collapse">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="profile.php" class="link-dark rounded"><span class="las la-sign-person"></span>Perfil</a></li>
          <li><a href="changepassword.php" class="link-dark rounded"><span class="las la-sign-out-alt"></span>Trocar Palavra-passe</a></li>
          <li><a href="update.php" class="link-dark rounded"><span class="las la-sign-out-alt"></span>Actualizar Dados</a></li>
          <li><a href="logout.php" class="link-dark rounded"><span class="las la-sign-out-alt"></span>Sair</a></li>
        </ul>
      </div>
    </li>
            </ul>
        </div>
    </div><!-- ./sidebar -->

    <div class="mean-contnet">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                    Painel
                </label>
            </h2>
            <div class="user-wraper">
                <img src="img/do-utilizador.svg" alt="" height="30px" width="30px">
                <div>
                    <span><?php echo escape($user->data()->username); ?></span>
                    <small><?php if(escape($user->data()->grupo) == '2'){echo 'Admin';}else{echo 'User';}?></small>
                </div>
            </div>
        </header>
        <main>
    <div class="container">
  <center>
    <img src="assets/feg-logo.png" alt="Imagem" class="img-fluid" height="350px" width="350px">
  </center>
</div>
            
<div class="cards mx-3 d-flex justify-content-center align-items-center">
    <div class="card-single">
        <div>
            <h1></h1>
            <span><a href="doc_curso.php">Pendentes de mudança de cursos</a> </span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h1></h1>
            <span><a href="doc_turno.php">Pendentes de mudança de turno</a> </span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h1></h1>
            <span><a href="doc_credencial.php">Pendentes de pedido de credencial</a> </span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
    <div class="card-single">
        <div> 
            <h1></h1>
            <span><a href="doc_equivalencia.php">Pendentes de pedido de equivalencia</a> </span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
    <div class="card-sigle"></div>
    
</div>
<div class="cards mx-3 d-flex justify-content-center align-items-center">
<div class="card-single">
        <div>
            <h1></h1>
            <span><a href="doc_anulacao.php">Pendentes de anulacao de matricula</a> </span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h1></h1>
            <span><a href="doc_notas.php">Pendentes de declaracao de notas</a> </span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h1></h1>
            <span><a href="doc_revisao.php">Pendentes de revisao de exames</a> </span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
    
    <div class="card-single">
        <div>
            <h1></h1>
            <span><a href="doc_realizacao.php">Pendentes de pedido de realização exames</a> </span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
    <div class="card-single"></div>
</div>
        </main>
    <!-- </div> -->
</body>
</div>
<!-- files jQuery -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/JQuery.js"></script>
<!-- file charts js -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="js/chart.js"></script>
</html> <?php }