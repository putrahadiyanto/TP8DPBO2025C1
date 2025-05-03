<?php

class FakultasView {

    public function renderIndex($fakultas) {
        include "view/layouts/header.php";

        $message = isset($_GET['message']) ? $_GET['message'] : null;
        if ($message == 'success') {
            echo '<div class="alert alert-success">Sukses</div>';
        } elseif ($message == 'error') {
            echo '<div class="alert alert-danger">Gagal, terpakai di table lain?</div>';
        }

        echo '
            <div class="my-4 mx-5">
                <div class="col-1">
                <a type="button" class="btn btn-primary nav-link active" href="index.php?table=fakultas&action=create">Add New</a>
                </div>
            </div>
            <table class="table mr-6">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>DEKAN</th>
                    <th>ADDRESS</th>
                    <th>EMAIL</th>
                    <th>TANGGAL DIDIRIKAN</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($fakultas as $row) {
            echo "<tr>
                    <th>{$row['id']}</th>
                    <td>{$row['name']}</td>
                    <td>{$row['dekan']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['tanggal_didirikan']}</td>
                    <td>
                        <a class='btn btn-success' href='index.php?table=fakultas&action=update&id={$row['id']}'>Edit</a>
                        <a class='btn btn-danger' href='index.php?table=fakultas&action=delete&id={$row['id']}' onclick='return confirm(\"Apakah anda yakin data ingin dihapus?\");'>Delete</a>
                    </td>
                </tr>";
        }
        echo '  </tbody>
            </table>';
        
        include "view/layouts/footer.php";
    }

    public function renderCreate() {
        include "view/layouts/header.php";

        echo '
        <div class="col-lg-6 m-auto">

            <form method="post" action="index.php?table=fakultas&action=create">
            <br><br>
            <div class="card">

                <div class="card-header bg-primary">
                <h1 class="text-white text-center"> Create Fakultas</h1>
                </div><br>

                <label> NAME: </label>
                <input type="text" name="name" class="form-control" required> <br>

                <label> DEKAN: </label>
                <input type="text" name="dekan" class="form-control" required> <br>

                <label> ADDRESS: </label>
                <input type="text" name="address" class="form-control" required> <br>

                <label> EMAIL: </label>
                <input type="email" name="email" class="form-control"> <br>

                <label> TANGGAL DIDIRIKAN: </label>
                <input type="date" name="tanggal_didirikan" class="form-control"> <br>

                <button class="btn btn-success my-4" type="submit" name="submit">Submit </button><br>
                <a class="btn btn-info" type="submit" name="cancel" href="index.php?table=fakultas&action=index"> Cancel </a><br>

            </div>
            </form>
        </div>';
        
        include "view/layouts/footer.php";
    }

    public function renderEdit($fakultas) {
        include "view/layouts/header.php";
        
        $fak = $fakultas[0];
        
        $id = $fak['id'];
        $name = $fak['name'];
        $dekan = $fak['dekan'];
        $address = $fak['address'];
        $email = $fak['email'];
        $tanggal_didirikan = $fak['tanggal_didirikan'];

        echo '
        <div class="col-lg-6 m-auto">

            <form method="post" action="index.php?table=fakultas&action=update">

            <br><br>
            <div class="card">

                <div class="card-header bg-warning">
                <h1 class="text-white text-center"> Update Fakultas </h1>
                </div><br>

                <input type="hidden" name="id" value="' . $id . '" class="form-control"> <br>

                <label> NAME: </label>
                <input type="text" name="name" value="' . $name . '" class="form-control" required> <br>

                <label> DEKAN: </label>
                <input type="text" name="dekan" value="' . $dekan . '" class="form-control" required> <br>

                <label> ADDRESS: </label>
                <input type="text" name="address" value="' . $address . '" class="form-control" required> <br>

                <label> EMAIL: </label>
                <input type="email" name="email" value="' . $email . '" class="form-control"> <br>

                <label> TANGGAL DIDIRIKAN: </label>
                <input type="date" name="tanggal_didirikan" value="' . $tanggal_didirikan . '" class="form-control"> <br>

                <button class="btn btn-success my-4" type="submit" name="submit"> Submit </button><br>
                <a class="btn btn-info" type="submit" name="cancel" href="index.php?table=fakultas&action=index"> Cancel </a><br>

            </div>
            </form>
        </div>
        ';

        include "view/layouts/footer.php";
    }

}

?>