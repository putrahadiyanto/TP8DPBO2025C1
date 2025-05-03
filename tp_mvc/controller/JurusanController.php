<?php
require_once "model/Jurusan.php";
require_once "controller/Controller.php";
require_once "view/jurusan.view.php";

class JurusanController implements Controller
{
    private $jurusan;

    public function __construct()
    {
        $this->jurusan = new Jurusan();
    }

    public function index() {
        $jurusan = $this->jurusan->read();
        $view = new JurusanView();
        $view->renderIndex($jurusan);
    }

    public function create() {
        require_once "model/Fakultas.php";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $kaprodi = $_POST['kaprodi'];
            $akreditasi = $_POST['akreditasi'];
            $tanggal_didirikan = $_POST['tanggal_didirikan'];
            $email = $_POST['email'];
            $id_fakultas = $_POST['id_fakultas'];
            
            $result = $this->jurusan->create($name, $kaprodi, $akreditasi, $tanggal_didirikan, $email, $id_fakultas);
            if($result == false) {
                header("Location: index.php?table=jurusan&action=index&message=error");
            } else {
                header("Location: index.php?table=jurusan&action=index&message=success");
            }
        } else {
            $fakultas = new Fakultas();
            $fakultas_list = $fakultas->read();
            $view = new JurusanView();
            $view->renderCreate($fakultas_list);
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $kaprodi = $_POST['kaprodi'];
            $akreditasi = $_POST['akreditasi'];
            $tanggal_didirikan = $_POST['tanggal_didirikan'];
            $email = $_POST['email'];
            $id_fakultas = $_POST['id_fakultas'];
            
            $result = $this->jurusan->update($id, $name, $kaprodi, $akreditasi, $tanggal_didirikan, $email, $id_fakultas);
            if($result == false) {
                header("Location: index.php?table=jurusan&action=index&message=error");
            } else {
                header("Location: index.php?table=jurusan&action=index&message=success");
            }
        } else {
            require_once "model/Fakultas.php";
            $view = new JurusanView();
            $fakultas = new Fakultas();
            $jurusan = $this->jurusan->read($id);
            $fakultas_list = $fakultas->read();
            $view->renderEdit($jurusan, $fakultas_list);
        }
    }

    public function delete($id) {
        $code = $this->jurusan->delete($id);
        if($code == false){
            header("Location: index.php?table=jurusan&action=index&message=error");
        } else {
            header("Location: index.php?table=jurusan&action=index&message=success");
        }
    }
}
?>
