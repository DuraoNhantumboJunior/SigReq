<?php
    require_once 'core/init.php';

    if(!Session::exists('usuario')){
       Redirect::to('login.php');
        exit();
    }
    $user=new User();
    if($user->isLoggedIn()){
    if(Input::exists()){
        
        $database=trim($_POST['type']);
        
        $query=$user->Enviar($database,array(
            'nome'=>trim($_POST['nome']),
            'idade'=>trim($_POST['idade']),
            'nacionalidade'=>trim($_POST['nacionalidade']),
            'numero_bi'=>trim($_POST['nr_bi']),
            'local_emissao_bi'=>trim($_POST['local_emissao']),
            'numero_estudante'=>trim($_POST['cod']),
            'curso'=>trim($_POST['nome_curso']),
            'regime'=>trim($_POST['regime']),
            'ano'=>trim($_POST['ano']),
            'motivo'=>trim($_POST['motivo']),
            'estado'=>'pendente',
        ));
        if($query){
            Redirect::to('home.php');
        }else{
            echo 'Error 101';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faculdade De económia e Gestão</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/estilo2.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/formulario.css">
    <style>
    

      
    </style>

    
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h1><span ><img src="assets/feg-logo.png" alt="" height="30px" width="30px"></span><span>Sec.Feg</span></h1>
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
                            <li class="d-content-docs"><a href="formulario_re.php">de revisão de exame</a></li>
                            <li class="d-content-docs"><a href="formulario_ree.php">de realização de exame</a></li>
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
                    <a href="logout.php"><span class="las la-sign-out-alt"></span>   <span>Sign out</span></a>
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
    <!-- <div class="container">
  <center>
    <img src="assets/feg-logo.png" alt="Imagem" class="img-fluid" height="350px" width="350px">
  </center>
</div> -->
                    
                
                    <div class="container-form">
        <div class="information">
            <img src="assets/feg-logo.png" alt="FEG Logo" class="img-fluid" height="250px" width="250px">
            <p>Bem-vindo à FEG-Secretaria</p>
            <p>Preencha com cuidado os seus dados</p>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Pedido de anulação de matricula</h2>
                <form action="" method="post">
                    <input type="hidden" name="type" value="anulacao">
                    <label for="nome">
                        <input type="text" name="nome" placeholder="Nome Completo" id="nome">
                    </label>
                    <label for="nacionalidade">
                        <input type="text" name="nacionalidade" placeholder="Nacionalidade" id="nacionalidade">
                    </label>
                    <label for="idade">
                        <input type="text" name="idade" placeholder="Idade" id="idade">
                    </label>
                    <label for="nr_bi">
                        <input type="text" name="nr_bi" placeholder="Número de BI" id="nr_bi">
                    </label>
                    <label for="local_emissao">
                        <input type="text" name="local_emissao" placeholder="Local de Emissão" id="local_emissao">
                    </label>
                    <label for="cod">
                        <input type="text" name="cod" placeholder="Código" id="cod">
                    </label>
                    <label for="nome_curso">
                        <input type="text" name="nome_curso" placeholder="Nome do Curso" id="nome_curso">
                    </label>
                    <label for="regime">
                        <input type="text" name="regime" placeholder="Regime" id="regime">
                    </label>
                    <label for="ano">
                        <input type="text" name="ano" placeholder="Ano em que Está" id="ano">
                    </label>
                    <label for="motivo">
                        <input type="text" name="motivo" placeholder="Motivo" id="motivo">
                    </label>
                    <!-- <label for="delegacao" id="delegacao">
                        <input type="radio" name="doc" value="102" checked>
                    </label> -->
                    <input type="submit" value="Submeter" name="submit">
                </form>
            </div>
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
</html> <?php } else { Redirect::to('home.php');}
