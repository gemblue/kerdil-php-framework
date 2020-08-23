<?php

declare(strict_types=1);

namespace Core;

use PDO;

use function rtrim;

/**
 * Query Builder
 *
 * Simple Query Builder for Kerdil.
 */
class QueryBuilder
{
    /** @var string Untuk meyimpan SQL sintaks final */
    public $command;

    /** @var string Menyimpan koneksi socket */
    public $connection;

    /** @var string Menyimpan query select. */
    public $select = null;

    /** @var string Menyimpan query from. */
    public $from = null;

    /** @var string Menyimpan query where. */
    public $where = null;

    /** @var string Menyimpan query join. */
    public $join = null;

    /** @var string Menyimpan query groupBy. */
    public $groupBy = null;

    /** @var string Menyimpan query limit. */
    public $limit = null;

    /** @var string Pilihan fetch. */
    public $fetch = false;

    public function __construct()
    {
        $config = require '../config/database.php';

        try {
            $this->connection = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['database'], $config['user'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return new Exception($e->getMessage());
        }
    }

    /**
     * QB::select
     */
    public function select(string $field = '*'): QueryBuilder
    {
        if (empty($field)) {
            $this->select = 'SELECT *';
        }

        $this->select = 'SELECT ' . $field;

        return $this;
    }

    /**
     * QB::from
     */
    public function from(string $table, ?string $condition = null): QueryBuilder
    {
        $this->from = ' FROM ' . $table;

        return $this;
    }

    /**
     * QB::join
     */
    public function join(string $table, string $relation): QueryBuilder
    {
        $this->join = ' JOIN ' . $table . ' ON ' . $relation;

        return $this;
    }

    /**
     * QB::where
     */
    public function where(mixed $fields): QueryBuilder
    {
        $where = ' WHERE ';

        foreach ($fields as $key => $value) {
            $where .= $key . '="' . $value . '" AND ';
        }

        /** Trim */
        $where = rtrim($where, 'AND ');

        $this->where = $where;

        return $this;
    }

    /**
     * QB::limit
     */
    public function limit(string $limit, int $order = 0): QueryBuilder
    {
        $this->limit = ' LIMIT ' . $order . ', ' . $limit;

        return $this;
    }

    /**
     * QB::groupBy
     */
    public function groupBy(string $by): QueryBuilder
    {
        $this->groupBy = ' GROUP BY ' . $by;

        return $this;
    }

    /**
     * QB::results
     *
     * Compile all piece, run command
     */
    public function result(): mixed
    {
        $command = '';

        $command .= $this->select;
        $command .= $this->from;
        $command .= $this->join;
        $command .= $this->where;
        $command .= $this->groupBy;
        $command .= $this->limit;

        $this->command = $command;

        return $this->fetch()->run();
    }

    /**
     * QB::insert
     */
    public function insert(string $table, mixed $fields): mixed
    {
        /** Transform fields into string */
        $set = '';

        foreach ($fields as $key => $value) {
            $set .= $key . '="' . $value . '", ';
        }

        /** Trim */
        $set = rtrim($set, ', ');

        /** Build */
        $this->command = 'INSERT INTO ' . $table . ' SET ' . $set;

        return $this->run();
    }

    /**
     * QB::insertOnce
     *
     * Insert if record is not exist. Just one time. No duplicate.
     */
    public function insertOnce(string $table, mixed $fields): mixed
    {
        /** 1. Check duplicate */
        $row = $this->select('id')
                    ->from($table)
                    ->where($fields)
                    ->result();

        if ($row) {
            return false;
        }

        /** 2. Insert. */
        $this->fetch = false;

        return $this->insert($table, $fields);
    }

    /**
     * QB::update
     */
    public function update(string $table, mixed $fields, mixed $wheres): bool
    {
        /** Transform fields into string */
        $set = '';

        foreach ($fields as $key => $value) {
            $set .= $key . '="' . $value . '", ';
        }

        /** Transform wheres into string */
        $where = '';

        foreach ($wheres as $key => $value) {
            $where .= $key . '="' . $value . '", ';
        }

        /** Trim */
        $set   = rtrim($set, ', ');
        $where = rtrim($where, ', ');

        /** Build */
        $this->command = 'UPDATE ' . $table . ' SET ' . $set . ' WHERE ' . $where;

        return $this->run();
    }

    /**
     * QB::delete
     */
    public function delete(string $table, mixed $wheres): bool
    {
        /** Transform wheres into string */
        $where = '';

        foreach ($wheres as $key => $value) {
            $where .= $key . '="' . $value . '", ';
        }

        /** Trim */
        $where = rtrim($where, ', ');

        /** Build */
        $this->command = 'DELETE FROM ' . $table . ' WHERE ' . $where;

        return $this->run();
    }

    /**
     * QB::setCommand
     */
    public function setCommand(string $command): QueryBuilder
    {
        $this->command = $command;

        return $this;
    }

    /**
     * QB::withFetch
     *
     * Set agar API mengeluarkan data output
     */
    public function fetch(): QueryBuilder
    {
        $this->fetch = true;

        return $this;
    }

    /**
     * QB::run
     *
     * Run SQL or No SQL, dengan fetch atau tidak.
     */
    public function run(): bool
    {
        $statement = $this->connection->prepare($this->command);

        if ($statement->execute()) {
            if ($this->fetch) {
                $statement->setFetchMode(PDO::FETCH_ASSOC);

                return $statement->fetchAll(PDO::FETCH_OBJ);
            }

            return true;
        }

        return false;
    }
}
