<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/9/2017
 * Time: 2:01 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

include_once ('Connect.php');

class Database extends Connect {

    // If you need to open a connection directly
    public function connect() {
        return Connect::openConnection();
    }

    // If you need to close a connection directly
    public function disconnect() {
        Connect::$connection = null;
    }


    /**
     * Returns all from a row with a where clause
     * @param string $table
     * @param string $where
     * @param array $query_params
     * @return mixed
     */
    public static function selectAll(string $table, string $where, array $query_params) {
        $query = "SELECT * FROM $table WHERE $where";
        try {
            $stmt = Connect::openConnection()->prepare($query);
            $stmt->execute($query_params);
        }
        catch (PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage());
        }
        return $stmt->fetch();
    }


    /**
     * Returns 1 column from a row with a where clause
     * @param string $table
     * @param string $where
     * @param array $query_params
     * @return mixed
     */
    public static function selectOne(string $table, string $where, array $query_params) {
        $query = "SELECT 1 FROM $table WHERE $where";
        try {
            $stmt = Connect::openConnection()->prepare($query);
            $stmt->execute($query_params);
        }
        catch (PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage());
        }
        return $stmt->fetch();
    }



    /**
     * Insert data
     * @param $query
     * @param array $query_params
     */
    public static function insert($query, array $query_params)
    {
        try
        {
            $stmt = Connect::openConnection()->prepare($query);
            $stmt->execute($query_params);
        }
        catch (PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
    }


    /**
     * Update and sets values
     * @param string $table
     * @param string $set
     * @param array $query_params
     */
    public static function update(string $table, string $set, array $query_params)
    {
        $query = "UPDATE $table SET $set";
        try
        {
            $stmt = Connect::openConnection()->prepare($query);
            $stmt->execute($query_params);
        }
        catch (PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
    }


    /**
     * Deletes ... from ... where ...
     * @param string $table
     * @param string $delete
     * @param array $query_params
     */
    public static function deleteWhere(string $table, string $delete, array $query_params)
    {
        $query = "DELETE $delete FROM $table WHERE $query_params";
        try
        {
            $stmt = Connect::openConnection()->prepare($query);
            $stmt->execute($query_params);
        }
        catch (PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
    }


    public static function search($query, array $data = null)
    {
        try
        {
            $stmt = Connect::openConnection()->prepare($query);
            $stmt->execute($data);
        }
        catch (PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
        return $stmt->fetchAll();
    }


}