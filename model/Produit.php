<?php

require_once 'DB.php';
class Produit {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function getAllProduits() {
        $query = "SELECT * FROM produits";
        $stmt = $this->db->prepare($query); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>