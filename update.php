<?php
    require_once 'core/init.php';

    $user= new User();
    if(!$user->isLoggedIn()){
        Redirect::to('index.php');
    }

    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'name'=>array(
                    'required'=>true,
                    'min'=>2,
                    'max'=>50
                )
            ));

            if($validation->passed()){
                //update
                try{
                    $user->update(array(
                        'name'=>Input::get('name')
                    ));

                    Session::flash('home','Your details have been updated');
                    Redirect::to('index.php');
                }catch(Exception $e){
                    die($e->getMessage());
                }
            }else{
                foreach($validation->errors() as $error){
                    echo $error, '<br>';
                }
            }
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/style.css">
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
            <?php if(escape($user->data()->grupo)=='2'){
                ?>
<li>
                <a href="DocData.php"><span class="las la-receipt"></span><span>Lista de documentos</span></a>
                
            </li>
            <li>
                <a href="registro.php"><span class="las la-users"></span> <span>Lista de usuários</span></a>
               
            </li>
                <?php
            } ?>
            <!--<li>
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
<div class="information">
            <img src="assets/feg-logo.png" alt="FEG Logo">
            <p>Bem-vindo! à FEG-Secretaria</p>
            <p>Preencha com cuidado os seus dados</p>
        </div>
<div class="form-information">
            <div class="form-information-childs">
                <h2>Redefinição do Nome do usuário</h2>
                <form action="" method="POST">
        <div class="field">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo escape($user->data()->name); ?>">
            <input type="submit" value="Update">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </div>

    </form>
            </div>
</div>
</div>

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
</html>