<?php

namespace modelo;
use \DB\Database;
use \PDO;



class Disciplina
{
   
    public $idDisciplina;
    public $idCurso;
    public $sigla;
    public $nome;
    public $cargaHoraria;

    public function cadastrar()
    {
        $objDatabase = new Database('disciplina');
        $idCurso = $objDatabase->insert(
        [   
            'idDisciplina' => $this->idDisciplina,
            'idCurso' => $this->idCurso,
            'sigla' => $this->sigla,
            'nome' => $this->nome,
            'cargaHoraria' => $this->cargaHoraria
        ]);

    }
    public function atualizar()
    {

        return (new Database('disciplina'))->update('idDisciplina=' . $this->idDisciplina, [
            'idDisciplina' => $this->idDisciplina,
            'idCurso' => $this->idCurso,
            'sigla' => $this->sigla,
            'nome' => $this->nome,
            'cargaHoraria' => $this->cargaHoraria
        ]);

    }

    public function excluir()
    {
        return (new Database('disciplina'))->delete('idDisciplina=' . $this->idDisciplina);
    }

    public static function getDisciplinas($where = null, $order = null, $limit = null)
    {
        return (new Database('disciplina'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getDisciplinaCodigo($id)
    {
        return (new Database('disciplina'))->select('idDisciplina=' . $id)
            ->fetchObject(self::class);
    }
}
?>