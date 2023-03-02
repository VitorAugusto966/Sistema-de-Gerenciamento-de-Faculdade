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
            <h1 style="color:white">Notas do aluno</h1>
            <h4 style="text-align:end">Bem vindo ao sistema: <?=$_SESSION["usuario"]->login?> <h4>
        </div>
    </center>
    <?php


                 require_once("config.php");
                 include __DIR__.'/header.php';
                 use modelo\AlunoDisciplina;
                 use modelo\Disciplina;
                 $Disciplinas = AlunoDisciplina::getDisciplinas();
                 $opcao = "";
                 $resultados="";
                 $vazio = 0;
                 $vezes = 0;
                 $i = 0;
                 $j = 0;
                 $prontuario = -1;
                 
                 if(isset($_POST["enviar"]))
                 {
                     $opcao = $_POST["enviar"];
 
                 }  

                 if(isset($_POST["semestre"]) && $_POST["semestre"] != null )
                 {
                    $semestre = $_POST["semestre"];
                 }
                 $aln = Aluno::getAlunoCodigo($_SESSION["usuario"]->prontuario);

                 if($aln == null)
                 {
                     $i = 1;
                 }

                 
                if($opcao == "pesquisar" && $semestre > 0)
                {
                    
                if($Disciplinas != null)
                 {
                    if($_SESSION["usuario"]->prontuario != null || $_SESSION["usuario"]->prontuario == "admin")
                    {
                        foreach($Disciplinas as $a)
                        {
                            if($a->prontuarioAluno == $_SESSION["usuario"]->prontuario)
                            {       

                                if($semestre == $a->semestre)
                                {
                                    $media = ($a->nota1 + $a->nota2) / 2;
                                    $disciplina = Disciplina::getDisciplinaCodigo($a->idDisciplina);
           
                                       $resultados.='<tr>';
           
                                       $resultados.='<td>'.$disciplina->nome.'</td>
                                                   <td>'.$a->prontuarioAluno.'</td>
                                                   <td>'.$a->id.'</td>
                                                   <td>'.$a->nota1.'</td>
                                                   <td>'.$a->nota2.'</td>
                                                   <td>'.$media.'</td>
                                                   <td>'.$a->semestre.'</td>
                                                   <td>'.$a->ano.'</td>';
           
                                       $resultados.='</tr>';
                                       $vezes = $vezes + 1;
                                }

                                   
                            }
                        }
                    }
                    else
                    {
                        $i = 1;
                        $j = 1;
                    }
                    
                   
   
                 }
                }

       
                 

        ?>

    <div class="jumbotron">
        <center>
            <form action='boletim.php' method='POST'>
                <div class="form-group">
                    <label for="semestre">Digite o semestre</label>
                    <input type="number" class="form-control" style="width:50%" name='semestre'
                        placeholder="Digite o semestre" id="semestre">
                </div>
                <div style="margin-left:0px;width:350px">
                    <button id='pesquisar' name='enviar' value="pesquisar" class="btn btn-outline-success"
                        type='submit'>
                        Pesquisar </button>
                </div>
                <?php

                    if($vezes == 0)
                    {
                        $vazio = 1;
                    }

                        if($i == 1 && $j == 1)
                        {
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
                        <td>Nome Disciplina</td>
                        <td>Prontuário</td>
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

            if($vazio == 1)
            {
                    echo '<script> document.getElementById("tabela-notas").style.display="none" </script>';
            }
            
        

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