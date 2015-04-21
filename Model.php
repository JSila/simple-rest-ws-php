<?php

namespace App;

use PDO;
use Exception;

class Model
{
    /**
     * Database connection.
     *
     * @var PDO
     */
    protected $connection;

    public function __construct()
    {
        $config = include 'config/database.php';
        $this->connection = new PDO(
            "mysql:host={$config['hostname']};dbname={$config['database']};charset=utf8",
            $config['username'],
            $config['password']
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * if $relatedTable is added, than we select related record based on foreign key.
     *
     * @param $relatedTable
     * @return $this
     */
    public function with($relatedTable)
    {
        $this->with[] = $relatedTable;

        return $this;
    }

    /**
     * Selects all data from given table with given id.
     *
     * @param $table
     * @param $id
     * @return array
     * @throws Exception
     */
    protected function select($table, $id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM ' . $table .' WHERE id = :id');
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (! $data) {
            throw new Exception('Model not found');
        }

        return $data;
    }
}
