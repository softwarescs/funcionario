<?php
class Configuracoes
{
    private $diretorio;
    private $url;
    private $urlApres;
    private $cabecalho;
    private $menu;
    private $rodape;
    private $dataHora;
    private $bdHost;
    private $bdUsuario;
    private $bdSenha;
    private $bdNome;


    public function __construct()
    {
        $this->diretorio = dirname(__FILE__).'/';
        $this->url = '/scs/appfuncionario/';
        $this->urlApres = $this->url.'apresentacao/';
        $this->cabecalho = $this->diretorio.'apresentacao/_cabecalho.php';
        $this->menu = $this->diretorio.'apresentacao/_menu.php';
        $this->rodape = $this->diretorio.'apresentacao/_rodape.php';
        date_default_timezone_set('America/Sao_Paulo');
        $this->dataHora = date('h:i:s - d/m');
        $this->bdHost = 'localhost';
        $this->bdUsuario = 'root';
        $this->bdSenha = '';
        $this->bdNome = 'scs';
    }

    public function getDiretorio()
    {
        return $this->diretorio;
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function getUrlApres()
    {
        return $this->urlApres;
    }
    public function getCabecalho()
    {
        return $this->cabecalho;
    }
    public function getMenu()
    {
        return $this->menu;
    }
    public function getRodape()
    {
        return $this->rodape;
    }
    public function getDataHora()
    {
        return $this->dataHora;
    }
    public function getBdHost()
    {
        return $this->bdHost;
    }
    public function getBdUsuario()
    {
        return $this->bdUsuario;
    }
    public function getBdSenha()
    {
        return $this->bdSenha;
    }
    public function getBdNome()
    {
        return $this->bdNome;
    }
}