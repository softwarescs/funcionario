<?php
class Curso
{
    private $nome;
    private $areaAtuacao;

    function __construct($nome = null, $areaAtuacao = null)
    {
        if(!empty($nome))
            $this->nome = $nome;
        if(!empty($areaAtuacao))
            $this->areaAtuacao = $areaAtuacao;
    }

    function ConsultarCursos($areaAtuacao = null)
    {
        $crud = new Crud();

		if(empty($areaAtuacao))
			$consultarBd = $crud->ConsultarBd('cursos');
		else
			$consultarBd = $crud->ConsultarBd('cursos', 'areaAtuacao', $areaAtuacao);

        if($consultarBd)
        {
            return $consultarBd;
        }
        else
            return null;
    }

    function ConsultarCurso($nome) : bool
    {
        $crud = new Crud();

        $consultarBd = $crud->ConsultarBd('cursos', 'nome', $nome);

        if($consultarBd)
        {
            $this->nome = $consultarBd[0]['nome'];
            $this->areaAtuacao = $consultarBd[0]['areaAtuacao'];

            return true;
        }
        else
            return false;
    }

    function AdicionarCurso() : bool
    {
        $consultarCurso = $this->ConsultarCurso($this->nome);

        if(!$consultarCurso)
        {
            $crud = new Crud();

            $adicionarBd = $crud->AdicionarBd('cursos', 'nome', 'areaAtuacao', $this->nome, $this->areaAtuacao);

            if($adicionarBd)
                return true;
            else
                return false;
        }
        else
            $_SESSION['erro'] = 'Já existe um curso com esse nome.';
            return false;
    }

    function AlterarCurso($nome) : bool
    {
        $crud = new Crud();

        $alterarBd = $crud->AlterarBd('cursos', 'nome', $nome, 'areaAtuacao', $this->areaAtuacao);

        if($alterarBd)
            return true;
        else
            return false;
    }

    function RemoverCurso($nome) : bool
    {
        $crud = new Crud();

        $removerBd = $crud->RemoverBd('cursos', 'nome', $nome);

        if($removerBd)
            return true;
        else
            return false;
    }

    function setNome(string $param)
    {
        $this->nome = $param;
    }
    function setAreaAtuacao(string $param)
    {
        $this->areaAtuacao = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>