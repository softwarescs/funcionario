<?php
class TurmasControle extends abstrErroPropriedades
{
    function IndexGet($curso, $periodo)
    {
        $turma = new Turma();
        $modelo = new apresTurmasIndex();
        
        $consultarTurmas = $turma->ConsultarTurmas($curso, $periodo);
        
        $modelo->titulo = 'Turmas - Sistema consulta de sala';
        $modelo->urlJs = 'turmas';

        if(!empty($consultarTurmas))
        {
            $modelo->turmas = $consultarTurmas;
        }

        return $modelo;
    }

    function ConsultarGet()
    {
        $curso = new Curso();
        $modelo = new apresTurmasAdicionarAlterarRemoverConsultar();
        
        $consultarCursos['Biologicas'] = $curso->ConsultarCursos('Biologicas');
        $consultarCursos['Exatas'] = $curso->ConsultarCursos('Exatas');
        $consultarCursos['Humanas'] = $curso->ConsultarCursos('Humanas');
        
        $modelo->titulo = 'Consultar turmas - Sistema consulta de sala';
        $modelo->urlJs = 'turmas';
        
        if(!empty($consultarCursos))
        {
        $modelo->cursos = $consultarCursos;
        }

        return $modelo;
    }

    function AdicionarGet()
    {
        $curso = new Curso();
        $sala = new Sala();
        $modelo = new apresTurmasAdicionarAlterarRemoverConsultar();
        
        $consultarCursos['Biologicas'] = $curso->ConsultarCursos('Biologicas');
        $consultarCursos['Exatas'] = $curso->ConsultarCursos('Exatas');
        $consultarCursos['Humanas'] = $curso->ConsultarCursos('Humanas');

        for($i = 'A'; $i != 'Z'; $i++)
        {
            $consultarSalas[$i] = $sala->ConsultarSalas($i);
        }
        
        $modelo->titulo = 'Adicionar turma - Sistema consulta de sala';
        $modelo->urlJs = 'turmas';
        
        if(!empty($consultarCursos))
        {
        $modelo->cursos = $consultarCursos;
        }
        
        if(!empty($consultarSalas))
        {
        $modelo->salas = $consultarSalas;
        }

        return $modelo;
    }

    function AdicionarPost($modelo) : bool
    {
        try
        {
            $validacao = new Validacao();
            $turma = new Turma();
            
            $camposString = array();
            $camposInteiro = array();
            
            $camposString['Curso'] = $modelo->curso;
            $camposString['Periodo'] = $modelo->periodo;
            $camposString['Sala'] = $modelo->sala;
            $validacao->setEntrada($camposString, 'string');
            
            $camposInteiro['Semestre'] = $modelo->semestre;
            $validacao->setEntrada($camposInteiro, 'inteiro');
            
            if($validacao->VerificarVazioArray() || !$validacao->LimparStringArray() || !$validacao->ValidarInteiroArray())
            {
                throw new Exception($validacao->getMensagem());
            }
            
            $turma->setCurso($validacao->getSaida()['string']['Curso']);
            $turma->setPeriodo($validacao->getSaida()['string']['Periodo']);
            $turma->setSala($validacao->getSaida()['string']['Sala']);
            
            $turma->setSemestre($validacao->getSaida()['inteiro']['Semestre']);
            
            if(!$turma->AdicionarTurma())
            {
                throw new Exception($turma->getMensagem());
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }

    function AlterarGet($curso, $periodo, $semestre)
    {
        $modelo = $this->AlterarRemoverGet($curso, $periodo, $semestre, 'Alterar');
        
        if(!empty($modelo))
        {
            $sala = new Sala();
            $consultarSalas = array();

            for($i = 'A'; $i != 'Z'; $i++)
            {
                $consultarSalas[$i] = $sala->ConsultarSalas($i);
            }

            if(!empty($consultarSalas))
            {
            $modelo->salas = $consultarSalas;
            }
            
            return $modelo;
        }
        else
        {
            return null;
        }
    }

    function AlterarPost($modelo) : bool
    {
        try
        {
            $validacao = new Validacao();
            $turma = new Turma();
            
            $validacao->setCampo('Sala');
            $validacao->setEntrada($modelo->sala, 'string');
            
            if($validacao->VerificarVazio() || !$validacao->LimparString())
            {
                throw new Exception($validacao->getMensagem());
            }
            
            $turma->setSala($validacao->getSaida()['string']);

            if(!$turma->AlterarTurma($modelo->curso, $modelo->periodo, $modelo->semestre))
            {
                throw new Exception($turma->getMensagem());
            }

            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }

    function RemoverGet($curso, $periodo, $semestre)
    {
        $modelo = $this->AlterarRemoverGet($curso, $periodo, $semestre, 'Remover');
        
        if(!empty($modelo))
        {
            return $modelo;
        }
        else
        {
            return null;
        }
    }

    function RemoverPost($modelo) : bool
    {
        try
        {
            $turma = new Turma();
            
            if(!$turma->RemoverTurma($modelo->curso, $modelo->periodo, $modelo->semestre))
            {
                throw new Exception($turma->getMensagem());
            }

            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }
    
    private function AlterarRemoverGet($curso, $periodo, $semestre, string $pagina)
    {
        try
        {
            $turma = new Turma();
            $modelo = new apresTurmasAdicionarAlterarRemoverConsultar();
            
            if(!$turma->ConsultarTurma($curso, $periodo, $semestre))
            {
                throw new Exception($turma->getMensagem());
            }
            
            $modelo->titulo = $pagina.' turma - Sistema consulta de sala';
            $modelo->urlJs = 'turmas';
            $modelo->curso = $turma->__get('curso');
            $modelo->periodo = $turma->__get('periodo');
            $modelo->semestre = $turma->__get('semestre');
            $modelo->sala = $turma->__get('sala');
            
            return $modelo;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return null;
        }
    }
}