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

?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Lista de documentos</title>
</head>
<body>
    <?php include 'pasta/sidebar.php'?>
<div class="info-credencial">
<table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Curso</th>
                <th scope="col">Número de estudante</th>
                <th scope="col">Estado</th>
                <th scope="col">Operação</th>
            </tr>
        </thead>
        <tbody>

         
    <?php
        $obj=new Credencial();
        $resultData=$obj->registroUsers('credencial');
        $obj->grab($resultData);
        $resultData=$obj->registroUsers('anulacao');
        $obj->grab($resultData);
        $resultData=$obj->registroUsers('curso');
        $obj->grab($resultData);
        $resultData=$obj->registroUsers('equivalencia');
        $obj->grab($resultData);
        $resultData=$obj->registroUsers('notas');
        $obj->grab($resultData);
        $resultData=$obj->registroUsers('turno');
        $obj->grab($resultData);
        $resultData=$obj->registroUsers('realizar_exame');
        $obj->grab($resultData);
        $resultData=$obj->registroUsers('revisao_exame');
        $obj->grab($resultData);   
    ?>
    </tbody>
    </table> 
    <button type="submit"><a href="index.php">Retornar</a></button>
</div>

</body>
</html>
