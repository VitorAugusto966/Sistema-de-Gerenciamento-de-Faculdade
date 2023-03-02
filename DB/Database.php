<?php
    
namespace DB;

use \PDO;

    class Database{
        const HOST = "localhost";
        const NAME = "projeto";
        const USER = "root";
        const PASS = "cr07";

        private $tabela;
        private $conexao;

        public function __construct($table=null){
            $this->tabela = $table;
            $this->setConexao();
        }

        private function setConexao(){
            try{
               $this->conexao=new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
               $this->conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
               die("ERROR: ".$e->getMessage()); 
            }
        }

        public function execute($query,$params=[]){
            try{
                $statement = $this->conexao->prepare($query);
                $statement->execute($params);
                return $statement;
             } catch(PDOException $e){
                die("ERROR: ".$e->getMessage()); 
             } 
        }

        public function insert($values){
            $campos = array_keys($values);
            $binds  = array_pad([],count($campos),'?');

            $sql = 'insert into '.$this->tabela.'('.implode(',',$campos).') values ('.implode(',',$binds).')'; 
            $this->execute($sql,array_values($values));
            return $this->conexao->lastInsertId();
        }

        public function update($where,$values){
            $campos = array_keys($values);
            $binds  = array_pad([],count($campos),'?');
            $sql = 'update '.$this->tabela.' set '.implode('=?,',$campos).'=? where '.$where;
            $this->execute($sql,array_values($values));
            return true;
        }

        public function delete($where){
            $sql = 'delete from '.$this->tabela.' where '.$where;
            $this->execute($sql);
            return true;
        }

        public function select($where=null,$order=null,$limit=null){
            $where = strlen($where) ?' where '.$where :'';
            $order = strlen($order) ?' where '.$order :'';
            $limit = strlen($limit) ?' where '.$limit :'';

            $sql="select * from ".$this->tabela.' '.$where.' '.$order.' '.$limit;
            return $this->execute($sql);
        }

        
    }


?>