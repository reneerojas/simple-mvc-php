<?php
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
require_once 'models/usuario.php';

class Usuarios extends Usuario {

    private $folderName = 'usuarios';

    public function __construct() {
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function index() {
        $data = $this->findAll();

        require "views/$this->folderName/index.php";
    }

    public function detalhe() {
        $data = $this->findAllByField($this->idField, $_GET['id']);

        require "views/$this->folderName/detalhe.php";
    }

    public function cadastra() {
        if (!empty($_POST)) {

            $values['UsuCodigo'] = $this->next_id();
            $values['UsuNome'] = $_POST['nome'];
            $values['UsuLogin'] = $_POST['login'];
            $values['UsuSenha'] = $_POST['senha'];

            if ($this->adiciona($this->fields, $values)) {
                echo "<h1>" . ucfirst($this->table) . " cadastrado com sucesso.</h1>";
            } else {
                echo "<h1>Erro ao gravar registro</h1>";
                require "views/$this->folderName/cadastra.php";
            }
            echo "<a href=\"?controller=$this->folderName\">Ir para listagem</a>";
        } else {
            require "views/$this->folderName/cadastra.php";
        }
    }

    //Edita Registro
    public function edita() {
        if (!empty($_POST)) {
            $values['UsuCodigo'] = $_POST['id'];
            $values['UsuNome'] = $_POST['nome'];
            $values['UsuLogin'] = $_POST['login'];
            $values['UsuSenha'] = $_POST['senha'];

            if (parent::edita($values)) {
                echo "<h1>" . ucfirst($this->table) . " Atualizado com sucesso.</h1>";
                $this->index();
            } else {
                echo "<h1>Erro ao atualizar registro</h1>";
                require "views/$this->folderName/edita.php";
            }
            // echo "<a href=\"?controller=$this->folderName\">Ir para listagem</a>";
        } else {
            if (!empty($_GET['id'])) {
                $usuario = $this->findAllByField($this->idField, $_GET['id']);
                require "views/$this->folderName/edita.php";
            } else {
                // Se nao houver ID vai pra listagem
                $this->index();
            }
        }
    }

    /**
     * Remove o registro passando o id
     */
    public function remove() {
        if (parent::remove($_GET['id'])) {
            echo "<h1>Registro removido da tabela $this->table</h1>";
        }
        else
            echo "<h1>Erro ao remover registro</h1>";

        echo "<a href=\"?controller=$this->folderName\">Retornar para listagem</a>";
    }

    public function login() {
        if (!empty($_POST)) {
            $user = $this->findAllByField('UsuLogin', $_POST['login']);
            if (!empty($user) && $user[0]['UsuSenha'] == $_POST['senha']) {
                //Armazena dados na sessao

                $_SESSION['usuario']['id'] = $user[0]['UsuCodigo'];
                $_SESSION['usuario']['login'] = $user[0]['UsuLogin'];
                $_SESSION['usuario']['nome'] = $user[0]['UsuNome'];

                print_r($_SESSION);
                //Redireciona a pagina
                //echo "<script type=\"text/javascript\">window.location= \"?\"</script>";
            } else {
                $error = "<h2>Login/Senha inválidos";
            }
        }
        require "views/$this->folderName/login.php";
    }

    public function logout() {
        session_destroy();
        echo "<script type=\"text/javascript\">window.location= \"?\"</script>";
    }

}

?>
