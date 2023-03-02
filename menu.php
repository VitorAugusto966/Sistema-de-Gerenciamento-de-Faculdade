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
    <script type="text/javascript" src="javascript/funcao.js"></script>

    <title> Menu </title>


    <style>
    body {
        background-color: black;
    }

    h2 {
        color: white;
    }


    .navbar {
        box-shadow: none;
        background-color: #222222;
    }

    #logout {
        background-color: red;
        color: white;
        border-color: red;
    }

    #logout:hover {
        background-color: white;
        color: red;
    }

    h2 {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-weight: bold;
        text-transform: uppercase;
    }


    #topo {
        margin-top: 20px;
        width: 100%;
    }

    #teste {
        margin-top: 20px;
        width: 75%;
        background-color: lightcoral;

    }

    body {
        background: black;
    }
    </style>

</head>
<?php  
                 require_once("config.php");
                 use modelo\Aluno;

                 if(!isset($_SESSION))
                 {
                    session_start();
                 }
                if(!isset($_SESSION["usuario"]))
                 {
                    
                     header("Location: index.php");
                 }

                 $opcao = "";

                 if(isset($_POST["enviar"]))
                 {
                     $opcao = $_POST["enviar"];
 
                 }

                 if($opcao == "logout")
                 {
                     session_unset();
                     header("Location:index.php");
                 }

                
    ?>

<body>
    <center>
        <div id="teste" class="jumbotron text-center" style="margin-bottom:0;padding-bottom:30px">
            <h2 style="color:white">Menu Principal </h2> <br>
            <h4 style="position:absolute;color:white">Bem vindo ao sistema: <?=$_SESSION["usuario"]->login?> <h4>
        </div>

        <nav id="teste" style="margin-top:0px" class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="">Menu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="menu" onmouseover="sob('menu')" onmouseout="tirar('menu')" class="nav-link"
                            href="menu.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a id="aluno" onmouseover="sob('aluno')" onmouseout="tirar('aluno')" class="nav-link"
                            href="cadAluno.php">Aluno</a>
                    </li>
                    <li class="nav-item">
                        <a id="curso" onmouseover="sob('curso')" onmouseout="tirar('curso')" class="nav-link"
                            href="cadCurso.php">Curso</a>
                    </li>
                    <li class="nav-item">
                        <a id="AlunoDisciplina" onmouseover="sob('AlunoDisciplina')"
                            onmouseout="tirar('AlunoDisciplina')" class="nav-link" href="cadAlunoDisciplina.php">Aluno
                            em Disciplina</a>
                    </li>
                    <li class="nav-item">
                        <a id="disciplina" onmouseover="sob('disciplina')" onmouseout="tirar('disciplina')"
                            class="nav-link" href="cadDisciplina.php">Disciplina</a>
                    </li>
                    <li class="nav-item">
                        <a id="notaAluno" onmouseover="sob('notaAluno')" onmouseout="tirar('notaAluno')"
                            class="nav-link" href="notasView.php">Notas do Aluno</a>
                    </li>
                    <li class="nav-item">
                        <a id="notaDisciplina" onmouseover="sob('notaDisciplina')" onmouseout="tirar('notaDisciplina')"
                            class="nav-link" href="notasDisciplinas.php">Notas por Disciplina</a>
                    </li>
                    <li class="nav-item">
                        <a id="boletim" onmouseover="sob('boletim')" onmouseout="tirar('boletim')" class="nav-link"
                            href="boletim.php">Boletim</a>
                    </li>
                    <li class="nav-item">
                        <form action='menu.php' method='POST'>
                            <button id='logout' name='enviar' value="logout" class="btn btn-outline-success"
                                type='submit'>
                                Sair </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

    </center>


    <?php
     if($_SESSION["usuario"]->login != "admin")
     {
         echo "<script> 
                lista = document.getElementsByClassName('nav-link');
                lista[0].style.display='none';
                lista[1].style.display='none';
                lista[2].style.display='none';
                lista[3].style.display='none';
                lista[4].style.display='none';
                lista[6].style.display='none';
                

                
                </script>";
     }

?>
</body>

</html>