<?php

final class DAO {
    private string $table;

    public function __construct(string $table) { $this->table = $table; }

    public function findAll(SQLite3 $db) {
        $preparedStatement = $db->prepare("SELECT * FROM {$this->table};");
        $resultSet = $preparedStatement->execute();
        $list = [];

        while ($row = $resultSet->fetchArray(SQLITE3_ASSOC)) $list[] = $row;

        return $list;
    }

    public function findOneByKey(SQLite3 $db, string $key, $val) {
        $preparedStatement = $db->prepare("SELECT * FROM {$this->table} WHERE $key = :val");
        $preparedStatement->bindValue(':val', $val);

        $resultSet = $preparedStatement->execute();

        return $resultSet->fetchArray();
    }

    public function findManyByKey(SQLite3 $db, string $key, $val) {
        $preparedStatement = $db->prepare("SELECT * FROM {$this->table} WHERE $key = :val");
        $preparedStatement->bindValue(':val', $val);

        $resultSet = $preparedStatement->execute();
        $list = [];

        while ($row = $resultSet->fetchArray()) $list[] = $row;

        return $list;
    }

    public function updateManyByKey(SQLite3 $db, array $data, string $key, $val) {
        $keys = array_keys($data);
        $pairs = implode(', ', array_map(fn($k) => "$k = :$k", $keys));

        $preparedStatement = $db->prepare("UPDATE {$this->table} SET $pairs WHERE $key = :val");
        
        foreach ($data as $k => $v) $preparedStatement->bindValue(":$k", $v);
        $preparedStatement->bindValue(':val',$val);

        $preparedStatement->execute();

        return $db->changes();
    }

    public function create(SQLite3 $db, array $data) {
        $keys = array_keys($data);
        $columns = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $preparedStatement = $db->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");

        foreach ($data as $key => $val) $preparedStatement->bindValue(":$key", $val);

        $preparedStatement->execute();
        return $db->changes();
    }

    public function killManyByKey(SQLite3 $db, string $key, $val) {
        $preparedStatement = $db->prepare("DELETE FROM {$this->table} WHERE $key = :val");
        $preparedStatement->bindValue(':val', $val);

        $preparedStatement->execute();

        return $db->changes();
    }
}
