<?php
class Crud
{
    private $conexao;
    private $bancoDados;
    private $sql;
    private $declaracao;
    private $resultado;

    function __construct()
    {
        $this->conexao = new Conexao();
    }

    function ConsultarBd($tabela, $coluna1 = null, $filtro1 = null,
        $coluna2 = null, $filtro2 = null,
        $coluna3 = null, $filtro3 = null)
    {
        $qtdeArgs = func_num_args();

        try
        {
            $this->bancoDados = $this->conexao->AbrirBd();

            if($qtdeArgs == 1)
            {
                $this->sql = 'SELECT * FROM ' . $tabela;

                if($this->bancoDados)
                    $this->declaracao = $this->bancoDados->prepare($this->sql);
                else
                    throw new Exception('Erro no conexao->AbrirBd');

                if($this->declaracao)
                    $execute = $this->declaracao->execute();
                else
                    throw new Exception('Erro no bd->prepare.');

                if($execute)
                    $getResult = $this->declaracao->get_result();
                else
                    throw new Exception('Erro no declaracao->execute.');

                if($getResult)
                    $this->resultado = $getResult->fetch_all(MYSQLI_ASSOC);
                else
                    throw new Exception('Erro no declaracao->get_result.');
            }
            else
            {
                if($qtdeArgs == 3)
                {
                    $bindParamTipoArgs = $this->AddBindParamTipoArgs($filtro1);

                    $this->sql = "SELECT * FROM " . $tabela . " WHERE " . $coluna1 . "=?";

                    if($this->bancoDados)
                        $this->declaracao = $this->bancoDados->prepare($this->sql);
                    else
                        throw new Exception('Erro no conexao->AbrirBd');

                    if($this->declaracao)
                        $bindParam = $this->declaracao->bind_param($bindParamTipoArgs, $filtro1);
                    else
                        throw new Exception('Erro no bd->prepare.');
                }
                elseif($qtdeArgs == 5)
                {
                    $bindParamTipoArgs = $this->AddBindParamTipoArgs($filtro1);
                    $bindParamTipoArgs .= $this->AddBindParamTipoArgs($filtro2);

                    $this->sql = 'SELECT * FROM '.$tabela.' WHERE '.$coluna1.'=? AND '.$coluna2.'=?';

                    if($this->bancoDados)
                        $this->declaracao = $this->bancoDados->prepare($this->sql);
                    else
                        throw new Exception('Erro no conexao->AbrirBd');

                    if($this->declaracao)
                        $bindParam = $this->declaracao->bind_param($bindParamTipoArgs, $filtro1, $filtro2);
                    else
                        throw new Exception('Erro no bd->prepare.');
                }
                elseif($qtdeArgs == 7)
                {
                    $bindParamTipoArgs = $this->AddBindParamTipoArgs($filtro1);
                    $bindParamTipoArgs .= $this->AddBindParamTipoArgs($filtro2);
                    $bindParamTipoArgs .= $this->AddBindParamTipoArgs($filtro3);

                    $this->sql = 'SELECT * FROM '.$tabela.' WHERE '.$coluna1.'=? AND '.$coluna2.'=? AND '.$coluna3.'=?';

                    if($this->bancoDados)
                        $this->declaracao = $this->bancoDados->prepare($this->sql);
                    else
                        throw new Exception('Erro no conexao->AbrirBd');

                    if($this->declaracao)
                        $bindParam = $this->declaracao->bind_param($bindParamTipoArgs, $filtro1, $filtro2, $filtro3);
                    else
                        throw new Exception('Erro no bd->prepare.');
                }

                if($bindParam)
                    $execute = $this->declaracao->execute();
                else
                    throw new Exception('Erro no declaracao->bind_param.');

                if($execute)
                    $getResult = $this->declaracao->get_result();
                else
                    throw new Exception('Erro no declaracao->execute.');

                if($getResult)
                    $this->resultado = $getResult->fetch_all(MYSQLI_ASSOC);
                else
                    throw new Exception('Erro no declaracao->get_result.');
            }

            $this->declaracao->close();
            $this->conexao->FecharBd($this->bancoDados);

            if(isset($this->resultado))
            {
                $_SESSION['erro'] = '';
                return $this->resultado;
            }
            else
                throw new Exception('Não foram encontrados resultados no BD.');
        }
        catch (Exception $e)
        {
            $_SESSION['erro'] = 'Não foi possível consultar no BD';
            return null;
        }
    }

    function AdicionarBd ($tabela) : bool
    {
        $qtdeArgs = func_num_args();
        $valorArgs = func_get_args();

        $atributos = array();
        $valores = array();

        $sqlArgs = '';

        $bindParamTipoArgs = '';
        $bindParamArgs = array();

        for($i = 1; $i <= ($qtdeArgs / 2) - 0.5; $i++)
        {
            $iValores = $i + (($qtdeArgs / 2) - 0.5);

            $atributos[] = $valorArgs[$i];
            $valores[] = $valorArgs[$iValores];

            $sqlArgs .= '?, ';

            $bindParamTipoArgs .= $this->AddBindParamTipoArgs($valorArgs[$iValores]);
        }

        $bindParamArgs[] = $bindParamTipoArgs;
        foreach($valores as $chave => $valor)
        {
            $bindParamArgs[] = & $valores[$chave];
        }

        try
        {
            $this->bancoDados = $this->conexao->AbrirBd();

            $this->sql = 'INSERT INTO ' . $tabela . ' (' . implode(', ', $atributos) . ') VALUES (' . substr($sqlArgs, 0, -2) . ')';

            if($this->bancoDados)
                $this->declaracao = $this->bancoDados->prepare($this->sql);
            else
                throw new Exception('Erro no conexao->AbrirBd');

            if($this->declaracao)
                $bindParam = call_user_func_array(array($this->declaracao, 'bind_param'), $bindParamArgs);
            else
                throw new Exception('Erro no bd->prepare.');

            if($bindParam)
                $execute = $this->declaracao->execute();
            else
                throw new Exception('Erro no declaracao->bind_param.');

            $this->declaracao->close();
            $this->conexao->FecharBd($this->bancoDados);

            if($execute)
            {
                $_SESSION['erro'] = '';
                return true;
            }
            else
                throw new Exception('Erro no declaracao->execute.');
        }
        catch (Exception $e)
        {
            $_SESSION['erro'] = 'Não foi possível incluir os dados no BD.';
            return false;
        }
    }

    function AlterarBd(string $tabela, $coluna, $filtro) : bool
    {
        $qtdeArgs = func_num_args();
        $valorArgs = func_get_args();

        $atributos = array();
        $valores = array();

        $bindParamTipoArgs = '';
        $bindParamArgs = array();

        for($i = 1; $i <= ($qtdeArgs / 2) - 1.5; $i++)
        {
            $iAtributos = $i + 2;
            $iValores = $i +  2 + (($qtdeArgs / 2) - 1.5);

            $atributos[] = $valorArgs[$iAtributos] . '=?';
            $valores[] = $valorArgs[$iValores];

            $bindParamTipoArgs .= $this->AddBindParamTipoArgs($valorArgs[$iValores]);
        }

        if(is_string($filtro))
            $bindParamTipoArgs .= $this->AddBindParamTipoArgs($filtro);
        else
            foreach($filtro as $f)
                $bindParamTipoArgs .= $this->AddBindParamTipoArgs($f);

        $bindParamArgs[] = $bindParamTipoArgs;

        foreach($valores as $chave => $valor)
            $bindParamArgs[] = & $valores[$chave];

        if(is_string($filtro))
            $bindParamArgs[] = & $filtro;
        else
            foreach($filtro as $chave => $valor)
                $bindParamArgs[] = & $filtro[$chave];

        try
        {
            $this->bancoDados = $this->conexao->AbrirBd();

            if(is_string($coluna))
                $this->sql = 'UPDATE ' . $tabela . ' SET ' . implode(', ', $atributos) . ' WHERE ' . $coluna . '=?';
            else
            {
                $this->sql = 'UPDATE ' . $tabela . ' SET ' . implode(', ', $atributos) . ' WHERE';

                foreach($coluna as $c)
                    $this->sql .= ' '.$c.'=? AND';

                $this->sql = substr($this->sql, 0, -4);
            }

            if($this->bancoDados)
                $this->declaracao = $this->bancoDados->prepare($this->sql);
            else
                throw new Exception('Erro no conexao->AbrirBd');

            if($this->declaracao)
                $bindParam = call_user_func_array(array($this->declaracao, 'bind_param'), $bindParamArgs);
            else
                throw new Exception('Erro no bd->prepare.');

            if($bindParam)
                $execute = $this->declaracao->execute();
            else
                throw new Exception('Erro no declaracao->bind_param.');

            $this->declaracao->close();
            $this->conexao->FecharBd($this->bancoDados);

            if($execute)
            {
                $_SESSION['erro'] = '';
                return true;
            }
            else
                throw new Exception('Erro no declaracao->execute.');
        }
        catch (Exception $exception)
        {
            $_SESSION['erro'] = 'Não foi possível alterar os dados no BD.';
            return false;
        }
    }

    function RemoverBd($tabela, $coluna1, $filtro1,
        $coluna2 = null, $filtro2 = null,
        $coluna3 = null, $filtro3 = null) : bool
    {
        $qtdeArgs = func_num_args();

        try
        {
            $this->bancoDados = $this->conexao->AbrirBd();

            if($qtdeArgs == 3)
            {
                $bindParamTipoArgs = $this->AddBindParamTipoArgs($filtro1);

                $this->sql = 'DELETE FROM '.$tabela.' WHERE '.$coluna1.'=?';

                if($this->bancoDados)
                    $this->declaracao = $this->bancoDados->prepare($this->sql);
                else
                    throw new Exception('Erro no conexao->AbrirBd');

                if($this->declaracao)
                    $bindParam = $this->declaracao->bind_param($bindParamTipoArgs, $filtro1);
                else
                    throw new Exception('Erro no bd->prepare.');
            }
            elseif($qtdeArgs == 7)
            {
                $bindParamTipoArgs = $this->AddBindParamTipoArgs($filtro1);
                $bindParamTipoArgs .= $this->AddBindParamTipoArgs($filtro2);
                $bindParamTipoArgs .= $this->AddBindParamTipoArgs($filtro3);

                $this->sql = 'DELETE FROM '.$tabela.' WHERE '.$coluna1.'=? AND '.$coluna2.'=? AND '.$coluna3.'=?';

                if($this->bancoDados)
                    $this->declaracao = $this->bancoDados->prepare($this->sql);
                else
                    throw new Exception('Erro no conexao->AbrirBd');

                if($this->declaracao)
                    $bindParam = $this->declaracao->bind_param($bindParamTipoArgs, $filtro1, $filtro2, $filtro3);
                else
                    throw new Exception('Erro no bd->prepare.');
            }

            if($bindParam)
                $execute = $this->declaracao->execute();
            else
                throw new Exception('Erro no declaracao->bind_param.');

            $this->declaracao->close();
            $this->conexao->FecharBd($this->bancoDados);

            if($execute)
            {
                $_SESSION['erro'] = '';
                return true;
            }
            else
                throw new Exception('Erro no declaracao->execute.');
        }
        catch (Exception $e)
        {
            $_SESSION['erro'] = 'Não foi possível remover os dados no BD';
            return false;
        }
    }

    private function AddBindParamTipoArgs($argumento) : string
    {
        $tipoArgs = '';

        try
        {
        	if(is_int($argumento))
                $tipoArgs .= 'i';
            elseif(is_string($argumento))
                $tipoArgs .= 's';
            else
                $tipoArgs .= 'd';

            return $tipoArgs;
        }
        catch (Exception $e)
        {
            return null;
        }
    }
}
?>