<?php
class SalasControle extends abstrErroPropriedades
{
    function IndexGet()
    {
        $sala = new Sala();
        $modelo = new apresSalasIndex();
        $consultarSalas = array();

        for($i = 'A'; $i != 'Z'; $i++)
        {
            $consultarSalas[$i] = $sala->ConsultarSalas($i);
        }

        $modelo->titulo = 'Salas - Sistema consulta de sala';
        $modelo->urlJs = 'salas';

        if(!empty($consultarSalas))
        {
            $modelo->salas = $consultarSalas;
        }
        
        return $modelo;
    }

    function AdicionarGet()
    {
        $modelo = new apresSalasAdicionarAlterarRemover();
        $modelo->titulo = 'Adicionar sala - Sistema consulta de sala';
        $modelo->urlJs = 'salas';

        return $modelo;
    }

    function AdicionarPost($modelo) : bool
    {
        try
        {
            $validacao = new Validacao();
            $sala = new Sala();
            
            $camposString = array();
            $camposString['Nome da sala'] = $modelo->nome;
            $camposString['Bloco'] = $modelo->bloco;
            $validacao->setEntrada($camposString, 'string');
            
            $camposInteiro = array();
            $camposInteiro['Prédio'] = $modelo->predio;
            $camposInteiro['Pavimento'] = $modelo->pavimento;
            $validacao->setEntrada($camposInteiro, 'inteiro');
            
            if($validacao->VerificarVazioArray() || !$validacao->LimparStringArray() || !$validacao->ValidarInteiroArray())
            {
                throw new Exception($validacao->getMensagem());
            }
            
            $sala->setNome($validacao->getSaida()['string']['Nome da sala']);
            $sala->setBloco($validacao->getSaida()['string']['Bloco']);
            
            $sala->setPredio($validacao->getSaida()['inteiro']['Prédio']);
            $sala->setPavimento($validacao->getSaida()['inteiro']['Pavimento']);
            
            if(!$sala->AdicionarSala())
            {
                throw new Exception($sala->getMensagem());
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }

    function AlterarGet(string $nome)
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

    function AlterarPost($modelo) : bool
    {
        try
        {
            $validacao = new Validacao();
            $sala = new Sala();
            
            $validacao->setCampo('Bloco');
            $validacao->setEntrada($modelo->bloco, 'string');
            
            $campos = array();
            $campos['Prédio'] = $modelo->predio;
            $campos['Pavimento'] = $modelo->pavimento;
            $validacao->setEntrada($campos, 'inteiro');
            
            if($validacao->VerificarVazio() || $validacao->VerificarVazioArray() || !$validacao->LimparString() || !$validacao->ValidarInteiroArray())
            {
                throw new Exception($validacao->getMensagem());
            }
            
            $sala->setBloco($validacao->getSaida()['string']);
            
            $sala->setPredio($validacao->getSaida()['inteiro']['Prédio']);
            $sala->setPavimento($validacao->getSaida()['inteiro']['Pavimento']);
            
            if(!$sala->AlterarSala($modelo->nome))
            {
                throw new Exception($sala->getMensagem());
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }

    function RemoverGet(string $nome)
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

    function RemoverPost($modelo) : bool
    {
        try
        {
            $sala = new Sala();
            
            if(!$sala->RemoverSala($modelo->nome))
            {
                throw new Exception($sala->getMensagem());
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
            $sala = new Sala();
            $modelo = new apresSalasAdicionarAlterarRemover();
            
            if(!$sala->ConsultarSala($nome))
            {
                throw new Exception($sala->getMensagem());
            }
            
            $modelo->titulo = $pagina.' sala - Sistema consulta de sala';
            $modelo->urlJs = 'salas';
            $modelo->nome = $sala->__get('nome');
            $modelo->predio = $sala->__get('predio');
            $modelo->bloco = $sala->__get('bloco');
            $modelo->pavimento = $sala->__get('pavimento');

            return $modelo;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return null;
        }
    }
}