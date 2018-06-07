<?php
class Validacao extends abstrErroPropriedades
{
    private $campo;
    private $entrada;
    private $saida;
    
    public function LimparString() : bool
    {
        try
        {
            if(!$limparString = filter_var($this->entrada['string'], FILTER_SANITIZE_STRING))
            {
                throw new Exception();
            }

            $this->saida['string'] = $limparString;
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem .= 'O campo '.$this->campo.' foi preenchido incorretamente.</br>';
            return false;
        }
    }
    
    public function LimparStringArray() : bool
    {
        $excecao = array();
        
        try
        {
            $retorno = true;
            
            foreach($this->entrada['string'] as $chave => $valor)
            {
                if(!$limparString = filter_var($valor, FILTER_SANITIZE_STRING))
                {
                    $excecao[] = $chave;
                    $retorno = false;
                }

                $this->saida['string'][$chave] = $limparString;
            }

            if($retorno)
            {
                return true;
            }
            else
            {
                throw new Exception();
            }
        }
        catch (Exception $e)
        {
            foreach($excecao as $campo)
            {
                $this->mensagem .= '<i class="fas fa-exclamation mr-2"></i>O campo '.$campo.' foi preenchido incorretamente.</br>';
            }
                
            return false;
        }
    }
    
    public function ValidarInteiro() : bool
    {
        try
        {
            if(!$validarInt = filter_var($this->entrada['inteiro'], FILTER_VALIDATE_INT))
            {
                throw new Exception();
            }
            
            $this->saida['inteiro'] = $validarInt;
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem .= 'Preencha o campo '.$this->campo.' apenas com números inteiros.</br>';
            return false;
        }
    }
    
    public function ValidarInteiroArray() : bool
    {
        $excecao = array();
        
        try
        {
            $retorno = true;
            
            foreach($this->entrada['inteiro'] as $chave => $valor)
            {
                if(!$validarInt = filter_var($valor, FILTER_VALIDATE_INT))
                {
                    $excecao[] = $chave;
                    $retorno = false;
                }

                $this->saida['inteiro'][$chave] = $validarInt;
            }

            if($retorno)
            {
                return true;
            }
            else
            {
                throw new Exception();
            }
        }
        catch (Exception $e)
        {
            foreach($excecao as $campo)
            {
                $this->mensagem .= '<i class="fas fa-exclamation mr-2"></i>Preencha o campo '.$campo.' apenas com números inteiros.</br>';
            }
                
            return false;
        }
    }
    
    public function ValidarEmail() : bool
    {
        $excecao = array();
        
        try
        {
            $retorno = true;
            
            foreach($this->entrada['email'] as $chave => $valor)
            {
                if(!$validarEmail = filter_var($valor, FILTER_VALIDATE_EMAIL))
                {
                    $excecao[] = $chave;
                    $retorno = false;
                }

                $this->saida['email'][$chave] = $validarEmail;
            }

            if($retorno)
            {
                return true;
            }
            else
            {
                throw new Exception();
            }
        }
        catch (Exception $e)
        {
            foreach($excecao as $campo)
            {
                $this->mensagem .= '<i class="fas fa-exclamation mr-2"></i>Preencha o campo '.$campo.' com um e-mail válido.</br>';
            }
                
            return false;
        }
    }
    
    public function VerificarVazio() : bool
    {
        foreach($this->entrada as $tipo => $valor)
        {
            if(is_string($this->entrada[$tipo]))
            {
                if(empty($this->entrada[$tipo]) || preg_match('/Selecione/', $this->entrada[$tipo]))
                {
                    $this->mensagem .= 'Preencha o campo '.$this->campo.'.</br>';
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }
    
    public function VerificarVazioArray() : bool
    {
        $retorno = false;
        
        foreach($this->entrada as $tipo => $valor)
        {
            if(is_array($this->entrada[$tipo]))
            {
                foreach($this->entrada[$tipo] as $chave => $valor)
                {
                    if(empty($valor) || preg_match('/Selecione/', $valor))
                    {
                        $this->mensagem .= '<i class="fas fa-exclamation mr-2"></i>Preencha o campo '.$chave.'.</br>';
                        $retorno = true;
                    }
                }
            }
        }

        return $retorno;
    }
    
    //Get
    public function getSaida()
    {
        return $this->saida;
    }
    
    //Set
    public function setCampo(string $campo)
    {
        $this->campo = $campo;
    }
    public function setEntrada($entrada, string $tipo)
    {
        $this->entrada[$tipo] = $entrada;
    }
}