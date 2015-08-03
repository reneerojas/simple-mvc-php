/**
 * Copyright 2013 Renee Rojas (reneerojas)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistemas Web</title>
        <link href="assets/css/bootstrap.min.css" type="text/css" rel="stylesheet"></link>
        <link href="assets/css/default.css" type="text/css" rel="stylesheet"></link>
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php

        //Adiciona o menu do topo
        require 'views/elementos/menu.php';
        ?>
        <div class="container">

            <?php
            /**
             * Gerencia as rotas passadas pela url
             * ex: ?controller=usuarios&action=index
             */
            //Caso o contoller seja passado como GET e exista
            if (!empty($_GET['controller'])) {

                //CammelCase na string do controller classe -> Classe
                $class_name = ucfirst($_GET['controller']);

                //Se o arquivo de controller existir
                if (is_file("controllers/{$_GET['controller']}.php")) {

                    //Anexa o arquivo do controller
                    require "controllers/{$_GET['controller']}.php";

                    //Se a Classe existir no controller
                    if (class_exists($class_name)) {

                        //Instancia a classe
                        $class = "\$class = new $class_name();";
                        eval($class);

                        //Se nao for passada a acao vai para o metodo index
                        if (empty($_GET['action']))
                            $class->index();
                        else {
                            //Se a action passada pelo url for um método da classe, invoca o método
                            if (method_exists($class, $_GET['action'])) {
                                eval("\$class->{$_GET['action']}();");
                            }
                            else
                                exit("<h1>O método não existe na classe $class_name.</h1>");
                        }
                    }
                    else
                        exit("<h1>Classe $class_name não encontradada em {$_GET['controller']}.php</h1>");
                }
                else
                    exit("<h1>Controller não encontrado</h1>");
            }
            else
            //Adiciona pagina inicial se nao houver controller
                require 'views/elementos/inicio.php';
            ?>
        </div>
    </body>
</html>
