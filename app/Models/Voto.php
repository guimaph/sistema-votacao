<?php 
class Voto
{
    private $id;
    private $nome;
    private $cpf;
    private $idade;
    private $candidato;
    private $dataRegistro;
    public $erro;

    public function __construct($nome, $cpf, $idade, $candidato)
    {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->idade = $idade;
        $this->candidato = $candidato;
    }
    // id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    // nome
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    // cpf
    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
    // idade
    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
    }
    // candidato
    public function getCandidato()
    {
        return $this->candidato;
    }

    public function setCandidato($candidato)
    {
        $this->candidato = $candidato;
    }
    // data registro
    public function getDataRegistro()
    {
        return $this->dataRegistro;
    }

    public function setDataRegistro($dataRegistro)
    {
        $this->dataRegistro = $dataRegistro;
    }

    public function validarVoto() 
    {
        if (empty($this->nome)) {
            $this->erro = "O campo <strong>Nome</strong> deve ser preenchido!";
        }

        if (empty($this->cpf)) {
            $this->erro = "O campo <strong>CPF</strong> deve ser preenchido!";
        }

        if (empty($this->idade)) {
            $this->erro = "O campo <strong>Idade</strong> deve ser preenchido!";
        }

        if (empty($this->candidato)) {
            $this->erro = "É necessário selecionar um dos canditatos!";
        }

        if ($this->idade > 120 || !is_numeric($this->idade)) {
            $this->erro = "Idade inválida!";
        }

        if ($this->idade < 16) {
            $this->erro = "Você não possui a idade mínima para votar!";
        }

        $this->cpf = str_replace("-", "",str_replace(".", "", $this->cpf));
        if(!is_numeric($this->cpf)) {
            $this->erro = "O CPF deve conter apenas números!";
        }
    }
}
?>