<?php
    require_once 'core/init.php';
    if(!Session::exists('usuario')){
       Redirect::to('login.php');
        exit();
    }
    $user=new User();
    if($user->isLoggedIn()){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faculdade De económia e Gestão</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo2.css">
    <link rel="stylesheet" href="css/media.css">
    
    
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
                <li class="drop">
                    <a href="#"><span class="las la-clipboard-list"></span>  <span>Pedidos</span>
                    </a>
                    <ul class="dropdown-content">
                            <li class="d-content-docs"><a href="formulario_am.php">anulação de matricula</a></li>
                            <li class="d-content-docs"><a href="formulario_dn.php">declaração de notas</a></li>
                            <li class="d-content-docs"><a href="formulario_pc.php">de credencial</a></li>
                            <li class="d-content-docs"><a href="formulario_pe.php">de equivalência</a></li>
                            <li class="d-content-docs"><a href="formulario_mc.php">mudança de curso</a></li>
                            <li class="d-content-docs"><a href="formulario_mt.php">mudança de turno</a></li>
                            <li class="d-content-docs"><a href="formulario_mc.php">de revisão de exame</a></li>
                            <li class="d-content-docs"><a href="formulario_mc.php">de realização de exame</a></li>
                        </ul>
                </li>
                <!-- <li>
                    <a href="#"><span class="las la-clipboard-list"></span><span>Projects</span></a>
                    
                </li>
                <li>
                    <a href="#"><span class="las la-shopping-bag"></span> <span>Orders</span></a>
                   
                </li>
                <li>
                    <a href="#"><span class="las la-receipt"></span><span>Inventory</span></a>
                    
                </li>
                <li>
                    <a href="#"><span class="las la-user-circle"></span> <span>Accounts</span></a>
                   
                </li>
                <li>
                    <a href="#"><span class="las la-clipboard-list"></span>   <span>Tasks</span></a>
                 
                </li>
                <li>
                    <a href="#"><span class="las la-sign-out-alt"></span>   <span>Arabic</span></a>
                </li> -->
                <li>
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
            <!-- <div class="search-wraper">
                <span class="las la-search"></span>
                <input type="search" placeholder="search here"/>
            </div>./search-wrapper -->
            <div class="user-wraper">
                <img src="img/do-utilizador.svg" alt="" height="30px" width="30px">
                <div>
                    <span><?php echo escape($user->data()->username); ?></span>
                    <small><?php if(escape($user->data()->grupo) == '2'){echo 'Admin';}else{echo 'User';}?></small>
                </div>
            </div><!-- ./user-wraper -->
        </header>
        <main>
            <!-- <div class="cards">
                <div class="single-card"> 
                    <div>
                        <h1>100</h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div> end card one -->
                <!-- <div class="single-card">
                    <div>
                        <h1>20</h1>
                        <span>projects</span>
                    </div>
                    <div>
                        <span class="las la-clipboard"></span>
                    </div>
                </div>end card two -->
                <!-- <div class="single-card">
                    <div>
                        <h1>$50</h1>
                        <span>Income</span>
                    </div>
                    <div>
                        <span class="lab la-google-wallet"></span>
                    </div>
                </div>end card three -->
                <!-- <div class="single-card">
                    <div class="text">
                        <h1>124</h1>
                        <span>Orders</span>
                    </div>
                    <div class="icon">
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>< end card four 
            </div>./cards -->
            <!-- <div class="charts">
               <div id="columnchart_material" style="width: 80%; height: 300px; margin: 30px auto"></div>
            </div>
            <div class="charts">
                <div id="curve_chart" style="width: 80%; height: 300px; margin: 30px auto"></div>
             </div> -->
             <!-- <div class="imagefield">
                <img src="assets/feg-logo.png" alt="" >
    </div> -->
    <div class="container">
  <center>
    <img src="assets/feg-logo.png" alt="Imagem" class="img-fluid" height="350px" width="350px">
  </center>
</div>
            
            <div class="cards">
                <div class="card-single">
                    <div>
                        <span>A Faculdade de Economia e Gestão (FEG)<br> 
                        outrora Escola Superior de Contabilidade e Gestão (ESCOG) é uma unidade orgânica criada a 20 de Agosto de 2008, com vocação para pesquisa, ensino, extensão e inovação nas áreas das ciências económicas e empresariais.</span>
                    </div>
                    <div>
                        
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <span>A sua criação foi uma resposta da UP-Maputo às exigências e necessidades do mercado de trabalho, que se fazia e ainda se faz sentir de profissionais qualificados de nível superior, com competência para competir no mercado de trabalho nacional e internacional</span>
                    </div>
                    <div>
                        
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <span>Desde a sua criação, as áreas de abrangência das actividades da FEG no ensino, pesquisa, extensão e inovação são as ciências empresariais e económicas. Desde a sua fundação já graduou cerca de 3.350 estudantes.</span>
                    </div>
                    <div>
                       
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <span>Desde a sua criação, as áreas de abrangência das actividades da FEG no ensino, pesquisa, extensão e inovação são as ciências empresariais e económicas. Desde a sua fundação já graduou cerca de 3.350 estudantes.</span>
                    </div>
                    <div>
                       
                    </div>
                </div>
                <div>
                    <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"]=="notsubmited")
                            echo "<p>Erro ao submeter o documento, tente mais tarde</p>"; 
                        elseif ($_GET["error"]=="submited")
                            echo "<p> O seu documento foi submetido com sucesso. Aproxime da secretaria daqui a 2 dias para fazer o levantamento do mesmo</p>";
                        elseif($_Get["error"]=="incorrectos"){
                            echo "<p> Password ou senha incorrecta</p>";
                        }    
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
</body>
<!-- files jQuery -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/JQuery.js"></script>
<!-- file charts js -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="js/chart.js"></script>
</html> <?php }