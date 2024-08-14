<?php

declare(strict_types=1);

namespace App\Models;

use App\Database\Db;

class BaseModel
{
    protected static Db $db;
    protected string $table = '';
    protected array $fields = [];
    
    public function __construct(array $options)
    {
        static::$db = new Db($options);
    }

    public function fetchLazy(\PDOStatement $stmt):\Generator
    {
        foreach($stmt as $record)
        {
            yield $record;
        }
    }

    private function prepareStmt($query)
    {
        $conn = static::$db;
        return $conn->prepare($query);
    }

    public function getAll()
    {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->prepareStmt($query);
        $stmt->execute();
        return $this->fetchLazy($stmt);
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->prepareStmt($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject(__CLASS__);
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->prepareStmt($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function __get(string $prop): mixed
    {
        return $this->fields[$prop];
    }

    public function __set(string $prop, mixed $value)
    {
        $this->fields[$prop] = $value;
    }

    public function save()
    {

        if(empty($this->fields['id']))
        {
            $query = $this->makeInsertQuery();
        }
        else
        {
            $query = $this->makeUpdateQuery();
        }

        $stmt = $this->prepareStmt($query);
        return $stmt->execute($this->fields);

    }

    private function makeInsertQuery(): string
    {
        $keys = array_keys($this->fields);
        $query = "INSERT INTO $this->table (";
        foreach($keys as $key)
        {
            $query.= $key. ",";
        }
        $beginQuery = $this->removeLastComma($query);
        $query1 = " VALUES (";
        foreach($keys as $key)
        {
            $query1.= ":".$key. ",";
        }
        $endQuery = $this->removeLastComma($query1);
        return $beginQuery.$endQuery;
    }

    private function removeLastComma(string $str): string
    {
        $posLastComma = strrpos($str,",");
        $subStr = substr($str,0,$posLastComma);
        $subStr.=")";
        return $subStr;
    }

    private function makeUpdateQuery(): string
    {
        $keys = array_keys($this->fields);
        $newkeys = array_splice($keys,1,-1);
        
        $updateQuery = "UPDATE $this->table SET ";
        foreach($newkeys as $key)
        {
            $updateQuery.= "$key = :$key,";
        }
        $posLastComma = strrpos($updateQuery,",");
        $updateQuery = substr($updateQuery,0,$posLastComma);
        return $updateQuery." WHERE id = :id";
    }

}
