<?php
require_once 'core/init.php';
// if(Session::exists('usuario')){
//   if(Session::verify('usuario',2)){
//       Redirect::to('home.php');
//       exit();
//   }
// }else{
//   Redirect::to('login.php?sessao nao criada');
//   exit();
// }

?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Relatório Credenciais - - FEG-Secretaria</title>
</head>
<body>
<div class="info-credencial">
    <?php
        $obj=new Credencial();
        $resultData=$obj->see('pedido');
        $obj->grab($resultData);    
    ?>
    <button type="submit"><a href="index.php">Retornar</a></button>
</div>

</body>
</html>
