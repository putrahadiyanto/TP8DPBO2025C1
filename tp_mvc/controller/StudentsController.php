<?php
require_once "model/Students.php";
require_once "controller/Controller.php";
require_once "view/students.view.php";

class StudentsController implements Controller
{
    private $students;

    public function __construct()
    {
        $this->students = new Students();
    }

    public function index() {
        $students = $this->students->read();
        $view = new StudentsView();
        $view->renderIndex($students);
    }

    public function create() {
        require_once "model/Jurusan.php";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $nim = $_POST['nim'];
            $phone = $_POST['phone'];
            $join_date = $_POST['join_date'];
            $id_jurusan = $_POST['id_jurusan'];
            
            $result = $this->students->create($name, $nim, $phone, $join_date, $id_jurusan);
            if($result == false) {
                header("Location: index.php?table=students&action=index&message=error");
            } else {
                header("Location: index.php?table=students&action=index&message=success");
            }
        } else {
            $jurusan = new Jurusan();
            $jurusan_list = $jurusan->read();
            $view = new StudentsView();
            $view->renderCreate($jurusan_list);
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $nim = $_POST['nim'];
            $phone = $_POST['phone'];
            $join_date = $_POST['join_date'];
            $id_jurusan = $_POST['id_jurusan'];
            
            $result = $this->students->update($id, $name, $nim, $phone, $join_date, $id_jurusan);
            if($result == false) {
                header("Location: index.php?table=students&action=index&message=error");
            } else {
                header("Location: index.php?table=students&action=index&message=success");
            }
        } else {
            require_once "model/Jurusan.php";
            $view = new StudentsView();
            $jurusan = new Jurusan();
            $student = $this->students->read($id);
            $jurusan_list = $jurusan->read();
            $view->renderEdit($student, $jurusan_list);
        }
    }

    public function delete($id) {
        $code = $this->students->delete($id);
        if($code == false){
            header("Location: index.php?table=students&action=index&message=error");
        } else {
            header("Location: index.php?table=students&action=index&message=success");
        }
    }

}

?>