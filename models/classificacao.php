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

class Classificacao extends DataBase {

    protected $table = 'classificacao';
    protected $idField = 'ClaCodigo';
    protected $fields = array('ClaCodigo', 'ClaNome');

    function __construct() {
        parent::__construct();
        parent::setTable($this->table);
        parent::setIdField($this->idField);
    }

    function __destruct() {
        parent::__destruct();
    }

}

?>
