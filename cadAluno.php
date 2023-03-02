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
    <title> Cadastro de Aluno</title>
    <script type="text/javascript" src="funcao.js"></script>

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
            <h1 style="color:white">Cadastro de aluno</h1>
        </div>
    </center>

    <?php
                include __DIR__.'/header.php';
                require_once("config.php");
                use modelo\Aluno;
                $opcao = "";
                $Aluno=new Aluno(); 

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

                if(isset($_GET["prontuario"])){       
                    $id = $_GET["prontuario"];
                    $Aluno = Aluno::getAlunoCodigo($id);

                    if($_GET["op"]==2){         
                       $Aluno->excluir();
                       $Aluno = new Aluno();
                       include __DIR__.'/Include/listarAlunos.php';
                    }
 
                }
                
                if(isset($_POST["enviar"]))
                {
                    $opcao = $_POST["enviar"];

                }

                 if($opcao == "cadastrar")
               {
                    if(isset($_POST["prontuario"]) && $_POST["prontuario"] != null)
                        {
                            $Aluno = new Aluno();
                            $Aluno->prontuario = $_POST["prontuario"];
                            $Aluno->nome = $_POST["nome"];
                            $Aluno->email = $_POST["email"];
                            $Aluno->telefone = $_POST["telefone"];
                            $Aluno->endereco = $_POST["endereco"];
                            $Aluno->cidade = $_POST["cidade"];
                            $Aluno->estado = $_POST["estado"];
                            $Aluno->idCurso = $_POST["idCurso"];
                            $Aluno->login = $_POST["login"];
                            $Aluno->senha = $_POST["senha"];

                            $Aluno->cadastrar();
                            $Aluno = new Aluno();
                        }
                }
                if($opcao == "pesquisar")
                {
                    if(isset($_POST["prontuario"]) && $_POST["prontuario"] != null)
                    {
                        $prontuario = $_POST["prontuario"];


                        $Aluno1 =  Aluno::getAlunoCodigo($prontuario);

                        if($Aluno1 != null)
                        {
                            $Aluno =  Aluno::getAlunoCodigo($prontuario);
                        }
        
                    }
                }


                
            

    ?>


    <div class="jumbotron">
        <form action='cadAluno.php' method='POST'>
            <div class="form-group">
                <label for="prontuario">Prontuario</label>
                <input type="text" class="form-control" style="width:35%" name='prontuario'
                    placeholder="Digite o prontuario" id="prontuario" value="<?=$Aluno->prontuario?>">
            </div>
            <div class="form-group">
                <label for="idCurso">ID Curso</label>
                <input type="number" class="form-control" style="width:35%" name='idCurso'
                    placeholder="Digite o ID do curso" id="idCurso" value="<?=$Aluno->idCurso?>">
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" style="width:50%" name='nome' placeholder="Digite o nome"
                    id="nome" value="<?=$Aluno->nome?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" style="width:50%" name='email' placeholder="Digite o e-mail"
                    id="email" value="<?=$Aluno->email?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="tel" class="form-control" style="width:50%" name='telefone' placeholder="Digite o telefone"
                    id="telefone" value="<?=$Aluno->telefone?>">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" style="width:50%" name='endereco'
                    placeholder="Digite o endereço" id="endereco" value="<?=$Aluno->endereco?>">
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" style="width:50%" name='cidade' placeholder="Digite o cidade"
                    id="cidade" value="<?=$Aluno->cidade?>">
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="uf" class="form-control" style="width:50%" name='estado' placeholder="Digite o estado"
                    id="estado" value="<?=$Aluno->estado?>">
            </div>

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" style="width:50%" name='login' placeholder="Digite o login"
                    id="login" value="<?=$Aluno->login?>">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" style="width:50%" name='senha' placeholder="Digite a senha"
                    id="senha" value="<?=$Aluno->senha?>">
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
    </div>
    <center>


        <?php
        if($opcao == "listar")
        {
            include __DIR__.'/Include/listarAlunos.php';
        }

        if($opcao == "alterar")
        {
            $Aluno->prontuario = $_POST["prontuario"];
            $Aluno->nome = $_POST["nome"];
            $Aluno->email = $_POST["email"];
            $Aluno->telefone = $_POST["telefone"];
            $Aluno->endereco = $_POST["endereco"];
            $Aluno->cidade = $_POST["cidade"];
            $Aluno->estado = $_POST["estado"];
            $Aluno->idCurso = $_POST["idCurso"];
            $Aluno->login = $_POST["login"];
            $Aluno->senha = $_POST["senha"];
            
            $Aluno->atualizar();

            //include __DIR__.'/Include/listarAlunos.php';

        }
       
    ?>

    </center>