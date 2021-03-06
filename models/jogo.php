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
require_once 'base/db.php';

/*
 * Classe para manipular dados do usuario no banco
 */

class Jogo extends DataBase {

    protected $table = 'jogo';
    protected $idField = 'JogCodigo';
    protected $fields = array('JogCodigo', 'JogNome', 'JogFaixaEtaria', 'ClaCodigo');

    function __construct() {
        parent::__construct();
        parent::setTable($this->table);
        parent::setIdField($this->idField);
    }

    function __destruct() {
        parent::__destruct();
    }

    public function lista() {
        var_dump($this->findAll());
    }

    /**
     * Lista todos as classificações disponíveis
     * @return array
     */
    public function listaClassificacoes(){
        return $this->query_result("SELECT * FROM classificacao");
    }

    /**
     * Lista Classificacoes retornando array[ClaCod] = ClaNome
     * para facilitar exibicoes
     * @return array
     */
    public function classificacoesIndexed(){
        $todos = $this->listaClassificacoes();
        foreach($todos as $item)
            $data[$item['ClaCodigo']] = $item['ClaNome'];
        return $data;
    }

}

?>
