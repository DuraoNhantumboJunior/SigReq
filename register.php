<?php
    require_once 'core/init.php';



    if(Input::exists()){
        if(Token::check(Input::get('token'))){

        $validate=new Validate();
        $validation=$validate->check($_POST, array(
            'username'=>array(
                'required'=>true,
                'min'=>2,
                'max'=>20,
                'unique'=> 'users'
            ),
            'password'=>array(
                'require'=>true,
                'min'=>6
            ),
            'password_again'=>array(
                'required'=>true,
                'matches'=>'password'
            ),
            'name'=>array(
                'required'=>true,
                'min'=>2,
                'max'=>50
            )
        ));

        if($validation->passed()){

            $user = new User();

            $salt=Hash::salt(32);
            

            try {
                
                $user->create(array(
                    'username'=> Input::get('username'),
                    'password'=>Hash::make(Input::get('password'), $salt),
                    'salt'=>$salt,
                    'name'=>Input::get('name'),
                    'joined'=>date('Y-m-d H:i:s'),
                    'grupo'=>1

                ));

                Session::flash('home','You have been registered and can now log in!');
                header('Location: index.php');

            } catch (Exception $e) {
                die($e->getMessage());
            }
        }else{

           foreach($validation->errors() as $error) {
                echo $error. '<br>'; 
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
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
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
    background-color:#183e66;
    border-bottom-left-radius: 10px;
    border-top-left-radius: 10px;
    color: #fff;
    padding: 20px;
}

.information img {
    width: 150px;
    margin-bottom: 20px;
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
    margin-top: 10px;
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
            <h2>Welcome to Feg-Sec!</h2>
            <p>Preencha usando os seus dados e aproveite o nosso app.</p>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Register</h2>
                <form action="" method="POST">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
                    </div>

                    <div class="field">
                        <label for="password">Choose a password</label>
                        <input type="password" name="password" id="password" value="" autocomplete="off">
                    </div>

                    <div class="field">
                        <label for="password_again">Enter your password again</label>
                        <input type="password" name="password_again" id="password_again" value="" autocomplete="off">
                    </div>

                    <div class="field">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off">
                    </div>

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
