<?php
require_once "model/Database.php";

class Students extends Database {

    public function __construct()
    {
        parent::__construct();
    }

    public function create($name, $nim, $phone, $join_date, $id_jurusan)
    {
        try {
            $sql = "INSERT INTO students (name, nim, phone, join_date, id_jurusan) VALUES (:name, :nim, :phone, :join_date, :id_jurusan)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':nim', $nim);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':join_date', $join_date);
            $stmt->bindParam(':id_jurusan', $id_jurusan);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function read($id = null)
    {
        if ($id) {
            $sql = "SELECT students.*, jurusan.id AS jurusan_id, jurusan.name AS jurusan_name FROM students 
            JOIN jurusan ON students.id_jurusan = jurusan.id 
            WHERE students.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
        } else {
            $sql = "SELECT students.*, jurusan.id AS jurusan_id, jurusan.name AS jurusan_name FROM students 
            JOIN jurusan ON students.id_jurusan = jurusan.id";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $nim, $phone, $join_date, $id_jurusan)
    {
        try {
            $sql = "UPDATE students SET name = :name, nim = :nim, phone = :phone, join_date = :join_date, id_jurusan = :id_jurusan WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':nim', $nim);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':join_date', $join_date);
            $stmt->bindParam(':id_jurusan', $id_jurusan);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM students WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }
    
}

?>