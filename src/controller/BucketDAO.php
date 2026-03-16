<?php require_once 'Bucket.php';

final class BucketDAO { // <-- FUCK = Find Update Create Kill
    private SQLite3 $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findAll() {
        $preparedStatement = $this->db->prepare('SELECT * FROM bucket');
        $resultSet = $preparedStatement->execute();
        $list = [];

        while ($row = $resultSet->fetchArray()) {
            $bucket = new Bucket();

            $bucket->setId($row['id']);
            $bucket->setName($row['name']);

            $list[] = $bucket;
        }

        return $list;
    }

    public function findById($id) {
        $preparedStatement = $this->db->prepare('SELECT * FROM bucket WHERE id = :id');
        $preparedStatement->bindValue(':id', $id, SQLITE3_INTEGER);
        $resultSet = $preparedStatement->execute();

        $row = $resultSet->fetchArray();

        if ($row) {
            $bucket = new Bucket();

            $bucket->setId($row['id']);
            $bucket->setName($row['name']);

            return $bucket;
        }
        
        return null;
    }

    public function update(Bucket $bucket) {
        $preparedStatement = $this->db->prepare('UPDATE bucket SET name = :name WHERE id = :id');
        $preparedStatement->bindValue(':id', $bucket->getId(), SQLITE3_INTEGER);
        $preparedStatement->bindValue(':name', $bucket->getName(), SQLITE3_TEXT);
        $preparedStatement->execute();

        return $this->db->changes() > 0;
    }

    public function create(Bucket $bucket) {
        $preparedStatement = $this->db->prepare('INSERT INTO bucket (id, name) VALUES (:id, :name)');
        $preparedStatement->bindValue(':id', $bucket->getId(), SQLITE3_INTEGER);
        $preparedStatement->bindValue(':name', $bucket->getName(), SQLITE3_TEXT);
        $preparedStatement->execute();

        return $this->db->changes() > 0;
    }

    public function kill($id) {
        $preparedStatement = $this->db->prepare('DELETE FROM bucket WHERE id = :id');
        $preparedStatement->bindValue(':id', $id, SQLITE3_INTEGER);
        $preparedStatement->execute();

        return $this->db->changes() > 0;
    }
}
