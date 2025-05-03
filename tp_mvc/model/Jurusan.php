<?php
require_once 'model/Database.php';

class Jurusan extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function create($name, $kaprodi, $akreditasi, $tanggal_didirikan, $email, $id_fakultas)
    {
        try {
            $sql = "INSERT INTO jurusan (name, kaprodi, akreditasi, tanggal_didirikan, email, id_fakultas) VALUES (:name, :kaprodi, :akreditasi, :tanggal_didirikan, :email, :id_fakultas)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':kaprodi', $kaprodi);
            $stmt->bindParam(':akreditasi', $akreditasi);
            $stmt->bindParam(':tanggal_didirikan', $tanggal_didirikan);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id_fakultas', $id_fakultas);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function read($id = null)
    {
        try {
            if ($id) {
                $sql = "SELECT jurusan.*, fakultas.name AS fakultas_name FROM jurusan
                JOIN fakultas ON jurusan.id_fakultas = fakultas.id WHERE jurusan.id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id);
            } else {
                $sql = "SELECT jurusan.*, fakultas.name AS fakultas_name FROM jurusan
                JOIN fakultas ON jurusan.id_fakultas = fakultas.id";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update($id, $name, $kaprodi, $akreditasi, $tanggal_didirikan, $email, $id_fakultas)
    {
        try {
            $sql = "UPDATE jurusan SET name = :name, kaprodi = :kaprodi, akreditasi = :akreditasi, tanggal_didirikan = :tanggal_didirikan, email = :email, id_fakultas = :id_fakultas WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':kaprodi', $kaprodi);
            $stmt->bindParam(':akreditasi', $akreditasi);
            $stmt->bindParam(':tanggal_didirikan', $tanggal_didirikan);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id_fakultas', $id_fakultas);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            // First check if there are related records in students
            $sql = "SELECT COUNT(*) FROM students WHERE id_jurusan = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            if ($stmt->fetchColumn() > 0) {
                // Cannot delete if there are related records
                return false;
            }
            
            // If no related records, proceed with deletion
            $sql = "DELETE FROM jurusan WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>

