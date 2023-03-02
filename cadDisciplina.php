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
    <title> Cadastro de Disciplina</title>

    <style>
    #topo {
        margin-top: 30px;
        width: 100%;
        margin-left: 0px;
    }

    .teste {
        margin-right: 10px;
    }

    .container {
        margin-left: 0px;
    }
    </style>
</head>

<body>
    <center>
        <div class="jumbotron text-center" style="margin-bottom:0;width:100%;background:lightcoral">
            <h1 style="color:white">Cadastro de Disciplina</h1>
        </div>
    </center>


    <?php

        require_once("config.php");
        include __DIR__.'/header.php';
        use modelo\Disciplina;
        $opcao = "";
        $Disciplina=new Disciplina(); 

        if(!isset($_SESSION))
        {
           session_start();
        }
       if(!isset($_SESSION["usuario"]))
        {
           
            header("Location: index.php");
        }
        else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]->login != "admin")
        {
            header("Location: menu.php");
        }

        if(isset($_GET["idDisciplina"])){       
            $id = $_GET["idDisciplina"];
            $Disciplina = Disciplina::getDisciplinaCodigo($id);

            if($_GET["op"]==1){         
            $Disciplina->excluir();
            $Disciplina = new Disciplina();
            }

        }

        if(isset($_POST["enviar"]))
        {
            $opcao = $_POST["enviar"];

        }

        if($opcao == "cadastrar")
        {
            if(isset($_POST["idDisciplina"]) && $_POST["idDisciplina"] != null)
                {
                    $Disciplina = new Disciplina();
                    $Disciplina->idDisciplina = $_POST["idDisciplina"];
                    $Disciplina->idCurso = $_POST["idCurso"];
                    $Disciplina->sigla = $_POST["sigla"];
                    $Disciplina->nome = $_POST["nome"];
                    $Disciplina->cargaHoraria = $_POST["cargaHoraria"];

                    $Disciplina->cadastrar();
                    $Disciplina = new Disciplina();
                }
        }

        if($opcao == "pesquisar")
        {
            if(isset($_POST["idDisciplina"]) && $_POST["idDisciplina"] != null)
            {
                $id = $_POST["idDisciplina"];


                $Disciplina1 =  Disciplina::getDisciplinaCodigo($id);

                if($Disciplina1 != null)
                {
                    $Disciplina =  Disciplina::getDisciplinaCodigo($id);
                }

            }
        }

        if($opcao == "alterar")
        {
            $Disciplina->idDisciplina = $_POST["idDisciplina"];
            $Disciplina->idCurso = $_POST["idCurso"];
            $Disciplina->sigla = $_POST["sigla"];
            $Disciplina->nome = $_POST["nome"];
            $Disciplina->cargaHoraria = $_POST["cargaHoraria"];

            $Disciplina->atualizar();
            $Disciplina = new Disciplina();

        }





        ?>


    <div class="jumbotron">

        <form action='cadDisciplina.php' method='POST'>
            <center>
                <div class="form-group">
                    <label for="idDisciplina">ID Disciplina</label>
                    <input type="number" class="form-control" style="width:50%" name='idDisciplina'
                        placeholder="Digite o ID da disciplina" id="idDisciplina" value="<?=$Disciplina->idDisciplina?>">
                </div>
                <div class="form-group">
                    <label for="idCurso">ID Curso</label>
                    <input type="number" class="form-control" style="width:50%" name='idCurso'
                        placeholder="Digite o ID do curso" id="idCurso" value="<?=$Disciplina->idCurso?>">
                </div>
                <div class="form-group">
                    <label for="sigla">Sigla</label>
                    <input type="text" class="form-control" style="width:50%" name='sigla' placeholder="Digite a sigla"
                        id="sigla" value="<?=$Disciplina->sigla?>">
                </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" style="width:50%" name='nome' placeholder="Digite o nome"
                        id="nome" value="<?=$Disciplina->nome?>">
                </div>
                <div class="form-group">
                    <label for="cargaHoraria">Carga Horaria</label>
                    <input type="number" class="form-control" style="width:50%" name='cargaHoraria'
                        placeholder="Digite a carga horaria" id="cargaHoraria" value="<?=$Disciplina->cargaHoraria?>">
                </div>
                <br>
                <div style="margin-left:0px;width:350px">
                    <button name='enviar' value="cadastrar" class="btn btn-outline-success" type='submit'>
                        Cadastrar </button>
                    <button name='enviar' value="listar" class="btn btn-outline-dark" type='submit'>
                        Listar </button>
                    <button name='enviar' value="alterar" class="btn btn-outline-primary" type='submit'>Alterar
                    </button>
                    <button name='enviar' value="pesquisar" class="btn btn-outline-warning" type='submit'>Pesquisar
                    </button>
                </div>
        </form>
        </center>