<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="login.js"></script>

    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">

    <title> Login </title>



</head>


<?php

            $opcao = "";
            require_once("config.php");
            use modelo\Aluno;
            if(isset($_POST["enviar"]))
            {
                $opcao = $_POST["enviar"];

            }
    
            if(!isset($_SESSION))
            {
                session_start();
            }



        if($opcao == "logar")
        {
            if(isset($_POST["login"])) 
            {
                $login = $_POST["login"];
                $senha = $_POST["senha"];

                $Aluno = Aluno::getUsuario($login);  

                                 

                if($Aluno != null) {
                       if($login==$Aluno->login && $senha == $Aluno->senha){
                           if(!isset($_SESSION["usuario"]))
                            {
                                    $_SESSION["usuario"] = new Aluno;
                                    $_SESSION["usuario"]->login = $login;
                                    $_SESSION["usuario"]->prontuario = $Aluno->prontuario;
                                    header('Location: menu.php');
                            }

                       }

                    }

            }
        }


    ?>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form action="index.php" method="POST" class="login100-form validate-form">
                    <span class="login100-form-title p-b-49">
                        Login
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                        <span class="label-input100">Usuario</span>
                        <input class="input100" type="text" name="login" placeholder="Digite o usuario">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Senha</span>
                        <input class="input100" type="password" name="senha" placeholder="Digite a senha">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>
                    <br> <br>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button name="enviar" value="logar" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>

                    <div id="msg">

                        <?php
    
            if(!isset($_SESSION))
            {
                session_start();
            }



        if($opcao == "logar")
        {
            if(isset($_POST["login"])) 
            {
                $login = $_POST["login"];
                $senha = $_POST["senha"];

                $Aluno = Aluno::getUsuario($login);  

                                 

                if($Aluno != null) {
                       if($login==$Aluno->login && $senha == $Aluno->senha){
                           if(!isset($_SESSION["usuario"]))
                            {
                                    $_SESSION["usuario"] = new Aluno;
                                    $_SESSION["usuario"]->login = $login;

                                    header('Location: menu.php');
                            }

                       }
                       else
                       {
                       echo("<br> <div class='alert alert-danger'>
                        <strong>Erro!</strong> Senha incorreta</div>"); 
                       }
                    }
                    else
                    {
                        echo("<br> <div class='alert alert-danger'>
                        <strong>Erro!</strong> Usuario incorreto</div>"); 
                    }
                  


            }
        }


    ?>


                    </div>


                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>


</body>

</html>