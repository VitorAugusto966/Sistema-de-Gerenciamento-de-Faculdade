<?php

namespace modelo;

use \DB\Database;
use \PDO;


class Aluno
{
   
    public $prontuario;
    public $nome;
    public $email;
    public $telefone;
    public $endereco;
    public $cidade;
    public $estado;
    public $idCurso;
    public $login;
    public $senha;

    public function cadastrar()
    {
        $objDatabase = new Database('aluno');

        $idAluno = $objDatabase->insert(
        [
            'prontuario' => $this->prontuario,
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'idCurso' => $this->idCurso,
            'login' => $this->login,
            'senha' => $this->senha
        ]);

    }

    public function atualizar()
    {

        return (new Database('aluno'))->update("prontuario=".'"'.$this->prontuario.'"', [
            'prontuario' => $this->prontuario,
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'idCurso' => $this->idCurso,
            'login' => $this->login,
            'senha' => $this->senha
        ]);

    }

    public function excluir()
    {
        return (new Database('aluno'))->delete("prontuario=".'"'.$this->prontuario.'"');
    }

    public static function getAlunos($where = null, $order = null, $limit = null)
    {
        return (new Database('aluno'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function getUsuario($login)
    {
        return (new Database('aluno'))->select("login=".'"'.$login.'"')
            ->fetchObject(self::class);
    }

    public static function getAlunoCodigo($prontuario)
    {
        return (new Database('aluno'))->select("prontuario=".'"'.$prontuario.'"')
            ->fetchObject(self::class);
    }
}

?>