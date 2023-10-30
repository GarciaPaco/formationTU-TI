<?php

namespace Repository;
require_once "Entity/Contact.php";
use PDO;
use Exception;
use Entity\Contact;
use PDOException;
class ContactRepository
{
 public function add(Contact $contact)
 {
    $pdo = $this->connectToDatabase();
    $this->createTable($pdo);
    $query = $pdo->prepare("INSERT INTO contact (nom, prenom, email) VALUES (:nom, :prenom, :email)");
    return $query->execute([
        'nom' => $contact->getNom(),
        'prenom' => $contact->getPrenom(),
        'email' => $contact->getEmail()
    ]);
}


    public function delete()
    {
        $pdo = $this->connectToDatabase();
        $this->createTable($pdo);
        $query = $pdo->prepare("DELETE contact WHERE id = :id");
        return $query->execute([
            'id' => 7
        ]);

    }

    private function connectToDatabase(): PDO
    {
        try {
            $pdo = new PDO('sqlite:'.dirname(__FILE__).'database.sqlite');
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $e) {
            echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
            die();
        }
    }

    private function createTable(PDO $pdo)
    {
        $pdo->query("CREATE TABLE IF NOT EXISTS contact (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom VARCHAR(250) NOT NULL,
            prenom VARCHAR(250) NOT NULL,
            email VARCHAR(250) NOT NULL
            )");
    }
}
