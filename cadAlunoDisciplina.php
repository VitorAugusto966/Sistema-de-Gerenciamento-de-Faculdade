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
    <title> Cadastro de Alunos em Disciplinas</title>
    <script type="text/javascript" src=".js"></script>

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
            <h1 style="color:white">Cadastro de aluno em disciplina</h1>
        </div>
    </center>

    <?php
                    
                    require_once("config.php");
                    include __DIR__.'/header.php';
                    use modelo\AlunoDisciplina;
                    $opcao = "";
                    $AlunoDisciplina=new AlunoDisciplina(); 

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

                    // if(isset($_GET["idDisciplina"])){      ///arrumar ainda 
                    //     $id = $_GET["idDisciplina"];
                    //     $Disciplina = Disciplina::getDisciplinaCodigo($id);

                    //     if($_GET["op"]==1){         
                    //     $Disciplina->excluir();
                    //     $Disciplina = new Disciplina();
                    //     }

                    // }

                    if(isset($_POST["enviar"]))
                    {
                        $opcao = $_POST["enviar"];

                    }

                    if($opcao == "cadastrar")
                    {
                        if(isset($_POST["idDisciplina"]) && $_POST["idDisciplina"] != null &&
                           isset($_POST["prontuarioAluno"]) && $_POST["prontuarioAluno"] != null &&
                           isset($_POST["id"])  && $_POST["id"] != null )
                            {
                                $AlunoDisciplina = new AlunoDisciplina();
                                $AlunoDisciplina->idDisciplina = $_POST["idDisciplina"];
                                $AlunoDisciplina->prontuarioAluno = $_POST["prontuarioAluno"];
                                $AlunoDisciplina->id = $_POST["id"];
                                $AlunoDisciplina->nota1 = $_POST["nota1"];
                                $AlunoDisciplina->nota2 = $_POST["nota2"];
                                $AlunoDisciplina->semestre = $_POST["semestre"];
                                $AlunoDisciplina->ano = $_POST["ano"];
                                

                                $AlunoDisciplina->cadastrar();
                                $AlunoDisciplina = new AlunoDisciplina();
                            }
                    }

                    if($opcao == "pesquisar")
                    {
                        if(isset($_POST["idDisciplina"]) && $_POST["idDisciplina"] != null &&
                           isset($_POST["prontuarioAluno"]) && $_POST["prontuarioAluno"] != null &&
                           isset($_POST["id"]) && $_POST["id"] != null )

                        {
                            $id = $_POST["id"];
                            $idDisciplina = $_POST["idDisciplina"];
                            $prontuarioAluno = $_POST["prontuarioAluno"];

            
            
                            $AlunoDisciplina1 =  AlunoDisciplina::getDisciplinaAluno($prontuarioAluno, $idDisciplina, $id);
            

                            if($AlunoDisciplina1 != null)
                            {
                                $AlunoDisciplina =  AlunoDisciplina::getDisciplinaAluno($prontuarioAluno, $idDisciplina, $id);
                            }
            
                        }
                    }
                    if($opcao == "alterar")
                    {
                        $AlunoDisciplina->idDisciplina = $_POST["idDisciplina"];
                        $AlunoDisciplina->prontuarioAluno = $_POST["prontuarioAluno"];
                        $AlunoDisciplina->id = $_POST["id"];
                        $AlunoDisciplina->nota1 = $_POST["nota1"];
                        $AlunoDisciplina->nota2 = $_POST["nota2"];
                        $AlunoDisciplina->semestre = $_POST["semestre"];
                        $AlunoDisciplina->ano = $_POST["ano"];

                        $AlunoDisciplina->atualizar();
                        $AlunoDisciplina = new AlunoDisciplina();

                    }





                    ?>



    

    <div class="jumbotron">
        <center>
            <form action='cadAlunoDisciplina.php' method='POST'>
                <div class="form-group">
                    <label for="prontuarioAluno">Prontuario do aluno</label>
                    <input type="text" class="form-control" style="width:50%" name='prontuarioAluno'
                        placeholder="Digite o prontuario do aluno" id="prontuarioAluno" value="<?=$AlunoDisciplina->prontuarioAluno?>">
                </div>
                <div class="form-group">
                    <label for="idDisciplina">ID Disciplina</label>
                    <input type="number" class="form-control" style="width:50%" name='idDisciplina'
                        placeholder="Digite o ID da disciplina" id="idCurso" value="<?=$AlunoDisciplina->idDisciplina?>">
                </div>
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="number" class="form-control" style="width:50%" name='id' placeholder="Digite o ID"
                        id="id" value="<?=$AlunoDisciplina->id?>">
                </div>
                <div class="form-group">
                    <label for="nota1">Primeira nota</label>
                    <input type="double" class="form-control" style="width:50%" name='nota1'
                        placeholder="Digite a primeira nota" id="nota1" value="<?=$AlunoDisciplina->nota1?>">
                </div>
                <div class="form-group">
                    <label for="nota2">Segunda nota</label>
                    <input type="double" class="form-control" style="width:50%" name='nota2'
                        placeholder="Digite a segunda nota" id="nota2" value="<?=$AlunoDisciplina->nota2?>">
                </div>

                <div class="form-group">
                    <label for="semestre">Semestre</label>
                    <input type="number" class="form-control" style="width:50%" name='semestre'
                        placeholder="Digite o semestre" id="semestre" value="<?=$AlunoDisciplina->semestre?>">
                </div>

                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input type="number" class="form-control" style="width:50%" name='ano' placeholder="Digite o ano"
                        id="ano" value="<?=$AlunoDisciplina->ano?>">
                </div>


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

        </center>
        </form>
    </div>