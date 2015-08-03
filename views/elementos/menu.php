<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="?" class="brand">Sistema Web</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="?">Inicial</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="nav-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                    <?php if (!empty($_SESSION['usuario'])) { ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $_SESSION['usuario']['nome']?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="nav-header">Opções</li>
                           <li><a href="?controller=usuarios&action=edita&id=<?php echo $_SESSION['usuario']['id']?>">Editar</a></li>
                           <li><a href="?controller=usuarios&action=logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
                <?php if (!$_SESSION['usuario']) { ?>
                    <form class="navbar-form pull-right" action="?controller=usuarios&action=login" method="post">
                        <input type="text" name="login" placeholder="Login" class="span2">
                        <input type="password" name="senha" placeholder="Senha" class="span2">
                        <button class="btn" type="submit">Entrar</button>
                    </form>
                <?php } ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>