<?php
    require_once 'core/init.php';

    if(Input::exists()){
        if(Token::check(Input::get('token'))){

            $validate= new Validate();
            $validation=$validate->check($_POST,array(
                'username'=>array('required'=>true),
                'password'=>array('required'=>true)
            ));

            if($validation->passed()){
                $user =new User();

                $remember = (Input::get('remember')=== 'on') ? true : false; 
                $login=$user->login(Input::get('username'),Input::get('password'),$remember);

                if($login){
                    $data=$user->getSession(Input::get('username'));
                    if($data==2){
                        $_SESSION['usuario']=$data;
                        Redirect::to('index.php');
                    }else if($data==1){
                        $_SESSION['usuario']=$data;
                        Redirect::to('home.php');
                    }else{  
                        echo 'error';
                        die();
                    }    
                        // if($user->hasPermission()){
                        //     $_SESSION['usuario']=2;
                        //     Redirect::to('index.php');
                        // }else{
                        //     $_SESSION['usuario']=1;
                        //     Redirect::to('home.php');
                        // }
                }else{
                    echo '<p>Sorry, logging in failed</p>';
                }
            }else{
                foreach ($validation->errors() as $error) {
                    echo $error, '<br>';
                }
            }

        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        @media only screen and (max-width: 600px) {
    .container-form {
        flex-direction: column;
        max-width: 100%;
    }

    .information,
    .form-information {
        width: 100%;
        border-radius: 0;
    }
}


* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Courier New', Courier, monospace;
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f5f5f5;
}

.container-form {
    display: flex;
    height: auto;
    max-width: 900px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: all 0.5s ease-in-out;
    margin: 18px;
    background-color: #fff;
}

.information {
    width: 40%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    background-color: #183e66;
    border-bottom-left-radius: 10px;
    border-top-left-radius: 10px;
    color: #fff;
    padding: 20px;
}

.information img {
    width: 150px;
    margin-bottom: 20px;
    width: 100%;
    height: auto;
}

.form-information {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 60%;
    text-align: center;
    background-color: #f5f5f5;
    border-bottom-right-radius: 10px;
    border-top-right-radius: 10px;
    padding: 20px;
}

.form-information-childs {
    width: 100%;
    max-width: 400px;
}

.form-information-childs h2 {
    color: #333;
    font-size: 2rem;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
    text-align: left;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    background-color: #183e66;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #005fbf;
}

    </style>
</head>
<body>
    <div class="container-form">
        <div class="information">
            <img src="assets/feg-logo.png" alt="Logo">
            <h2>Welcome!</h2>
            <p>To the FEG-SEC.</p>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Login</h2>
                <form action="" method="POST">
                    <div class="field">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" autocomplete="off">
                    </div>
                    <div class="field">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="field">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <div class="">
    <label>Criar conta. <a href="register.php">registe-se aqui</a>.</label>
</div>
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
