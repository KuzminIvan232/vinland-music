<?php

namespace core;

class Model
{

    protected $fieldsArray;
    protected static $primaryKey;
    protected static $tableName = '';

    public function __construct()
    {
        $this->fieldsArray = [];
    }

    public function __set($name, $value)
    {
        $this->fieldsArray[$name] = $value;
    }

    public function __get($name)
    {
        return $this->fieldsArray[$name];
    }

    public static function deleteById($id)
    {
        $db = Core::get()->db;
        static::$primaryKey = rtrim(static::$tableName, 's') . '_id';
        $db->delete(static::$tableName, [static::$primaryKey => $id]);
    }

    public static function deleteByCondition($conditionArray)
    {
        $db = Core::get()->db;
        static::$primaryKey = rtrim(static::$tableName, 's') . '_id';
        $db->delete(static::$tableName, $conditionArray);
    }

    public static function findById($id)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', [static::$primaryKey => $id,]);
        if (count($arr) > 0) {
            return $arr[0];
        } else {
            return null;
        }
    }

    public static function findByCondition($conditionArray)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', [static::$primaryKey => $conditionArray,]);
        if (count($arr) > 0) {
            return $arr[0];
        } else {
            return null;
        }
    }

    public function save()
    {
        $db = Core::get()->db;
        static::$primaryKey = rtrim(static::$tableName, 's') . '_id';
        $value = array_key_exists(static::$primaryKey, $this->fieldsArray)
            ? $this->fieldsArray[static::$primaryKey]
            : null;

        $recordExists = false;
        if (!empty($value)) {
            $existing = $db->select(static::$tableName, '*', [
                static::$primaryKey => $value
            ]);
            $recordExists = !empty($existing);
        }

        if (empty($value) || !$recordExists) {                //insert
            unset($this->fieldsArray[static::$primaryKey]);
            $db->insert(static::$tableName, $this->fieldsArray);
        } else {                                              //update
            $db->update(static::$tableName, $this->fieldsArray,
                [
                    static::$primaryKey => $value
                ]);
        }
    }
}