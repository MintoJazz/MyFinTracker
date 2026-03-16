<?php final class Transaction {
    private $id;
    private $descritpion;
    private $date;
    private $amount;
    private $bucket;
    private $bucketId;

    public function __construct() {}

    public function getId() { return $this->id; }
    public function getDescription() { return $this->descritpion; }
    public function getDate() { return $this->date; }
    public function getAmount() { return $this->amount; }
    public function getBucket() { return $this->bucket; }
    public function getBucketId() { return $this->bucketId; }

    public function setId($id) { $this->id = $id; }
    public function setDescription($description) { $this->descritpion = $description; }
    public function setDate($date) { $this->date = $date; }
    public function setAmount($amount) { $this->amount = $amount; }
    public function setBucket($bucket) { $this->bucket = $bucket; }
    public function setBucketId($bucketId) { $this->bucketId = $bucketId; }
}
