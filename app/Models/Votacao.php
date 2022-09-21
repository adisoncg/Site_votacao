<?php

class votacao
{
    private $id;
    private $nome;
    private $cpf;
    private $idade;
    private $voto;
    private $msg;
    private $erro = [];

    public function __construct($nome, $cpf, $idade, $voto)
    {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->idade = $idade;
        $this->voto = $voto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
      $this->nome = $nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

    public function getVoto()
    {
        return $this->voto;
    }

    public function setVotar($voto)
    {
        $this->voto = $voto;
    }

    public function getMsg()
    {
        return $this->msg;
    }


    public function validarDados()
    {
        if(empty($this->nome))
        {
            $this->erro["erro_nome"] = "O campo nome está vazio!";
        }

        if ($this->idade < 16 || !is_numeric($this->idade))
        {
            $this->erro["erro_idade"] = "Idade inválida";
            $this->msg = "Idade Inválida!";
        }

        if(!is_numeric($this->cpf))
        {
            $this->erro["erro_cpf"] = "CPF inválido";
            $this->msg = "CPF Inválido!";
            
        }else if(empty($this->erro)){
            $this->msg = "Votação feita com sucesso!";
        }

    }

}?>

