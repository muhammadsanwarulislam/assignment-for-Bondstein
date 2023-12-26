<?php

namespace App;

use PDO;
use PDOException;

class DatabaseConnection
{
    private $db;

    public function __construct($host, $username, $password, $dbname)
    {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function getDb()
    {
        return $this->db;
    }
}
