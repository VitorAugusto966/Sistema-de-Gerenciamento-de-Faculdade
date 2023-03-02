<?php

namespace modelo;
use \DB\Database;
use \PDO;



class AlunoDisciplina
{
   
    public $idDisciplina;
    public $prontuarioAluno;
    public $id;
    public $nota1;
    public $nota2;
    public $semestre;
    public $ano;

    public function cadastrar()
    {
        $objDatabase = new Database('aluno_disciplina');
        $idCurso = $objDatabase->insert(
        [   
            'idDisciplina' => $this->idDisciplina,
            'prontuarioAluno' => $this->prontuarioAluno,
            'id' => $this->id,
            'nota1' => $this->nota1,
            'nota2' => $this->nota2,
            'semestre' => $this->semestre,
            'ano' => $this->ano
        ]);

    }
    public function atualizar() /// arrumado
    {

        return (new Database('aluno_disciplina'))->update('idDisciplina=' . $this->idDisciplina . ' and id='. $this->id ." and prontuarioAluno=".'"'.$this->prontuarioAluno.'"', [
            'idDisciplina' => $this->idDisciplina,
            'prontuarioAluno' => $this->prontuarioAluno,
            'id' => $this->id,
            'nota1' => $this->nota1,
            'nota2' => $this->nota2,
            'semestre' => $this->semestre,
            'ano' => $this->ano
        ]);

    }

    public function excluir() /// arrumado 
    {
        return (new Database('aluno_disciplina'))->delete('idDisciplina=' . $this->idDisciplina . ' and id='. $this->id ." and prontuarioAluno=".'"'.$this->prontuarioAluno.'"');
    }

    public static function getDisciplinas($where = null, $order = null, $limit = null)
    {
        return (new Database('aluno_disciplina'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getDisciplinaAluno($prontuario, $id, $idDisciplina) //arrumado amém
    {
        return (new Database('aluno_disciplina'))->select('idDisciplina=' . $idDisciplina . ' and id='. $id ." and prontuarioAluno=".'"'.$prontuario.'"')
            ->fetchObject(self::class);
    }
}
?>