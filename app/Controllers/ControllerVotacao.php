<?php

require_once('app/Database/ConexaoDB.php');

class ControllerUsuario
{
    public function createVotos(Votacao $votos)
    {
        try {
            $insertVotos = "INSERT INTO votos (nome, cpf, idade, voto) VALUES (:nome, :cpf, :idade, :voto)";
            $stmt = ConexaoDB::getConn()->prepare($insertVotos);
            $stmt->bindValue(':nome', $votos->getNome());
            $stmt->bindValue(':idade', $votos->getIdade());
            $stmt->bindValue(':cpf', $votos->getCpf());
            $stmt->bindValue(':voto', $votos->getVoto());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function readVotos()
    {
        try {
            $queryVotos = "SELECT * FROM votos";
            $stmt = ConexaoDB::getConn()->prepare($queryVotos);
            $stmt->execute();

            if ($stmt->rowCount()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


class ContaVotos
{

    public function resultadoRodrigo()
    {
        try {
            $queryVoto = "SELECT count(voto) AS votosTotais FROM votos WHERE voto='1'";
            $stmt = ConexaoDB::getConn()->prepare($queryVoto);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result["votosTotais"];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function resultadoLarissa()
    {
        try {
            $queryVoto = "SELECT COUNT(voto) AS votosTotais FROM votos WHERE voto='2'";
            $stmt = ConexaoDB::getConn()->prepare($queryVoto);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result["votosTotais"];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
