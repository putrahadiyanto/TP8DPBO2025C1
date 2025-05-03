<?php
require_once "model/Fakultas.php";
require_once "controller/Controller.php";
require_once "view/fakultas.view.php";

class FakultasController implements Controller{

    private $fakultas;

    public function __construct() {
        $this->fakultas = new Fakultas();
    }

    public function index() {
        $fakultas = $this->fakultas->read();
        $view = new FakultasView();
        $view->renderIndex($fakultas);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $dekan = $_POST['dekan'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $tanggal_didirikan = $_POST['tanggal_didirikan'];
            
            $result = $this->fakultas->create($name, $dekan, $address, $email, $tanggal_didirikan);
            if($result == false) {
                header("Location: index.php?table=fakultas&action=index&message=error");
            } else {
                header("Location: index.php?table=fakultas&action=index&message=success");
            }
        } else {
            $view = new FakultasView();
            $view->renderCreate();
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $dekan = $_POST['dekan'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $tanggal_didirikan = $_POST['tanggal_didirikan'];
            
            $result = $this->fakultas->update($id, $name, $dekan, $address, $email, $tanggal_didirikan);
            if($result == false) {
                header("Location: index.php?table=fakultas&action=index&message=error");
            } else {
                header("Location: index.php?table=fakultas&action=index&message=success");
            }
        } else {
            $fakultas = $this->fakultas->read($id);
            if (!$fakultas) {
                header("Location: index.php?table=fakultas&action=index");
                exit;
            }
            $view = new FakultasView();
            $view->renderEdit($fakultas);
        }
    }

    public function delete($id) {
        $code = $this->fakultas->delete($id);
        if($code == false){
            header("Location: index.php?table=fakultas&action=index&message=error");
        } else {
            header("Location: index.php?table=fakultas&action=index&message=success");
        }
        // header("Location: index.php?table=fakultas&action=index&message=$code");
    }

}

?>