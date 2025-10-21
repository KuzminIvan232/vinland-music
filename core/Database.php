<?php

namespace core;

class Database
{

    public $pdo;

    public function __construct($host, $name, $login, $password)
    {
        $this->pdo = new \PDO("mysql:host={$host};dbname={$name}", $login, $password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
    }

    protected function where($where)
    {
        if (!is_array($where) || empty($where)) {
            return '';
        }
        $parts = [];
        foreach (array_keys($where) as $field) {
            $parts[] = "{$field} = :{$field}";
        }
        return 'WHERE ' . implode(' AND ', $parts);
    }

    public function select($table, $fields = '*', $where = null)
    {
        if (is_array($fields)) {
            $fields_string = implode(', ', $fields);
        } else {
            if (is_string($fields)) {
                $fields_string = $fields;
            } else {
                $fields_string = '*';
            }
        }

        $where_string = $this->where($where);

        $sql = "SELECT {$fields_string} FROM {$table} {$where_string}";

        $sth = $this->pdo->prepare($sql);

        if (is_array($where)) {
            foreach ($where as $key => $value) {
                $sth->bindValue(":{$key}", $value);
            }
        }
        $sth->execute();
        return $sth->fetchAll();
    }

    public function insert($table, $row_to_insert)
    {
        $fields_list = implode(', ', array_keys($row_to_insert));
        $params_array = [];
        foreach ($row_to_insert as $key => $value) {
            $params_array[] = ":{$key}";
        }
        $params_list = implode(', ', $params_array);
        $sql = "INSERT INTO {$table} ({$fields_list}) VALUES ({$params_list})";
        $sth = $this->pdo->prepare($sql);
        foreach ($row_to_insert as $key => $value) {
            $sth->bindValue(":{$key}", $value);
        }
        $sth->execute();
        return $sth->rowCount();
    }

    public function delete($table, $where)
    {
        $where_string = $this->where($where);
        $sql = "DELETE FROM {$table} {$where_string}";
        $sth = $this->pdo->prepare($sql);
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                $sth->bindValue(":{$key}", $value);
            }
        }

        $sth->execute();
        return $sth->rowCount();
    }

    public function update($table, $row_to_update, $where)
    {
        $where_string = $this->where($where);
        $set_array = [];
        foreach ($row_to_update as $key => $value) {
            $set_array[] = "{$key} = :{$key}";
        }
        $set_string = implode(', ', $set_array);
        $sql = "UPDATE {$table} SET {$set_string} {$where_string}";
        $sth = $this->pdo->prepare($sql);
        foreach ($row_to_update as $key => $value) {
            $sth->bindValue(":{$key}", $value);
        }
        foreach ($where as $key => $value) {
            $sth->bindValue(":{$key}", $value);
        }
        $sth->execute();
        return $sth->rowCount();
    }

}