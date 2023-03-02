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
    <title> Notas do aluno</title>
    <script type="text/javascript" src="javascript/funcao.js"></script>

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
    <?php  
                 require_once("config.php");
                 use modelo\Aluno;
                 use modelo\AlunoDisciplina;

                 if(!isset($_SESSION))
                 {
                    session_start();
                 }
                if(!isset($_SESSION["usuario"]))
                 {
                    
                     header("Location: index.php");
                 }


                
    ?>
    <center>
        <div class="jumbotron text-center" style="margin-bottom:0;width:100%;background:lightcoral">
            <h1 style="color:white">Notas por Disciplina</h1>
            <h4 style="position:absolute">Bem vindo ao sistema: <?=$_SESSION["usuario"]->login?> <h4>
        </div>
    </center>

    <?php


        require_once("config.php");
        include __DIR__.'/header.php';
        use modelo\Disciplina;

        $Disciplinas = AlunoDisciplina::getDisciplinas();
        $opcao = "";
        $resultados="";
        $idDisciplina = -1;
        $i = 0;
        $j = 0;

        if(isset($_POST["enviar"]))
        {
            $opcao = $_POST["enviar"];

        }
        
        if(isset($_POST["idDisciplina"]) && $_POST["idDisciplina"] != null )
        {
           $idDisciplina = $_POST["idDisciplina"];
           $j = 1;
        }
        $disciplinaA = Disciplina::getDisciplinaCodigo($idDisciplina);

        if($disciplinaA == null)
        {
            $i = 1;
        }

        if($opcao == "pesquisar")
                {
                    
                    if($Disciplinas != null)
                    {
                        foreach($Disciplinas as $a)
                        {
                            if($a->idDisciplina == $idDisciplina)
                            {
                                $media = ($a->nota1 + $a->nota2) / 2;
                                $disciplina = Disciplina::getDisciplinaCodigo($a->idDisciplina);
                                $aluno = Aluno::getAlunoCodigo($a->prontuarioAluno);

                                $resultados.='<tr>';
                                $resultados.='<td>'.$disciplina->nome.'</td>
                                <td>'.$aluno->nome.'</td>
                                <td>'.$a->id.'</td>
                                <td>'.$a->nota1.'</td>
                                <td>'.$a->nota2.'</td>
                                <td>'.$media.'</td>
                                <td>'.$a->semestre.'</td>
                                <td>'.$a->ano.'</td>';

                                $resultados.='</tr>';
                            }
                        }
                    }
                }


    ?>

    <div class="jumbotron">
        <center>

            <form action='notasDisciplinas.php' method='POST'>
                <div class="form-group">
                    <label for="idDiscplina">ID da Disciplina</label>
                    <input type="text" class="form-control" style="width:50%" name='idDisciplina'
                        placeholder="Digite o ID da disciplina" id="idDisciplina">
                </div>
                <div style="margin-left:0px;width:350px">
                    <button id='pesquisar' name='enviar' value="pesquisar" class="btn btn-outline-success"
                        type='submit'>
                        Pesquisar </button>
                </div>
                <?php
                        if($i == 1 && $j == 1)
                        {
                           echo("<br><br><br> <div class='alert alert-danger'>
                            <strong>Erro!</strong> Disciplina não existe.</div>");  
                            $opcao="erro";
                        }
                        else if($i == 1)
                        {
                            $opcao="erro";
                        }

                ?>

        </center>
        </form>
    </div>

    <div id="tabela-notas" class="jumbotron text-center" style="background-color:#e9ecef;padding-top:25px">
        <section>
            <table class='table table-dark table-hover'>
                <thead>
                    <tr>
                        <td>Disciplina</td>
                        <td>Aluno</td>
                        <td>ID</td>
                        <td>Primeira Nota</td>
                        <td>Segunda Nota</td>
                        <td>Média</td>
                        <td>Semestre</td>
                        <td>Ano</td>
                    </tr>
                </thead>

                <tbody>
                    <?=$resultados?>
                </tbody>
            </table>

        </section>
    </div>
    <?php
            if(!isset($_POST["enviar"]))
            {
                    echo '<script> document.getElementById("tabela-notas").style.display="none" </script>';
            }

            if(isset($_POST["enviar"]) && $opcao == "erro")
            {
                    echo '<script> document.getElementById("tabela-notas").style.display="none" </script>';
            }
   
   
    ?>

</body>