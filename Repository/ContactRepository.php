<?php

namespace Repository;
require_once "Entity/Contact.php";
require_once "mesClass/CountErrorException.php";
use PDO;
use Exception;
use Entity\Contact;
class ContactRepository
{
    public function findAll(): array
    {
        $pdo = $this->connectToDatabase();
        $this->createTable($pdo);
        $query = $pdo->query("SELECT * FROM contact");
        return $query->fetchAll();
    }

    public function getLastRow(): array
    {
        $pdo = $this->connectToDatabase();
        $this->createTable($pdo);
        $query = $pdo->query("SELECT * FROM contact ORDER BY id DESC LIMIT 1");
        return $query->fetchAll();
    }
    public function count(): int
    {
        $pdo = $this->connectToDatabase();
        $this->createTable($pdo);
        $query = $pdo->query("SELECT COUNT(*) FROM contact");
        $total = $query->fetchColumn();
        return $total;
    }

    public function compareCount(int $firstCount, int $secondCount)
    {
        if ($secondCount == $firstCount + 1) {
            return "L'insertion semble avoir fonctionner, le nombre de ligne est passé de $firstCount à $secondCount";
        }
    // throw new Exception\CountErrorException();
    }

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

    public function delete(int $id)
    {
        $pdo = $this->connectToDatabase();
        $this->createTable($pdo);
        $query = $pdo->prepare("DELETE FROM contact WHERE id = :id");
        return $query->execute([
            'id' => $id
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
