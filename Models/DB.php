<?php


class DB {

    private $con;
    private $host = "poseidon.salford.ac.uk";
    private $dbname = "sgb989";
    private $user = "sgb989";
    private $password = "cssa1database";

    public function __construct() {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;

        try {
            $this->con = new PDO($dsn, $this->user, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: ". $e->getMessage();
        }
    }

    public function viewData() {
        $query = "SELECT content FROM topics";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function searchData($content) {
        $query = "SELECT content FROM topics WHERE content LIKE :content";
        $stmt = $this->con->prepare($query);
        $stmt->execute(["content" => "%" . $content . "%"]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}