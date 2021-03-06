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
require_once 'models/jogo.php';

class Jogos extends Jogo {

    private $folderName = 'jogos';

    function __construct() {
        parent::__construct();
    }

    function __destruct() {
        parent::__destruct();
    }

    function index() {
        //dados para a view
        $data = $this->findAll();

        //retorna dado[codigo] = nome
        $classificacoes = $this->classificacoesIndexed();

        require "views/$this->folderName/index.php";
    }

    function detalhe() {
        $data = $this->findAllByField($this->idField, $_GET['id']);

        require "views/$this->folderName/detalhe.php";
    }

    function cadastra() {

        if (!empty($_POST)) {

            $values[$this->idField] = $this->next_id();
            $values['JogNome'] = $_POST['nome'];
            $values['JogFaixaEtaria'] = $_POST['faixa'];
            $values['ClaCodigo'] = $_POST['classificacao'];

            if ($this->adiciona($this->fields, $values)) {
                echo "<h1>" . ucfirst($this->table) . " cadastrada com sucesso.</h1>";
            } else {
                echo "<h1>Erro ao gravar registro</h1>";
                require "views/$this->folderName/cadastra.php";
            }
            echo "<a href=\"?controller=$this->folderName\">Ir para listagem</a>";
        } else {
            //importa o Model de classificacao
            $classificacoes = $this->listaClassificacoes();

            require "views/$this->folderName/cadastra.php";
        }
    }

    //Edita Registro
    function edita() {
        if (!empty($_POST)) {

            $values['JogCodigo'] = $_POST['id'];
            $values['JogNome'] = $_POST['nome'];
            $values['JogFaixaEtaria'] = $_POST['faixa'];
            $values['ClaCodigo'] = $_POST['classificacao'];

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

                //dados para a view
                $data = $this->findAllByField($this->idField, $_GET['id']);
                //importa o Model de classificacao
                $classificacoes = $this->listaClassificacoes();

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
    function remove() {
        if (parent::remove($_GET['id'])) {
            echo "<h1>Registro removido da tabela $this->table</h1>";
        }
        else
            echo "<h1>Erro ao remover registro</h1>";

        echo "<a href=\"?controller=$this->folderName\">Retornar para listagem</a>";
    }

}

?>
