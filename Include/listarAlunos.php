<?php

require_once("config.php");
use modelo\Aluno;
    
    $resultados="";
    $alunos = Aluno::getAlunos();

  if($alunos != null)
  {
    foreach($alunos as $a)
    {
        $resultados.='<tr>';
        $resultados.='<td>'.$a->prontuario.'</td>
                      <td>'.$a->nome.'</td>
                      <td>'.$a->email.'</td>
                      <td>'.$a->telefone.'</td>
                      <td>'.$a->idCurso.'</td>
                      <td>
                         <a href="cadAluno.php?prontuario='.$a->prontuario.'&op=2">
                         <button type="button" class="btn btn-danger">Excluir</button>
                      </a></td>';
        $resultados.='</tr>';
                      
    }
  }

?>

<main>
<div id="teste" class="jumbotron text-center" style="background-color:#e9ecef;padding-top:25px">
    <section>
        <table class='table table-dark table-hover' >
            <thead><tr>
                <td>Prontuário</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Telefone</td>
                <td>ID Curso</td>
               </tr>
            </thead>
      
        <tbody>
             <?=$resultados?>
        </tbody>
       </table>

   </section>    
</div>
</main>