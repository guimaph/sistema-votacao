<?php

require_once('app/Database/ConexaoDB.php');

class ControllerVoto
{
    public $erroCtrlVoto;

    public function createVoto(Voto $voto){
        try{
            $insertVoto = "INSERT INTO voto (vot_nome, vot_cpf, vot_idade, can_codigo) VALUES (:nome, :cpf, :idade, :candidato)";
            $stmt = ConexaoDB::getConn()->prepare($insertVoto);
            $stmt->bindValue(':nome', $voto->getNome());
            $stmt->bindValue(':cpf', $voto->getCpf());
            $stmt->bindValue(':idade', $voto->getIdade());
            $stmt->bindValue(':candidato', $voto->getCandidato());
            $stmt->execute();
            
            $this->erroCtrlVoto = 'O seu voto foi computado!';
        }catch(PDOException $e){
            echo $e->getMessage();
            $this->erroCtrlVoto = 'Ocorreu um erro ao votar. Tente novamente.';
        }
    }

    public function readVoto(){
        try{
            $queryVoto = "SELECT COALESCE(v.vot_nome, '1') nome, COALESCE(v.vot_cpf, '1') cpf, COALESCE(v.vot_idade, '1') idade, COALESCE(c.can_nome, '1') candidato, COALESCE(v.vot_data_registro, '1') data_registro
            FROM voto v INNER JOIN candidato c ON v.can_codigo = c.can_codigo;";
            $stmt = ConexaoDB::getConn()->prepare($queryVoto);
            $stmt->execute();

            if($stmt->rowCount()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function deleteVoto(){
        try{
            $queryVoto = "DELETE FROM voto";
            $stmt = ConexaoDB::getConn()->prepare($queryVoto);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function readTotal(){
        try{
            $queryVoto =
                "SELECT
                    COALESCE((SELECT COUNT(*) FROM voto WHERE can_codigo = 1), 0) qtd_bill,
                    COALESCE((SELECT COUNT(*) FROM voto WHERE can_codigo = 2), 0) qtd_mark";
            $stmt = ConexaoDB::getConn()->prepare($queryVoto);
            $stmt->execute();

            if($stmt->rowCount()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

?>