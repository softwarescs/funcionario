<?php
class CursosControle extends abstrErroPropriedades
{
    public function IndexGet()
    {
        $curso = new Curso();
        $modelo = new apresCursosIndex();

        $consultarCursos['Biologicas'] = $curso->ConsultarCursos('Biologicas');
        $consultarCursos['Exatas'] = $curso->ConsultarCursos('Exatas');
        $consultarCursos['Humanas'] = $curso->ConsultarCursos('Humanas');

        $modelo->titulo = 'Cursos - Sistema consulta de sala';
        $modelo->urlJs = 'cursos';

        if(!empty($consultarCursos))
        {
        $modelo->cursos = $consultarCursos;
        }

        return $modelo;
    }

    public function AdicionarGet()
    {
        $modelo = new apresCursosAdicionarAlterarRemover();
        $modelo->titulo = 'Adicionar curso - Sistema consulta de sala';
        $modelo->urlJs = 'cursos';

        return $modelo;
    }

    public function AdicionarPost($modelo) : bool
    {
        try
        {
            $validacao = new Validacao();
            $curso = new Curso();

            $camposString = array();
            $camposString['Nome do curso'] = $modelo->nome;
            $camposString['Área de atuação'] = $modelo->areaAtuacao;
            $validacao->setEntrada($camposString, 'string');
            
            if($validacao->VerificarVazioArray() || !$validacao->LimparStringArray())
            {
                throw new Exception($validacao->getMensagem());
            }
            
            $curso->setNome($validacao->getSaida()['string']['Nome do curso']);
            $curso->setAreaAtuacao($validacao->getSaida()['string']['Área de atuação']);
            
            if(!$curso->AdicionarCurso())
            {
                throw new Exception($curso->getMensagem());
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }

    public function AlterarGet(string $nome)
    {
        $modelo = $this->AlterarRemoverGet($nome, 'Alterar');
        
        if(!empty($modelo))
        {
            return $modelo;
        }
        else
        {
            return null;
        }
    }

    public function AlterarPost($modelo) : bool
    {
        try
        {
            $validacao = new Validacao();
            $curso = new Curso();
            
            $validacao->setCampo('Área de atuação');
            $validacao->setEntrada($modelo->areaAtuacao, 'string');
            
            if($validacao->VerificarVazio() || !$validacao->LimparString())
            {
                throw new Exception($validacao->getMensagem());
            }
            
            $curso->setAreaAtuacao($validacao->getSaida()['string']);
            
            if(!$curso->AlterarCurso($modelo->nome))
            {
                throw new Exception($curso->getMensagem());
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }

    public function RemoverGet(string $nome)
    {
        $modelo = $this->AlterarRemoverGet($nome, 'Remover');
        
        if(!empty($modelo))
        {
            return $modelo;
        }
        else
        {
            return null;
        }
    }

    public function RemoverPost($modelo) : bool
    {
        try
        {
            $curso = new Curso();
            
            if(!$curso->RemoverCurso($modelo->nome))
            {
                throw new Exception($curso->getMensagem());
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }
    
    private function AlterarRemoverGet(string $nome, string $pagina)
    {
        try
        {
            $curso = new Curso();
            $modelo = new apresCursosAdicionarAlterarRemover();
            
            if(!$curso->ConsultarCurso($nome))
            {
                throw new Exception($curso->getMensagem());
            }
            
            $modelo->titulo = $pagina.' curso - Sistema consulta de sala';
            $modelo->urlJs = 'cursos';
            $modelo->nome = $curso->__get('nome');
            $modelo->areaAtuacao = $curso->__get('areaAtuacao');

            return $modelo;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return null;
        }
    }
}