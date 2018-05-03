<?php
class SalasControle
{
    function IndexGet()
    {
        $sala = new Sala();
        $consultarSalas = array();

        for($i = 'A'; $i != 'Z'; $i++)
        {
            $consultarSalas[$i] = $sala->ConsultarSalas($i);
        }

        $modelo = new apresSalasIndex();
        $modelo->setTitulo('Salas - Sistema consulta de sala');
        $modelo->setUrlJs('salas');

        if($consultarSalas)
            $modelo->setSalas($consultarSalas);

        return $modelo;
    }

    function AdicionarGet()
    {
        $modelo = new apresSalasAdicionarAlterarRemover();
        $modelo->setTitulo('Adicionar sala - Sistema consulta de sala');
        $modelo->setUrlJs('salas');

        return $modelo;
    }

    function AdicionarPost(object $modelo)
    {
        $sala = new Sala();
        $sala->setNome($modelo->__get('nome'));
        $sala->setPredio($modelo->__get('predio'));
        $sala->setBloco($modelo->__get('bloco'));
        $sala->setPavimento($modelo->__get('pavimento'));

        $adicionarSala = $sala->AdicionarSala();

        if($adicionarSala)
            return true;
        else
            return false;
    }

    function AlterarGet($nome)
    {
        $sala = new Sala();
        $consultarSala = $sala->ConsultarSala($nome);

        if($consultarSala)
        {
            $modelo = new apresSalasAdicionarAlterarRemover();
            $modelo->setTitulo('Alterar sala - Sistema consulta de sala');
            $modelo->setUrlJs('salas');
            $modelo->setNome($sala->__get('nome'));
            $modelo->setPredio($sala->__get('predio'));
            $modelo->setBloco($sala->__get('bloco'));
            $modelo->setPavimento($sala->__get('pavimento'));

            return $modelo;
        }
    }

    function AlterarPost(object $modelo)
    {
        $sala = new Sala();
        $sala->setPredio($modelo->__get('predio'));
        $sala->setBloco($modelo->__get('bloco'));
        $sala->setPavimento($modelo->__get('pavimento'));

        $alterarSala = $sala->AlterarSala($modelo->__get('nome'));

        if($alterarSala)
            return true;
        else
            return false;
    }

    function RemoverGet($nome)
    {
        $sala = new Sala();
        $consultarSala = $sala->ConsultarSala($nome);

        if($consultarSala)
        {
            $modelo = new apresSalasAdicionarAlterarRemover();
            $modelo->setTitulo('Remover sala - Sistema consulta de sala');
            $modelo->setUrlJs('salas');
            $modelo->setNome($sala->__get('nome'));
            $modelo->setPredio($sala->__get('predio'));
            $modelo->setBloco($sala->__get('bloco'));
            $modelo->setPavimento($sala->__get('pavimento'));

            return $modelo;
        }
    }

    function RemoverPost(object $modelo)
    {
        $sala = new Sala();
        $removerSala = $sala->RemoverSala($modelo->__get('nome'));

        if($removerSala)
            return true;
        else
            return false;
    }
}
?>