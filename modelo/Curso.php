<?php

namespace modelo;
use \DB\Database;
use \PDO;



class Curso
{
   
    public $idCurso;
    public $sigla;
    public $nome;
    public $cargaHoraria;

    public function cadastrar()
    {
        $objDatabase = new Database('curso');
        $idCurso = $objDatabase->insert(
        [
            'idCurso' => $this->idCurso,
            'sigla' => $this->sigla,
            'nome' => $this->nome,
            'cargaHoraria' => $this->cargaHoraria
        ]);

    }
    public function atualizar()
    {

        return (new Database('curso'))->update('idCurso=' . $this->idCurso, [
            'idCurso' => $this->idCurso,
            'sigla' => $this->sigla,
            'nome' => $this->nome,
            'cargaHoraria' => $this->cargaHoraria,
        ]);

    }

    public function excluir()
    {
        return (new Database('curso'))->delete('idCurso=' . $this->idCurso);
    }

    public static function getCursos($where = null, $order = null, $limit = null)
    {
        return (new Database('curso'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getCursoCodigo($id)
    {
        return (new Database('curso'))->select('idCurso=' . $id)
            ->fetchObject(self::class);
    }
}
?>