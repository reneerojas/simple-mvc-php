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
/**
 * Gerancia manipulação do banco de dados
 */
class DataBase {

    private $conexao;
    private $server;
    private $user;
    private $pass;
    private $db;
    private $table;
    private $idField;

    /*
     * Construtor
     */

    function __construct() {
        $this->config();
        echo "<p>-------------DB!--------------------------------</p>";
        $this->conecta();
    }

    function __destruct() {
        $this->fecha();
        echo "<p>--------------FIM DB!---------------------------</p>";
    }

    /*
     * Configura a conexão
     */

    private function config() {

        require_once 'base/db_config.php';

        $this->server = $DB_SERVER;
        $this->user = $DB_USER;
        $this->pass = $DB_PASS;
        $this->db = $DB_BASE;
    }

    /**
     * Abre conexão com o Banco de dados
     */
    public function conecta() {
        $this->conexao = mysql_connect($this->server, $this->user, $this->pass);

        if (!$this->conexao)
            die('Erro ao conectar banco de dados. ' . mysql_error());


        mysql_select_db($this->db) or die('Erro ao selecionar banco de dados. ' . mysql_error());
    }

    /**
     * Configura a tabela que sera consultada
     * @param strng $table
     */
    protected function setTable($table) {
        $this->table = $table;
    }

    /**
     * Configura o campo que possui o ID unico
     * @param string $field
     */
    protected function setIdField($field) {
        $this->idField = $field;
    }

    /**
     *
     * @param string $consulta
     * @return type
     */
    public function query($consulta) {
        $res = mysql_query($consulta);

        if (!$res)
            die('<br />Erro ao executar instrucao SQL: ' . mysql_error());

        return $res;
    }

    /**
     * Transforma resposta do Banco de Dados em array
     * @param string $consulta
     * @return array
     */
    public function query_result($consulta) {
        $query = $this->query($consulta);
        //Retorna tudo como array
        while ($res[] = mysql_fetch_array($query));
        //Remove elemento extra
        unset($res[sizeof($res) - 1]);
        return $res;
    }

    /**
     * Retorna o próximo id
     * @return int
     */
    public function next_id() {
        $query = "SELECT MAX($this->idField)+1 as next FROM $this->table";
        $next = mysql_fetch_array($this->query($query));
        return $next['next'];
    }

    /**
     * Lista todos os dados da tabela
     * @return array
     */
    public function findAll() {
        return $this->query_result("SELECT * FROM $this->table");
    }

    /**
     * Encontra um ou mais registros que possuem um campo com um determinado valor
     * @param string $field
     * @param string $value
     * @return array
     */
    public function findAllByField($field, $value) {
        return $this->query_result("SELECT * FROM $this->table WHERE $field = '$value'");
    }

    /**
     * Cadastra item no banco de dados
     * @param array $fields
     * @param array $values
     * @return bool
     */
    public function adiciona($fields, $values) {
        foreach ($values as $key => $value)
            $values[$key] = "'$value'";

        $query = "INSERT INTO $this->table (" . implode(",", $fields) . ") VALUES (" . implode(",", $values) . ")";
        return $this->query($query);
    }

    /**
     * Edita item no banco de dados
     * @param array $fields
     * @param array $values
     * @return bool
     */
    public function edita($values) {

        //monta a array para o sql
        foreach ($values as $key => $value)
            $data[] = $key." ='$value'";

        //remove o primeiro elemento da array que é o ID e monta a string condicional
        $cond = array_shift($data);

        $query = "UPDATE $this->table SET " . implode(", ", $data) . " WHERE $cond";

        return $this->query($query);
    }

    /**
     * Remove registro do Banco
     * @param type $id
     * @return type
     */
    public function remove($id) {
        $query = "DELETE FROM $this->table WHERE $this->idField = '{$_GET['id']}'";
        return $this->query($query);
    }

    /*
     * Termina a conexao
     */

    public function fecha() {
        mysql_close();
    }

}

?>
