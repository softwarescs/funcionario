    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mr-5" href="<?=app_urlRaizA?>index.php">
                <img src="<?=app_urlRaiz?>wwwrot/img/logo-unip.png" width="100" height="30" class="d-inline-block align-top mr-2">
                <strong>SCS/Funcionário</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown" id="turmas">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Turmas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?=app_urlRaizA?>turmas/adicionar.php">Adicionar</a>
                        <a class="dropdown-item" href="<?=app_urlRaizA?>turmas/consultar.php">Consultar</a>
                        </div>
                    </li>
                    <li class="nav-item" id="cursos">
                        <a class="nav-link" href="<?=app_urlRaizA?>cursos/index.php">Cursos</a>
                    </li>
                    <li class="nav-item" id="salas">
                        <a class="nav-link" href="<?=app_urlRaizA?>salas/index.php">Salas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown" id="conta">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        João Carlos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?=app_urlRaizA?>conta/index.php">Gerenciar conta</a>
                        <a class="dropdown-item" href="<?=app_urlRaizA?>conta/logout.php">Sair</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>