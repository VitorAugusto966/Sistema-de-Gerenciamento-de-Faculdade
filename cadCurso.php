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
    <title> Cadastro de Curso</title>

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
            <h1 style="color:white">Cadastro de curso</h1>
        </div>

        <?php
                    include __DIR__.'/header.php';
                    require_once("config.php");
                    use modelo\Curso;
                    $opcao = "";
                    $Curso=new Curso();

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

                    if(isset($_GET["idCurso"])){       
                        $id = $_GET["idCurso"];
                        $Curso = Curso::getCursoCodigo($id);

                        if($_GET["op"]==1){         
                        $Curso->excluir();
                        $Curso = new Curso();
                        }

                    }

                    if(isset($_POST["enviar"]))
                    {
                        $opcao = $_POST["enviar"];

                    }

                    if($opcao == "cadastrar")
                    {
                        if(isset($_POST["idCurso"]) && $_POST["idCurso"] != null)
                            {
                                $Curso = new Curso();
                                $Curso->idCurso = $_POST["idCurso"];
                                $Curso->sigla = $_POST["sigla"];
                                $Curso->nome = $_POST["nome"];
                                $Curso->cargaHoraria = $_POST["cargaHoraria"];

                                $Curso->cadastrar();
                                $Curso = new Curso();
                            }
                    }
                    if($opcao == "pesquisar")
                    {
                        if(isset($_POST["idCurso"]) && $_POST["idCurso"] != null)
                        {
                            $id = $_POST["idCurso"];


                            $Curso1 =  Curso::getCursoCodigo($id);

                            if($Curso1 != null)
                            {
                                $Curso =  Curso::getCursoCodigo($id);
                            }

                        }
                    }
                    if($opcao == "alterar")
                    {
                        $Curso->idCurso = $_POST["idCurso"];
                        $Curso->sigla = $_POST["sigla"];
                        $Curso->nome = $_POST["nome"];
                        $Curso->cargaHoraria = $_POST["cargaHoraria"];

                        $Curso->atualizar();
                        $Curso = new Curso();


                    }





                    ?>


        <div class="jumbotron">
            <form action='cadCurso.php' method='POST'>
                <div class="form-group">
                    <label for="idCurso">ID Curso</label>
                    <input type="number" class="form-control" style="width:50%" name='idCurso'
                        placeholder="Digite o ID do curso" id="idCurso" value="<?=$Curso->idCurso?>">
                </div>
                <div class="form-group">
                    <label for="sigla">Sigla</label>
                    <input type="text" class="form-control" style="width:50%" name='sigla' placeholder="Digite a sigla"
                        id="sigla" value="<?=$Curso->sigla?>">
                </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" style="width:50%" name='nome' placeholder="Digite o nome"
                        id="nome" value="<?=$Curso->nome?>">
                </div>
                <div class="form-group">
                    <label for="cargaHoraria">Carga Horaria</label>
                    <input type="number" class="form-control" style="width:50%" name='cargaHoraria'
                        placeholder="Digite a carga horaria" id="cargaHoraria" value="<?=$Curso->cargaHoraria?>">
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