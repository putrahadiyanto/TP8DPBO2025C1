<?php

require_once "model/Database.php";

class Fakultas extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($name, $dekan, $address, $email, $tanggal_didirikan)
    {
        try {
            $sql = "INSERT INTO fakultas (name, dekan, address, email, tanggal_didirikan) VALUES (:name, :dekan, :address, :email, :tanggal_didirikan)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':dekan', $dekan);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':tanggal_didirikan', $tanggal_didirikan);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function read($id = null)
    {
        if ($id) {
            $sql = "SELECT * FROM fakultas WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
        } else {
            $sql = "SELECT * FROM fakultas";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $dekan, $address, $email, $tanggal_didirikan)
    {
        try {
            $sql = "UPDATE fakultas SET name = :name, dekan = :dekan, address = :address, email = :email, tanggal_didirikan = :tanggal_didirikan WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':dekan', $dekan);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':tanggal_didirikan', $tanggal_didirikan);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            // First check if there are related records in jurusan
            $sql = "SELECT COUNT(*) FROM jurusan WHERE id_fakultas = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            if ($stmt->fetchColumn() > 0) {
                // Cannot delete if there are related records
                return false;
            }
            
            // If no related records, proceed with deletion
            $sql = "DELETE FROM fakultas WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>