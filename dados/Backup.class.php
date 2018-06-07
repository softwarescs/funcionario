<?php
class Backup extends BancoDados
{
    private $nome;
    
    public function AdicionarBkpDadosTabelas() : bool
    {        
        $config = new Configuracoes();
        
        $this->nome = 'Backup_'.date('d-m-Y_H.i.s');
        
        if(file_exists($config->getDiretorio().'dados/bkp/'.$this->nome.'.sql'))
        {
            exit;
        }

        $consultarTabelas = $this->ConsultarTabelas();
        
        if(!empty($consultarTabelas))
        {
            $arquivo = fopen($config->getDiretorio().'dados/bkp/'.$this->nome.'.sql', 'a');
            
            foreach($consultarTabelas as $iT => $tabela)
            {
                switch($iT)
                {
                    case 'salas':
                        $this->sql .= 'INSERT INTO `salas` (`nome`, `predio`, `bloco`, `pavimento`) VALUES'.PHP_EOL;
                        break;
                    case 'cursos':
                        $this->sql .= 'INSERT INTO `cursos` (`nome`, `areaAtuacao`) VALUES'.PHP_EOL;
                        break;
                    case 'turmas':
                        $this->sql .= 'INSERT INTO `turmas` (`cursos_nome`, `salas_nome`, `periodo`, `semestre`) VALUES'.PHP_EOL;
                        break;
                }
                
                $keysTabela = array_keys($tabela);

                foreach($tabela as $iI => $item)
                {
                    switch($iT)
                    {
                        case 'salas':
                            $this->sql .= '(\''.$item['nome'].'\', '.$item['predio'].', \''.$item['bloco'].'\', '.$item['pavimento'].')';
                            break;
                        case 'cursos':
                            $this->sql .= '(\''.$item['nome'].'\', \''.$item['areaAtuacao'].'\')';
                            break;
                        case 'turmas':
                            $this->sql .= '(\''.$item['cursos_nome'].'\', \''.$item['salas_nome'].'\', \''.$item['periodo'].'\', '.$item['semestre'].')';
                            break;
                    }

                    if($iI === end($keysTabela))
                    {
                        $this->sql .= ';'.PHP_EOL.PHP_EOL;
                    }
                    else
                    {
                        $this->sql .= ','.PHP_EOL;
                    }
                }
            }
            
            fwrite($arquivo, $this->sql);
            fclose($arquivo);
            
            $this->RemoverBkpsAntigos(10);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function RestaurarBkpDadosTabelas() : bool
    {
        try
        {
            $config = new Configuracoes();
            
            if(!$consultarBkps = $this->ConsultarBkps())
            {
                throw new Exception('Erro no ConsultarBkps()');
            }
            
            $this->sql = file_get_contents($config->getDiretorio().'dados/bkp/'. current($consultarBkps));

            if(!$this->conexao = $this->AbrirBd())
            {
                throw new Exception('Erro no AbrirBd().');
            }

            if(!$this->conexao->multi_query($this->sql))
            {
                throw new Exception('Erro no conexao->multi_query().');
            }

            return true;
        }
        catch(Exception $e)
        {
            $this->mensagem = 'Não foi possível importar os dados no BD.';
            return false;
        }
    }
    
    public function ConsultarBkps()
    {
        $config = new Configuracoes();
        
        $backups = array();
        
        if($pasta = opendir($config->getDiretorio().'dados/bkp')) 
        {
            while(($backup = readdir($pasta)) !== false)
            {
                if ($backup != "." && $backup != "..")
                {
                    $backups[date('Y/m/d H:i:s', filemtime($config->getDiretorio().'dados/bkp/'.$backup))] = $backup;
                }
            }
            closedir($pasta);
        }
        
        krsort($backups, SORT_STRING);
        
        if($backups)
        {
            return $backups;
        }
        else
        {
            $this->mensagem = 'Não foi possível consultar os backups.';
            return null;
        }
    }
    
    public function RemoverBkpsAntigos(int $qtdeMaxBackups) : bool
    {
        $config = new Configuracoes();
        
        $consultarBkps = $this->ConsultarBkps();
        
        if($backups = $consultarBkps)
        {
            foreach($backups as $backup)
            {
                if($qtdeMaxBackups <= 0)
                {
                    unlink($config->getDiretorio().'dados/bkp/'.$backup);
                }

                $qtdeMaxBackups--;
            }
            
            return true;
        }
        else
        {
            $this->mensagem = 'Não foi possível remover os backups antigos.';
            return false;
        }
    }
}
